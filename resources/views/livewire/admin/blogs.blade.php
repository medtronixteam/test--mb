<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="mb-0">Blogs</h3>
       <a href="{{ route('blogs.index') }}" class="btn btn-primary">Add Blog</a>
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
            @foreach($blogs as $blog)
            <tr>
                <td>{{ $blog->title }}</td>
                <td>{{ \Str::limit($blog->description, 50, '...') }}</td>
                <td><a href="{{ asset('storage/' . $blog->file_url) }}" target="_blank">View File</a></td>
                <td>
                    <!-- Add actions like edit or delete if needed -->
                </td>
            </tr>
            @endforeach
        </tbody>

      </table>
    </div>
</div>
