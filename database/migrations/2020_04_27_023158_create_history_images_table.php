<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_images', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 50);
            $table->tinyInteger('sort');
            $table->unsignedSmallInteger('history_id');
            $table->timestamps();

            $table->foreign('history_id')->references('id')->on('histories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_images');
    }
}
