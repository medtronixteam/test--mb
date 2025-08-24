<?php
// app/Livewire/JobListing.php
namespace App\Livewire;

use App\Models\JobPosting;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class JobListing extends Component
{
    use WithPagination, WithFileUploads;

    public $jobTypes = ['full-time', 'part-time', 'contract', 'internship', 'remote'];
    public $filters = [
        'job_type' => '',
        'location' => '',
        'title' => ''
    ];

    public $showApplicationModal = false;
    public $currentJob;
    public $applicantName;
    public $applicantEmail;
    public $applicantPhone;
    public $resume;
    public $coverLetter;

    protected $queryString = [
        'filters' => ['except' => ['job_type' => '', 'location' => '', 'title' => '']]
    ];

    public function mount()
    {
        $this->filters = array_merge([
            'job_type' => '',
            'location' => '',
            'title' => ''
        ], $this->filters);
    }

    public function applyNow($jobId)
    {
        $this->currentJob = JobPosting::active()->findOrFail($jobId);
        $this->showApplicationModal = true;
    }

    public function submitApplication()
    {
        $this->validate([
            'applicantName' => 'required|string|max:255',
            'applicantEmail' => 'required|email|max:255',
            'applicantPhone' => 'required|string|max:20',
            'resume' => 'required|file|mimes:pdf|max:2048',
            'coverLetter' => 'nullable|string|max:1000',
        ]);

        // Store resume
        $resumePath = $this->resume->store('resumes', 'public');

        // Create application
        $this->currentJob->applications()->create([
            'applicant_name' => $this->applicantName,
            'email' => $this->applicantEmail,
            'phone' => $this->applicantPhone,
            'resume_path' => $resumePath,
            'cover_letter' => $this->coverLetter,
        ]);

        // Reset form
        $this->resetApplicationForm();
        $this->showApplicationModal = false;

        session()->flash('success', 'Application submitted successfully!');
    }

    public function resetApplicationForm()
    {
        $this->reset(['applicantName', 'applicantEmail', 'applicantPhone', 'resume', 'coverLetter']);
    }

    public function updatedFilters()
    {
        $this->resetPage();
    }

    public function render()
    {
        $jobs = JobPosting::active()
            ->filter($this->filters)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.job-listing', [
            'jobs' => $jobs
        ])->layout('layouts.admin');
    }
}
