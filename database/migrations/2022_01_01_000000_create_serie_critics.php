<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerieCritics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serie_critics', function (Blueprint $table) {
            $table->id();
            $table->integer('serie_id')->nullable();
            $table->string('serie_critic_title')->nullable();
            $table->integer('serie_critic_name_id')->nullable();
            $table->text('serie_criticism')->nullable();
            $table->string('serie_complete_criticism')->nullable();
            $table->string('serie_description')->nullable();
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
        Schema::dropIfExists('serie_critics');
    }
}
