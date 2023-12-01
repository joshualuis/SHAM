<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\softDeletes;

class Attendance extends Model
{
    // use softDeletes;
    protected $guarded = [];
    protected $connection = 'mongodb';
    protected $collection = 'attendance';

    public function student()
    {
    	return $this->belongsTo(Student::class);
	}

    public function curriculum(){
        return $this->hasMany(Curriculum::class);
    }

    public function teacher(){
        return $this->hasMany(Teacher::class);
    }

    public function section(){
        return $this->hasMany(Section::class);
    }

    public function year()
    {
    	return $this->belongsTo(Year::class);
    }

    public function semester()
    {
    	return $this->belongsTo(Semester::class);
	}
}
