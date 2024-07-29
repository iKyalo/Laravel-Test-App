<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadsController extends Controller
{
    public function upload_photo(Request $request, $folder, $name = "photo") {
        $folder = strtolower($folder);
        
        if ($request->hasFile($name)) {
            $file = $request->file($name);
            
            // Generate a unique file name
            $fileName = time() . '_' . uniqid() . "." . $file->getClientOriginalExtension();
    
            // Store the file
            $filePath = $file->storeAs('public/photos/' . $folder, $fileName);
            
            // Return the storage path and final path
            return [
                'file_name' => $fileName,
                'storage_path' => $filePath,
                'final_path' => asset('storage/photos/' . $folder . '/' . $fileName)
            ];
        } else {
            // Return an error response if no file is uploaded
            return response()->json(['error' => 'No file uploaded.'], 400);
        }
    }
}
