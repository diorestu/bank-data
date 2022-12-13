<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function index()
    {
        return view('about');
    }

    public function uploadToServer(Request $request)
    {
        $request->validate([
            'file' => 'required',
        ]);

        $name = time() . '.' . request()->file->getClientOriginalExtension();

        $request->file->move(public_path('uploads'), $name);

        $file = new FileUpload;
        $file->title = $name;
        $file->save();

        return response()->json(['success' => 'Successfully uploaded.']);
    }
}
