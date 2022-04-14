<?php

namespace App\Repositories\Admin\Users;

use App\Models\Users\User;

class UserRepository{
    public function getUser($id)
    {
        return User::query()->findOrFail($id);
    }

    public function getUsers($perPage){
        return User::query()->paginate($perPage);
    }

    public function destroy($id)
    {
        return User::query()->findOrFail($id)->delete();
    }

    public function store(array $data)
    {
        return User::query()->create($data);
    }

    public function update($id, array $data)
    {
        return User::query()->findOrFail($id)->update($data);
    }
}