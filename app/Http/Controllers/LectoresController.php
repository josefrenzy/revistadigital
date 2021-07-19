<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Lector;
use App\Models\User;

class LectoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $lectores = User::all();
            return view('lectores.index')
                ->with('lectores', $lectores);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lectores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // if (auth()->user()->type == 2) {
        //     return redirect()->route('revista.index');
        // } else {
        //     $request->validate([
        //         'nombre' => 'required',
        //         'nombre_empresa' => 'required',
        //         'status' => 'required',
        //         'email' => 'required',
        //     ]);
        //     $items = lector::create($request->all());
        //     return back()
        //         ->with('success', 'Lector creado correctamente.');
        // }
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['name'],),
                'type' => $request['type'],
            ]);
            return back()
                ->with('success', 'Artículo creado correctamente.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {   

    //     // $search = lector::findOrFail($id);
    //     // return view('lectores')
    //     //     ->with('search',$search);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $lector = lector::findOrFail($id);
            return view('lectores.edit')
                ->with('lector', $lector);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $data =  $request->except('_token', '_method');
            lector::where('id', $id)
                ->update($data);
            return back()
                ->with('success', 'Lector editado correctamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            dd($id);
        }
    }
}
