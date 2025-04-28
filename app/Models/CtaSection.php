<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CtaSection extends Model
{
  use HasFactory;
  protected $table = 'cta_sections';
  protected $fillable = [
    'title',
    'description',
    'image',
    'alt',
  ];
}
