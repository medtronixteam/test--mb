<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class BlogController extends Controller
{
       public function getallProjects()
    {
        $projects = Blog::latest()->get();
        return response()->json($projects);
    }
    public function index()
    {
        return view('admin.blogs.index');
    }

    public function uploadChunk(Request $request)
    {
        $file = $request->file('file');
        $fileName = $request->fileName;
        $chunkIndex = $request->chunkIndex;

        $tempPath = storage_path('app/chunks/' . $fileName);

        if (!file_exists($tempPath)) {
            mkdir($tempPath, 0777, true);
        }

        $file->move($tempPath, $chunkIndex);

        return response()->json(['status' => 'chunk_uploaded']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'fileName'    => 'required|string',
            'totalChunks' => 'required|integer',
        ]);

        $fileName = $request->fileName;
        $tempPath = storage_path('app/chunks/' . $fileName);
        $finalPath = storage_path('app/public/uploads/' . $fileName);

        $out = fopen($finalPath, "ab");

        for ($i = 0; $i < $request->totalChunks; $i++) {
            $chunk = $tempPath . '/' . $i;
            $in = fopen($chunk, "rb");
            stream_copy_to_stream($in, $out);
            fclose($in);
            unlink($chunk);
        }
        fclose($out);

        rmdir($tempPath);

        $mimeType = mime_content_type($finalPath);
        $fileType = str_starts_with($mimeType, 'image') ? 'image' : 'video';

        $fileUrl = 'storage/uploads/' . $fileName;

        Blog::create([
            'title'       => $request->title,
            'description' => $request->description,
            'file_url'    => url($fileUrl),
            'file_type'   => $fileType,
        ]);

        return response()->json(['status' => 'success', 'file_url' => $fileUrl]);
    }
}
