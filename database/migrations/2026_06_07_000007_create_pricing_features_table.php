<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pricing_features', function (Blueprint $table) {
            $table->id();
            $table->string('plan_key');
            $table->string('text');
            $table->boolean('included')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->index('plan_key');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pricing_features');
    }
};
