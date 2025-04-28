<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpertiseSliderItem extends Model
{
  protected $fillable = [
    'label',
    'description',
    'background_color',
    'expertise_area',
    'years_of_experience',
    'key_projects',
    'team_members',
  ];

  protected $casts = [
    'key_projects' => 'array',
    'team_members' => 'array',
  ];
}
