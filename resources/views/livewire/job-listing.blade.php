<div >
    <!-- Optional: Add Font Awesome & Google Fonts for better icons and typography -->
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .bg-gradient-primary {
            background: linear-gradient(90deg, #0d6efd, #0b5ed7);
        }
        .text-muted i {
            opacity: 0.7;
        }
        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
@endpush
    <!-- Filters Section -->
    <div class="card shadow-sm mb-4 border-0" style="margin-top: -20px;">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Available Jobs</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="job_type" class="form-label fw-semibold">Job Type</label>
                    <select wire:model.live="filters.job_type" id="job_type" class="form-control">
                        <option value="">All Job Types</option>
                        @foreach($jobTypes as $type)
                            <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="location" class="form-label fw-semibold">Location</label>
                    <input type="text" wire:model.live="filters.location" id="location"
                           class="form-control" placeholder="e.g. New York, Remote">
                </div>
                <div class="col-md-4">
                    <label for="title" class="form-label fw-semibold">Job Title</label>
                    <input type="text" wire:model.live="filters.title" id="title"
                           class="form-control" placeholder="e.g. Laravel Developer">
                </div>
            </div>
        </div>
    </div>

    <!-- Jobs List -->
    @if($jobs->count())
        <div class="job-list">
            @foreach($jobs as $job)
                <div class="card mb-4 shadow-sm border-light">
                    <div class="card-body p-4">
                        <!-- Job Title & Company -->
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="mb-1 fw-bold text-dark">{{ $job->title }}</h5>
                                <p class="mb-0 text-primary fs-6">{{ $job->company_name }}</p>
                            </div>
                            <span class="badge bg-light text-dark border">{{ ucfirst($job->job_type) }}</span>
                        </div>

                        <!-- Badges -->
                        <div class="mb-1">
                            <span class="badge bg-secondary  text-dark me-2">
                                <i class="fas fa-map-marker-alt mr-1"></i>{{ $job->location }}
                            </span>
                            @if($job->salary)
                                <span class="badge bg-success  text-dark me-2">
                                    <i class="fas fa-dollar-sign mr-1"></i>{{ $job->salary }}
                                </span>
                            @endif
                            @if($job->deadline)
                                <span class="badge bg-info  text-dark">
                                    <i class="far fa-clock mr-1"></i>Apply by {{ $job->deadline->format('M d') }}
                                </span>
                            @endif
                        </div>

                        <!-- Description -->
                        <p class="text-muted mb-1">
                            {{ Str::limit(strip_tags($job->description), 250) }}
                        </p>

                        <!-- Tags -->
                        @if($job->job_tags)
                            <div class="mb-3">
                                @foreach($job->job_tags_array as $tag)
                                    <span class="badge bg-light text-muted border me-1 px-2 py-1">
                                        #{{ trim($tag) }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <!-- Footer -->
                        <div class="d-flex justify-content-end">
                            <button wire:click="applyNow('{{ $job->id }}')"
                                    class="btn btn-outline-primary btn-sm px-4">
                                <i class="fas fa-paper-plane me-1"></i> Apply Now
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $jobs->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-briefcase fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">No jobs found matching your criteria.</h5>
            <p class="text-secondary">Try adjusting your filters to see more results.</p>
        </div>
    @endif

    <!-- Application Modal -->
    @if($showApplicationModal && $currentJob)
        <div class="modal fade show d-block" tabindex="-1" style="background-color: rgba(0,0,0,0.5);" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg">
                    <div class="modal-header bg-white border-0">
                        <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Apply for: <strong>{{ $currentJob->title }}</strong></h5>
                        <button type="button" class="btn-close" wire:click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                            </div>
                        @endif

                        <form wire:submit="submitApplication">
                            <div class="row g-3">
                                <div class="col-md-6 mb-1">
                                    <label class="form-label fw-semibold">Full Name *</label>
                                    <input type="text" wire:model="applicantName" class="form-control @error('applicantName') is-invalid @enderror" placeholder="John Doe" required>
                                    @error('applicantName') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="form-label fw-semibold">Email *</label>
                                    <input type="email" wire:model="applicantEmail" class="form-control @error('applicantEmail') is-invalid @enderror" placeholder="john@example.com" required>
                                    @error('applicantEmail') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="form-label fw-semibold">Phone *</label>
                                    <input type="tel" wire:model="applicantPhone" class="form-control @error('applicantPhone') is-invalid @enderror" placeholder="+1 (555) 123-4567" required>
                                    @error('applicantPhone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6 mb-1">
                                    <label class="form-label fw-semibold">Resume (PDF) *</label>
                                    <input type="file" wire:model="resume" class="form-control @error('resume') is-invalid @enderror" accept=".pdf" required>
                                    @error('resume') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    @if($resume)
                                        <small class="text-success mt-1 d-block"><i class="fas fa-file-pdf me-1"></i>Selected: {{ $resume->getClientOriginalName() }}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-3">
                                <label class="form-label fw-semibold">Cover Letter (Optional)</label>
                                <textarea wire:model="coverLetter" class="form-control" rows="4" placeholder="Why should we hire you?"></textarea>
                                @error('coverLetter') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="modal-footer border-0 pt-4">
                                <button type="button" class="btn btn-secondary" wire:click="closeModal">
                                    <i class="fas fa-times me-1"></i> Cancel
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane me-1"></i> Submit Application
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>


