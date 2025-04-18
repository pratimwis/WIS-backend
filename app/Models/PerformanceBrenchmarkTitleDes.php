<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformanceBrenchmarkTitleDes extends Model
{
  protected $table = 'performance_brenchmark_title_des';

  protected $fillable = [
    'title',
    'description',
  ];
}
