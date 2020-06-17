<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->enum('salutation', ['Mr.', 'Mrs.', 'Ms.']);
            $table->string('first_name', 20);
            $table->string('mid_name', 20);
            $table->string('last_name', 20);
            $table->string('company', 30);
            $table->string('mail', 50);
            $table->string('country_code', 20);
            $table->string('area_code', 20);
            $table->string('phone', 20);
            $table->string('province', 20);
            $table->string('city', 20);
            $table->string('post_code', 20);
            $table->string('category', 50);
            $table->string('model', 50);
            $table->string('comments', 500);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotes');
    }
}
