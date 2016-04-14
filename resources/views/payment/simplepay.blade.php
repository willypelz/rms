
@extends('layout.template-user')

@section('content')

<script src="https://checkout.simplepay.ng/simplepay.js"></script>

<button id="btn-checkout">Checkout Simple Pay</button>

<script>
	function processPayment (token) {
    // implement your code here - we call this after a token is generated
    // example:
   // alert(token)
   // console.log(token)
   var url ="{{ route('simplepay') }}"
    $.ajax
      ({
          type: "POST",
          url: url,
          data: ({ rnd : Math.random() * 100000, token:token }),
          success: function(response){
               console.log(response)
          }
      });

}

// Configure SimplePay's Gateway
var handler = SimplePay.configure({
   token: processPayment, // callback function to be called after token is received
   key: 'test_pu_6afdbcd91aa446ecb7f79a2f29c2b530', // place your api key. Demo: test_pu_*. Live: pu_*
   image: 'http://' // optional: an url to an image of your choice
});


$('#btn-checkout').on('click', function (e) { // add the event to your "pay" button
    e.preventDefault();

    handler.open(SimplePay.CHECKOUT, // type of payment
    {
       email: 'customer@store.com', // optional: user's email
       // phone: '+234{{ $company->phone }}', // optional: user's phone number
       description: 'Payment for Job boards', // a description of your choosing
       address: '{{ $company->address }}', // user's address
       postal_code: '110001', // user's postal code
       city: '{{ $company->location }}', // user's city
       country: 'NG', // user's country
       amount: '{{  }}', // value of the purchase, ₦ 1100
       currency: 'NGN' // currency of the transaction
    });



});



</script>






@stop