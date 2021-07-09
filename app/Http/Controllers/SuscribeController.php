<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Suscribe;
// use Mail;
use Illuminate\Support\Facades\Mail;

class SuscribeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(){
        $suscripciones = Suscribe::paginate(5);
        return view('emails.index')
            ->with('suscripciones',$suscripciones);
    }
    
    public function suscribe()
    {
        return view('emails.suscribe');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function suscribePost(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'email' => 'required|email',
        ]);
        // se guarda en la base de datos
        Suscribe::create($request->all());
        //se envia el correo
        Mail::send(
            'emails.email',
            array(
                'email' => $request->get('email'),
            ),
            function ($message) {
                $message->from('techanical-atom@gmail.com');
                $message->to('user@example.com', 'Admin')
                    ->subject('Contact Form Query');
            }
        );


        return back()->with('success', 'Thanks for contacting us!');
    }
}
