<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Projects</h3>
       <a href="{{ route('projects.index') }}" class="btn btn-primary">Add Project</a>
    </div>
    <div class="card-body">
      <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>File</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr>
                <td>{{ $project->title }}</td>
                <td>{{ \Str::limit($project->description, 50, '...') }}</td>
                <td><a href="{{ asset('storage/' . $project->file_url) }}" target="_blank">View File</a></td>
                <td>
                    <!-- Add actions like edit or delete if needed -->
                </td>
            </tr>
            @endforeach
        </tbody>

      </table>
    </div>
</div>
