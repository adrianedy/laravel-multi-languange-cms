<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('models', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 50);
            $table->string('catalog', 50)->nullable();
            $table->string('video', 50)->nullable();
            $table->string('slug', 20);
            $table->unsignedSmallInteger('category_id');
            $table->unsignedSmallInteger('application_id')->nullable();
            $table->timestamps();

            $table->unique(['category_id', 'name']);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('models');
    }
}
