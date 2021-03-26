@extends('layouts.main')


@section('content')
    <span id="emilio">
        <div style="height: 400px" v-if="isLoading == true" class="checkout">
            {{-- vuoto --}}
        </div>
        <transition name="fade">
        <div v-if="isLoading != true" class="checkout">
            <section class="checkout_left">
                <div class="cart_checkout">
                    <div v-if="isLoading == false" class="cart shadow">
                        <h2>Controlla Il Tuo Ordine</h2>
                        <i class="fas fa-cart-arrow-down"></i>
                        <div class="order_plate" v-for='plate in cart'>
                            <ul class="shadow">
                                <li class="plateName">@{{ plate . name }}</li>
                                <li class="plateCounter">X @{{plate.counter}}</li>
                                <li class="platePrice">@{{ calculatePrice(plate.price, plate.counter) }} €</li>
                                <li class="plateAddRemove">
                                    {{-- <i class="fas fa-arrow-left left"></i> --}}
                                    <i v-on:click="add(plate.id, plate.counter, plate.price, plate.name)"
                                        class="fas fa-plus-square" id="plus_checkout"></i>
                                    <i v-on:click="remove(plate.id, plate.counter, plate.price, plate.name)"
                                        class="fas fa-minus-square" id="minus_checkout"></i>
                                </li>
                            </ul>
                        </div>
                        <hr>
                        <h4 class="shadow">Totale: <br> @{{ formatFix(totalPrice) }} €</h4>
                    </div>
                </div>
            </section>
            <section class="checkout_right">
                @if (session('message'))
                    {{ session('message') }}
                @endif
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                @endif
               <section class="checkout_braintree shadow">
                     <form method="post" id="payment-form" action="{{ route('payment')}}">
                        @csrf
                        @method("post")
                        <div class="row shadow mb-2">
                            <input type="text" name="name" class="form-control" placeholder="Inserisci il tuo nome" value="" required>
                        </div>
                        <div class="row shadow mb-2">
                            <input type="text" name="surname" class="form-control" placeholder="Inserisci il tuo cognome" value="" required>
                        </div>
                        <div class="row shadow mb-2">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Inserisci il tua mail" value="" required>
                        </div>
                        <div class="row shadow mb-2">
                            <input type="address" name="address" class="form-control" id="address" value="" placeholder="Inserisci il tuo indirizzo" required>
                        </div>
                        <div class="row shadow mb-2">
                            <input type="datetime-local" name="time" class="form-control" id="time"  min ='<?php echo date('Y-m-d');?>T00:00'max="2099-12-31T00:00" value="" placeholder="A che ora vuoi ordinare?" required>
                        </div>
                        <div class="form-group">
                            <select style="display:none;"  class="form-control" name="plates[]" multiple>
                                    <option v-for="plate in cart" :value="plate.id" selected>@{{plate.id}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select style="display:none;"  class="form-control" name="quantities[]" multiple>
                                    <option v-for="plate in cart" :value="plate.counter" selected>@{{plate.id}}</option>
                            </select>
                        </div>
                        <label for="amount">
                            <div class="input-wrapper amount-wrapper amount">
                                <input id="total" name="total" type="tel" min="1" placeholder="Totale" :value="totalPrice">
                            </div>
                        </label>
                        <div class="bt-drop-in-wrapper">
                            <div id="bt-dropin">
                            </div>
                        </div>
                        <input id="nonce" name="payment_method_nonce" type="hidden"/>
                        <button class="btn btn-success pay" type="submit"><span>Paga</span></button>
                    </form>
                </section>
            </section>
           @section('braintree')
                <script src="https://js.braintreegateway.com/web/dropin/1.27.0/js/dropin.min.js"></script>
                <script>

                    // PRENDO I DATI DEL FORM
                    var form = document.querySelector('#payment-form');

                    // PRENDO IL TOKEN DAL CONTROLLER
                    var client_token = "{{ $token }}";

                    // CREO INTERFACCIA BRAINTREE
                    braintree.dropin.create({
                    authorization: client_token,
                    selector: '#bt-dropin',
                    //   RIMUOVO PAYPAL
                        //   paypal: {
                        //     flow: 'vault'
                        //   }
                    }, function (createErr, instance) {
                    if (createErr) {
                        console.log('Create Error', createErr);
                        return;
                    }
                    form.addEventListener('submit', function (event) {
                        event.preventDefault();

                        instance.requestPaymentMethod(function (err, payload) {
                        if (err) {
                            console.log('Request Payment Method Error', err);
                            return;
                        }

                        //   FACCIO SUBMIT
                        document.querySelector('#nonce').value = payload.nonce;
                        form.submit();
                        });
                    });
                    });
                </script>
            </section>
            @endsection
        </div>
        </transition>
    </span>
@endsection
