@extends('layouts.guests.main')

@section('content')
        <div class="jumbo">
            <div>
                <input v-model='search' v-on:keyup='searchRestaurants' type="text">
                <select name="" id="" v-model='categorySelect' v-on:change='searchRestaurants'>
                    <option value="">All</option>
                    <option :value="category.category" v-for='category in categories'>@{{category.category}}</option>
                </select>
            </div>
        </div>
        <main class="container">
            {{-- <section>
                <h2>Categorie</h2>
                <div v-for="category in categories">@{{category.category}}</div>
            </section> --}}
            <section>
                <h2>Ristoranti</h2>
                <div v-for="restaurant in filteredRestaurants">@{{restaurant.name}}</div>
            </section>
            <section>
                <h2>pubblicità</h2>
            </section>
        </main>    
@endsection
