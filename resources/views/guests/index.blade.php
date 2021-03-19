@extends('layouts.main')
{{-- @dd($restaurants) --}}
@section('content')
    <div id="fortunato">
        <div class="jumbo_box">
            <div class="search_bar">
                <input  v-model='search' v-on:keyup='searchRestaurants' type="text" placeholder="Cerca per cucina o ristorante">
                <select name="" id="" v-model='categorySelect' v-on:change='searchRestaurants'>
                    <option value="">All</option>
                    <option :value="category.category" v-for='category in categories'>@{{category.category}}</option>
                </select>

            </div>
            
            <div v-if="filteredRestaurants.length == 0" class="jumbo_title">
                <h1>Siamo spiacenti</h1>
                <h5>nella tua zona non sono presenti ristoranti con queste caratteristiche</h5>
            </div>
            <div v-else class="jumbo_title">
                <h1>In evidenza nella tua città</h1>
                <h5>Scopri i negozi più richiesti e ricevi alla tua porta ogni tuo desiderio</h5>
            </div>
        </div>
        <main>
           <div class="container">
                <section>
                    <div class="card_restaurant" v-if="filteredRestaurants.length >= 0" v-for="(restaurant, index) in filteredRestaurants">
                       <div class="image_box">
                            <img v-if="restaurant.photo == null" src="{{asset('/image/download.png')}}" alt="">
                            <img v-else :src="'{{url('/storage')}}' + '/' + restaurant.photo" :alt="restaurant.name">
                        </div>
                        <a class="slug" :href="'{{url('Boolivery/restaurant')}}' + '/' + restaurant.slug">@{{restaurant.name}}</a>  
                    </div>             
                    <div v-if="filteredRestaurants.length == 0" class="not_found">
                        <img src="{{asset('/image/search-results-lupa.svg')}}" alt="not found">
                    </div>
                  
                </section>
           </div>

           

           <div class="wave"></div>

           <div class="recruting">
               <div class="card_recruting">
                    <div class="box">
                        <div class="inside-box">
                            <img src="{{asset('/image/rider.png')}}" alt="">
                            <div class="title">
                                <h1>Unisciti a Noi</h1>
                            </div>
                        </div>
                    </div>
                    <h1>prova titolo</h1>
                    <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos quod ipsam ut sit a numquam, ab aut rerum, delectus, repellendus corporis voluptate nisi explicabo possimus! Doloremque harum error sunt neque.</h5>
                </div> 
                <div class="card_recruting">
                    <div class="box">
                        <div class="inside-box">
                            <img src="{{asset('/image/partner.png')}}" alt="">
                            <div class="title">
                                <h1>Unisciti a Noi</h1>
                            </div>
                        </div>
                    </div>
                    <h1>prova titolo</h1>
                    <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos quod ipsam ut sit a numquam, ab aut rerum, delectus, repellendus corporis voluptate nisi explicabo possimus! Doloremque harum error sunt neque.</h5>
                </div>
                <div class="card_recruting">
                    <div class="box">
                        <div class="inside-box">
                            <img src="{{asset('/image/careers.png')}}" alt="">
                            <div class="title">
                                <h1>Unisciti a Noi</h1>
                            </div>
                        </div>
                    </div>
                    <h1>prova titolo</h1>
                    <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos quod ipsam ut sit a numquam, ab aut rerum, delectus, repellendus corporis voluptate nisi explicabo possimus! Doloremque harum error sunt neque.</h5>
                </div>
            
           </div>
        

        </main>
    </div>
@endsection
