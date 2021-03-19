@extends('layouts.main')
{{-- @dd($restaurants) --}}
@section('content')
    <div id="fortunato">
        <div class="jumbo_box">
            <div class="search_bar">
                <input  v-model='search' v-on:keyup='searchRestaurants' type="text">
                <select name="" id="" v-model='categorySelect' v-on:change='searchRestaurants'>
                    <option value="">All</option>
                    <option :value="category.category" v-for='category in categories'>@{{category.category}}</option>
                </select>
                
            </div>
            <div class="jumbo_title">
                <h1>In evidenza nella tua città</h1>
                <h5>Scopri i negozi più richiesti e ricevi alla tua porta ogni tuo desiderio</h5>
            </div>
        </div>
        <main>
           <div class="container">
            <h2>Ristoranti</h2>
                <section>
                    <div class="card" v-for="(restaurant, index) in filteredRestaurants">
                       <a :href="'{{url('Boolivery/restaurant')}}' + '/' + restaurant.slug">@{{restaurant.name}}</a>
                       <div class="image-box">
                        {{-- <img src="@{{asset('storage/')+'restaurant.photo'}}">                       </div> --}}
                        <img src="{{asset('image/logo.png')}}" alt="">
                        </div>
                        <p>@{{restaurant.description}}</p>
                    </div>


                   
                </section>
           </div>


        </main>
    </div>
@endsection
