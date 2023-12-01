<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\softDeletes;

class Teacher_Curriculum extends Model
{
    // use softDeletes;
    protected $guarded = [];
    protected $connection = 'mongodb';
    protected $collection = 'teacher_curriculum';

    public function year()
    {
    	return $this->belongsTo(Year::class);
    }

    public function semester()
    {
    	return $this->belongsTo(Semester::class);
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

}
