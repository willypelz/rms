@if(!$model->container)
	<div>
		<canvas id="{{ $model->id }}" @include('charts::_partials.dimension.html')></canvas>
	</div>
@endif