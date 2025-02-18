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
        Schema::create('asset', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->date('tanggal_beli');
            $table->string('foto_barang')->nullable();
            $table->integer('harga_barang');
            $table->enum('jenis_barang', [
                'building', 'kendaraan', 'peralatan mebel', 'peralatan non elektronik', 
                'peralatan elektronik', 'peralatan drone', 'peralatan multimedia', 
                'software', 'perlengkapan'
            ]);
            $table->string('nomor_asset');
            $table->integer('stok');
            $table->string('serial_number');
            $table->string('qr_code')->nullable();
            $table->string('kode_uniq');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset');
    }
};
