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
        Schema::table('user_lessons', function (Blueprint $table) {
            $table->unsignedBigInteger('topic_active_id')->nullable();
            $table->integer('water')->nullable();
            $table->integer('lumen')->nullable();
            $table->foreign('topic_active_id')->references('id')->on('user_topics')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_lessons', function (Blueprint $table) {
            $table->dropForeign('topic_active_id');
            $table->dropColumn('topic_active_id');
            $table->dropColumn('water');
            $table->dropColumn('lumen');
        });
    }
};
