<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SearchController extends Controller
{
function search_form(Request $request, $query)
{
    $user = null;
    $user_id = Session::get('user_id');
    if ($user_id) {
         $user = \App\Models\User::find($user_id);
    }
    return view('search', ['user' => $user, 'query' => $query]);
}
}