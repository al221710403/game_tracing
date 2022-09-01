<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->string('background_image',100)->nullable();
            $table->string('download_site')->nullable();

            $table->unsignedBigInteger('status_game_id');
            $table->foreign('status_game_id')->references('id')->on('status');

            $table->unsignedBigInteger('game_engine_id');
            $table->foreign('game_engine_id')->references('id')->on('game_engines');

            $table->integer('qualification');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('games');
    }
}
