<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->timestamp('placed_at')->nullable();

            $table->string('order_number');
            $table->string('invoice_number');
            $table->string('variable_symbol');

            $table->date('tax_date');
            $table->date('due_date');

            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->text('notes')->nullable();
            $table->text('customer_note')->nullable();

            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('status_id')->nullable();
            $table->unsignedInteger('shipping_detail_id')->nullable();
            $table->unsignedInteger('billing_detail_id')->nullable();
            $table->unsignedInteger('delivery_method_id')->nullable();
            $table->unsignedInteger('payment_method_id')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null');
            $table->foreign('shipping_detail_id')->references('id')->on('shipping_details')->onDelete('set null');
            $table->foreign('billing_detail_id')->references('id')->on('billing_details')->onDelete('set null');
            $table->foreign('delivery_method_id')->references('id')->on('delivery_methods')->onDelete('set null');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
