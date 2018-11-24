<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_details', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('company_name')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('city');
            $table->string('street');
            $table->string('zipcode');
            $table->string('phone')->nullable();

            $table->unsignedInteger('country_id')->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_details');
    }
}
