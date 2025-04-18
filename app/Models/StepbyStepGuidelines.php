<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StepbyStepGuidelines extends Model
{
  use HasFactory;
  protected $table ='stepby_step_guidelines';
  protected $fillable = [
    'icon',
    'title',
    'description',
  ];
}
