@extends('layout.template-user')
@section('content')
<div class="container" style="padding-top: 150px;">
    <div class="row">
        <div class="col">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="text-center">Manage Super Admins</h2>
                </div>



                <div class="panel-body">

                @include('layout.alerts')

                @if(env('RMS_STAND_ALONE'))    
                <div data-toggle="modal" data-target="#superAdminModal" href="#superAdminModal" data-title="Background Check" style="margin-bottom:15px" class="btn btn-info pull-right">Invite Super Admin</div>
                @endif
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
                                    <div onclick="assignRole({!! $user->id !!})" class="btn btn-success">Assign super admin role</div> @endif 
                                    @if(!isHrmsIntegrated())
                                        <div data-toggle="modal" data-target="#deleteSuperAdminModal{{ $user->id }}" href="#deleteSuperAdminModal{{ $user->id }}" data-title="Background Check" style="margin-bottom:15px; margin-left:6px" class="btn btn-danger pull-right">Delete</div>
                                    @endif
                                    <div data-toggle="modal" data-target="#editSuperAdminModal{{ $user->id }}" href="#editSuperAdminModal{{ $user->id }}" data-title="Background Check" style="margin-bottom:15px" class="btn btn-info pull-right">Edit</div>


                                    </td> 
                                </tr> 



                                <div class="modal widemodal fade" id="editSuperAdminModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">Edit Super Admin</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('job-team-add') }}" method="post" id="SuperAdmin">
                                                    {!! csrf_field() !!}
                                                    <input type="hidden" name="mod" value="1">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <div id="hiddenForm">
                                                                <div id="external_div">
                                                                    <label for="">Name: </label>
                                                                    <input type="text" value="{{ $user->name }}" id="name" name="name" value="" class="form-control">
                                                                    <small><em>The name of the team member</em></small>
                                                                    <br><br>
                                                                    <input type="hidden" name="email_from" value="{{ get_current_company()->email }}" class="form-control">
                                                                    <label for="">Email: </label>
                                                                    <input type="text" name="email" id="email_to" placeholder="email addresses here" value="{{ $user->email }}" class="form-control">
                                                                    <small><em>The email address of the team member</em>
                                                                    </small>
                                                                    <br><br>
                                                                </div>
                                                                <input type="hidden" name="id" value="{{ $user->id }}">

                                                            </div>
                                                            <div class="common-fields">

                                                                <label for="resend">Resend Invite Mail</label>
                                                                <input type="checkbox" id="resend" name="resend_email" class="form-control">
                                                                

                                                                <textarea  rows="10" cols="30" id="editor1" name="body_mail" style="display:none;" >&lt;p&gt;Hello,&lt;br&gt;Regarding the ongoing recruitment process at {{ ucwords( get_current_company()->name ) }} company, this is to inform you that you have been assigned the Role of Super Admin. You would be required to collaborate with your team and manage the System.</textarea>
                                                                
                                                                <br>
                                                                <p>
                                                                    <a aria-controls="superAdminModal" aria-expanded="false" class="btn btn-line btn-sm" data-toggle="collapse" data-target="#superAdminModal" href="">
                                                                        Cancel</a>
                                                                    <input class="btn btn-success btn-sm pull-right" id="sendMail" type="submit" value="Update">
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal widemodal fade" id="deleteSuperAdminModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">Delete Super Admin</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('job-team-admin-delete') }}" method="post"  id="SuperAdmin">
                                                    {!! csrf_field() !!}
                                                    <input type="hidden" name="mod" value="1">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <div id="hiddenForm">
                                                                <div id="external_div">
                                                                    <label for="">Are you sure you want to delete the {{ $user->name }} as super admin</label>
                                                                </div>
                                                                <input type="hidden" name="user_id" value="{{ $user->id }}">

                                                            </div>
                                                            <div class="common-fields">
                                                                <p>
                                                                    <a aria-controls="superAdminModal" aria-expanded="false" class="btn btn-line btn-sm" data-toggle="collapse" data-target="#superAdminModal" href="">
                                                                        Cancel</a>
                                                                    <input class="btn btn-danger btn-sm pull-right" id="sendMail" type="submit" value="Delete">
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                @endforeach 


                                
                            </tbody> 
                        </table> 
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
                                <div class="modal widemodal fade" id="superAdminModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="myModalLabel">Invite Super Admin</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('job-team-add') }}" method="post" id="SuperAdmin">
                                                    {!! csrf_field() !!}
                                                    <input type="hidden" name="mod" value="1">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <div id="hiddenForm">
                                                                <div id="external_div">
                                                                    <label for="">Name: </label>
                                                                    <input type="text" required id="name" name="name" value="" class="form-control">
                                                                    <small><em>The name of the team member</em></small>
                                                                    <br><br>
                                                                    <input type="hidden" name="email_from" value="{{ get_current_company()->email }}" class="form-control">
                                                                    <label for="">Email: </label>
                                                                    <input type="text" required name="email" id="email_to" placeholder="email addresses here" class="form-control">
                                                                    <small><em>The email address of the team member</em>
                                                                    </small>
                                                                    <br><br>
                                                                </div>
                                                            </div>
                                                            <div class="common-fields">
                                                                <label for="editor1">Invite Mail</label>
                                                                <textarea rows="10" cols="30" id="editor1" name="body_mail" style="visibility: hidden; display: none;">&lt;p&gt;Hello,&lt;br&gt;Regarding the ongoing recruitment process at {{ ucwords( get_current_company()->name ) }} company, this is to inform you that you have been assigned the Role of Super Admin. You would be required to collaborate with your team and manage the System.</textarea>
                                                                <script>
                                                                    CKEDITOR.replace('editor1');
                                                                </script>
                                                                <br>
                                                                <p>
                                                                    <a aria-controls="superAdminModal" aria-expanded="false" class="btn btn-line btn-sm" data-toggle="collapse" data-target="#superAdminModal" href="">
                                                                        Cancel</a>
                                                                    <input class="btn btn-success btn-sm pull-right" id="sendMail" type="submit" value="Send mail">
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                <script src="{{ secure_asset('js/jquery.form.js') }}"></script>
                <script>
                    $(document).ready(function() {
                        $('#myTable').DataTable();
                    });

                    function assignRole(userId) {

                        var result = confirm("Are you sure you want to assign Super Admin role?");
                        if (result) {
                            
                            $.ajax({
                                url: "{{ route('change-admin-role') }}",
                                type: "post",
                                data: {
                                    id: userId,
                                    role: 1
                                },
                                success: function(response) {
                                    if (response.status) {
                                        $.growl.notice({
                                            message: 'Changed successfully'
                                        });
                                        window.location.reload();
                                    } else {
                                        $.growl.error({
                                            message: response.message
                                        });
                                    }
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    $.growl.error({
                                        message: 'Could not change role please try again'
                                    });
                                }
                            });
                        }
                    }

                    function removeRole(userId) {
                         var result = confirm("Are you sure you want to remove Super Admin role?");
                            if (result) {
                                $.ajax({
                                    url: "{{ route('change-admin-role') }}",
                                    type: "post",
                                    data: {
                                        id: userId,
                                        role: 0
                                    },
                                    success: function(response) {
                                        if (response.status) {
                                            $.growl.notice({
                                                message: 'Changed successfully'
                                            });
                                            window.location.reload();
                                        } else {
                                            $.growl.error({
                                                message: response.message
                                            });
                                        }
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        $.growl.error({
                                            message: 'Could not change role please try again'
                                        });
                                    }
                                });
                            }
                    }
                </script>
                @endsection