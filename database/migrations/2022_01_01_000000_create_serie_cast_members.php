<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSerieCastMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serie_cast_members', function (Blueprint $table) {
            $table->id();
            $table->integer('serie_id')->nullable();
            $table->string('serie_cast_name')->nullable();
            $table->string('serie_cast_character')->nullable();
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
        Schema::dropIfExists('serie_cast_members');
    }
}
