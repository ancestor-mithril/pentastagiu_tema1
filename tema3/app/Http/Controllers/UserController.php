<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', ['users' => $users]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:32'
        ]);
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('email'));
        $user->save();
        return Redirect::to('user');
    }

    public function show(int $id)
    {
        $user = User::find($id);
        return view('user.show', ['user' => $user]);
    }

    public function edit(int $id)
    {
        $user = User::find($id);
        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:32'
        ]);
        $updatedUser = User::find($id);
        $updatedUser->name = $request->input('name');
        $updatedUser->email = $request->input('email');
        $updatedUser->password = Hash::make($request->input('email'));
        $updatedUser->save();
        return Redirect::to('user');
    }

    public function destroy(int $id)
    {
        $user = User::find($id);
        $user->delete();
        return Redirect::to('user');
    }
}
