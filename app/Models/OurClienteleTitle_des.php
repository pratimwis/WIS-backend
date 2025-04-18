<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurClienteleTitle_des extends Model
{
  protected $table = 'our_clientele_title_des';

  protected $fillable = [
    'title',
    'description',
  ];
}
