@extends('admin.layouts.default')

@section('content')

    <div class="container" style="padding-top: 50px;">
        <div class="row">
            <div class="col">
                <div class="panel panel-default">
                    @include('layout.alerts')
                    <a href="{{ route('edit-env') }}" class="btn btn-primary mb-2" >Edit ENV</a>
                    <div class="panel-body">
                        <table id="clientEnv" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>key</th>
                                    <th>value </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($clientEnv as $keyValue => $env)
                                    <tr>
                                        <td>{{$keyValue + 1}}</td>

                                        <td>
                                            {{ $env->key }}
                                        </td>

                                        <td>
                                            {{ $env->value }}
                                        </td>
                                        <td>
                                            <a href="{{route('edit-env', ['id' => $env->id])}}" class="btn btn-primary">Edit</a>
                                            <a href="" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection