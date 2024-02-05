<?php

namespace App\Http\Controllers\API;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return response()->json([
            'status'=> 200,
            'posts'=>$posts,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title'=>'required',
            'image'=>'required',
            'description'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=> 422,
                'validate_err'=> $validator->messages(),
            ]);
        }
        else
        {
            $post = new Post;
            $post->title = $request->input('title');
            $post->image = $request->input('image');
            $post->description = $request->input('description');
            $post->save();

            return response()->json([
                'status'=> 200,
                'message'=>'Post Added Successfully',
            ]);
        }

    }

    public function edit($id)
    {
        $post = Post::find($id);
        if($post)
        {
            return response()->json([
                'status'=> 200,
                'post' => $post,
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Post ID Found',
            ]);
        }

    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'title'=>'required',
            'image'=>'required',
            'description'=>'required',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=> 422,
                'validationErrors'=> $validator->messages(),
            ]);
        }
        else
        {
            $post = Post::find($id);
            if($post)
            {

                $post->title = $request->input('title');
                $post->image = $request->input('image');
                $post->description = $request->input('description');
                $post->update();

                return response()->json([
                    'status'=> 200,
                    'message'=>'Post Updated Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=> 404,
                    'message' => 'No Post ID Found',
                ]);
            }
        }
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if($post)
        {
            $post->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Post Deleted Successfully',
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message' => 'No Post ID Found',
            ]);
        }
    }
}
