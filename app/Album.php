<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
      'name',
      'file',
      'gender',
      'year',
      'label',
      'note',
      'artists',
      'songs'    ];
}
