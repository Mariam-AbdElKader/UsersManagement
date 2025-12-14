<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\UpdateUserRequest;
use App\Http\Resources\Client\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        return UserResource::collection($users);
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        return $user->toResource(UserResource::class);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();

        $data = $request->validated();

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);
        return $user->toResource(UserResource::class);
    }
}
