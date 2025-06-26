<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IpGeolocationController extends Controller
{
    public function get_geolocation(Request $request)
    {
        $apiKey = env('IP_GEO_KEY'); 
        $apiUrl = "https://ipgeolocation.abstractapi.com/v1/";
        $clientIp = $request->ip();

        if ($clientIp === '127.0.0.1' || $clientIp === '::1') {
            $url = "$apiUrl?api_key=$apiKey";
        } else {
            $url = "$apiUrl?api_key=$apiKey&ip_address=$clientIp";
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);

        return $response;

        curl_close($curl);
    }
}