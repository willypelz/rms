	<?php 
		$type = ( $type == 'ASSESSED' ) ? 'TEST' : $type;
	?>
	<strong class="text-warning">Showing
	{{ $start }} -  {{ $end }} of  {{ $total . ' ' . $type }}   [Page {{ $page }}]
	</strong> 


	<div class=" text-uppercase">

	@if( !empty( @$filters ) )
		
		<i class="fa fa-filter"></i> Filtering by: 

		<span class="text-uppercase text-warning"> 
			<?php 
				$filter_string = implode(', ', $filters);  
				preg_match('/(grade:"[0-9]+")/',$filter_string, $matches);
    			if( !empty( $matches ) )
				{
					$grade_index = str_replace( '"', '', str_replace( 'grade:', '', $matches[0] ) ); 
					$grade = getGrade( $grade_index );

					$filter_string = str_replace('grade:"'.$grade_index, 'grade:"'.$grade, $filter_string);
				}
				

				//Format approved filter string
				
				
				preg_match('/(is_approved:"(true|false)")/',$filter_string, $matches);

    		if( !empty( $matches ) )
				{
					$approval_text = str_replace( 'is_approved:', 'pending approval? :', $matches[0] );

					if( $matches[2] == "false" ) 
					{
						$approval_text = str_replace('false', 'yes', $approval_text);
					}
					else if( $matches[2] == "true" ) 
					{
						$approval_text = str_replace('true', 'no', $approval_text);
					}

					$filter_string = str_replace( $matches[0], $approval_text, $filter_string);
				}

				?>
			
			{{ ucwords(str_ireplace("_", " ", $filter_string)) }}

			<a id="clearAllFilters" href="javacript://" > &nbsp; <i class="fa fa-times" class="text-danger"></i>Clear Filter</a> 
		</span>
	@endif
	</div>
	<!-- <div class="col-xs-2">
		<a href="" class="btn select-all text-uppercase">Download</a>
	</div> -->
	
	<div class="clearfix"></div>
	<!-- <hr style="margin-bottom: 0; padding-bottom: 0;"> -->