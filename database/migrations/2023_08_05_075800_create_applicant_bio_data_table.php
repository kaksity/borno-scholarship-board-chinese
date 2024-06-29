<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantBioDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_bio_data', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('applicant_id')->index();
            $table->date('date_of_birth')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('gender')->nullable();
            $table->string('guardian_full_name')->nullable();
            $table->string('guardian_address')->nullable();
            $table->string('contact_address')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('nin')->nullable();
            $table->uuid('lga_id')->nullable();
            $table->string('passport_path')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('applicant_bio_data');
    }
}
