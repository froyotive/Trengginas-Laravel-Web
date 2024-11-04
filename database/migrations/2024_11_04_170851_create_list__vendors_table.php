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
        Schema::create('list__vendors', function (Blueprint $table) {
            $table->id('id_vendor');
            $table->string('nama_vendor');
            $table->string('alamat_vendor');
            $table->string('no_vendor');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list__vendors');
    }
};