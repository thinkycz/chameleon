<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->json('name');
            $table->text('name_v')->virtualAs('name');

            $table->decimal('price', 11, 2)->default(0);
            $table->decimal('minimal_order_amount', 11, 2)->default(0)->nullable();

            $table->boolean('needs_shipping_address')->default(true);
            $table->boolean('price_will_be_calculated')->default(false);
            $table->boolean('enabled')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_methods');
    }
}
