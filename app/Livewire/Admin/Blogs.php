<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Blog;
class Blogs extends Component
{

    public $blogs;


    public function mount()
    {
        $this->loadProjects();
    }

    public function loadProjects()
    {
        $this->blogs = Blog::latest()->get();
    }
    public function render()
    {
        return view('livewire.admin.blogs')->layout('layouts.admin');
    }
}
