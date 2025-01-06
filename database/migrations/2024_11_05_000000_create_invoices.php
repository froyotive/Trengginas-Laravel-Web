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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id('id_invoice');
            $table->string('document_code');
            $table->string('name');
            $table->string('spk_number');
            $table->date('date');
            $table->enum('status',['Belum dipesan', 'Sudah dipesan' , 'Dalam pengiriman' , 'Sudah diterima']);
            $table->string('user');
            $table->string('vendor');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
