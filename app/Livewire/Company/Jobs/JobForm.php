<?php

namespace App\Livewire\Company\Jobs;



use Livewire\Component;
use App\Models\JobPosting;
use App\Models\Tag;

class JobForm extends Component
{
    public $jobId, $title, $description, $company_name, $location, $job_type, $salary, $deadline, $is_active = true;
    public $job_tags = [];

    public function mount($id = null) {
        if ($id) {
            $job = JobPosting::with('tags')->findOrFail($id);
            $this->jobId = $job->id;
            $this->title = $job->title;
            $this->description = $job->description;
            $this->company_name = $job->company_name;
            $this->location = $job->location;
            $this->job_type = $job->job_type;
            $this->salary = $job->salary;
            $this->deadline = $job->deadline;
            $this->is_active = $job->is_active;
            $this->job_tags =json_decode($job->job_tags,true);
        }
    }

    public function save() {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'company_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'job_type' => 'required',
            'job_tags' => 'required',
        ]);

        $job = JobPosting::updateOrCreate(
            ['id' => $this->jobId],
            [
                'title' => $this->title,
                'description' => $this->description,
                'company_name' => $this->company_name,
                'location' => $this->location,
                'job_type' => $this->job_type,
                'job_tags' =>json_encode($this->job_tags),
                'salary' => $this->salary,
                'deadline' => $this->deadline,
                'is_active' => 1,
                'user_id' => auth()->id(),
            ]
        );



        session()->flash('success', 'Job saved successfully!');
        return redirect()->route('jobs.list');
    }

    public function render() {
        return view('livewire.company.jobs.job-form', [
            'allTags' => Tag::all()
        ])->layout('layouts.admin');
    }
}
