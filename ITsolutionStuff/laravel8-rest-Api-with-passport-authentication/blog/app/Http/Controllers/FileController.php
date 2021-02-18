<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;

class FileController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('dashboard/create');
    }
    public function store(Request $request){
        $this->validate($request, [
            'filenames' => 'required',
            'filenames.*' => 'image'
        ]);

        $files = [];
        if($request->hasFile('filesnames')){
            foreach ($request->file('filesnames') as $file){
                 $name = time().rand(1, 100).'.'.$file->extension();
                $file->move(public_path('files'), $name);
                $files[] = $name;
            }
        }
        $file = new File();
        $file->filenames = $files;
        $file->save();

        return back()->with('success', 'data your files has been succesfully added');
    }
}
