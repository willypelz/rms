<!-- <script src="{{ asset('js/embed.js') }}"></script> -->


<!-- <iframe id="sh-joblist-widget" scrolling="no" frameborder="0" allowtransparency="true" allowfullscreen="true" data-widget-id="600720083413962752" title="Twitter Timeline"> -->
	<ul>
	@foreach( $jobs as $job )
		@if( $job['status'] == 'ACTIVE')
			<li> 
				<big><a target="_blank" href="{{ url($company->slug.'/job/'.$job['id'].'/'.str_slug($job['title'])) }}"><b>{{ $job['title'] }}</b></a></big>
				small class="text-muted"><i class="glyphicon glyphicon-map-marker "></i> {{ $job['location'] }} &nbsp;
	                                    <i class="glyphicon glyphicon-calendar"></i> Date Created : {{ date('D. j M, Y', strtotime($job['created_at'])) }}</small>
	            <a target="_blank" href="{{ url($company->slug.'/job/'.$job['id'].'/'.str_slug($job['title'])) }}" type="button" class="btn btn-success">View Job</a>
			</li>
		@endif
	@endforeach 
	</ul>
<!-- </iframe> -->

<!-- <script type="text/javascript">
	
	// iframe = SH_Embed.get('#sh-joblist-widget'); console.log(iframe);
	// iframe.contentDocument.write("<h1>Injected from parent frame</h1>");
	iframe = document.getElementById('sh-joblist-widget');

	div_el = document.createElement('div');
	div_el.innerHTML = "<h1>This is an injected content</h1>";
	iframe.contentWindow.document.body.appendChild(div_el);

</script> -->

<!-- $('iframe')[0].contentDocument.write("<h1>Injected from parent frame</h1>") -->