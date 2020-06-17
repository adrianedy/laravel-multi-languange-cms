<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('office_translations', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name', 50);
            $table->string('address', 200);
            $table->string('locale', 10);
            $table->unsignedSmallInteger('office_id');
            $table->timestamps();

            $table->foreign('office_id')->references('id')->on('offices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('office_translations');
    }
}
