<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('users.index')
            ->with('users',$users);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return back()
            ->with('success', 'Artículo creado correctamente.');
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit')
            ->with('user', $user);
    }

    public function update(Request $request)
    {
        dd($request);
    }

    public function show($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('users')
            ->with('success', 'Artículo creado correctamente.');
    }
}
