<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustriesTi extends Model
{
  use HasFactory;
  protected $table = 'industries_tis';
  protected $fillable = [
    'icon',
    'title',
    'description',
  ];
}
