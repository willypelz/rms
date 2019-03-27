@if(!$model->container)
	@include('charts::_partials.container.title')

	<center>
		<div id="{{ $model->id }}" style="@include('charts::_partials.dimension.css')"></div>
	</center>
@endif