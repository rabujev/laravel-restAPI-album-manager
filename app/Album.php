<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
      'image',
      'artist',
      'name',
      'genre',
      'year',
      'label',
      'songs',
      'rating'
    ];
}
