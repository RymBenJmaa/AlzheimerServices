<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Symptomes extends Model
{
   /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description', 'type'
    ];

  }