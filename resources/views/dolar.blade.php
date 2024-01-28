<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="{{ asset('/img/favicon.png') }}">


    <title>Dolar Graph</title>
</head>
<body>
    <h1>Cotizaciones del Dólar</h1>

    @foreach ($data as $cotizacion)
        <div class="cotizacion">
                <p><strong>{{ $cotizacion['nombre'] }}</strong></p>
                <ul>
                    <li>Moneda: {{ $cotizacion['moneda'] }}</li>
                    <li>Casa: {{ $cotizacion['casa'] }}</li>
                    <li>Compra: {{ $cotizacion['compra'] }}</li>
                    <li>Venta: {{ $cotizacion['venta'] }}</li>
                    <li>Fecha de Actualización: {{ $cotizacion['fechaActualizacion'] }}</li>
                </ul>
            </div>
    @endforeach

</body>
</html>

