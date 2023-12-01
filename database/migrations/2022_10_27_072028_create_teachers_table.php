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
        Schema::create('teachers', function (Blueprint $table) {
            $table->string('fname', 256);
            $table->string('mname', 256);
            $table->string('lname', 256);
            $table->string('contact', 256);
            $table->string('email', 256);
            $table->string('image', 1000);
            $table->string('gender', 256);
            $table->integer('age', 256);
            $table->string('civilstatus', 256);
            $table->string('birthdate', 256);
            $table->string('address', 256);
            $table->string('certificate', 256);
            $table->string('major', 256);
            $table->string('specialization', 256);
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
        Schema::dropIfExists('teachers');
    }
};
