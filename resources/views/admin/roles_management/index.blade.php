@extends('layout.template-user')

@section('content')

    <div class="container" style="padding-top: 150px;">
        <div class="row">
            <div class="col">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="text-center">Manage Job Team Memebers Roles</h2>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
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
                                        <select name="role" data-id="{{$user->id}}" class="roles" id="{{$user->id . 'roles'}}">
                                            @foreach($roles as $role)
                                                @php
                                                    switch ($role->name){
                                                        case 'admin':
                                                        $name = 'Talent Acquisition Partner';
                                                        break;
                                                        case 'interviewer':
                                                        $name = "Business Manager";
                                                        break;
                                                        case 'commenter':
                                                        $name = 'Business Partner';
                                                        break;
                                                    }
                                                @endphp
                                            <option @if($user->roles()->first()->id == $role->id) selected @endif value="{{$role->id}}">{{$name}}</option>
                                            @endforeach
                                        </select>
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
