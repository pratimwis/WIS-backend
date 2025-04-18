<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DevelopmentService extends Model
{
  protected $fillable = ['heading', 'sub_heading', 'points', 'description'];

  protected $casts = [
    'points' => 'array',
  ];
}
