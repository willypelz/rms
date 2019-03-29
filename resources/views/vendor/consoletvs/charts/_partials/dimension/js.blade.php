@if($model->responsive)
    height: "100%",
    width: "100%",
@else
    @if($model->height)
        height: {{ $model->height }},
    @else
        height: "100%",
    @endif

    @if($model->width)
        width: {{ $model->width }},
    @else
        width: "100%",
    @endif
@endif
