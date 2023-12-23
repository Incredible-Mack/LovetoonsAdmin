<?php

namespace App\Http\Controllers;

use App\Models\biblevideo;
use App\Models\letReadTheBibleVideo;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Exception;

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
        
        
        public function deletevideo(Request $request){
            $videoItem  = $request->id;
            
            $type = $request->type;

  
            
            try {
                // Update the record
                if($type === 'biblevideo')
                    {
                        biblevideo::where('id', $videoItem)->update([
                            'deleteStatus' => 'deleted',
                        ]);

                        
                    }else{
                        letReadTheBibleVideo::where('id', $videoItem)->update([
                            'status' => 'deleted',
                        ]);
                    }
               
                
                // If the update is successful, return a success message
                return response()->json(['message' => 'Video deleted successfully'], 200);
            } catch (Exception $e) {
                // If an error occurs during the update, return an error message
                return response()->json(['error' => 'Failed'], 500);
            }
            
            
            
        }
        
        
        
        
        public function editvideo ($id){
            
            try {
                $videos = letReadTheBibleVideo::findOrFail($id);
                return view('readthebible.editvideo', compact('videos'));
            } catch (ModelNotFoundException $e) {
                return view('404');
            }
    
            
        }
        
        
        public function fetchvideo (){
            
            $videos = letReadTheBibleVideo::all()->where('status', 'active');
            return view('readthebible/updatevideo', compact('videos'));
            
        }

        public function updatevideo(Request $request){
            $request->validate([
                'fullname' => 'string|regex:/^[a-zA-Z ]+$/',
                'link' => 'required|min:10',
                'image' => ['sometimes', 'image', 'mimes:jpeg,png,jpg,gif'],
                'chapter' => 'required|string|min:5'
            ]);



            if ($request->hasFile("image")) {
                $image = $request->file("image");
                $filename = $image->getClientOriginalName(); // Get the original file name
                $filepath = public_path('bibleimages'); // Make sure 'product-images' directory exists
                
                if (File::exists($filepath . '/' . $filename)) {
                    return redirect()->back()->withErrors(['fileerror' => 'File Already Exists'])->withInput();
                }
                $image->move($filepath, $filename);
                $filename =  'bibleimages/' . $filename;
            }else{
                $filename =  $request->input('filename');
            }
            
            
            
            $id = $request->input('id');
            letReadTheBibleVideo::where('id', $id)->update([
                    'fullname' => $request->input('fullname'),
                    'biblechapter' => $request->input('chapter'),
                    'link' => $request->input('link'),
                    'image' => $filename,
                    'reg_date' => date('Y-m-d')
                    ]);

            
            
                
            return back()->with('success', "Video Updated Successfully ");


        }        

    
        public function fetchuploadedvideo(){
            $videos  = $videos = biblevideo::where('deleteStatus', '!=', 'deleted')->get();
            return view('readthebible.uploadedvideo', compact('videos'));

        }

        public function confirmvideo(Request $request){

            try{
                $id = $request->input('id');
                biblevideo::where('id', $id )->update([
                    'status' => 1
                ]);

                return response()->json(['message' => 'successfully updated video status'], 200);

            }catch(Exception $e){
                return response()->json(['error' => 'Failed'], 500);
            }
            



         
        }
        
        
    }
    