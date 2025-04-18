<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StepByStepGuidelinesTitleDes extends Model
{
    use HasFactory;
    protected $table = 'step_by_step_guidelines_title_des';
    protected $fillable = ['title', 'description'];
  

}
