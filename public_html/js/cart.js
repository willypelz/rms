window.Cart = (function(window,document,$,undefined){

	cart = {

		config: {
			action : null,
			actionUrl: null,
			getCountUrl: null,
			checkoutUrl: null,
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
			data.type = $this.config.type;

			$.ajax
            ({
	              type: "POST",
	              url: $this.config.actionUrl,
	              data: ( data ),
	              success: function(response){
	                
	                el.addClass( $this.config.cartRemoveClass )
			  		  .removeClass( $this.config.cartAddClass )
			  		  .html( $this.config.cartRemoveText )
			  		  .attr('id','cartRemove');

			  		$('.well-cart').show();

			  		response = JSON.parse(response);
			  		$('.well-cart').find('#item-count span').text( response.count );
			  		$('.well-cart').find('#price-total').text( response.total );
					console.log('added to cart');
	                
	              }
	          });
	  		
	  		
			return $this;
		},

		remove: function(data,el)
		{
			$this = this;
			data.type = $this.config.type;

			$.ajax
            ({
	              type: "POST",
	              url: $this.config.actionUrl,
	              data: ( data ),
	              success: function(response){
	                
	                el.addClass( $this.config.cartAddClass )
			  		  .removeClass( $this.config.cartRemoveClass )
			  		  .html( $this.config.cartAddText + data.price )
			  		  .attr('id','cartAdd');


			  		response = JSON.parse(response);
			  		$('.well-cart').find('#item-count span').text( response.count );
			  		$('.well-cart').find('#price-total').text( response.total );


			  		if( response.count == 0)
			  		{
			  			$('.well-cart').hide();
			  		}
					console.log('Removed from cart');
	                
	              }
	          });

			
			return $this;

		},

		checkout: function(data,el)
		{
			$this = this; 
			data.type = $this.config.type;

			$.ajax
	          ({
	            type: "POST",
	            url: $this.config.checkoutUrl,
	            data: (data),
	            success: function(response){

	              $('body #invoice-res').html(response);
	            }
	        });
		},

		clear: function(data,el)
		{
			$this = this;
			data.type = $this.config.type;

			$.ajax
	          ({
	            type: "POST",
	            url: $this.config.actionUrl,
	            data: (data),
	            success: function(response){
	              	
	            	$('body #cartRemove').each(function( index ){
	            		$(this)
		            	.addClass( $this.config.cartAddClass )
			  		  	.removeClass( $this.config.cartRemoveClass )
			  		  	.html( $this.config.cartAddText + $(this).data('cost') )
			  		  	.attr('id','cartAdd');
	            	});

	            	

		  		  	$('.well-cart').hide();
	              
	            }
	        });

	        

		},

		getContents: function()
		{

		},

		getCount: function()
		{

			$.ajax
            ({
	              type: "POST",
	              url: $this.config.getCountUrl,
	              data: ({ rnd : Math.random() * 100000, type: $this.config.type}),
	              success: function(response){
	                
	                console.log(response);
	                return response;
	              }
	          });
		}

	};

	return cart;

})(window,document,jQuery);















$(document).ready(function(){
	$('body').on('click', '#cartAdd',function(e){
			e.preventDefault();
          	Cart.add({ 	
          				rnd : Math.random() * 100000, 
          				id: $(this).data('id'), 
          				action:'add', 
          				name: $(this).data('name'), 
          				qty: $(this).data('count'), 
          				price: $(this).data('cost'), 
          				"_token": $(this).data('pass')
          			},$(this));
        });

	$('body').on('click', '#cartRemove', function(e){
			e.preventDefault();
          	Cart.remove({ 	
          				rnd : Math.random() * 100000, 
          				id: $(this).data('id'), 
          				action:'remove', 
          				name: $(this).data('name'), 
          				qty: $(this).data('count'), 
          				price: $(this).data('cost'), 
          				"_token": $(this).data('pass')
          			},$(this));
        });

	$('body').on('click', '#checkout', function(e){
			e.preventDefault();
          	Cart.checkout({ 	
          				rnd : Math.random() * 100000, 
          				"_token": $(this).data('pass')
          			},$(this));
        });

	$('body').on('click', '#clearCart', function(e){
			e.preventDefault();
          	Cart.clear({ 	
          				rnd : Math.random() * 100000, 
          				// id: $(this).data('id'),
          				action:'clear',
          				"_token": $(this).data('pass')
          			},$(this));
        });

	
})