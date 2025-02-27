<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class BlogController extends Controller
{
    public function index(){
        $blogs=Blog::orderBy('created_at','DESC')->get();
        return response()->json([
            'status' => true,
            'data' => $blogs
        ]);
    }
    public function show($id){
        $blog = Blog::find($id);
        if (!$blog) {
            return response()->json([
                'status' => false,
                'message' => 'Blog not found'
                ], 404);
                }
                $blog['date'] = \Carbon\Carbon::parse($blog->created_at)->format('d M, Y');
                return response()->json([
                    'status' => true,
                    'data' => $blog
                    ]);
    }
    public function store(Request $request ){
        $validator=Validator::make($request->all(),[
            'title' => 'required',
            'author'=>'required',
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
    public function update($id, Request $request) {

        $blog = Blog::find($id);

        if ($blog == null) {
            return response()->json([
                'status' => false,
                'message' => 'Blog not found.',
            ]);
        } 

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Please fix the errors',
                'errors' => $validator->errors()
            ]);
        }

        $blog->title = $request->title;
        $blog->author = $request->author;
        $blog->description = $request->description;
        $blog->shortDesc = $request->shortDesc;
        $blog->save();
        }

        public function destroy($id) {

            $blog = Blog::find($id);
    
            if ($blog == null) {
                return response()->json([
                    'status' => false,
                    'message' => 'Blog not found.',
                ]);
            }
    
            // Delete blog from DB
            $blog->delete();
    
            return response()->json([
                'status' => true,
                'message' => 'Blog deleted successfully.'            
            ]);
    
         }    
}
