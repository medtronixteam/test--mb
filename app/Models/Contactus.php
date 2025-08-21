<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
class Contactus extends Model
{

    use HasUlids;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'inquiry_type',
        'message',
    ];
}
