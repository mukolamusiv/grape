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
            $table->string('image')->nullable();
            $table->string('text')->nullable();
            $table->unsignedBigInteger('pair_id')->nullable();
            $table->timestamps();

            $table->foreign('find_a_pair')->references('id')->on('find_a__pairs')->cascadeOnDelete();
            $table->foreign('pair_id')->references('id')->on('find_a__pair__data')->cascadeOnDelete();
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
