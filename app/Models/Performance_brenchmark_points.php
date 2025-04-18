<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance_brenchmark_points extends Model
{
  use HasFactory;
  protected $table = 'performance_benchmark_points';
  protected $fillable = ['title', 'content', 'image'];
}
