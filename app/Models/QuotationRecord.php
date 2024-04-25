<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationRecord extends Model
{
  use HasFactory;

  protected $table = 'quotation_record';
  public $timestamps = false;

  protected $fillable = [
    'quotation_number',
    'quotation_date',
    'validity',
    'reference_number',
    'requestor',
    'quotation_to',
    'inCharge',
    'subject',
    'letter',
    'preparedBy',
    'checkedBy',
    'approvedBy',
    'department',
    'local',
    'thru',
    'itemTotal',
    'laborTotal',
    'numItem',
    'numLabor',
    'overhead_profit',
    'total',
    'numWords',
    'br1',
    'br2',
  ];
}
