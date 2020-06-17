<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCareerTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('career_translations', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('description', 1000);
            $table->string('locale', 10);
            $table->unsignedSmallInteger('career_id');
            $table->timestamps();

            $table->foreign('career_id')->references('id')->on('careers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('career_translations');
    }
}
