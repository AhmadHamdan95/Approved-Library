<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\ChangePasswordRequest;
use App\Repositories\Admin\Users\UserRepository;
use Illuminate\Http\Request;

class UserChangePasswordController extends Controller
{
    public function edit()
    {
        return response()->view('admin.users.editPassword');
    }

    public function update(ChangePasswordRequest $request, UserRepository $userRepo)
    {
        $data = $request->validated();
        $user = auth('admin')->user();
        $model = $userRepo->update($user->id, $data);

        if (!$model) {
            $request->session()->flash('data', [
                'title' => 'Error',
                'code' => 400,
                'message' => 'Error While Updating'
            ]);
            return redirect()->route('admin.users.index');
        }
        $request->session()->flash('data', [
            'title' => 'success',
            'code' => 200,
            'message' => 'Updated Successfully'
        ]);
        return redirect()->route('admin.users.index');
    }
}
