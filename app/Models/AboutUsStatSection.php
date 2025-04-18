<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsStatSection extends Model
{
  // app/Models/AboutUs.php
  protected $table = "about_us_stat_sections";
  protected $fillable = [
    'title',
    'subtitle',
    'description',
    'stat_1_label',
    'stat_1_value',
    'stat_2_label',
    'stat_2_value',
    'stat_3_label',
    'stat_3_value',
  ];
}
