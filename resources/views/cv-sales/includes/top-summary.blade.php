<div class="row">
	<div class="text-uppercase col-xs-4"> 
		<strong>Showing</strong> 
		{{ $start }} -  {{ $end }} of  {{ $total . ' ' . $type }}   [Page {{ $page }} ]
	</div>

	@if( !empty( @$filters ) )

	<div class="text-right text-uppercase col-xs-6">
		&rarr;
		<i class="fa fa-filter"></i> Filtering by: 

		<span class="text-uppercase"> 
			<?php $filter_string = implode(', ', $filters);  ?>
			
			{{ ucwords(str_ireplace("_", " ", $filter_string)) }}

			<a id="clearAllFilters" href="javacript://" > &nbsp; <i class="fa fa-times"></i>Clear Filter</a> 
		</span>
	</div>
	@endif
	
	<div class="clearfix"></div>
	<!-- <hr style="margin-bottom: 0; padding-bottom: 0;"> -->
</div>