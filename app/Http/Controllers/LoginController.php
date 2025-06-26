<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function register_form()
    {
        if(Session::get('user_id')) {
            return redirect('home');
        }

        $error = Session::get('error');
        Session::forget('error');
        return view('register') ->with('error', $error);
    }

    public function do_register()
    {
        if(Session::get('user_id')) {
            return redirect('home');
        }

        if (
            strlen(request('name')) == 0 ||
            strlen(request('surname')) == 0 ||
            strlen(request('email')) == 0 ||
            strlen(request('password')) == 0 ||
            strlen(request('password_confirmation')) == 0 ||
            !request()->has('allow')
        ) {
            Session::put('error', 'Riempi tutti i campi');
            return redirect('register')->withInput();
        }

        if (strlen(request('password')) < 8) {
            Session::put('error', 'Caratteri password insufficienti');
            return redirect('register')->withInput();
        }

        if (request('password') !== request('password_confirmation')) {
            Session::put('error', 'Le password non coincidono');
            return redirect('register')->withInput();
        }

        if (!filter_var(request('email'), FILTER_VALIDATE_EMAIL)) {
            Session::put('error', 'Indirizzo email non valido');
            return redirect('register')->withInput();
        }

        if (\App\Models\User::where('email', strtolower(request('email')))->first()) {
            Session::put('error', 'Email già utilizzata');
            return redirect('register')->withInput();
        }

        if (!request('allow')) {
            Session::put('error', "Devi accettare i termini e condizioni d'uso di D&D Beyond.");
            return redirect('register')->withInput();
        }

        $user = new \App\Models\User();
        $user->name = request('name');
        $user->surname = request('surname');
        $user->email = strtolower(request('email'));
        $user->password = password_hash(request('password'), PASSWORD_BCRYPT);
        $user->save();

        Session::put('user_id', $user->id);

        return redirect("home");
    }


    public function login_form()
    {
        if(Session::get('user_id')) {
            return redirect('home');
        }
        $error = Session::get('error');
        Session::forget('error');
        return view('login')->with('error', $error);
    }

    public function do_login()
    {
        if(Session::get('user_id')) {
            return redirect('home');
        }

        if (strlen(request('email')) == 0 || strlen(request('password')) == 0) {
            Session::put('error', 'Riempi tutti i campi');
            return redirect('login')->withInput();
        }

        $user = \App\Models\User::where('email', strtolower(request('email')))->first();

        if (!$user || !password_verify(request('password'), $user->password)) {
            Session::put('error', 'Email o password errati');
            return redirect('login')->withInput();
        }

        Session::put('user_id', $user->id);
        return redirect("home");
    }

    public function logout()
    {
        Session::flush();
        return redirect('home');
    }

    function profile_view(){
        $user = \App\Models\User::find(Session::get('user_id'));
        if (!$user) {
            return redirect('login');
        }
        

        return view('profile')->with([
            'user' => $user,
        ]);
    }
}
