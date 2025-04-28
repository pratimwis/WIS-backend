<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAppointment extends Model
{
  use HasFactory;
  protected $table = 'book_appointments';
  protected $fillable = [
    'title',
    'description',
    'image',
    'alt'
  ];
}
