@extends('layout.template-user')
@section('content')

    <div class="container" style="padding-top: 50px;">
        <div class="row">
            <div class="col">
                <div class="panel panel-default">
                    <!-- <div class="panel-heading">
                        <h2 class="text-center"> Audit</h2>
                    </div> -->

                    @include('layout.alerts')

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Initiator</th>
                                    <th>Actions</th>
                                    <th>Description </th>
                                    <th>Subject</th>
                                    <th>Date Created </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($audits as $key => $audit)
                                    <tr>
                                        <td>{{$key + 1}}</td>

                                        <td>
                                            {{ $audit->causer->name ?? $audit->candidate->name()}}
                                        </td>
                    
                                        <td>
                                            {{ $audit->action_type }}
                                        </td>
                                        <td>
                                            {{ $audit->description}}
                                        </td>
                                        <td>
                                            {{ $audit->subject->name ?? $audit->subjectCandidate->name()}}
                                        </td>
                                        <td>
                                            {{ $audit->created_at->toDayDateTimeString()}}
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

    <!-- <script>
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

    </script> -->
@endsection
