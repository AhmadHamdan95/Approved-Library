<?php

namespace App\Repositories\Frontend\Authors;

use App\Models\Authors\Author;

class AuthorRepository{
    public function getAuthor($id)
    {
        return Author::query()->findOrFail($id);
    }

    public function getAuthors($perPage){
        return Author::query()->paginate($perPage);
    }

    public function destroy($id)
    {
        return Author::query()->findOrFail($id)->delete();
    }

    public function store(array $data)
    {
        return Author::query()->create($data);
    }

    public function update($id, array $data)
    {
        return Author::query()->findOrFail($id)->update($data);
    }
}