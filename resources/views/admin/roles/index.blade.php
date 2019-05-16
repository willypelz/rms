@extends('layout.template-user')
@section('content')

    <div class="container" style="padding-top: 150px;">
        <div class="row">
            <div class="col">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="text-center"> Roles </h2>
                    </div>

                    @include('layout.alerts')

                    <div class="panel-body">
                        <a href="{{ route('create-role') }}" class="btn btn-success pull-right">Create Role</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Display Name</th>
                                    <th>Description </th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $key => $role)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>
                                            {{ $role->name }}
                                        </td>
                                        <td>
                                            {{ $role->display_name }}
                                        </td>
                                        <td>
                                            {{ $role->description}}
                                        </td>

                                        <td> 
                                            <div class="btn-group pull-right">
                                                <a href="{{ route('role-edit', $role->id) }}" type="button" class="btn btn-default">Edit</a>
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <span class="caret"></span>
                                                  <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu">
                                                  <li><a href="{{ route('role-edit', $role->id) }}">Edit</a></li>
                                                  <li role="separator" class="divider"></li>
                                                  <li><a onclick="if (!confirm('Are you sure you want to delete this role?')) return false;" href="{{ route('role-delete', $role->id) }}">Delete</a></li>
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
        </div>
    </div>
    <script src="{{ secure_asset('js/jquery.form.js') }}"></script>

    <script>
        $('.roles').on('change', function () {
            var userId = $(this).data('id');
            var role = $('#' + userId + 'roles').val();
                $.ajax({
                    url: "{{ route('change-admin-role') }}",
                    type: "post",
                    data: {id: userId, role: role },
                    success: function (response) {
                        $.growl.notice({message: 'Changed successfully'});
                        window.location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $.growl.error({message: 'Could not change role please try again'});
                    }
                });
        });

    </script>
@endsection
