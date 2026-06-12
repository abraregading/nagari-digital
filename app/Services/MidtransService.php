<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    protected string $serverKey;
    protected string $baseUrl;

    public function __construct()
    {
        $this->serverKey = config('midtrans.server_key');
        $isProduction = config('midtrans.is_production', false);
        $this->baseUrl = $isProduction
            ? 'https://app.midtrans.com'
            : 'https://app.sandbox.midtrans.com';
    }

    public function getSnapToken(array $params): string
    {
        if (empty($this->serverKey)) {
            throw new Exception('Midtrans server key tidak dikonfigurasi.');
        }

        $auth = base64_encode($this->serverKey . ':');
        $jsonBody = json_encode($params);
        $url = $this->baseUrl . '/snap/v1/transactions';
        $headers = [
            'Authorization: Basic ' . $auth,
            'Content-Type: application/json',
            'Accept: application/json',
        ];

        if (function_exists('curl_init')) {
            return $this->getSnapTokenCurl($url, $jsonBody, $headers);
        }

        return $this->getSnapTokenFileGetContents($url, $jsonBody, $headers);
    }

    private function getSnapTokenCurl(string $url, string $jsonBody, array $headers): string
    {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $jsonBody,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            Log::error('Midtrans cURL error: ' . $error);
            throw new Exception('Gagal terhubung ke gateway pembayaran.');
        }

        return $this->parseSnapResponse($response, $httpCode);
    }

    private function getSnapTokenFileGetContents(string $url, string $jsonBody, array $headers): string
    {
        $context = stream_context_create([
            'http' => [
                'method' => 'POST',
                'header' => implode("\r\n", $headers),
                'content' => $jsonBody,
                'timeout' => 30,
                'ignore_errors' => true,
            ],
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]);

        $response = @file_get_contents($url, false, $context);

        if ($response === false) {
            $error = error_get_last();
            Log::error('Midtrans stream error: ' . ($error['message'] ?? 'unknown'));
            throw new Exception('Gagal terhubung ke gateway pembayaran.');
        }

        $httpCode = 0;
        if (isset($http_response_header)) {
            preg_match('#HTTP/\d\.\d\s+(\d+)#', $http_response_header[0], $m);
            $httpCode = (int) ($m[1] ?? 0);
        }

        return $this->parseSnapResponse($response, $httpCode);
    }

    private function parseSnapResponse(string $response, int $httpCode): string
    {
        if ($httpCode >= 400 || $httpCode === 0) {
            Log::error('Midtrans API HTTP ' . $httpCode . ': ' . $response);

            if ($httpCode === 401) {
                throw new Exception('Konfigurasi pembayaran tidak valid. Hubungi administrator.');
            }

            throw new Exception('Gagal memproses pembayaran. Silakan coba lagi.');
        }

        $body = json_decode($response, true);

        if (empty($body['token'])) {
            Log::error('Midtrans response: ' . $response);
            throw new Exception('Gagal mendapatkan token pembayaran.');
        }

        return $body['token'];
    }

    public function verifyNotification(array $payload): array
    {
        $orderId = $payload['order_id'] ?? null;
        $statusCode = $payload['status_code'] ?? null;
        $grossAmount = $payload['gross_amount'] ?? null;
        $signatureKey = $payload['signature_key'] ?? '';

        $signature = hash('sha512', $orderId . $statusCode . $grossAmount . $this->serverKey);

        if ($signature !== $signatureKey) {
            Log::warning('Midtrans invalid signature for order: ' . ($orderId ?? 'unknown'));
            throw new Exception('Signature key tidak valid.');
        }

        $vaNumbers = $payload['va_numbers'] ?? [];
        $paymentChannel = null;

        if (!empty($vaNumbers[0]['bank'])) {
            $paymentChannel = $vaNumbers[0]['bank'] . ' - ' . ($vaNumbers[0]['va_number'] ?? '');
        } elseif (!empty($payload['payment_code'])) {
            $paymentChannel = $payload['payment_code'];
        } elseif (!empty($payload['store'])) {
            $paymentChannel = $payload['store'];
        } elseif (!empty($payload['bank'])) {
            $paymentChannel = $payload['bank'];
        } else {
            $paymentChannel = $payload['payment_type'] ?? null;
        }

        return [
            'order_id' => $orderId,
            'transaction_status' => $payload['transaction_status'] ?? '',
            'fraud_status' => $payload['fraud_status'] ?? 'accept',
            'payment_type' => $payload['payment_type'] ?? '',
            'transaction_id' => $payload['transaction_id'] ?? '',
            'payment_channel' => $paymentChannel,
            'payload' => $payload,
        ];
    }
}
