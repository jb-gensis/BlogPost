<?php

namespace App\Services\Interfaces;

use App\Models\Blog;
use App\DTOs\BlogDTO;

interface BlogServiceInterface
{
    public function getAllBlogs();

    public function getBlog(int $id): ?Blog;

    public function createBlog(BlogDTO $dto): Blog;

    public function updateBlog(Blog $blog, BlogDTO $dto): Blog;

    public function deleteBlog(Blog $blog): bool;

    public function getAuthUserBlogs(int $userId);
}
