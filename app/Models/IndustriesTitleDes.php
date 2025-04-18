<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndustriesTitleDes extends Model
{
  protected $table = 'industries_title_des';

  protected $fillable = [
    'title',
    'description',
  ];
}
