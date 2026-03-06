<?php

namespace App\Http\Controllers\API;

use App\DTOs\BlogDTO;
use App\Models\Blog;
use App\Http\Resources\Blog as BlogResource;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Services\Interfaces\BlogServiceInterface;
use App\Http\Controllers\API\BaseController;
use Illuminate\Support\Facades\Auth;

class BlogController extends BaseController
{
    public function __construct(
        protected BlogServiceInterface $blogService
    ) {}

    public function index()
    {
        $blogs = $this->blogService->getAllBlogs();

        return $this->sendResponse(
            BlogResource::collection($blogs),
            'Posts fetched.'
        );
    }

    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;

        $dto = BlogDTO::fromArray($data);

        $blog = $this->blogService->createBlog($dto);

        return $this->sendResponse(
            new BlogResource($blog),
            'Post created.'
        );
    }

    public function show($id)
    {
        $blog = $this->blogService->getBlog($id);

        if (!$blog) {
            return $this->sendError('Post does not exist.');
        }

        return $this->sendResponse(
            new BlogResource($blog),
            'Post fetched.'
        );
    }

    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $data = $request->validated();
        $data['user_id'] = $blog->user_id;

        $dto = BlogDTO::fromArray($data);

        $blog = $this->blogService->updateBlog($blog,$dto);

        return $this->sendResponse(
            new BlogResource($blog),
            'Post updated.'
        );
    }

    public function destroy(Blog $blog)
    {
        $this->blogService->deleteBlog($blog);

        return $this->sendResponse([], 'Post deleted.');
    }
}
