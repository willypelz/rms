
@if(Auth::check())

	@include('layout.template-user')

@else

	@include('layout.template-guest')

@endif