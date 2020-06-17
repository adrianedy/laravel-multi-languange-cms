<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecificationTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specification_translations', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 100);
            $table->string('detail', 500);
            $table->string('locale', 10);
            $table->unsignedSmallInteger('specification_id');
            $table->timestamps();

            $table->foreign('specification_id')->references('id')->on('specifications')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specification_translations');
    }
}
