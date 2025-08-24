<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
        use HasUlids;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'job_posting_id',
        'applicant_name',
        'email',
        'phone',
        'resume_path',
        'cover_letter'
    ];

    public function jobPosting()
    {
        return $this->belongsTo(JobPosting::class);
    }
}
