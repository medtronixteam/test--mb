<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
  use HasUlids,HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'name'
    ];
}
