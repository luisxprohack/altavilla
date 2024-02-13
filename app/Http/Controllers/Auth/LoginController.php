<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username(){
        return 'username';
    }

    public function authenticated(Request $request,User $user)
    {
        // verificamos si el usuario esta bloqueado
        if ($user->estado == 0) {
            $request->session()->invalidate();
            return redirect('login')->with('msj', "El usuario <u><b>" . $request->username . "</b></u> está bloqueado, por favor comuniquese con el administrador del sistema.");
        }

        //Actualizamos la ultima fecha de acceso
        $user->fecha_acceso = $user->fecha_acceso_fin == null ? now() : $user->fecha_acceso_fin;
        $user->fecha_acceso_fin = now();
        $user->save();

        return redirect($this->redirectTo);
    }

}
