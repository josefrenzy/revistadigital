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
        $this->validate($request, [
            'email' => 'required|email',
        ]);
        // se guarda en la base de datos
        Suscribe::create($request->all());
        //se envia el correo
        $details = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp',
            'email' => $request->get('email')
        ];
       
        Mail::to($request->input('email'))->send(new \App\Mail\ContactanosMailable($details));
       
        // dd("Email is Sent.");
        // Mail::send(
        //     'emails.email',
        //     array(
        //         'email' => $request->get('email'),
        //     ),
        //     function ($message) {
        //         $message->from('techanical-atom@gmail.com');
        //         $message->to('user@example.com', 'Admin')
        //             ->subject('Suscripcion');
        //     }
        // );
        return back()->with('success', 'Gracias por suscribirte al boletín.');
    }
    public function destroy($id){
        if (auth()->user()->type == 2) {
            return redirect()->route('revista.index');
        } else {
            $user = Suscribe::find($id);
            $user->delete();
            return back()
                    ->with('success', 'Usuario eliminado correctamente.');
        }
    }
}
