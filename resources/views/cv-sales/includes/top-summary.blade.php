<div class="row">
	<div class="text-uppercase col-xs-12"> 
		<strong class="text-warning">Showing
		{{ $start }} -  {{ $end }} of  {{ $total . ' ' . $type }}   [Page {{ $page }}]
		</strong> 
	</div>

	@if( !empty( @$filters ) )

	<div class=" text-uppercase col-xs-10">
		
		<i class="fa fa-filter"></i> Filtering by: 

		<span class="text-uppercase text-warning"> 
			<?php $filter_string = implode(', ', $filters);  ?>
			
			{{ ucwords(str_ireplace("_", " ", $filter_string)) }}

			<a id="clearAllFilters" href="javacript://" > &nbsp; <i class="fa fa-times" class="text-danger"></i>Clear Filter</a> 
		</span>
	</div>
	@endif
	
	<div class="clearfix"></div>
	<!-- <hr style="margin-bottom: 0; padding-bottom: 0;"> -->
</div>