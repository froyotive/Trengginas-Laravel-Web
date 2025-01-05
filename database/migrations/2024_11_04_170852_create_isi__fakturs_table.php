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
        Schema::create('isi_fakturs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_faktur');
            $table->unsignedBigInteger('id_vendor');
            $table->string('nama_barang');
            $table->integer('banyak_unit');
            $table->date('garansi');
            $table->string('lokasi');
            $table->enum('requires_serial_number', ['yes', 'no'])->default('no');
            $table->string('serial_number')->nullable();
            $table->enum('status_list', ['Belum dipesan', 'Sudah dipesan', 'Barang sampai', 'Barang diserahkan ke user']);
            $table->date('jatuh_tempo');
            $table->float('harga_jual', 15, 2)->nullable();
            $table->float('harga_beli', 15, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_faktur')->references('id_faktur')->on('fakturs')->onDelete('cascade');
            $table->foreign('id_vendor')->references('id_vendor')->on('list__vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isi_fakturs');
    }
};