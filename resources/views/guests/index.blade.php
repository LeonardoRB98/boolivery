@extends('layouts.main')
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
             
                <section v-if="categorySelect == '' ">
                    <div class="card_restaurant" v-if="filteredRestaurants[index].sponsored == true" v-for="(restaurant, index) in filteredRestaurants">
                       <div class="image_box">
                            <i class="fas fa-medal"></i>
                            <img v-if="restaurant.photo == null" src="{{asset('/image/download.png')}}" alt="">
                            <img v-else :src="'{{url('/storage')}}' + '/' + restaurant.photo" :alt="restaurant.name">
                        </div>
                        <a class="slug" :href="'{{url('Boolivery/restaurant')}}' + '/' + restaurant.slug">@{{restaurant.name}}</a>  
                    </div>             
                    <div v-if="filteredRestaurants.length == 0" class="not_found">
                        <img src="{{asset('/image/search-results-lupa.svg')}}" alt="not found">
                    </div>
                </section>
                <section v-if="categorySelect != '' ">
                    <div class="card_restaurant" v-for="(restaurant, index) in filteredRestaurants">
                       <div class="image_box">
                            <i v-if="filteredRestaurants[index].sponsored == true"class="fas fa-medal"></i>
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
               <h2>Uniamo le forze</h2>
               <div class="card_recruting">
                    <div class="box">
                        <div class="inside-box">
                            <img src="{{asset('/image/rider.png')}}" alt="">
                            <div class="title">
                                <h1>Unisciti a Noi</h1>
                            </div>
                        </div>
                    </div>
                    <h1>Diventa un rider</h1>
                    <h5>Lavora per te stesso! Goditi flessibilità, libertà e guadagni competitivi effettuando consegne con Glovo.</h5>
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
                    <h1>Diventa partner</h1>
                    <h5>Cresci con Glovo! La nostra tecnologia e la nostra base di utenti possono aiutarti a incrementare le vendite e aprire nuove opportunità!</h5>
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
                    <h1>Lavora con noi</h1>
                    <h5>Pronto per una nuova ed entusiasmante sfida? Se sei ambizioso, umile e ami lavorare con gli altri, mettiti in contatto con noi!</h5>
                </div>
            
           </div>
        

        </main>
    </div>
@endsection
