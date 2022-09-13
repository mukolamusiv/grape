<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('find_a__pair__data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('find_a_pair');
            $table->string('title');
            $table->string('description');
            $table->string('image');
            $table->unsignedBigInteger('pair')->nullable();
            $table->timestamps();

            $table->foreign('find_a_pair')->references('id')->on('find_a__pairs');
            $table->foreign('pair')->references('id')->on('find_a__pair__data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('find_a__pair__data');
    }
};
