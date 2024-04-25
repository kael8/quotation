<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRecords extends Model
{
  use HasFactory;

  protected $table = 'item_records';
  public $timestamps = false;

  protected $fillable = ['item', 'quantity', 'unit', 'rate', 'amount', 'quotation_number'];
}
