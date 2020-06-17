<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_translations', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('title', 50);
            $table->string('description', 500);
            $table->string('url', 100);
            $table->string('locale', 10);
            $table->unsignedSmallInteger('home_id');
            $table->timestamps();

            $table->foreign('home_id')->references('id')->on('homes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('home_translations');
    }
}
