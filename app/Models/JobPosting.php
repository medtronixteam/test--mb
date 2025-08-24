<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
class JobPosting extends Model
{
use HasUlids;
    protected $keyType = 'string';
    public $incrementing = false;
     protected $fillable = [
        'title','description','company_name','location',
        'job_type','salary','deadline','is_active','user_id','job_tags',
    ];

    protected $casts = [
        'deadline' => 'date',
        'is_active' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }

    public function getJobTagsArrayAttribute(): array
    {
        return $this->job_tags ? json_decode($this->job_tags,true) : [];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                    ->where(function($query) {
                        $query->whereNull('deadline')
                              ->orWhere('deadline', '>=', now());
                    });
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['job_type'] ?? null, function ($query, $jobType) {
            $query->where('job_type', $jobType);
        })
        ->when($filters['location'] ?? null, function ($query, $location) {
            $query->where('location', 'like', '%'.$location.'%');
        })
        ->when($filters['title'] ?? null, function ($query, $title) {
            $query->where('title', 'like', '%'.$title.'%');
        });
    }
}



