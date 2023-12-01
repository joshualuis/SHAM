<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\softDeletes;

class Registration extends Model
{
    protected $guarded = [];
    protected $connection = 'mongodb';
    protected $collection = 'registrations';

    public function year()
    {
    	return $this->belongsTo(Year::class);
    }
}
