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
        Schema::create('one_word_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('one_word_id');
            $table->string('description');
            $table->string('title');
            $table->string('image_src')->nullable();
            $table->string('text')->nullable();
            $table->string('word');
            $table->timestamps();

            $table->foreign('one_word_id')->references('id')->on('one_words');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('one_word_questions');
    }
};
