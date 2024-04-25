<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestorList extends Model
{
  use HasFactory;

  protected $table = 'requestorlist';
  public $timestamps = false;

  protected $fillable = ['requestor', 'department', 'local'];
}
