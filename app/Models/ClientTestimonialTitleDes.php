<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientTestimonialTitleDes extends Model
{
  protected $table = 'client_testimonial_title_des';

  protected $fillable = [
    'title',
    'description',
  ];
}
