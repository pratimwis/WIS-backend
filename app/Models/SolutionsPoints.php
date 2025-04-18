<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolutionsPoints extends Model
{
  use HasFactory;

  protected $table = 'solution_points';

  protected $fillable = [
    'title',
    'description',
  ];
}
