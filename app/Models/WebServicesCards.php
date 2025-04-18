<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebServicesCards extends Model
{
  use HasFactory;
  protected $table = 'home_service_sections';
  protected $fillable = [
    'title',
    'description',
    'icon',
    'image',
  ];
}
