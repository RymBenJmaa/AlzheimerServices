<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class BestPractices extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title' , 'description'
    ];

  }