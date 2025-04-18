<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolutionTitleDes extends Model
{
  use HasFactory;

  protected $table = 'solution_title_des';

  protected $fillable = [
    'title',
    'description',
  ];
}
