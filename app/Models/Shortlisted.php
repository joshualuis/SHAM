<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\softDeletes;

class Shortlisted extends Model
{
    // use softDeletes;
    protected $guarded = [];
    protected $connection = 'mongodb';
    protected $collection = 'shortlisteds';

    public function year()
    {
    	return $this->belongsTo(Year::class);
    }

    public function applicant()
    {
    	return $this->belongsTo(Applicant::class);
    }

    public function strand()
    {
    	return $this->belongsTo(Strand::class);
    }

    public function section()
    {
    	return $this->belongsTo(Section::class);
    }

}
