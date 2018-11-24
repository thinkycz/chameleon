<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('code');
            $table->string('type');
            $table->text('description');
            $table->json('parameters');

            $table->unsignedInteger('times_used')->default(0);
            $table->unsignedInteger('max_usage')->default(0);

            $table->timestamp('valid_from')->nullable();
            $table->timestamp('valid_to')->nullable();

            $table->boolean('enabled')->default(true);
            $table->boolean('once_per_user')->default(true);
            $table->boolean('can_be_combined')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
