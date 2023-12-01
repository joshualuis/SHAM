<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\softDeletes;

class Student_Curriculum extends Model
{
    protected $guarded = [];
    protected $connection = 'mongodb';
    protected $collection = 'student_curriculum';

    public function year()
    {
    	return $this->belongsTo(Year::class);
    }

    public function student()
    {
    	return $this->belongsTo(Student::class);
	}

    public function curriculum()
    {
    	return $this->belongsTo(Curriculum::class);
	}

    public function teacher()
    {
    	return $this->belongsTo(Teacher::class);
	}

    public function section()
    {
    	return $this->belongsTo(Section::class);
	}

    public function semester()
    {
    	return $this->belongsTo(Semester::class);
	}
}
