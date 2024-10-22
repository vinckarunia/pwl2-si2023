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
        Schema::create('suppliers', function (Blueprint $table) { // Ubah dari `supplier` menjadi `suppliers`
            $table->id();
            $table->string('nama_supplier');
            $table->string('alamat_supplier');
            $table->string('pic_supplier');
            $table->string('no_hp_pic_supplier'); // Ubah tipe dari integer ke string
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};