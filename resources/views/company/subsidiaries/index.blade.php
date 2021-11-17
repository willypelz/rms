@extends('layout.template-default')

@section('content')
    <div class="separator separator-small"></div>
    <section class="no-pad">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page">
                        <div class="row">
                            <h5 class="no-margin text-center l-sp-5 text-brandon text-uppercase">
                                Company Subsidiaries
                            </h5>
                            <hr>
                            <br>
                            <div class="panel-body">

                                @include('layout.alerts')

                                @permission("can-add-subsidiaries")
                                @if(getEnvData('RMS_STAND_ALONE'))
                                    <a  href="{{ url('company/subsidiaries/create') }}"
                                         style="margin-bottom:15px"
                                         class="btn btn-primary pull-right"><i class="fa fa-plus-circle"></i> Add Subsidiary
                                    </a>
                                @endif
                                @endpermission
                                <table class="table" id="myTable">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subsidiaries as $key => $subsidiary)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>
                                                {{$subsidiary->name}}
                                            </td>
                                            <td>
                                                {{$subsidiary->email}}
                                            </td>
                                            <td>
                                                {{$subsidiary->phone}}
                                            </td>
                                            <td>
                                                {{($subsidiary->is_active) ? "Active" : "Inactive"}}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button"
                                                            id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="true">
                                                        Action
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                        <li><a href="{{ url('company/subsidiaries/' . $subsidiary->id) }}"><i class="fa fa-pencil-square-o"></i> Edit Subsidiary</a></li>
                                                        <li role="separator" class="divider"></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--/tab-content-->
                </div>
            </div>
        </div>
    </section>
    <script src="{{ secure_asset('js/jquery.form.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        });
    </script>
@endsection
