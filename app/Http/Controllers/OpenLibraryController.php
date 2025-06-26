<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OpenLibraryController extends Controller
{
    public function fetch()
    {
        $url = "https://openlibrary.org/search.json?author=Wizards+RPG+Team";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);

        return $response;

        curl_close($curl);
    }
}