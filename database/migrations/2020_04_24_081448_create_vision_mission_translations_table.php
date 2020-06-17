<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisionMissionTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vision_mission_translations', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('vision', 500);
            $table->string('mission', 500);
            $table->string('locale', 10);
            $table->unsignedSmallInteger('vision_mission_id');
            $table->timestamps();

            $table->foreign('vision_mission_id')->references('id')->on('vision_missions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vision_mission_translations');
    }
}
