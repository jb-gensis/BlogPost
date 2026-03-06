<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Blog as BlogResource;
use App\Services\Interfaces\BlogServiceInterface;
use Illuminate\Support\Facades\Auth;

class CustomBlogController extends BaseController
{
    public function __construct(
        protected BlogServiceInterface $blogService
    ) {}

    public function showAllBlogAuth()
    {
        $blogs = $this->blogService->getAuthUserBlogs(Auth::user()->id);

        return $this->sendResponse(
            BlogResource::collection($blogs),
            'Post fetched.'
        );
    }
}
