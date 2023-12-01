<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\softDeletes;

class Applicant extends Model
{
    // use softDeletes;
    protected $guarded = [];
    protected $connection = 'mongodb';
    protected $collection = 'applicants';

    public function shortlisted()
    {
    	return $this->hasOne(Shortlisted::class);
    }

    public function year()
    {
    	return $this->belongsTo(Year::class);
    }

    // public function applicant_parent()
    // {
    // 	return $this->hasOne(Applicant_Parent::class);
    // }

    // public function applicant_studentinfo()
    // {
    // 	return $this->hasOne(Applicant_Studentinfo::class);
    // }

    // public function applicant_studentaddress()
    // {
    // 	return $this->hasOne(Applicant_Studentaddress::class);
    // }
}
