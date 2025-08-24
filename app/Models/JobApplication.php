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
        'applicant_name',
        'applicant_id',
        'job_posting_id',
        'email',
        'phone',
        'resume_path',
        'cover_letter',
        'is_approved',
    ];

    public function jobPosting()
    {
        return $this->belongsTo(JobPosting::class);
    }
}
