<?php

use App\Enums\PreconfiguredOption;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('availabilities', function (Blueprint $table) {
            $table->increments('id');

            $table->json('name');
            $table->text('name_v')->virtualAs('name');

            $table->json('description')->nullable();
            $table->text('description_v')->virtualAs('description');

            $table->boolean('allow_orders')->default(true);
            $table->boolean('allow_negative_quantity')->default(true);
            $table->boolean('products_visible')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('availabilities');
    }
}
