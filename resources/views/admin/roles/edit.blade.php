@extends('layout.template-user')
@section('content')

    <div class="container" style="padding-top: 150px;">
        <div class="row">
            <div class="col">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="text-center"> Roles </h2>
                    </div>
                    <div class="panel-body">
                        
                    <form action="" method="post"> 
                        <div class="well dash-well">
                            <h4 class="text-bolder">Edit Profile</h4><br>
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{$role->id}}">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control angular" id="name" name="name" placeholder="Enter name" value="{{$role->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="display_name">Display Name</label>
                                    <input type="text" class="form-control angular" id="display_name" name="display_name" placeholder="Enter display name" value="{{ $role->display_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <input type="text" class="form-control angular" id="description" name="description" placeholder="Enter description" value="{{$role->description}}">
                                </div>
                        </div>

                         <div class="form-group">
                    <br>
                    <h6 for="permissions" class="text-center text-bolder text-uppercase lsp3">Edit permissions below</h6><br>

                    <div class="row">

                          <div class="permissions">
                            <div class="col-md-12">
                                <div class="well dash-well">


                                    <label><input type="checkbox" id="permission_select_all" /> <b>Toggle All</b></label><br/>

                                    <div class="ad-mgt-scroll">
                                          @foreach($permissions as $key => $permission)
                                            <label><input type="checkbox" name="permissions[]" value="{{$permission->id}}" class="permission_checkbox" {{in_array($permission->id, $rolePermissions) ? "checked" : ''}}> {{$permission->name}}</label> <br/>
                                          @endforeach
                                    </div>

                                </div>
                            </div>
                          </div>
                        
                    </div>

                <button type="submit" class="btn btn-primary pull-right">Submit</button>

                </div>

                    </div>
                </div>



                </form>
            </div>
        </div>
    </div>
    <script src="{{ secure_asset('js/jquery.form.js') }}"></script>


<script type="text/javascript">
    var select_all = document.getElementById("permission_select_all"); //select all checkbox
    var checkboxes = document.getElementsByClassName("permission_checkbox"); //checkbox items

    //select all checkboxes
    select_all.addEventListener("change", function(e){
      for (i = 0; i < checkboxes.length; i++) { 
        checkboxes[i].checked = select_all.checked;
      }
    });


    for (var i = 0; i < checkboxes.length; i++) {
      checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
        //uncheck "select all", if one of the listed checkbox item is unchecked
        if(this.checked == false){
          select_all.checked = false;
        }
        //check "select all" if all checkbox items are checked
        if(document.querySelectorAll('.checkbox:checked').length == checkboxes.length){
          select_all.checked = true;
        }
      });
    }
</script>
   
@endsection