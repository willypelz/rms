<span>Showing {{ $start }} -  {{ $end }} of  {{ $total . ' ' . $type }}   [Page {{ $page }} ];</span>

@if( !empty( @$filters ) )
<br/>Filtering by: 

<span> 
	@foreach($filters as $fq)
		
		{{ ucwords(str_ireplace("_", " ", $fq)).', ' }}

	@endforeach
<a id="clearAllFilters" href="javacript://" >Clear Filter</a> </span>
@endif