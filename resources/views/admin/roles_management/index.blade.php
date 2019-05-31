@extends('layout.template-user')

@section('content')

    <div class="container" style="padding-top: 150px;">
        <div class="row">
            <div class="col">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="text-center">Make Users Super Admins</h2>
                    </div>
                    <div class="panel-body">
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>
                                        {{$user->name}}
                                    </td>
                                    <td>
                                        {{$user->email}}
                                    </td>
                                    <td>
                                        @if($user->is_super_admin)
                                            <div onclick="removeRole({!! $user->id !!})" class="btn btn-danger">Remove super admin role</div>
                                        @else
                                            <div onclick="assignRole({!! $user->id !!})" class="btn btn-success">Assign super admin role</div
                                        @endif
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
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );

        function assignRole(userId) {
            $.ajax({
                url: "{{ route('change-admin-role') }}",
                type: "post",
                data: {id: userId, role: 1 },
                success: function (response) {
                    $.growl.notice({message: 'Changed successfully'});
                    window.location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $.growl.error({message: 'Could not change role please try again'});
                }
            });
        }

        function removeRole(userId) {
            $.ajax({
                url: "{{ route('change-admin-role') }}",
                type: "post",
                data: {id: userId, role: 0 },
                success: function (response) {
                    $.growl.notice({message: 'Changed successfully'});
                    window.location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $.growl.error({message: 'Could not change role please try again'});
                }
            });
        }

    </script>
@endsection
