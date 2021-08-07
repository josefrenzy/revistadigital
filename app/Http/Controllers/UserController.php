<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $users = DB::table('users')
                ->whereIn('type', [2, 1])
                ->orderBy('id','desc')
                ->paginate(5);
            return view('users.index')
                ->with('users', $users);
        }
    }

    public function create()
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            return view('users.create');
        }
    }

    public function store(Request $request)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'type' => $request['type'],
            ]);
            $id = DB::getPdo()->lastInsertId();
            User::where('id', $id)
                ->update([
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'type' => $request['type'],
                ]);
            return back()
                ->with('success', 'Artículo creado correctamente.');
        }
    }
    public function edit($id)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $user = User::find($id);
            return view('users.edit')
                ->with('user', $user);
        }
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            if ($request['password'] != '') {
                User::where('id', $id)
                    ->update([
                        'name' => $request['name'],
                        'email' => $request['email'],
                        'password' => Hash::make($request['password']),
                        'type' => $request['type'],
                    ]);
                return back()
                    ->with('success', 'Usuario editado correctamente.');
            } else {
                User::where('id', $id)
                    ->update([
                        'name' => $request['name'],
                        'email' => $request['email'],
                        'type' => $request['type'],
                    ]);
                return back()
                    ->with('success', 'Usuario editado correctamente.');
            }
        }
    }

    public function destroy($id){
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $user = User::find($id);
            $user->delete();
            return back()
                    ->with('success', 'Usuario eliminado correctamente.');
        }
    }
}
