                            <h5 class="no-margin">Edit {{ $user->name }} Details <span class="pull-right"><i class="fa fa-lg fa-user-plus"></i></span></h5><hr>

                            <div class="collapse in" style="height: auto;">
                              
                                   <form action="">

                                       <div class="form-group">
                                           <label for="">Name: </label>
                                           <input type="text" class="form-control" value="{{ $user->name }}" disabled="">
                                           
                                           <label for="">Email: </label>
                                           <!-- <small>Separate your addresses by a comma</small> -->
                                           <input type="email" class="form-control" value="{{ $user->email }}">

                                       </div>

                                   </form>
                                   <br>
                                   <p>
                                       <a role="button" data-toggle="collapse" href="#collapseWYSIWYG" aria-expanded="false" aria-controls="collapseWYSIWYG" class="btn btn-line btn-sm"><i class="fa fa-times"></i> &nbsp; Cancel</a>

                                       <a role="button" data-toggle="collapse" href="#collapseWYSIWYG" aria-expanded="false" aria-controls="collapseWYSIWYG" class="btn btn-success btn-sm pull-right">Update Details &nbsp; <i class="fa fa-send"></i></a>
                                   </p>
                               </div>
