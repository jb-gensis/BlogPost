<?php

namespace App\Repositories\Interfaces;

use App\Models\Blog;
use App\DTOs\BlogDTO;

interface BlogRepositoryInterface
{
    public function getAll();

    public function findById(int $id): ?Blog;

    public function create(BlogDTO $dto): Blog;

    public function update(Blog $blog, BlogDTO $dto): Blog;

    public function delete(Blog $blog): bool;

    public function getBlogsByUser(int $userId);
}
