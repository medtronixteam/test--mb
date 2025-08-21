<!-- resources/views/projects/index.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
         <h2 class="mb-3">Upload Project</h2>
    </div>
 <div class="card-body">

    <form id="projectForm">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required />
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">File</label>
            <input type="file" id="fileInput" class="form-control" required />
            <div class="progress mt-2">
                <div id="progressBar" class="progress-bar" role="progressbar" style="width: 0%">0%</div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
 </div>
</div>

@push('scripts')


<script>

$('#projectForm').on('submit', function(e) {
    e.preventDefault();

    let file = $('#fileInput')[0].files[0];
    let chunkSize = 2 * 1024 * 1024; // 2MB
    let totalChunks = Math.ceil(file.size / chunkSize);
    let fileName = Date.now() + "_" + file.name;

    let formData = new FormData(this);
    formData.append('fileName', fileName);
    formData.append('totalChunks', totalChunks);

    let currentChunk = 0;

    function uploadNextChunk() {
        let start = currentChunk * chunkSize;
        let end = Math.min(start + chunkSize, file.size);
        let chunk = file.slice(start, end);

        let chunkForm = new FormData();
        chunkForm.append('_token', $('input[name="_token"]').val());
        chunkForm.append('file', chunk);
        chunkForm.append('fileName', fileName);
        chunkForm.append('chunkIndex', currentChunk);

        $.ajax({
            url: "{{ route('projects.upload-chunk') }}",
            type: 'POST',
            data: chunkForm,
            processData: false,
            contentType: false,
            success: function() {
                currentChunk++;
                let percent = Math.floor((currentChunk / totalChunks) * 100);
                $('#progressBar').css('width', percent + '%').text(percent + '%');

                if (currentChunk < totalChunks) {
                    uploadNextChunk();
                } else {
                    // All chunks uploaded, now finalize
                    $.ajax({
                        url: "{{ route('projects.store') }}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                             $('#projectForm')[0].reset();
                            $('#progressBar').css('width', '0%').text('0%');
                              flashyAlert('info', "Project created successfully.");
                        }
                    });
                }
            }
        });
    }

    uploadNextChunk();
});
</script>
@endpush
@endsection
