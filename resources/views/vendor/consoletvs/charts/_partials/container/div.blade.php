@if(!$model->container)
	<div id="{{ $model->id }}" style="@include('charts::_partials.dimension.css')"></div>
@endif