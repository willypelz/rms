<script src="{{ asset('js/embed.js') }}"></script>


<!-- <iframe id="sh-joblist-widget" scrolling="no" frameborder="0" allowtransparency="true" allowfullscreen="true" data-widget-id="600720083413962752" title="Twitter Timeline"> -->
	<!-- <div class="bg-light border rounded mb-3">
        <div class="card-body py-2 pr-2">
            <div class="d-flex small text-secondary align-items-center justify-content-between">
                <div class="text-uppercase lsp-3">
                    Showing 10 Jobs · 1 of 2 pages
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination m-0 justify-content-end">
                        <li class="page-item">
                            <a class="page-link" href="#">
                                «
                            </a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="#">
                                1
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                2
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                »
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div> -->
	<div>
	@foreach( $jobs as $job )
		@if( strtotime($job['expiry_date']) <= strtotime( date('m/d/Y h:i:s a', time()) ) )

		@else

			<div class="card job-card mb-3">
		        <div class="card-body">
		            <div class="job-card-heading d-flex">
		                <div>
		                    <a class="job-title font-weight-bold text-dark h5" href="{{ route('job-view', [$job['id'], str_slug($job['title']) ]) }}" target="_blank">
		                        {{ ucwords( $job['title'] ) }}
		                    </a>
							<p>{{ ucwords($company->name) }}</p>
		                </div>
		                <div>
		                </div>
		            </div>
		            <hr>
		                <div class="job-card-excerpt">
		                    <!-- <p>
		                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae assumenda temporibus doloremque quas eos reprehenderit accusamus ex quo quibusdam ullam officia fuga mollitia molestiae nisi, corporis rerum sequi, illum eaque.
		                    </p> -->
		                    
		                </div>
		                <div class="job-card-meta pt-2">
		                    <div class="card border-0 bg-light">
		                        <div class="card-body p-2">
		                            <div class="d-flex small align-items-center text-secondary flex-wrap">

		                                <div class="d-flex">
		                                    <div class="mr-4">
		                                        <i class="fas fa-calendar mr-2">
		                                        </i>
		                                        Posted: {{ date('D. j M, Y', strtotime($job['created_at'])) }}
		                                    </div>
		                                    <div>
		                                        <i class="fas fa-map-marker mr-2">
		                                        </i>
		                                        {{ $job['location'] }}
		                                    </div>
		                                </div>

		                                <div class="ml-auto">
		                                    <a class="btn btn-sm btn-primary" href="{{ route('job-view', [$job['id'], str_slug($job['title']) ]) }}"  target="_blank">
		                                        View Details
		                                        <i class="fas fa-chevron-right ml-2">
		                                        </i>
		                                    </a>
		                                </div>

		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </hr>
		        </div>
		    </div>
		@endif
	@endforeach 

	</div>

<!-- </iframe> -->

<!-- <script type="text/javascript">
	
	// iframe = SH_Embed.get('#sh-joblist-widget'); console.log(iframe);
	// iframe.contentDocument.write("<h1>Injected from parent frame</h1>");
	iframe = document.getElementById('sh-joblist-widget');

	div_el = document.createElement('div');
	div_el.innerHTML = "<h1>This is an injected content</h1>";
	iframe.contentWindow.document.body.appendChild(div_el);

</script> -->

<!-- $('iframe')[0].contentDocument.write("<h1>Injected from parent frame</h1>")