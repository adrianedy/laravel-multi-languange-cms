<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedSmallInteger('model_id');
            $table->tinyInteger('sort');
            $table->unsignedSmallInteger('application_id');
            $table->timestamps();

            $table->foreign('model_id')->references('id')->on('models')->onDelete('cascade');
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_products');
    }
}
