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
        Schema::create('crossword_lessons_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('crossword_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('words_id');
            $table->boolean('reply');
            $table->timestamps();

            $table->foreign('crossword_id')->references('id')->on('crosswords')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('words_id')->references('id')->on('words')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('crossword_lessons_answers');
    }
};
