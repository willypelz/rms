@extends('layout.template-user')
@section('content')

    <div class="container" style="padding-top: 50px;">
        <div class="row">
            <div class="col">
                <div class="panel panel-default">
                    @include('layout.alerts')
                    <div class="panel-body">
                        <table id="audit" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Initiator</th>
                                    <th>Actions</th>
                                    <th>Description </th>
                                    <th>Company </th>
                                    <th>Subject</th>
                                    <th>Date Created </th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($audits as $key => $audit)
                                    <tr>
                                        <td>{{$key + 1}}</td>

                                        <td>
                                            {{ isset($audit->causer) ? $audit->causer->name : (isset($audit->candidate) ? $audit->candidate->name() : 'N/A')}}
                                        </td>

                                        <td>
                                            {{ $audit->log_name }}
                                        </td>
                                        <td>
                                            {{ $audit->description}}
                                        </td>
                                        <td>
                                            {{ (isset($audit->causer) ? $audit->causer->companies[0gi]['name'] : 'N/A')}}
                                        </td>

                                        <td>
                                            {{ isset($audit->subject) ? $audit->subject->name : (isset($audit->candidateSubject) ? $audit->candidateSubject->name() : 'N/A')}}
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
    <script>
    $(document).ready(function() {
       $('#audit').DataTable();
    } );
    </script>
@endsection
