<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebServiceInfacts extends Model
{
  protected $fillable = ['title', 'description', 'services'];

  protected $casts = [
    'services' => 'array',
  ];
}
