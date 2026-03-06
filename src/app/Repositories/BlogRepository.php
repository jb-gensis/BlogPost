<?php

namespace App\Repositories;

use App\Models\Blog;
use App\DTOs\BlogDTO;
use App\Repositories\Interfaces\BlogRepositoryInterface;

class BlogRepository implements BlogRepositoryInterface
{
    public function getAll()
    {
        return Blog::join('users','users.id','=','blogs.user_id')
            ->orderBy('blogs.updated_at','desc')
            ->get(['blogs.*','users.name']);
    }

    public function findById(int $id): ?Blog
    {
        return Blog::find($id);
    }

    public function create(BlogDTO $dto): Blog
    {
        return Blog::create([
            'title' => $dto->title,
            'description' => $dto->description,
            'user_id' => $dto->user_id
        ]);
    }

    public function update(Blog $blog, BlogDTO $dto): Blog
    {
        $blog->update([
            'title' => $dto->title,
            'description' => $dto->description
        ]);

        return $blog;
    }

    public function delete(Blog $blog): bool
    {
        return $blog->delete();
    }

    public function getBlogsByUser(int $userId)
    {
        return Blog::where('user_id', $userId)
            ->join('users', 'users.id', '=', 'blogs.user_id')
            ->orderBy('blogs.updated_at', 'desc')
            ->get(['blogs.*', 'users.name']);
    }
}
