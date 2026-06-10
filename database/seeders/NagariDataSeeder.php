<?php

namespace Database\Seeders;

use App\Models\Stat;
use App\Models\Product;
use App\Models\WhyChooseUs;
use App\Models\Testimonial;
use App\Models\PricingPlan;
use App\Models\PricingFeature;
use App\Models\Faq;
use App\Models\AboutSection;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class NagariDataSeeder extends Seeder
{
    public function run(): void
    {
        // ===== SETTINGS =====
        Setting::set('site_name', 'Nagari Digital');
        Setting::set('tagline', 'Platform Digital Terintegrasi untuk Pemerintahan Nagari');
        Setting::set('logo_icon', 'fa-leaf');
        Setting::set('footer_desc', 'Platform digital terintegrasi untuk pemerintahan Nagari/Desa di seluruh Indonesia. Mewujudkan tata kelola pemerintahan yang modern, transparan, dan efisien.');
        Setting::set('whatsapp', '6282284186104');
        Setting::set('email', 'info@nagaridigital.web.id');
        Setting::set('location', 'Sumatera Barat, Indonesia');
        Setting::set('social_facebook', '#');
        Setting::set('social_instagram', '#');
        Setting::set('social_youtube', '#');
        Setting::set('seo_description', 'Nagari Digital — Platform digital terintegrasi untuk pemerintahan Nagari/Desa. Website resmi, aplikasi pelayanan kependudukan, pendataan penduduk, posyandu, dan manajemen jorong.');
        Setting::set('seo_keywords', 'Nagari digital, desa digital, website desa, aplikasi desa, pelayanan kependudukan, posyandu digital');
        Setting::set('demo_email', 'admin@demo.id');
        Setting::set('demo_password', 'demo1234');
        Setting::set('demo_url', 'https://kuamangalai-ug.nagaridigital.web.id/');

        // ===== HERO SETTINGS =====
        Setting::set('hero_badge', 'Platform #1 Digitalisasi Nagari di Indonesia');
        Setting::set('hero_title', 'Solusi Digital <span class="highlight">Terintegrasi</span> untuk Pemerintahan Nagari');
        Setting::set('hero_subtitle', 'Kelola administrasi, data penduduk, pelayanan kependudukan, posyandu, dan website Nagari Anda dalam satu platform yang mudah dan modern.');
        Setting::set('hero_primary_btn_text', 'Lihat Paket Harga');
        Setting::set('hero_primary_btn_link', 'harga');
        Setting::set('hero_primary_btn_icon', 'fa-rocket');
        Setting::set('hero_secondary_btn_text', 'Lihat Demo');
        Setting::set('hero_secondary_btn_link', 'https://kuamangalai-ug.nagaridigital.web.id/');
        Setting::set('hero_secondary_btn_icon', 'fa-eye');
        Setting::set('hero_scroll_text', 'Scroll ke bawah');

        // ===== STATS =====
        $stats = [
            ['icon' => 'fa-puzzle-piece', 'count' => 5, 'suffix' => '+', 'label' => 'Aplikasi Terintegrasi', 'order' => 1],
            ['icon' => 'fa-building-columns', 'count' => 50, 'suffix' => '+', 'label' => 'Nagari Terdaftar', 'order' => 2],
            ['icon' => 'fa-shield-halved', 'count' => 99.9, 'suffix' => '%', 'label' => 'Uptime Terjamin', 'order' => 3],
            ['icon' => 'fa-headset', 'count' => 24, 'suffix' => '/7', 'label' => 'Support Teknis', 'order' => 4],
        ];
        foreach ($stats as $s) {
            Stat::create($s);
        }

        // ===== PRODUCTS =====
        $products = [
            [
                'icon' => 'fa-file-contract', 'title' => 'Pelayanan Kependudukan',
                'description' => 'Layanan administrasi kependudukan digital untuk pembuatan Surat Keterangan, dan surat-surat penting lainnya.',
                'features' => ['Pembuatan surat otomatis', 'Database kependudukan', 'Tracking status pengajuan'],
                'link' => 'fitur#pelayanan', 'color' => 'green', 'order' => 1,
            ],
            [
                'icon' => 'fa-map-location-dot', 'title' => 'Aplikasi Jorong',
                'description' => 'Manajemen data dan administrasi tingkat jorong yang terintegrasi dengan sistem Nagari.',
                'features' => ['Data jorong real-time', 'Laporan periodik otomatis', 'Sinkronisasi data Nagari'],
                'link' => 'fitur#jorong', 'color' => 'blue', 'order' => 2,
            ],
            [
                'icon' => 'fa-users-rectangle', 'title' => 'Pendataan Penduduk',
                'description' => 'Sistem pencatatan dan pendataan penduduk yang akurat, lengkap, dan mudah diakses.',
                'features' => ['Input data terstruktur', 'Statistik demografi', 'Export laporan & grafik'],
                'link' => 'fitur#pendataan', 'color' => 'purple', 'order' => 3,
            ],
            [
                'icon' => 'fa-heart-pulse', 'title' => 'Aplikasi Posyandu',
                'description' => 'Pencatatan kesehatan balita dan lansia, jadwal posyandu, dan monitoring pertumbuhan anak.',
                'features' => ['Kartu Menuju Sehat (KMS)', 'Jadwal imunisasi', 'Monitoring gizi balita'],
                'link' => 'fitur#posyandu', 'color' => 'rose', 'order' => 4,
            ],
            [
                'icon' => 'fa-globe', 'title' => 'Website Nagari',
                'description' => 'Portal informasi resmi Nagari yang profesional dengan berita, profil, galeri, dan layanan publik.',
                'features' => ['Desain modern & responsif', 'CMS mudah dikelola', 'SEO optimized'],
                'link' => 'fitur#website', 'color' => 'teal', 'order' => 5,
            ],
        ];
        foreach ($products as $p) {
            Product::create($p);
        }

        // ===== WHY CHOOSE US =====
        $why = [
            ['icon' => 'fa-gauge-high', 'title' => 'Mudah Digunakan', 'description' => 'Interface yang intuitif dan user-friendly, tidak perlu keahlian teknis untuk mengoperasikannya.', 'order' => 1],
            ['icon' => 'fa-puzzle-piece', 'title' => 'Terintegrasi', 'description' => 'Semua aplikasi saling terhubung dalam satu ekosistem, data selalu sinkron dan konsisten.', 'order' => 2],
            ['icon' => 'fa-shield-halved', 'title' => 'Aman & Terpercaya', 'description' => 'Data tersimpan aman dengan enkripsi standar industri dan backup otomatis setiap hari.', 'order' => 3],
            ['icon' => 'fa-wallet', 'title' => 'Harga Terjangkau', 'description' => 'Paket harga yang fleksibel dan terjangkau, mulai dari Rp 450.000/bulan untuk nagari kecil.', 'order' => 4],
            ['icon' => 'fa-headset', 'title' => 'Support 24/7', 'description' => 'Tim support siap membantu kapan saja melalui WhatsApp, telepon, dan remote assistance.', 'order' => 5],
            ['icon' => 'fa-arrows-rotate', 'title' => 'Update Berkala', 'description' => 'Fitur terus diperbarui mengikuti regulasi terbaru dan masukan dari pengguna.', 'order' => 6],
        ];
        foreach ($why as $w) {
            WhyChooseUs::create($w);
        }

        // ===== TESTIMONIALS =====
        $testimonials = [
            ['name' => 'Wali Nagari', 'role' => 'Wali Nagari', 'village' => 'Nagari Kuamang Alai Ujung Gading', 'text' => 'Sejak menggunakan Nagari Digital, pelayanan administrasi di nagari kami menjadi jauh lebih cepat dan efisien. Warga sangat terbantu.', 'rating' => 5, 'avatar' => 'WN'],
            ['name' => 'Sekretaris Nagari', 'role' => 'Sekretaris Nagari', 'village' => 'Nagari Pelangiran', 'text' => 'Pendataan penduduk yang dulunya memakan waktu berhari-hari, sekarang bisa selesai dalam hitungan jam. Sangat recommended!', 'rating' => 5, 'avatar' => 'SK'],
            ['name' => 'Kader Posyandu', 'role' => 'Kader Posyandu', 'village' => 'Nagari Sungai Aua', 'text' => 'Aplikasi Posyandu sangat membantu kader dalam mencatat tumbuh kembang balita. Data jadi rapi dan bisa diakses kapan saja.', 'rating' => 4.5, 'avatar' => 'KP'],
        ];
        foreach ($testimonials as $t) {
            Testimonial::create($t);
        }

        // ===== PRICING PLANS =====
        $dasar = PricingPlan::create([
            'key' => 'dasar', 'name' => 'Paket Dasar', 'icon' => 'fa-seedling',
            'tagline' => 'Untuk nagari yang baru memulai digitalisasi',
            'price' => ['bulanan' => 450000, '6bulan' => 2250000, 'tahunan' => 4050000],
            'period_label' => ['bulanan' => '/bulan', '6bulan' => '/6 bulan', 'tahunan' => '/tahun'],
            'savings' => ['bulanan' => '', '6bulan' => 'Hemat 17%', 'tahunan' => 'Hemat 26%'],
            'popular' => false, 'apps' => ['Pelayanan Kependudukan', 'Aplikasi Jorong'], 'order' => 1,
        ]);

        $komplet = PricingPlan::create([
            'key' => 'komplet', 'name' => 'Paket Komplet', 'icon' => 'fa-crown',
            'tagline' => 'Solusi lengkap untuk nagari yang serius berdigitalisasi',
            'price' => ['bulanan' => 9500000, '6bulan' => 9500000, 'tahunan' => 9500000],
            'period_label' => ['bulanan' => '/tahun', '6bulan' => '/tahun', 'tahunan' => '/tahun'],
            'savings' => ['bulanan' => 'Termasuk server', '6bulan' => 'Termasuk server', 'tahunan' => 'Termasuk server'],
            'popular' => true,
            'apps' => ['Pelayanan Kependudukan', 'Aplikasi Jorong', 'Pendataan Penduduk', 'Aplikasi Posyandu', 'Website Nagari'],
            'order' => 2,
        ]);

        $lepas = PricingPlan::create([
            'key' => 'lepas', 'name' => 'Paket Lepas', 'icon' => 'fa-rocket',
            'tagline' => 'Beli putus, kelola sendiri sepenuhnya',
            'price' => ['bulanan' => 15000000, '6bulan' => 15000000, 'tahunan' => 15000000],
            'period_label' => ['bulanan' => 'sekali bayar', '6bulan' => 'sekali bayar', 'tahunan' => 'sekali bayar'],
            'savings' => ['bulanan' => 'Full ownership', '6bulan' => 'Full ownership', 'tahunan' => 'Full ownership'],
            'popular' => false,
            'apps' => ['Pelayanan Kependudukan', 'Aplikasi Jorong', 'Pendataan Penduduk', 'Aplikasi Posyandu', 'Website Nagari'],
            'order' => 3,
        ]);

        // ===== PRICING FEATURES =====
        $dasarFeatures = [
            ['text' => 'Surat kependudukan otomatis', 'included' => true, 'order' => 1],
            ['text' => 'Database penduduk dasar', 'included' => true, 'order' => 2],
            ['text' => 'Dashboard jorong', 'included' => true, 'order' => 3],
            ['text' => 'Laporan bulanan', 'included' => true, 'order' => 4],
            ['text' => 'Support via WhatsApp', 'included' => true, 'order' => 5],
            ['text' => 'Backup harian', 'included' => true, 'order' => 6],
            ['text' => 'Update sistem berkala', 'included' => true, 'order' => 7],
            ['text' => 'Pendataan Penduduk', 'included' => false, 'order' => 8],
            ['text' => 'Aplikasi Posyandu', 'included' => false, 'order' => 9],
            ['text' => 'Website Nagari', 'included' => false, 'order' => 10],
            ['text' => 'Sewa server', 'included' => false, 'order' => 11],
            ['text' => 'Custom domain', 'included' => false, 'order' => 12],
        ];
        foreach ($dasarFeatures as $f) {
            PricingFeature::create(array_merge($f, ['plan_key' => 'dasar']));
        }

        $kompletFeatures = [
            ['text' => 'Semua fitur Paket Dasar', 'included' => true, 'order' => 1],
            ['text' => 'Pendataan Penduduk lengkap', 'included' => true, 'order' => 2],
            ['text' => 'Aplikasi Posyandu', 'included' => true, 'order' => 3],
            ['text' => 'Website Nagari profesional', 'included' => true, 'order' => 4],
            ['text' => 'Sewa server included', 'included' => true, 'order' => 5],
            ['text' => 'Custom domain .nagaridigital.web.id', 'included' => true, 'order' => 6],
            ['text' => 'SSL certificate gratis', 'included' => true, 'order' => 7],
            ['text' => 'Priority support 24/7', 'included' => true, 'order' => 8],
            ['text' => 'Training tim nagari', 'included' => true, 'order' => 9],
            ['text' => 'Backup otomatis harian', 'included' => true, 'order' => 10],
            ['text' => 'Update & maintenance', 'included' => true, 'order' => 11],
        ];
        foreach ($kompletFeatures as $f) {
            PricingFeature::create(array_merge($f, ['plan_key' => 'komplet']));
        }

        $lepasFeatures = [
            ['text' => 'Semua fitur Paket Komplet', 'included' => true, 'order' => 1],
            ['text' => 'Source code diberikan penuh', 'included' => true, 'order' => 2],
            ['text' => 'Client hosting sendiri', 'included' => true, 'order' => 3],
            ['text' => 'Custom domain bebas', 'included' => true, 'order' => 4],
            ['text' => 'Full ownership & hak cipta', 'included' => true, 'order' => 5],
            ['text' => 'Panduan teknis lengkap', 'included' => true, 'order' => 6],
            ['text' => 'Support instalasi awal', 'included' => true, 'order' => 7],
            ['text' => 'Training komprehensif', 'included' => true, 'order' => 8],
            ['text' => 'Bebas modifikasi', 'included' => true, 'order' => 9],
            ['text' => 'Sewa server (client tanggung)', 'included' => false, 'order' => 10],
            ['text' => 'Maintenance berkelanjutan', 'included' => false, 'order' => 11],
        ];
        foreach ($lepasFeatures as $f) {
            PricingFeature::create(array_merge($f, ['plan_key' => 'lepas']));
        }

        // ===== FAQS =====
        $faqs = [
            [
                'icon' => 'fa-server', 'question' => 'Apa yang termasuk dalam sewa server?',
                'answer' => '<p>Sewa server yang termasuk dalam <strong>Paket Komplet</strong> mencakup:</p><ul><li>VPS/Cloud server berkualitas tinggi</li><li>Bandwidth dan storage memadai</li><li>SSL certificate untuk keamanan</li><li>Maintenance server rutin</li><li>Monitoring uptime 24/7</li><li>Backup otomatis harian</li></ul>',
                'order' => 1,
            ],
            [
                'icon' => 'fa-cart-shopping', 'question' => 'Bagaimana cara berlangganan?',
                'answer' => '<p>Proses berlangganan sangat mudah:</p><ol><li>Hubungi kami via WhatsApp atau email</li><li>Pilih paket yang sesuai</li><li>Lakukan pembayaran via transfer bank</li><li>Proses setup oleh tim kami (1-3 hari)</li><li>Training penggunaan untuk tim nagari</li><li>Go live!</li></ol>',
                'order' => 2,
            ],
            [
                'icon' => 'fa-arrow-up-right-dots', 'question' => 'Apakah bisa upgrade paket?',
                'answer' => '<p><strong>Ya, tentu bisa!</strong> Anda dapat upgrade paket kapan saja. Biaya dihitung secara prorata berdasarkan sisa masa berlangganan.</p>',
                'order' => 3,
            ],
            [
                'icon' => 'fa-money-bill-wave', 'question' => 'Apakah ada biaya setup?',
                'answer' => '<p><strong>Tidak ada biaya setup!</strong> Semua biaya sudah termasuk dalam harga paket. Instalasi, import data awal, training, dan kustomisasi awal GRATIS.</p>',
                'order' => 4,
            ],
            [
                'icon' => 'fa-right-from-bracket', 'question' => 'Bagaimana jika ingin berhenti berlangganan?',
                'answer' => '<p>Anda bebas berhenti kapan saja tanpa penalti. Informasikan minimal 30 hari sebelumnya. Data akan kami backup dan serahkan.</p>',
                'order' => 5,
            ],
            [
                'icon' => 'fa-shield-halved', 'question' => 'Apakah data aman?',
                'answer' => '<p><strong>Keamanan data prioritas utama kami.</strong> Enkripsi SSL/TLS, backup harian, server terisolasi, firewall, akses role-based, dan audit log.</p>',
                'order' => 6,
            ],
            [
                'icon' => 'fa-clock', 'question' => 'Berapa lama proses instalasi?',
                'answer' => '<p>Paket Dasar: 1-2 hari, Paket Komplet: 3-5 hari, Paket Lepas: 5-7 hari (termasuk deployment & training).</p>',
                'order' => 7,
            ],
            [
                'icon' => 'fa-medal', 'question' => 'Apakah ada garansi?',
                'answer' => '<p><strong>Ya, garansi 30 hari uang kembali!</strong> Juga garansi uptime 99.9% dan garansi bug-free.</p>',
                'order' => 8,
            ],
        ];
        foreach ($faqs as $f) {
            Faq::create($f);
        }

        // ===== ABOUT SECTIONS =====
        AboutSection::create([
            'type' => 'story_paragraphs',
            'content' => [
                'Nagari Digital lahir dari keprihatinan terhadap kondisi administrasi pemerintahan nagari di Indonesia — khususnya di Sumatera Barat — yang masih sangat bergantung pada proses manual. Pencatatan data penduduk di buku tebal, pembuatan surat yang memakan waktu berjam-jam, dan arsip yang mudah rusak menjadi masalah sehari-hari.',
                'Berangkat dari pengalaman langsung, kami bertekad menciptakan solusi digital yang benar-benar sesuai dengan kebutuhan pemerintahan nagari. Bukan sekadar teknologi yang rumit dan mahal, melainkan platform yang mudah digunakan, terjangkau, dan terintegrasi penuh.',
                'Hari ini, Nagari Digital telah menjadi mitra terpercaya bagi puluhan nagari di Sumatera Barat, membantu mereka bertransformasi dari administrasi konvensional menuju tata kelola pemerintahan yang modern dan transparan.',
            ],
            'order' => 1,
        ]);

        AboutSection::create([
            'type' => 'story_highlight',
            'content' => 'Kami percaya bahwa setiap nagari di Indonesia berhak mendapatkan akses terhadap teknologi yang memudahkan pelayanan publik — tanpa terkecuali.',
            'order' => 2,
        ]);

        AboutSection::create([
            'type' => 'vision',
            'label' => 'Visi Kami',
            'content' => 'Menjadi platform digitalisasi pemerintahan nagari/desa terdepan di Indonesia yang menghadirkan kemudahan, efisiensi, dan transparansi dalam tata kelola pemerintahan desa untuk seluruh masyarakat Indonesia.',
            'order' => 3,
        ]);

        AboutSection::create([
            'type' => 'missions',
            'content' => [
                ['icon' => 'fa-laptop-code', 'text' => 'Menyediakan teknologi yang mudah digunakan untuk pemerintahan nagari.'],
                ['icon' => 'fa-rocket', 'text' => 'Meningkatkan efisiensi pelayanan publik melalui otomasi dan digitalisasi.'],
                ['icon' => 'fa-database', 'text' => 'Membangun ekosistem data yang terintegrasi dan aman.'],
                ['icon' => 'fa-coins', 'text' => 'Memberikan harga yang terjangkau untuk semua nagari.'],
            ],
            'order' => 4,
        ]);

        AboutSection::create([
            'type' => 'values',
            'content' => [
                ['id' => 1, 'icon' => 'fa-lightbulb', 'title' => 'Inovasi', 'desc' => 'Terus mengembangkan fitur dan teknologi terbaru untuk memenuhi kebutuhan nagari.'],
                ['id' => 2, 'icon' => 'fa-shield-halved', 'title' => 'Integritas', 'desc' => 'Menjaga keamanan dan privasi data pengguna sebagai prioritas utama.'],
                ['id' => 3, 'icon' => 'fa-handshake', 'title' => 'Kolaborasi', 'desc' => 'Bekerja sama erat dengan pemerintah daerah dan stakeholder.'],
                ['id' => 4, 'icon' => 'fa-wand-magic-sparkles', 'title' => 'Kesederhanaan', 'desc' => 'Teknologi canggih dalam antarmuka sederhana dan mudah digunakan.'],
                ['id' => 5, 'icon' => 'fa-wallet', 'title' => 'Keterjangkauan', 'desc' => 'Harga yang bisa dijangkau semua nagari tanpa terkecuali.'],
                ['id' => 6, 'icon' => 'fa-seedling', 'title' => 'Keberlanjutan', 'desc' => 'Komitmen jangka panjang dalam mendampingi perjalanan transformasi digital.'],
            ],
            'order' => 5,
        ]);

        AboutSection::create([
            'type' => 'timeline',
            'content' => [
                ['year' => '2024', 'title' => 'Ide Awal & Pengembangan Prototype', 'desc' => 'Riset mendalam, pengembangan konsep, dan pembuatan prototype awal aplikasi.', 'status' => 'done'],
                ['year' => '2025', 'title' => 'Peluncuran Versi Beta', 'desc' => 'Peluncuran beta untuk nagari pertama, pengujian lapangan, dan penyempurnaan fitur.', 'status' => 'done'],
                ['year' => '2026', 'title' => 'Peluncuran Resmi — 5 Aplikasi Terintegrasi', 'desc' => 'Platform lengkap dengan 5 aplikasi terintegrasi. Ekspansi ke lebih banyak nagari.', 'status' => 'current'],
                ['year' => '2027', 'title' => 'Target 100+ Nagari se-Indonesia', 'desc' => 'Ekspansi nasional, pengembangan fitur AI, dan integrasi sistem pemerintah kabupaten/kota.', 'status' => 'future'],
            ],
            'order' => 6,
        ]);
    }
}
