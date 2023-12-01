<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\softDeletes;

class Grade extends Model
{
    // use softDeletes;
    protected $guarded = [];
    protected $connection = 'mongodb';
    protected $collection = 'grades';

    public function student()
    {
    	return $this->belongsTo(Student::class);
	}

    public function curriculum(){
        
        return $this->belongsTo(Curriculum::class);
    }

    public function section(){
        
        return $this->belongsTo(Section::class);
    }

    public function teacher(){
        return $this->belongsTo(Teacher::class);
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
