<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\UpdateUserRequest;
use App\Models\user;
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
        return view('client.users.index', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        return view('client.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('client.users.edit', compact('user'));
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
        return to_route('home')->with('success', 'Your profile has been updated successfully');
    }
}
