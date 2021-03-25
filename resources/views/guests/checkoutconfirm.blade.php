@extends('layouts.main')

@section('content')

    <div class="central">
        <div class="message">
            <h1>Grazie per aver scelto Boolivery!</h1>
            <h2>Il pagamento è stato effettuato con successo!</h2>
            <p>Il tuo ordine partirà a breve...</p>
        </div>
        
        <img id="rider" :class="classImage" src="https://cdn1.iconfinder.com/data/icons/restaurant-76/64/delivery-bike-scooter-rider-512.png" alt="">

    </div>
    <script type="application/javascript"> 
    setTimeout(function(){
        window.location = "http://127.0.0.1:8000/Boolivery"
    }
        , 5500); 
    </script> 
    


@endsection
