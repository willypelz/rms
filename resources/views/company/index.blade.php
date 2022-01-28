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
                                            {{-- <th>Website</th> --}}
                                            <th>Parent Company</th>
                                            <th>Client Url</th>
                                            {{-- <th>address</th> --}}
                                            <th>License Type</th>
                                            <th>Valid Till</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($companies as $key => $company)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>

                                                <td>
                                                    {{ $company->name ?? 'NA' }}
                                                </td>

                                                <td>
                                                    {{ $company->email ?? 'NA' }}
                                                </td>
                                                <td>
                                                    {{ $company->phone ?? 'NA' }}
                                                </td>
                                                {{-- <td>
                                                    {{ $company->website ?? 'NA' }}
                                                </td> --}}
                                                <td>
                                                    {{ $company->client->name ?? 'NA' }}
                                                </td>
                                                <td>
                                                        {{ $company->client->url ?? 'NA' }}
                                                    </td>
                                                {{-- <td>
                                                    {{ $company->address ?? 'NA' }}
                                                </td> --}}
                                                <td>
                                                    {{ $company->license_type ?? 'NA' }}
                                                </td>
                                                <td>
                                                    @if (isset($company->date_added) && @$company->license_type == 'TRIAL') 
                                                    {{Carbon\Carbon::parse($company->date_added)->addDays(28)->format('d M, Y')}} 
                                                    @else
                                                        Not Applicable
                                                    @endif
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
