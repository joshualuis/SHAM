<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\softDeletes;

class Student extends Model
{
    // use softDeletes;
    protected $guarded = [];
    protected $connection = 'mongodb';
    protected $collection = 'students';
    protected $casts = [
        'curr_array' => 'array',
    ];

    public function year()
    {
    	return $this->belongsTo(Year::class);
    }

    public function shortlisted()
    {
        return $this->belongsTo(Shortlisted::class);
    }

    public function section()
    {
    	return $this->belongsTo(Section::class);
    }

    public function strand()
    {
     	return $this->belongsTo(Strand::class);
    }

    public function student_schedule()
    {
     	return $this->hasMany(Student_Schedule::class);
    }

    public function teacher_schedule()
    {
     	return $this->hasMany(Teacher_Schedule::class);
    }

    public function attendance()
    {
     	return $this->hasMany(Attendance::class);
    }

    public function user()
    {
    	return $this->hasOne(User::class);
    }

    public function grade()
    {
    	return $this->hasMany(Grade::class);
    }
     
}
