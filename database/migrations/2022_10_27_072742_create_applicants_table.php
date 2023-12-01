<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->boolean('studentstatus');
            $table->string('lrnstatus', 256);
            $table->string('gradetoenroll', 256);
            $table->string('presentgrade', 256);
            $table->string('section', 256);
            $table->string('yeartofinish', 256);
            $table->string('image', 1000);
            $table->string('lastschoolattended', 256);
            $table->string('lastschooladdress', 256);
            $table->string('schoolid', 256);
            $table->string('schooltype', 256);
            $table->string('schooltoenroll', 256);
            $table->string('schooladdress', 256);
            $table->string('semester', 256);
            $table->string('track', 256);
            $table->string('firstchoice', 256);
            $table->string('secondchoice', 256);
            $table->string('thirdchoice', 256);
            $table->string('reportcard', 256);
            $table->string('birthcertificate', 256);
            $table->string('englishgrade', 256);
            $table->string('mathgrade', 256);
            $table->string('sciencegrade', 256);
            $table->string('filipinograde', 256);
            $table->foreignId('year_id')->constrained('years');

            $table->string('lrn', 256)->nullable();
            $table->string('psanumber', 256)->nullable();
            $table->string('email', 256);
            $table->string('fname', 256);
            $table->string('mname', 256);
            $table->string('lname', 256);
            $table->string('extname', 256)->nullable();
            $table->string('birthdate', 256);
            $table->integer('age', 256);
            $table->string('gender', 256);
            $table->string('contact', 256);
            $table->string('mothertongue', 256);
            $table->string('religion', 256)->nullable();
            $table->string('indipeople', 256)->nullable();
            $table->string('specialneeds', 256)->nullable();
            $table->string('assistivedevices', 256)->nullable();

            $table->string('mothername', 256)->nullable();
            $table->string('mothereducation', 256)->nullable();
            $table->string('motheremployment', 256)->nullable();
            $table->boolean('motherworkstat');
            $table->string('mothercontact', 256)->nullable();
            $table->string('fathername', 256)->nullable();
            $table->string('fathereducation', 256)->nullable();
            $table->string('fatheremployment', 256)->nullable();
            $table->boolean('fatherworkstat');
            $table->string('fathercontact', 256)->nullable();
            $table->string('guardianname', 256)->nullable();
            $table->string('guardianeducation', 256)->nullable();
            $table->string('guardianemployment', 256)->nullable();
            $table->boolean('guardianworkstat');
            $table->string('guardiancontact', 256)->nullable();

            $table->string('housestreet', 256);
            $table->string('barangay', 256);
            $table->string('city', 256);
            $table->string('province', 256);
            $table->string('region', 256);

            $table->timestamps();
            $table->softDeletes();
        });

        // Schema::create('applicant_studentinfo', function (Blueprint $table) {
        //     $table->string('lrn', 256)->nullable();
        //     $table->string('psanumber', 256)->nullable();
        //     $table->string('email', 256);
        //     $table->string('fname', 256);
        //     $table->string('mname', 256);
        //     $table->string('lname', 256);
        //     $table->string('extname', 256)->nullable();
        //     $table->string('birthdate', 256);
        //     $table->integer('age', 256);
        //     $table->string('gender', 256);
        //     $table->string('contact', 256);
        //     $table->string('mothertongue', 256);
        //     $table->string('religion', 256)->nullable();
        //     $table->string('indipeople', 256)->nullable();
        //     $table->string('specialneeds', 256)->nullable();
        //     $table->string('assistivedevices', 256)->nullable();
        //     $table->foreignId('applicant_id')->constrained('applicants');
        //     $table->timestamps();
        //     $table->softDeletes();
        // });

        // Schema::create('applicant_parent', function (Blueprint $table) {
        //     $table->string('mothername', 256)->nullable();
        //     $table->string('mothereducation', 256)->nullable();
        //     $table->string('motheremployment', 256)->nullable();
        //     $table->boolean('motherworkstat');
        //     $table->string('mothercontact', 256)->nullable();
        //     $table->string('fathername', 256)->nullable();
        //     $table->string('fathereducation', 256)->nullable();
        //     $table->string('fatheremployment', 256)->nullable();
        //     $table->boolean('fatherworkstat');
        //     $table->string('fathercontact', 256)->nullable();
        //     $table->string('guardianname', 256)->nullable();
        //     $table->string('guardianeducation', 256)->nullable();
        //     $table->string('guardianemployment', 256)->nullable();
        //     $table->boolean('guardianworkstat');
        //     $table->string('guardiancontact', 256)->nullable();
        //     $table->foreignId('applicant_id')->constrained('applicants');
        //     $table->timestamps();
        //     $table->softDeletes();
        // });

        // Schema::create('applicant_studentaddress', function (Blueprint $table) {
        //     $table->string('housestreet', 256);
        //     $table->string('barangay', 256);
        //     $table->string('city', 256);
        //     $table->string('province', 256);
        //     $table->string('region', 256);
        //     $table->foreignId('applicant_id')->constrained('applicants');
        //     $table->timestamps();
        //     $table->softDeletes();
        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
        // Schema::dropIfExists('applicant_studentinfo');
        // Schema::dropIfExists('applicant_parent');
        // Schema::dropIfExists('applicant_studentaddress');
    }
};
