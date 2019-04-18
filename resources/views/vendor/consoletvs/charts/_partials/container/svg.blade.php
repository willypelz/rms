@if(!$model->container)
	<svg id="{{ $model->id }}" @include('charts::_partials.dimension.html')></svg>
@endif