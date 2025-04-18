<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpertiseCard extends Model
{
  protected $fillable = [
    'title',
    'description',
    'icon',
    'alt',
  ];
}
