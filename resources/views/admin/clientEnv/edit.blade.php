@extends('admin.layouts.default')

@section('content')

    @include('layout.alerts')
    {{-- {{dd($clientEnv->toArray())}} --}}
    
    {{ $clientEnv->key }}
    
@endsection
