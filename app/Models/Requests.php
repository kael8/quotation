<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
  use HasFactory;

  protected $table = 'quotation_request';
  public $timestamps = false;

  protected $fillable = ['job_request_no', 'requestor_id', 'subject', 'status'];
}
