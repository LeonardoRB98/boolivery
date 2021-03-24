@extends('layouts.main')


@section('content')
    <span id="emilio">
        <div class="checkout">
            <section class="checkout_left">
                <div class="cart_checkout">
                    <div class="cart shadow">
                        <h2>Controlla Il Tuo Ordine</h2>
                        <i class="fas fa-cart-arrow-down"></i>
                        <div class="order_plate" v-for='plate in cart'>
                            <ul>
                                <li class="plateCounter">
                                    {{-- <i class="fas fa-arrow-left left"></i> --}}
                                    <i v-on:click="add(plate.id, plate.counter, plate.price, plate.name)"
                                        class="fas fa-plus-square" id="plus_checkout"></i>
                                    <i v-on:click="remove(plate.id, plate.counter, plate.price, plate.name)"
                                        class="fas fa-minus-square" id="minus_checkout"></i>
                                    {{-- <i class="fas fa-arrow-right right"></i> --}}
                                </li>
                                <li class="plateName">@{{ plate . name }}</li>
                                <li class="platePrice">@{{ plate . price * plate . counter }} €</li>
                            </ul>
                        </div>
                        <hr>
                        <h4>Totale: <br> @{{ totalPrice }} €</h4>
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
               <section class="checkout_right">
            <form method="post" id="payment-form" action="{{ route('payment')}}">
                @csrf
                @method("post")
                <div class="row">
                    <input type="text" name="name" class="form-control" placeholder="Inserisci il tuo nome" value="Emilio">
                </div>
                <div class="row">
                    <input type="text" name="surname" class="form-control" placeholder="Inserisci il tuo cognome" value="Furnari">
                </div>
                <div class="row">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Inserisci la tua email" value="Furnari@mail.com">
                </div>
                <div class="row">
                    <input type="address" name="address" class="form-control" id="address" value="Via delle cose" placeholder="Inserisci la tua email">
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
                <section>
                    <label for="amount">
                        <span class="input-label">Totale da pagare: @{{ totalPrice }}  € </span>
                        <div class="input-wrapper amount-wrapper amount">
                            <input id="total" name="total" type="tel" min="1" placeholder="Totale" :value="totalPrice">
                        </div>
                    </label>

                    <div class="bt-drop-in-wrapper">
                        <div id="bt-dropin">
                        </div>
                    </div>
                </section>

                <input id="nonce" name="payment_method_nonce" type="hidden"/>
                <button class="btn btn-success pay" type="submit"><span>Paga</span></button>
            </form>
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
</span>
@endsection
