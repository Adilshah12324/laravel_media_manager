<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index(){
        $folders = Folder::where('user_id',auth()->user()->id)->get();
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
        $folder = Folder::where('name', $folderName)->first();
        $path = $file->store($folderName,'public');

        $uploadedFile = File::create([
            'folder_id' => $folder->id,
            'path' => $path,
            'original_name' => $file->getClientOriginalName(),
        ]);

        return response()->json(['message' => 'File uploaded successfully.', 'file' => $uploadedFile]);
    }

    public function delete(Request $request, $id){
        $file = File::find($id);
        $file->delete();
        $folderPath = public_path('storage/'. $file->path);
        if (\Illuminate\Support\Facades\File::exists($folderPath)) {
            \Illuminate\Support\Facades\File::delete($folderPath);
            return redirect()->back()->with('success', 'File Deleted successfully.');
        }
    }
}
