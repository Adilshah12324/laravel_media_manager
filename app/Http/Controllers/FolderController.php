<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

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
}
