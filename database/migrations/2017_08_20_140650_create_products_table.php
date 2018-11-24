<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('name');
            $table->string('slug')->unique();

            $table->text('description')->nullable();
            $table->longText('details')->nullable();

            $table->string('catalogue_number')->nullable();
            $table->string('barcode')->nullable();

            $table->integer('quantity_in_stock')->default(0);
            $table->integer('minimum_order_quantity')->default(1);
            $table->unsignedDecimal('vatrate')->default(21.00);
            $table->boolean('enabled')->default(true);

            $table->unsignedInteger('availability_id')->nullable();
            $table->foreign('availability_id')->references('id')->on('availabilities')->onDelete('set null');

            $table->unsignedInteger('unit_id')->nullable();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('set null');

            $table->nestedSet();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
