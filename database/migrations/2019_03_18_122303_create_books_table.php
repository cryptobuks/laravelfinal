<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 200);
            $table->integer('booktype_id')->unsigned();
            $table->float('price')->nullable();
            $table->integer('stock_qty')->nullable();
            $table->string('image_url')->nullable();
            $table->timestamps();
            $table->foreign('booktype_id')->references('id')->on('booktype');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
