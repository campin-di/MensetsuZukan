@extends('layouts.st.common')
<link href="{{ asset('css/stripe.css') }}" rel="stylesheet">

@section('content')

  <div class="container py-3">
    <h3 class="mb-3">ご登録フォーム</h3>

    <form action="{{route('stripe.afterpay')}}" method="post" id="payment-form">
      @csrf

        <label for="exampleInputEmail1">お名前</label>
        <input type="test" class="form-control col-sm-5" id="card-holder-name" required>

        <label for="exampleInputPassword1">カード番号</label>
        <div class="form-group MyCardElement col-sm-5" id="card-element"></div>

        <div id="card-errors" role="alert" style='color:red'></div>

        <button class="btn btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">送信する</button>

    </form>
  </div>
  <script>
  // Configに設定したStripeのAPIキーを読み込む
  const stripe = {{ config('services.stripe.pb_key') }};

  const elements = stripe.elements();

  var style = {
  	base: {
      color: "#32325d",
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSmoothing: "antialiased",
      fontSize: "16px",
      "::placeholder": {
        color: "#aab7c4"
      }
    },
    invalid: {
      color: "#fa755a",
      iconColor: "#fa755a"
    }
  };

  const card = elements.create('card', {style: style, hidePostalCode: true});
  card.mount('#card-element');
  const cardHolderName = document.getElementById('card-holder-name');
  const cardButton = document.getElementById('card-button');
  const clientSecret = cardButton.dataset.secret;

  card.on('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
      displayError.textContent = event.error.message;
    } else {
      displayError.textContent = '';
    }
  });

  cardButton.addEventListener('click', async (e) => {
      const { setupIntent, error } = await stripe.confirmCardSetup(
          clientSecret, {
              payment_method: {
                card: card,
                billing_details: { name: cardHolderName.value }
              }
          }
      );

      if (error) {
        // エラー処理
        console.log('error');

      }else {
        // 問題なければ、stripePaymentHandlerへ
        stripePaymentHandler(setupIntent);
      }
  });

  var form = document.getElementById('payment-form');
  form.addEventListener('submit', function(event) {
    event.preventDefault();
  });

  function stripePaymentHandler(setupIntent) {
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripePaymentMethod');
    hiddenInput.setAttribute('value', setupIntent.payment_method);
    form.appendChild(hiddenInput);

    form.submit();
  }
  </script>


@endsection
