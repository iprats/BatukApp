<?php

namespace App\Http\Controllers;

use App\Models\Prova;
use Illuminate\Http\Request;

class ProvaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $url = '192.168.56.1:4000/assistances/1';
        // $data = array('user_iduser' => 2, 'answer' => "Si", 'instrument_idinstrument' => 1);

        // $ch = curl_init($url);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        // $response = curl_exec($ch);
        // curl_close($ch);


        $url = 'http://localhost:4000/users/band/1';
        // $data = array('user_iduser' => 2, 'answer' => "Si", 'instrument_idinstrument' => 1);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $response = curl_exec($ch);

        dd($response);


        curl_close($ch);

        echo $response;

        //return view("prova.index", compact("response"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Prova $prova)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prova $prova)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prova $prova)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prova $prova)
    {
        //
    }
}
