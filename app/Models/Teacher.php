<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\softDeletes;

class Teacher extends Model
{
    // use softDeletes;
    protected $guarded = [];
    protected $connection = 'mongodb';
    protected $collection = 'teachers';

    public function year()
    {
    	return $this->belongsTo(Year::class);
    }

    public function section()
    {
        return $this->hasMany(Section::class);
    }

    public function user()
    {
    	return $this->hasOne(User::class);
    }

    // public function section()
    // {
    //     return $this->hasMany('App\Section', 'section', '_id');
    // }

    public function teacher_curriculum()
    {
    	return $this->hasOne(Teacher_Curriculum::class);
	}

    public function teacher_schedule()
    {
    	return $this->hasMany(Teacher_Schedule::class);
	}

    public function student_schedule()
    {
     	return $this->hasMany(Student_Schedule::class);
    }

    public function grade()
    {
    	return $this->hasMany(Grade::class);
    }
}
