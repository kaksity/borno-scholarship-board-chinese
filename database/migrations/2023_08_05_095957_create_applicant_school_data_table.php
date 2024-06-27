<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantSchoolDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_school_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('applicant_id')->index();
            $table->string('identity_number')->nullable();
            $table->string('institution_type')->default('University');
            $table->string('current_level')->nullable();
            $table->string('course_of_study')->nullable();
            $table->string('admission_status')->nullable();
            $table->string('name_of_institution')->nullable();
            $table->date('date_of_admission')->nullable();
            $table->date('date_of_graduation')->nullable();
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
        Schema::dropIfExists('applicant_school_data');
    }
}
