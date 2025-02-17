<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class BlogController extends Controller
{
    public function index(){
        
    }
    public function show(){

    }
    public function store(Request $request ){
        $validator=Validator::make($request->all(),[
            'title' => 'required|min:10',
            'author'=>'required|min:3',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => $validator->messages(),
                'errors' => $validator->errors(),
            ]);
        }
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->author = $request->author;
        $blog->description = $request->description;
        $blog->shortDesc = $request->shortDesc;
        $blog->save();

        return response()->json([
            'status' => true,
            'message' => 'Blog Added Successfully',
            'data' => $blog
        ]);
    }
    public function update(){

    }
    public function destroy(){

    }    
}
