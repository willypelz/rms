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
                                Company List
                            </h5>
                            <hr>
                            <br>
                            <div class="panel-body">

                                @include('layout.alerts')
                                <table class="table" id="myTable">
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
                                        @foreach ($companies as $key => $company)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>

                                                <td>
                                                    {{ $company->name }}
                                                </td>

                                                <td>
                                                    {{ $company->email }}
                                                </td>
                                                <td>
                                                    {{ $company->phone }}
                                                </td>
                                                <td>
                                                    {{ $company->website }}
                                                </td>
                                                <td>
                                                    {{ $company->address }}
                                                </td>
                                                <td>
                                                    {{ $company->license_type }}
                                                </td>
                                                <td>
                                                    {{ $company->valid_till }}
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
        $(document).ready(function() {
            $('#myTable').DataTable();
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            })
        });
    </script>
@endsection
