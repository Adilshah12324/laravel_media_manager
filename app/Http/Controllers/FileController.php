<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index(){
        $folders = Folder::all();
        return view('index',compact('folders'));
    }

    public function create($folderName){
        $folders = Folder::all();
        return view('file.create',compact('folderName','folders'));
    }

    public function store(Request $request)
    {
        $file = $request->file('file');
        $folderName = $request->input('folderName');
        $path = $file->store($folderName,'public');

        $uploadedFile = File::create([
            'path' => $path,
            'original_name' => $file->getClientOriginalName(),
        ]);

        return response()->json(['message' => 'File uploaded successfully.', 'file' => $uploadedFile]);
    }
}
