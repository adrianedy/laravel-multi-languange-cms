<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('as_sections', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('image', 50);
            $table->tinyInteger('sort');
            $table->unsignedSmallInteger('after_sale_id');
            $table->timestamps();

            $table->foreign('after_sale_id')->references('id')->on('after_sales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('as_sections');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
