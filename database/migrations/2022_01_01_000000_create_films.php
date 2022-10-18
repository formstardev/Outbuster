<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('film_original_title')->nullable();
            $table->string('film_country_of_origin')->nullable();
            $table->string('film_version')->nullable();
            $table->string('film_running_time')->nullable();
            $table->string('film_tagline')->nullable();
            $table->text('film_synopsis')->nullable();
            $table->text('film_category')->nullable();
            $table->text('film_genre')->nullable();
            $table->text('film_tag')->nullable();
            $table->string('film_pros')->nullable();
            $table->string('film_cons')->nullable();
            $table->string('film_cover')->nullable();
            $table->string('film_trailer')->nullable();
            $table->string('film_master_file')->nullable();
            $table->integer('film_country_id')->nullable();
            $table->string('film_certification')->nullable();
            $table->string('video_id')->nullable();
            $table->boolean('home')->nullable();
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
        Schema::dropIfExists('films');
    }
}
