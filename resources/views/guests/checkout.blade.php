@extends('layouts.main')

@section('content')
<span id="leonardo"></span>
    <div class="checkout">
        <section>
            Dati pagamento
            <form method="post" id="payment-form" action="{{ url('/checkout')}}">
                @csrf
                <section>
                    <label for="amount">
                        <span class="input-label">Amount</span>
                        <div class="input-wrapper amount-wrapper">
                            <input id="amount" name="amount" type="tel" min="1" placeholder="Amount" value="11">
                        </div>
                    </label>

                    <div class="bt-drop-in-wrapper">
                        <div id="bt-dropin"></div>
                    </div>
                </section>

                <input id="nonce" name="payment_method_nonce" type="hidden" />
                <button class="btn btn-success" type="submit"><span>Proceed</span></button>
            </form>
            <script src="https://js.braintreegateway.com/web/dropin/1.27.0/js/dropin.min.js"></script>
            <script>
                // extract from
                var form = document.querySelector('#payment-form');
                // client token
                var client_token = "{{ $token }}";

                braintree.dropin.create({
                  authorization: client_token,
                  selector: '#bt-dropin',
                    // remove paypall
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

                      // Add the nonce to the form and submit
                      document.querySelector('#nonce').value = payload.nonce;
                      form.submit();
                    });
                  });
                });
            </script>
        </section>
        <section>

        </section>
    </div>
@endsection
