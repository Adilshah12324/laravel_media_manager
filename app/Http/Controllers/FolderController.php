<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FolderController extends Controller
{
    public function store(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $folderName = $validatedData['name'];
        $folderPath = "app/public/$folderName";

        if (!File::exists(storage_path($folderPath))) {
            File::makeDirectory(storage_path($folderPath), 0755, true);

            $folderName = new Folder();
            $folderName->name = $request->input('name');
            $folderName->save();
            return redirect()->back()->with('success', 'Folder created successfully.');
        }
            return redirect()->back()->with('error', 'Folder already exists.');

    }


    public function delete($id){
        $folder = Folder::find($id);
        $folder->delete();
        $folderPath = public_path('storage/' . $folder->name);

        if (File::exists($folderPath)) {
            File::deleteDirectory($folderPath);
            return redirect()->back()->with('success', 'Folder Deleted successfully.');
        }
    }

    public function edit($id){
        $folder = Folder::find($id);
        $folders = Folder::all();
        return view('layouts.folder_edit',compact('folder','folders'));
    }

    public function update(Request $request, $id){
        $folder = Folder::find($id);
        $oldFolderName = $folder->name;
        $newFolderName = $request->input('name');

        $folder->name = $newFolderName;
        $folder->save();
        $oldFolderPath = public_path("storage/$oldFolderName");
        $newFolderPath = public_path("storage/$newFolderName");

        if (is_dir($oldFolderPath)) {
            rename($oldFolderPath, $newFolderPath);
        }
        return to_route('file.index')->with('success', 'Folder Update successfully.');
    }
}
