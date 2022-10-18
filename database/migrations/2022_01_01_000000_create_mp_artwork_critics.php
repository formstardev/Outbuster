<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMpArtworkCritics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mp_artwork_critics', function (Blueprint $table) {
            $table->id();
            $table->string('artwork_critic_name')->nullable();
            $table->string('artwork_critic_website')->nullable();
            $table->string('artwork_critic_logotype')->nullable();
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
        Schema::dropIfExists('mp_artwork_critics');
    }
}
