<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultingSection extends Model
{
  use HasFactory;

  protected $fillable = ['title', 'description', 'points', 'dropdown_options'];

  protected $casts = [
    'points' => 'array',
    'dropdown_options' => 'array',
  ];
}
