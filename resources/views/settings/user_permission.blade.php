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
                                User Role and Permission Settings
                            </h5>
                            <hr>
                            <br>
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <div class="col-md-12">
                                @include('layout.alerts')
                                <form id="myForm" >
                                    <div class="row">
                                        @foreach($user_roles as $key => $user_role)
                                            <div class="col-md-4">
                                                <div class="well dash-well">
                                                    <h5 class="text-uppercase lsp3">{{ $user_role->role->display_name }}</h5>
                                                    <hr/>
                                                    <div class="ad-mgt-scroll">
                                                        <label><input type="checkbox" onClick="toggle(this, '{{$key}}')" /> <b>Toggle All</b></label><br/>
                                                    @foreach($permissions as $permission)
                                                            <label> <input id="sys-con" type="checkbox"
                                                                           name="permissions[]"
                                                                           value="{{$permission->id}}"
                                                                           class="{{$key}}"
                                                                           {{$check = in_array($permission->id, $permission->getRolePermissions($user_role->role_id)) ? "checked" : ''}}  onClick="systemControl(this, '{{$key}}')"> {{$permission->name}}

                                                            </label> <br/>
                                                        @endforeach
                                                      <div class="pb-5 mb-5" style="padding-bottom: 15px">
                                                          <a  class="btn btn-primary btn-sm pull-right" onclick="updateRolesAndPermission('{{$user_role->role_id}}',  '{{$key}}')">Update</a>
                                                      </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    {{--                                {{ $roles }}--}}
                                    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
{{--                                    <hr>--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-xs-12"></div>--}}
{{--                                        <div class="col-xs-4"></div>--}}
{{--                                        <div class="col-sm-4"></div>--}}
{{--                                        <div class="col-sm-4">--}}
{{--                                            <button id="p-p-btn" type="submit" class="btn btn-success btn-block">--}}
{{--                                                Update Settings--}}
{{--                                            </button>--}}
{{--                                        </div>--}}
{{--                                        <div class="separator separator-small"></div>--}}
{{--                                    </div>--}}
                                </form>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!--/tab-content-->
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            if ($('#sys-con').prop('checked')) {
                $('.permissions').addClass('collapse');
            }
        });
    </script>
    <script>
        function toggle(source, className) {
            checkboxes = document.getElementsByClassName(className);

            for (var i = 0, n = checkboxes.length; i < n; i++) {
                checkboxes[i].checked = source.checked;
            }
        }
    </script>
    <script>
        function systemControl(source, className) {

            className = "System Control"
            $('.permissions input:checked').each(function () {
                $(this).prop('checked', false);
            });
            if ($('#sys-con').prop('checked')) {
                $('.permissions').addClass('collapse');
            } else {
                $('.permissions').removeClass('collapse');
            }
        }
    </script>
    <script>
      function updateRolesAndPermission(role_id, key){
          var permissions=[];
          $(`.${key}:checkbox:checked`).each(function() { permissions.push($(this).val()); });

          var url = `user-permission/${role_id}`;
          $.ajax({
              url: url,
              type: 'POST',
              data: {
                  _token: '{{ csrf_token() }}', id: role_id,  permissions,  background_callback: true
              },

              success: function (res) {
                  $.growl.notice({title: "Success", message: 'Role and permission settings updated successfully'})
              }
          });
        }
    </script>
@endsection
