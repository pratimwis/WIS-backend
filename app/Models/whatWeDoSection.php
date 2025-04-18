<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class whatWeDoSection extends Model
{
  use HasFactory;
  protected $table = 'what_we_do_sections';
  protected $fillable = [
    'icon',
    'title',
    'description',
  ];
}
