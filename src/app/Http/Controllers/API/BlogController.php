<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Blog;
use App\Http\Resources\Blog as BlogResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class BlogController extends BaseController
{
    public function index()
    {
        $blogs = Blog::join('users', 'users.id','=','blogs.user_id')
                    ->orderBy('updated_at','desc')->get(['blogs.*','users.name']);
                    
        return $this->sendResponse(BlogResource::collection($blogs), 'Posts fetched.');
    }
    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $input['user_id'] = Auth::id();
        $blog = Blog::create($input);

        return $this->sendResponse(new BlogResource($blog), 'Post created.');
    }
   
    public function show($id)
    {
        $blog = Blog::find($id);

        if (is_null($blog)) {
            return $this->sendError('Post does not exist..');
        }

        return $this->sendResponse(new BlogResource($blog), 'Post fetched.');
    }
 
    public function update(Request $request, Blog $blog)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        if ($blog->user_id == Auth::id()) {
            $blog->title = $input['title'];
            $blog->description = $input['description'];
            $blog->save();

            return $this->sendResponse(new BlogResource($blog), 'Post updated.');
        }
        
        return $this->sendError('Unauthorized', 'Unauthorized to update blog post', 401); 
    }
   
    public function destroy(Blog $blog)
    {
        if ($blog->user_id == Auth::id()) {
            $blog->delete();
            return $this->sendResponse([], 'Post deleted.');
        }

        return $this->sendError('Unauthorized', 'Unauthorized to delete blog post', 401);
    }

}
