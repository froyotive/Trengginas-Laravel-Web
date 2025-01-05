<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFakturItemsTable extends Migration
{
    public function up()
    {
        Schema::create('faktur_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faktur_id')->constrained('fakturs')->onDelete('cascade');
            $table->string('item_name');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('faktur_items');
    }
}
