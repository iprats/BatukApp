<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public static function callApi($path, $response = true, $method = "GET", $body = "")
    {
        $url = 'http://api-batukapp.cat:4000';
        $url = 'http://192.168.170.125:4000';
        $url .= $path;
        //dd($url);

        $ch = curl_init($url);
        //Establim la url de la API

        //Assignem el method a la crida
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

        //Si cal afegim un body
        if($body != "")
        {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        }


        curl_setopt($ch, CURLOPT_RETURNTRANSFER, $response);

        $json_data = curl_exec($ch);
        curl_close($ch);

        //dd($json_data);
        $data = json_decode($json_data);

        //dd($data);

        return $data;
    }
}