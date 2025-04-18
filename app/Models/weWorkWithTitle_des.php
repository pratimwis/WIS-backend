<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class weWorkWithTitle_des extends Model
{
  protected $table = 'we_work_with_title_des';

  protected $fillable = [
    'title',
    'description',
  ];
}
