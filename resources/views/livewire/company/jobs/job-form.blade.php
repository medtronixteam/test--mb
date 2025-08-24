<div class="container mt-4">
    @push('css')
        <link rel="stylesheet" href="{{ url('assets/modules/select2/dist/css/select2.min.css') }}">
    @endpush
    <h2>{{ $jobId ? 'Edit Job' : 'Create Job' }}</h2>

    <form wire:submit.prevent="save">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" wire:model="title">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" rows="5" wire:model="description"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Company</label>
            <input type="text" class="form-control" wire:model="company_name">
        </div>

        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" class="form-control" wire:model="location">
        </div>

        <div class="mb-3">
            <label class="form-label">Job Type</label>
            <select class="form-control" wire:model="job_type">
                <option value="">-- Select --</option>
                <option value="full-time">Full Time</option>
                <option value="part-time">Part Time</option>
                <option value="contract">Contract</option>
                <option value="internship">Internship</option>
                <option value="remote">Remote</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Job Tags (comma separated)</label>
            @foreach ($allTags as $tag)
                <div>
                    <input type="checkbox" value="{{ $tag->name }}" wire:model="job_tags"> {{ $tag->name }}
                </div>
            @endforeach

            @error('job_tags')
                <div class="text-danger">{{ $message }}</div>
            @enderror

        </div>
        <div class="mb-3">
            <label class="form-label">Salary <span>10k-20k ,10k </span> </label>
            <input type="text" class="form-control" wire:model="salary">
            @error('salary')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Deadline</label>
            <input type="date" class="form-control" wire:model="deadline">
            @error('deadline')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-success">Save Job</button>
        <a href="{{ route('jobs.list') }}" class="btn btn-secondary">Back</a>
    </form>
    @push('scripts')
        <script src="{{ url('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    @endpush
</div>
