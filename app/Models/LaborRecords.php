<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaborRecords extends Model
{
  use HasFactory;

  protected $table = 'labor_records';
  public $timestamps = false;

  protected $fillable = ['labor', 'count', 'working_days', 'rate', 'amount', 'quotation_number'];
}
