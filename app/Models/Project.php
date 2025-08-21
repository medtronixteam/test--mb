<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
class Project extends Model
{
    use HasUlids;
    protected $keyType = 'string';
    public $incrementing = false;
     protected $fillable = [
        'title', 'description', 'file_url', 'file_type'
    ];
}
