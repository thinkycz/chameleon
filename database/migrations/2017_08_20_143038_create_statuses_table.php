<?php

use App\Enums\PreconfiguredOption;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->json('name');
            $table->text('name_v')->virtualAs('name');

            $table->json('description')->nullable();
            $table->text('description_v')->virtualAs('description');

            $table->string('code')->unique();
            $table->string('color')->default('black');
            $table->boolean('is_final')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statuses');
    }
}
