<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JoinOurTeam extends Model
{
  use HasFactory;
  protected $table = 'join_our_teams';
  protected $fillable = [
   'title',
   'description'
  ];
}
