<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialList extends Model
{
  use HasFactory;

  protected $table = 'materiallist';
  public $timestamps = false;

  protected $fillable = ['item', 'price', 'unit'];
}
