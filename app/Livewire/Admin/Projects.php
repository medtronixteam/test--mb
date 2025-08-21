<?php

namespace App\Livewire\Admin;

use Livewire\WithFileUploads;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
class Projects extends Component
{
    use WithFileUploads;

    public $projects;


    public function mount()
    {
        $this->loadProjects();
    }

    public function loadProjects()
    {
        $this->projects = Project::latest()->get();
    }


    public function render()
    {
        return view('livewire.admin.projects')->layout('layouts.admin');
    }


}
