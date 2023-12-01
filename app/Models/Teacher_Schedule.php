<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\softDeletes;

class Teacher_Schedule extends Model
{
    // use softDeletes;
    protected $guarded = [];
    protected $connection = 'mongodb';
    protected $collection = 'teacher_schedule';

    public function year()
    {
    	return $this->belongsTo(Year::class);
    }

    public function teacher()
    {
    	return $this->belongsTo(Teacher::class);
	}

    public function curriculum()
    {
    	return $this->belongsTo(Curriculum::class);
	}

    public function section()
    {
    	return $this->belongsTo(Section::class);
	}

    public function student_schedule()
    {
    	return $this->hasMany(Student_Schedule::class, 'curriculum_id', 'curriculum_id');
	}

    public function semester()
    {
    	return $this->belongsTo(Semester::class);
	}
}
