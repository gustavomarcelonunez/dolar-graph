<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;


class DolarController extends Controller
{
    public function obtenerCotizaciones()
    {
        $client = new Client();
    
        $cotizaciones = [
            ["url" => "https://mercados.ambito.com//dolar/oficial/variacion", "nombre" => "Oficial"],
            ["url" => "https://mercados.ambito.com//dolar/informal/variacion", "nombre" => "Blue"],
            ["url" => "https://mercados.ambito.com//dolarrava/mep/variacion", "nombre" => "MEP"],
            ["url" => "https://mercados.ambito.com//dolarrava/cl/variacion", "nombre" => "CCL"],
            ["url" => "https://mercados.ambito.com//dolarnacion/variacion", "nombre" => "Banco Nación"],
            ["url" => "https://mercados.ambito.com//dolarturista/variacion", "nombre" => "Turista"],
            ["url" => "https://mercados.ambito.com//dolarcripto/variacion", "nombre" => "Crypto"],
            ["url" => "https://mercados.ambito.com//dolar/mayorista/variacion", "nombre" => "Mayorista"]
        ];
    
        $resultados = [];
    
        foreach ($cotizaciones as $cotizacion) {
            $response = $client->get($cotizacion['url']);
            $data = json_decode($response->getBody(), true);
            $data['nombre'] = $cotizacion['nombre'];
            $resultados[] = $data;
        }
    
        return view('dolar')->with('data', $resultados);
    }

}
