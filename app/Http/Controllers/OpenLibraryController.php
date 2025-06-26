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

        if (curl_errno($curl)) {
            return response()->json([
                "error" => "Errore nella richiesta cURL: " . curl_error($curl)
            ], 500);
        } else {
            return response($response, 200)
                ->header('Content-Type', 'application/json');
        }

        curl_close($curl);
    }
}