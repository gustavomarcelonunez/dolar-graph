<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('css/detalle_cotizacion.css') }}" rel="stylesheet">
        <link rel="shortcut icon" type="image/png" href="{{ asset('/img/favicon.png') }}">
        <title>Dolar Graph - {{ $nombre }}</title>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body>
        <title>Cotización Dólar {{ $nombre }}</title>
        <div style="width: 80%;">
            <canvas id="myChart"></canvas>
        </div>

        <script>
            window.name = @json($nombre);
            window.data = @json($data);
        </script>
        <script src="{{ asset('js/dolar_chart.js') }}"></script>
    </body>
</html>
