<!-- resources/views/livewire/job-listing.blade.php -->
<div>
    <!-- Filters Section -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Filter Jobs</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <label for="job_type" class="form-label">Job Type</label>
                    <select wire:model.live="filters.job_type" id="job_type" class="form-control">
                        <option value="">All Job Types</option>
                        @foreach($jobTypes as $type)
                            <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" wire:model.live="filters.location" id="location"
                           class="form-control" placeholder="Enter location">
                </div>
                <div class="col-md-4">
                    <label for="title" class="form-label">Job Title</label>
                    <input type="text" wire:model.live="filters.title" id="title"
                           class="form-control" placeholder="Enter job title">
                </div>
            </div>
        </div>
    </div>

    <!-- Jobs List -->
    @if($jobs->count())
        <div class="row">
            @foreach($jobs as $job)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $job->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $job->company_name }}</h6>

                            <div class="mb-3">
                                <span class="badge bg-primary">{{ ucfirst($job->job_type) }}</span>
                                <span class="badge bg-secondary">{{ $job->location }}</span>
                                @if($job->salary)
                                    <span class="badge bg-success">{{ $job->salary }}</span>
                                @endif
                            </div>

                            <p class="card-text">{{ Str::limit($job->description, 200) }}</p>

                            @if($job->job_tags)
                                <div class="mb-3">
                                    @foreach($job->job_tags_array as $tag)
                                        <span class="badge bg-light text-dark">{{ trim($tag) }}</span>
                                    @endforeach
                                </div>
                            @endif

                            @if($job->deadline)
                                <p class="text-muted">
                                    <small>Apply before: {{ $job->deadline->format('M d, Y') }}</small>
                                </p>
                            @endif
                        </div>
                        <div class="card-footer bg-transparent">
                            <button wire:click="applyNow('{{ $job->id }}')"
                                    class="btn btn-primary btn-sm">
                                Apply Now
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $jobs->links() }}
        </div>
    @else
        <div class="alert alert-info">
            No jobs found matching your criteria.
        </div>
    @endif

    <!-- Application Modal -->
    @if($showApplicationModal && $currentJob)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5)">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Apply for: {{ $currentJob->title }}</h5>
                        <button type="button" class="btn-close" wire:click="showApplicationModal = false"></button>
                    </div>
                    <div class="modal-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form wire:submit="submitApplication">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="applicantName" class="form-label">Full Name *</label>
                                    <input type="text" wire:model="applicantName"
                                           class="form-control" id="applicantName" required>
                                    @error('applicantName') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="applicantEmail" class="form-label">Email *</label>
                                    <input type="email" wire:model="applicantEmail"
                                           class="form-control" id="applicantEmail" required>
                                    @error('applicantEmail') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="applicantPhone" class="form-label">Phone *</label>
                                    <input type="tel" wire:model="applicantPhone"
                                           class="form-control" id="applicantPhone" required>
                                    @error('applicantPhone') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="resume" class="form-label">Resume (PDF) *</label>
                                    <input type="file" wire:model="resume"
                                           class="form-control" id="resume" accept=".pdf" required>
                                    @error('resume') <span class="text-danger">{{ $message }}</span> @enderror
                                    @if($resume)
                                        <small class="text-muted">Selected: {{ $resume->getClientOriginalName() }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="coverLetter" class="form-label">Cover Letter</label>
                                <textarea wire:model="coverLetter" class="form-control"
                                          id="coverLetter" rows="4"
                                          placeholder="Optional cover letter..."></textarea>
                                @error('coverLetter') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        wire:click="showApplicationModal = false">
                                    Cancel
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Submit Application
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
