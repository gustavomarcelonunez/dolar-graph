<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;

class DetalleCotizacionController extends Controller
{
    public function detalleCotizacion(Request $request)
    {
        $nombre = $request->input('nombre');
    
        $urls = [
            'Oficial' => 'https://mercados.ambito.com//dolar/oficial/historico-general/',
            'Blue' => 'https://mercados.ambito.com//dolar/informal/historico-general/',
            'MEP' => 'https://mercados.ambito.com//dolarrava/mep/grafico/',
            'CCL' => 'https://mercados.ambito.com//dolarrava/cl/grafico/',
            'Banco Nación' => 'https://mercados.ambito.com//dolarnacion/historico-general/',
            'Turista' => 'https://mercados.ambito.com//dolarturista/grafico/',
            'Crypto' => 'https://mercados.ambito.com//dolarcripto/grafico/',
            'Mayorista' => 'https://mercados.ambito.com//dolar/mayorista/grafico/'
        ];
    
        $url = $urls[$nombre] ?? null;
    
        if ($url) {
            
            $fechaActual = Carbon::now()->format('Y-m-d');
            $fechaInicial = Carbon::now()->subMonth()->format('Y-m-d');
            $url .= $fechaInicial . '/' . $fechaActual;

            try {
                $client = new Client();
                $response = $client->get($url);
                $data = json_decode($response->getBody(), true);
                array_shift($data);
                
                if (in_array($nombre, ["Oficial", "Blue", "Banco Nación"])) {
                    $data = array_reverse($data);
                }

                return view('detalle_cotizacion')->with('nombre', $nombre)->with('url', $url)->with('data', $data);
            } catch (RequestException $e) {
                // Si hay un error de solicitud (por ejemplo, el servidor devuelve un código de error HTTP)
                if ($e->hasResponse()) {
                    $statusCode = $e->getResponse()->getStatusCode();
                    $errorMessage = json_decode($e->getResponse()->getBody(), true)['error'] ?? 'Error desconocido';
            
                    // Puedes personalizar cómo manejar diferentes códigos de estado
                    if ($statusCode == 404) {
                        // Manejar error 404 (No encontrado)
                        return view('detalle_cotizacion')->with('nombre', $nombre)->with('url', $url)->with('data', null)->withErrors("Recursos no encontrados: $errorMessage");
                    } else {
                        // Otro código de estado, manejar según sea necesario
                        return view('detalle_cotizacion')->with('nombre', $nombre)->with('url', $url)->with('data', null)->withErrors("Error $statusCode: $errorMessage");
                    }
                } else {
                    // Si la respuesta no contiene detalles específicos, manejar el error genérico
                    return view('detalle_cotizacion')->with('nombre', $nombre)->with('url', $url)->with('data', null)->withErrors('Error durante la solicitud a la API: ' . $e->getMessage());
                }
            } catch (\Exception $e) {
                // Manejar otros tipos de excepciones (no relacionadas con la solicitud a la API)
                return view('detalle_cotizacion')->with('nombre', $nombre)->with('url', $url)->with('data', null)->withErrors('Error: ' . $e->getMessage());
            }
            
            
        
    
        // Manejar el caso en que el nombre no coincida con ninguna URL
        return view('detalle_cotizacion')->with('nombre', $nombre)->with('url', null);
        }
    }
}
