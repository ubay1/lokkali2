<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasestudyDesignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casestudy_design', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->string("header");
            $table->string("gambar");
            $table->string("judul");
            $table->string("isi");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('casestudy_design');
    }
}
