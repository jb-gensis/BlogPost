<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Blog;
use App\Http\Resources\Blog as BlogResource;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CustomBlogController extends BaseController
{
    public function showAllBlogAuth()
    {
        $blogs = Blog::where('user_id', Auth::id())
                    ->join('users', 'users.id','=','blogs.user_id')
                    ->orderBy('updated_at','desc')->get(['blogs.*','users.name']);

        return $this->sendResponse(BlogResource::collection($blogs), 'Post fetched.');
    }
}
