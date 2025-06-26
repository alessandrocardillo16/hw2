<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index()
    {
        $user = \App\Models\User::find(Session::get('user_id'));

        return view('home')->with([
            'user' => $user,
        ]);
    }

    public function get_cards()
    {
        $cards = \App\Models\Cards::limit(3)->get();
        return response()->json($cards);
    }
}