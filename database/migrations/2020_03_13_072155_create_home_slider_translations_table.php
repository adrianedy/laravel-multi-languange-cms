<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeSliderTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_slider_translations', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('title', 50);
            $table->string('button_label', 20);
            $table->string('button_url', 100);
            $table->string('locale', 10);
            $table->unsignedSmallInteger('home_slider_id');
            $table->timestamps();

            $table->foreign('home_slider_id')->references('id')->on('home_sliders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_slider_translations');
    }
}
