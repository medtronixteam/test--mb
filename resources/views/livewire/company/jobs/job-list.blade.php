<div class="card">
    <div class="card-body d-flex justify-content-between align-items-center">
        <h2>Job Postings</h2>
    <a href="{{ route('jobs.create') }}" class="btn btn-primary mb-3">+ Add Job</a>


    </div>
    <div class="card-body">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>Title</th>

                <th>Type</th>

                <th>Deadline</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($jobs as $job)
            <tr>
                <td>{{ $job->title }}</td>

                <td>{{ ucfirst($job->job_type) }}</td>

                <td>{{ $job->deadline }}</td>
                <td>
                    <span class="badge {{ $job->is_active ? 'bg-success' : 'bg-danger' }}">
                        {{ $job->is_active ? 'Active' : 'Closed' }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <button wire:click="deleteRow('{{ $job->id }}')" class="btn btn-sm btn-danger">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</div>
