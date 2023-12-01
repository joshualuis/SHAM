<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\softDeletes;

class Section extends Model
{
    // use softDeletes;
    protected $guarded = [];
    protected $connection = 'mongodb';
    protected $collection = 'sections';

    public function year()
    {
    	return $this->belongsTo(Year::class);
    }

   public function teacher()
    {
    	return $this->belongsTo(Teacher::class);
    }

    public function strand()
    {
    	return $this->belongsTo(Strand::class);
    }

    public function teacher_schedule()
    {
    	return $this->hasMany(Teacher_Schedule::class);
	}

    public function student_schedule()
    {
     	return $this->hasMany(Student_Schedule::class);
    }

    public function teacher_curriculum()
    {
    	return $this->hasMany(Teacher_Curriculum::class);
	}

    public function student(){
        return $this->hasMany(Student::class);
    }

    public function attendance(){
        return $this->hasMany(Attendance::class);
    }

    public function grade()
    {
    	return $this->hasMany(Grade::class);
    }
}
