window.Cart = (function(window,document,$,undefined){

	cart = {

		config: {
			type : null,
			actionUrl: null,
			cartAddText: '',
			cartRemoveText: '',
			cartAddClass: '',
			cartRemoveClass: ''
		},

		init: function(user_config)
		{	
			$this = this;
			$.extend( this.config, user_config );
			console.log('initiated');
			return $this;
		},

		add: function(data,el)
		{
			$this = this;
			// $.ajax
   //          ({
	  //             type: "POST",
	  //             url: $this.config.actionUrl,
	  //             data: ({ rnd : Math.random() * 100000, cv_id: cvId, type:'add', name:"{{ $cv['first_name']. " " . $cv['last_name'] }}", 'qty':1, 'price':500, "_token":"{{ csrf_token() }}"}),
	  //             success: function(response){
	                
	  //               console.log(response);
	                
	  //             }
	  //         });
	  		
	  		el.addClass( $this.config.cartRemoveClass )
	  		  .removeClass( $this.config.cartAddClass )
	  		  .html( $this.config.cartRemoveText );
			console.log('added to cart');
			return $this;
		},

		remove: function()
		{

		},

		clear: function()
		{

		},

		getContents: function()
		{

		},

		getCount: function()
		{

		}

	};

	return cart;

})(window,document,jQuery);















$(document).ready(function(){
	$('body  #cartAdd').click(function(e){
			e.preventDefault();
          	Cart.add({ 	
          				rnd : Math.random() * 100000, 
          				cv_id: $(this).data('id'), 
          				type:'add', 
          				name: $(this).data('name'), 
          				qty: $(this).data('count'), 
          				price: $(this).data('cost'), 
          				"_token": $(this).data('pass')
          			},$(this));
        });
})