<span> <strong>Showing</strong> {{ $start }} -  {{ $end }} of  {{ $total . ' ' . $type }}   [Page {{ $page }} ]</span>

@if( !empty( @$filters ) )
<br/>Filtering by: 

<span> 
	<?php $filter_string = implode(', ', $filters);  ?>
	
	{{ ucwords(str_ireplace("_", " ", $filter_string)) }}

	
<a id="clearAllFilters" href="javacript://" >Clear Filter</a> </span>
@endif