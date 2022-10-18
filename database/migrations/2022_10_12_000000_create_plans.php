<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('frequency')->nullable();
            $table->decimal('amount',12,2)->default(0)->nullable();
            $table->integer('free_period')->nullable();
            $table->integer('payment_period')->nullable();
            $table->integer('payment_recurring')->nullable();
            $table->string('stripe_prod_id')->nullable();
            $table->string('stripe_plan_id')->nullable();
            $table->string('paypal_plan_id')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('plans');
    }
}
