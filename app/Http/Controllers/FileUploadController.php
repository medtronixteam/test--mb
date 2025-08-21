<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'file' => 'required|file|max:10240', // 10 MB
            'model' => 'required|string',
            'id' => 'required|integer',
        ]);
     if ($validator->fails()) {
      return response()->json(['message' => $validator->messages()->first(),  'success' => false,], 500);

     }

        $model = strtolower($request->model);
        $id = $request->id;
        $file = $request->file('file');

        try {

            $path = $file->store("{$model}/", 'public');

            if($request->model=='Category'){
                Category::find($id)->update(['imageUrl' => $path]);

            }
            return response()->json([
                'success' => true,
                'message' => 'File uploaded successfully.',
                'path' => "/storage/{$path}",
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage(),
            ]);
        }
    }
}
