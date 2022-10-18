<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerieEpisodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serie_episodes', function (Blueprint $table) {
            $table->id();
            $table->integer('serie_id')->nullable();
            $table->string('serie_season_number')->nullable();
            $table->string('serie_episode_number')->nullable();
            $table->string('serie_episode_title')->nullable();
            $table->text('serie_episode_synopsis')->nullable();
            $table->string('serie_episode_running_time')->nullable();
            $table->string('serie_episode_cover')->nullable();
            $table->string('serie_episode_trailer')->nullable();
            $table->string('serie_episode_master_file')->nullable();
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
        Schema::dropIfExists('serie_episodes');
    }
}
