
@if (Auth::check())

	@extends('layout.template-user')

@else

	@extends('layout.template-guest')

@endif