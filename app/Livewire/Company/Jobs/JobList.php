<?php

namespace App\Livewire\Company\Jobs;

use Livewire\Component;
use App\Models\JobPosting;

class JobList extends Component
{
    public $jobs;

    public function mount() {
        $this->jobs = JobPosting::latest()->get();
    }

    public function deleteRow($id) {
        JobPosting::findOrFail($id)->delete();
        $this->jobs = JobPosting::with('tags')->latest()->get();
        session()->flash('success', 'Job deleted successfully!');
    }


    public function render()
    {
        return view('livewire.company.jobs.job-list')->layout('layouts.admin');
    }
}
