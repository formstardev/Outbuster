<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('serie_original_title')->nullable();
            $table->string('serie_country_of_origin')->nullable();
            $table->string('serie_version')->nullable();
            $table->string('serie_tagline')->nullable();
            $table->text('serie_synopsis')->nullable();
            $table->text('serie_category')->nullable();
            $table->text('serie_genre')->nullable();
            $table->text('serie_tag')->nullable();
            $table->string('serie_pros')->nullable();
            $table->string('serie_cons')->nullable();
            $table->string('serie_cover')->nullable();
            $table->string('serie_trailer')->nullable();
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
        Schema::dropIfExists('series');
    }
}
