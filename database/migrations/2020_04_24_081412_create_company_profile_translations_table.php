<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyProfileTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_profile_translations', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('description', 1000)->nullable();
            $table->string('locale', 10);
            $table->unsignedSmallInteger('company_profile_id');
            $table->timestamps();

            $table->foreign('company_profile_id')->references('id')->on('company_profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_profile_translations');
    }
}
