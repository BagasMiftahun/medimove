<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('perpindahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('formasi_awal')->constrained('formasis')->onDelete('cascade');
            $table->foreignId('formasi_tujuan')->constrained('formasis')->onDelete('cascade');
            $table->string('keterangan')->nullable();
            $table->bigInteger('nomor')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perpindahans');
    }
};
