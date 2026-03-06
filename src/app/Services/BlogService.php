<?php

namespace App\Services;

use App\Models\Blog;
use Illuminate\Support\Facades\Auth;
use App\DTOs\BlogDTO;
use App\Services\Interfaces\BlogServiceInterface;
use App\Repositories\Interfaces\BlogRepositoryInterface;

class BlogService implements BlogServiceInterface
{
    public function __construct(
        protected BlogRepositoryInterface $blogRepository
    ) {}

    public function getAllBlogs()
    {
        return $this->blogRepository->getAll();
    }

    public function getBlog(int $id): ?Blog
    {
        return $this->blogRepository->findById($id);
    }

    public function createBlog(BlogDTO $dto): Blog
    {
        return $this->blogRepository->create($dto);
    }

    public function updateBlog(Blog $blog, BlogDTO $dto): Blog
    {
        if ($blog->user_id !== Auth::id()) {
            throw new \Exception('Unauthorized');
        }

        return $this->blogRepository->update($blog,$dto);
    }

    public function deleteBlog(Blog $blog): bool
    {
        if ($blog->user_id !== Auth::id()) {
            throw new \Exception('Unauthorized');
        }

        return $this->blogRepository->delete($blog);
    }

    public function getAuthUserBlogs(int $userId)
    {
        return $this->blogRepository->getBlogsByUser($userId);
    }
}
