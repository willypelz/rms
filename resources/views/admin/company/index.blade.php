@extends('admin.layouts.default')

@section('content')

    <div class="container" style="padding-top: 50px;">
        <div class="row">
            <div class="col">
                <div class="panel panel-default">
                    @include('layout.alerts')
                    <div class="panel-body">
                        <table id="clientEnv" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email </th>
                                    <th>Phone Number</th>
                                    <th>Websit</th>
                                    <th>address</th>
                                    <th>License Type</th>
                                    <th>Valid Period</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($companies as $key => $company)
                                    <tr>
                                        <td>{{$key + 1}}</td>

                                        <td>
                                            {{ $company->name }}
                                        </td>

                                        <td>
                                            {{ $company->email }}
                                        </td>
                                        <td>
                                            {{ $company->phone}}
                                        </td>
                                        <td>
                                            {{ $company->website}}
                                        </td>
                                        <td>
                                            {{ $company->address}}
                                        </td>
                                        <td>
                                            {{ $company->license_type}}
                                        </td>
                                        <td>
                                            {{ $company->valid_till}}
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