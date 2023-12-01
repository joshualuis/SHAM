<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\softDeletes;

class Curriculum extends Model
{
    // use softDeletes;
    protected $guarded = [];
    protected $connection = 'mongodb';
    protected $collection = 'curriculums';

    // public function teacher()
    // {
    // 	return $this->belongsToMany('App\Models\Teacher','teacher_curriculum','curriculum_id','teacher_id');
	// }

    public function teacher_curriculum()
    {
    	return $this->hasMany(Teacher_Curriculum::class);
	}

    public function teacher_schedule()
    {
    	return $this->hasMany(Teacher_Schedule::class);
	}

    public function student_schedule()
    {
    	return $this->hasMany(Student_Schedule::class);
	}

    public function strand()
    {
     	return $this->belongsTo(Strand::class);
    }

    public function grade()
    {
    	return $this->hasMany(Grade::class);
    }
    
}
