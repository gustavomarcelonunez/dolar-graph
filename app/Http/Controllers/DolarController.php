<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class DolarController extends Controller
{
    public function obtenerCotizacion()
    {
        $client = new Client();
        $response = $client->get('https://dolarapi.com/v1/dolares');

        $data = json_decode($response->getBody(), true);

        // Ahora, $data contiene la respuesta de la API en formato JSON.
        // Puedes manipular los datos según tus necesidades.

        return view('dolar')->with('data', $data);
    }
}
