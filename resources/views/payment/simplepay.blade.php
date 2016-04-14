
@extends('layout.template-user')

@section('content')

<script src="https://checkout.simplepay.ng/simplepay.js"></script>

<button id="btn-checkout">Checkout Simple Pay</button>

<script>
	function processPayment (token) {
    // implement your code here - we call this after a token is generated
    // example:
   alert('Got here')
   console.log('We are')
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
       phone: '+234*', // optional: user's phone number
       description: 'My Test Store Checkout 123-456', // a description of your choosing
       address: '31 Kade St, Abuja, Nigeria', // user's address
       postal_code: '110001', // user's postal code
       city: 'Abuja', // user's city
       country: 'NG', // user's country
       amount: '110000', // value of the purchase, ₦ 1100
       currency: 'NGN' // currency of the transaction
    });
});



</script>






@stop