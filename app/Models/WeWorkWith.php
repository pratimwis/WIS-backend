<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeWorkWith extends Model
{
  protected $table = 'we_work_with';

  protected $fillable = [
    'tab_name',
    'title',
    'description',
    'features',
    'image',
    'icon',
    'image_alt',
    'icon_alt'
  ];

  protected $casts = [
    'features' => 'array',
  ];
}
