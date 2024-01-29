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
            <li>Compra: {{ $cotizacion['compra'] }}</li>
            <li>Venta: {{ $cotizacion['venta'] }}</li>
            <li>Fecha de Actualización: {{ $cotizacion['fecha'] }}</li>
            <li>Variación: {{ $cotizacion['variacion'] }}</li>
        </ul>
        <form action="{{ route('detalle.cotizacion') }}" method="POST">
            @csrf
            <input type="hidden" name="nombre" value="{{ $cotizacion['nombre'] }}">
            <button type="submit">Ver Detalle</button>
        </form>
    </div>
    @endforeach

</body>
</html>

