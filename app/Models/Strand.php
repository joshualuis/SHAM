<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\softDeletes;

class Strand extends Model
{
    // use softDeletes;
    protected $guarded = [];
    protected $connection = 'mongodb';
    protected $collection = 'strands';

  public function section()
     {
     	return $this->hasMany(Section::class);
     }  

  //  public function strand()
  //    {
  //    	return $this->belongsTo(Strand::class);
  //    }  
}
