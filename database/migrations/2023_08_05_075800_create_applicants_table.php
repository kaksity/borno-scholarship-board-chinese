<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('surname');
            $table->string('other_names');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_number');
            $table->string('year')->nullable();
            $table->string('status')->default('active');
            $table->string('programme')->default(env('DEFAULT_SCHOLARSHIP_PROGRAMME'));
            $table->uuid('course_of_study_id');
            $table->string('candidate_number')->nullable();
            $table->boolean('has_passed_grade_point')->default(false);
            $table->decimal('earned_grades')->default(0);
            $table->string('tracking_code')->nullable();
            $table->dateTime('verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('applicants');
    }
}
