<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
class JobTag extends Model
{
use HasUlids;
    protected $keyType = 'string';
    public $incrementing = false;
     protected $fillable = [
        'job_id', 'tag_id'
    ];
}
