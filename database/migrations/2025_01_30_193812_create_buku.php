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
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('nama_buku');
            $table->text('ringkasan');
            $table->string('gambar_buku')->nullable();
            $table->integer('stok');
            $table->enum('kategori', [
                'fiksi', 'makanan', 'novel', 'cergam', 'komik', 'ensiklopedi', 'nomik', 
                'antologi', 'dongeng', 'biografi', 'catatan', 'harian', 'novelet', 
                'fotografi', 'karya ilmiah', 'tafsir', 'kamus', 'panduan_how_to', 
                'atlas', 'buku_ilmiah', 'teks', 'majalah', 'buku_digital'
            ]);
            $table->string('qr_code')->nullable();
            $table->enum('location', ['perpustakaan auriga', 'perpustakaan bang TM']);
            $table->string('kode_uniq');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
