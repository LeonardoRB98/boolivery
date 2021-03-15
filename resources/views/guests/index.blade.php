@extends('layouts.guests.main')

@section('content')
        <div class="jumbo">
            <div>
                <input type="text">
            </div>
        </div>
        <main class="container">
            <section>
                <h2>Categorie</h2>
            </section>
            <section>
                <h2 v-on:click="cercaRistoranti">Ristoranti</h2>
                <div v-for="restaurant in restaurants">@{{restaurant.name}}</div>
            </section>
            <section>
                <h2>pubblicità</h2>
            </section>
        </main>    
@endsection
