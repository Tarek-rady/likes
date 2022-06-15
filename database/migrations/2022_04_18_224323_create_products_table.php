<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('price');
            $table->string('img');
            $table->text('desc')->nullable();
            $table->foreignId('category_id')->references('id')->on('categories')->cascadeOnDelete();
            $table->string('rate')->default(0);
            $table->string('like')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('products');
    }
}
