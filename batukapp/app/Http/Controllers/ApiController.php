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
        $url = env("API_URL");
        //$url = 'http://192.168.170.229:4000';
        //$url = 'localhost:3000';
        //$url = 'http://52.47.192.142:5001';
        //$url = 'https://api-batukapp.cat:5001';

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
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', "Content-Length:" . strlen(json_encode($body))));
        }

        //I indiquem si ha de retornar quelcom
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, $response);

        //dd($ch);

        if($response)
        {
            $json_data = curl_exec($ch);

            curl_close($ch);
    
            $data = json_decode($json_data);
    
            return $data;
        }
        else
        {
            curl_exec($ch);
            curl_close($ch);
        }
    }
}