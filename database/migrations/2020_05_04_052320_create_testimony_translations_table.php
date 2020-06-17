<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestimonyTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testimony_translations', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('testimony', 1000);
            $table->string('locale', 10);
            $table->unsignedSmallInteger('testimony_id');
            $table->timestamps();

            $table->foreign('testimony_id')->references('id')->on('testimonies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('testimony_translations');
    }
}
