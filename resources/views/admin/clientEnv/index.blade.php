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
                                Company ENV
                            </h5>
                            <hr>
                            <br>
                            <div class="panel-body">

                                @include('layout.alerts')
                                <table class="table" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>key</th>
                                            <th>value </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clientEnv as $keyValue => $env)
                                            <tr>
                                                <td>{{ $keyValue + 1 }}</td>

                                                <td>
                                                    {{ $env->key }}
                                                </td>

                                                <td>
                                                    {{ $env->value }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('edit-env', ['id' => $env->id]) }}"
                                                        class="btn btn-primary">Edit</a>
                                                    <a href="{{ route('delete-env', ['id' => $env->id]) }}"
                                                        onclick="return confirm('Sure you want to delete {{ $env->key }}?')"
                                                        class="btn btn-danger">Delete</a>
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
