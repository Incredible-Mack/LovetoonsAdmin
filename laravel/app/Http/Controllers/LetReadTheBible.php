<?php

namespace App\Http\Controllers;

use App\Models\letReadTheBibleVideo;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class LetReadTheBible extends Controller
{
    //

    public function addvideo(){
        return view('readthebible/addvideo');
    }

    public function store(Request $request)
    {

        $filename = ''; 

        //validating request
        $request->validate([
            'firstname' => 'string|regex:/^[a-zA-Z ]+$/',
            'lastname' => 'string|regex:/^[a-zA-Z ]+$/',
            'image' => 'required',
            'link' => 'required|min:10',
            'chapter' => 'required|string|min:5'
        ]);


        if ($request->hasFile("image")) {
            $image = $request->file("image");
            $filename = $image->getClientOriginalName(); // Get the original file name
            $filepath = public_path('bibleimages'); // Make sure 'product-images' directory exists

            if (File::exists($filepath . '/' . $filename)) {
                // return redirect('addvideo')->with("fileerror","File Already Exist");
                return redirect()->back()->withErrors(['fileerror' => 'File Already Exists'])->withInput();
            }
        
            $image->move($filepath, $filename);
        }
        
        $filename =  'bibleimages/' . $filename;

       
        letReadTheBibleVideo::create(
            [
                'fullname' => $request->input('firstname') . ' ' . $request->input('lastname'),
                'biblechapter' => $request->input('chapter'),
                'link' => $request->input('link'),
                'image' => $filename,
                'reg_date' => date('Y-m-d')
            ]
        );

    

        return redirect('addvideo')->with('success', 'Video Added Successfully');
        
        
    }

   
}
