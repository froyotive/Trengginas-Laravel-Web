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
        Schema::create('fakturs', function (Blueprint $table) {
            $table->id('id_faktur');
            $table->string('no_spk')->unique();
            $table->date('tgl_sk');
            $table->string('user');
            $table->date('tgl_bast_vendor')->nullable();
            $table->date('deadline_pekerjaan');
            $table->string('spk_tj_ke_vendor');
            $table->string('nomor_folder_pekerjaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fakturs');
    }
};
