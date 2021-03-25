<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boolivery-Il tuo Ordine</title>
</head>
<body>

</body>
</html>


<div class="container mail_container" style="width:100%; min-height:250px; display: flex; justify-content: center; align-items: center;">
    <div style="text-align: center" class="message">
        <h1>Grazie per l'ordine effettuato <span style="text-transform: capitalize;" >{{$order->name}}</span></h1>
        <h2>Ordine numero: {{$order->id}}</h2>
        <h3>Totale Pagato: {{$order->total}} €</h3>
    </div>
</div>
