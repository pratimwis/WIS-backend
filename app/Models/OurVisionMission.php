<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurVisionMission extends Model
{
  use HasFactory;

  protected $fillable = [
    'vision_title',
    'vision_description',
    'mission_title',
    'mission_description',
  ];
}
