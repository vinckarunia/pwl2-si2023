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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_category_id')->nullable()->index();
            $table->foreignId('supplier_id')->nullable()->index();
            $table->string('image');
            $table->string('title');
            $table->text('description');
            $table->bigInteger('price');
            $table->integer('stock')->default(0);
            $table->timestamps();
        });

        Schema::create('category_product', function (Blueprint $table) {
            $table->id();
            $table->string('product_category_name');
            $table->timestamps();
        });

        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_supplier');
            $table->string('pic_supplier');
            $table->string('alamat_supplier');
            $table->string('no_hp_pic_supplier');
            $table->timestamps();
        });

        Schema::create('transaksi_penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kasir');
            $table->timestamp('tanggal_transaksi'); 
            $table->timestamps(); 
        });

        Schema::create('detail_transaksi_penjualans', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah_pembelian');
            $table->foreignId('transaksi_penjualan_id')->nullable()->index();

            $table->foreignId('product_id')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
