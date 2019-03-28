@if(!$model->container)
	@include('charts::_partials.container.title')

	<div id="{{ $model->id }}" style="@include('charts::_partials.dimension.css')" class="ct-chart ct-perfect-fourth"></div>
@endif