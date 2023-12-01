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
        Schema::create('strand_section', function (Blueprint $table) {
            $table->foreignId('strand_id')->constrained('strands');
            $table->foreignId('section_id')->constrained('sections');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('section_curriculum', function (Blueprint $table) {
            $table->foreignId('curriculum_id')->constrained('curriculums');
            $table->foreignId('section_id')->constrained('sections');
            $table->foreignId('student_id')->constrained('students');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('teacher_curriculum', function (Blueprint $table) {
            $table->foreignId('curriculum_id')->constrained('curriculums');
            $table->foreignId('teacher_id')->constrained('teachers');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sham', function (Blueprint $table) {
            $table->foreignId('year_id')->constrained('years');
            $table->foreignId('student_id')->constrained('students');
            $table->foreignId('teacher_id')->constrained('teachers');
            $table->foreignId('strand_id')->constrained('strands');
            $table->foreignId('section_id')->constrained('sections');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('strand_section');
        Schema::dropIfExists('section_curriculum');
        Schema::dropIfExists('teacher_curriculum');
        Schema::dropIfExists('sham');
    }
};
