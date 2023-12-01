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
        Schema::create('strands', function (Blueprint $table) {
            $table->string('name', 256);
            $table->string('description', 256);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sections', function (Blueprint $table) {
            $table->string('name', 256);
            $table->string('room', 256);
            $table->foreignId('teacher_id')->constrained('teachers');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('curriculums', function (Blueprint $table) {
            $table->string('code', 256);
            $table->string('prerequisite', 256);
            $table->string('name', 256);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('students', function (Blueprint $table) {
            $table->string('fname', 256);
            $table->string('mname', 256);
            $table->string('lname', 256);
            $table->integer('age');
            $table->string('gender', 256);
            $table->string('address', 256);
            $table->foreignId('shortlisted_id')->constrained('shortlisteds');
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
        Schema::dropIfExists('students');
        Schema::dropIfExists('strands');
        Schema::dropIfExists('sections');
        Schema::dropIfExists('curriculums');
    }
};
