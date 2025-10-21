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
        Schema::create('t_product', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255);
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 15, 2)->default(0);
            $table->string('kategori', 100)->nullable();
            $table->string('sub_kategori', 100)->nullable();
            $table->string('satuan', 50)->nullable();
            $table->integer('min_pembelian')->default(1);
            $table->string('dimensi_unit', 100)->nullable();
            $table->decimal('berat', 10, 2)->nullable();
            $table->string('merk', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_product');
    }
};
