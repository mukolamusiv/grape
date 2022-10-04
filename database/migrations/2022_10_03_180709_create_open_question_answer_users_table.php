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
        Schema::create('open_question_answer_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('open_question_id');
            $table->boolean('audit')->default(false);
            $table->unsignedBigInteger('audit_user_id');
            $table->string('answer');
            $table->boolean('reply')->default(false);
            $table->timestamps();

            $table->foreign('audit_user_id')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('open_question_id')->references('id')->on('open_questions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('open_question_answer_users');
    }
};
