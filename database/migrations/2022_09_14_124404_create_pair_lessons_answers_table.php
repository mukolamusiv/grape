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
        Schema::create('pair_lessons_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('find_a_pair_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('answer_pair_id_first');
            $table->unsignedBigInteger('answer_pair_id_second');
            $table->boolean('reply');
            $table->timestamps();

            $table->foreign('find_a_pair_id')->references('id')->on('find_a__pairs')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('answer_pair_id_first')->references('id')->on('find_a__pair__data')->cascadeOnDelete();
            $table->foreign('answer_pair_id_second')->references('id')->on('find_a__pair__data')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pair_lessons_answers');
    }
};
