@extends('layout.template-default')

@section('content')

    <section>
        <div class="container">
            @php
                $user_role = getCurrentLoggedInUserRole();
                $is_super_admin = auth()->user()->is_super_admin;
            @endphp
            @include('layout.alerts')
            @include('layout.confirm-dialog')

            <div class="row">

                <div class="col-md-6">
                    <h4>Specializations</h4>

                    @if(count($specializations))
                        @foreach($specializations as $specialization)
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="worflow-top-part clearfix">

                                        <div class="pull-left">
                                            <a @if((isset($user_role) && !is_null($user_role) && !in_array($user_role->name, ['admin'])) || !$is_super_admin) href="#" @else  href="{{ route('update-specialization', ['id' => $specialization->id]) }}" @endif>
                                                <h5>{{ $specialization->name }}</h5>
                                            </a>
                                        </div>

                                        <div class="pull-right">

                                            @if((isset($user_role) && !is_null($user_role) && in_array($user_role->name, ['admin'])) || $is_super_admin)

                                                <a href="{{ route('update-specialization', ['id' => $specialization->id]) }}"
                                                   class="btn btn-warning btn-sm">
                                                    <i class="fa fa-pencil fa-fw"></i>
                                                    Edit
                                                </a>
                                            @endif
                                            @if(!$specialization->jobs()->exists())
                                                <form id="{{ "delForm" . $specialization->id}}" action="{{ route('delete-specialization', ['id' => $specialization->id]) }}"
                                                      method="post"
                                                      class="delete-spoof">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="_method" value="delete">

                                                    <button  onclick="delConfirmation('Are you sure you want to delete this specialization?', {{ $specialization->id }});" type="button" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash fa-fw"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="panel panel-danger">
                            <div class="panel-body">
                                No Specialization is available

                            </div>
                        </div>
                    @endif

                </div>
                <div class="col-md-6">
                    <h4>Create Specialization</h4>
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <form action="{{ route('store-specialization') }}" method="post">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <span class="text-danger">*</span>
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           value="{{ old('name') }}"
                                           class="form-control">
                                </div>


                                <div class="form-group">
                                    <button @if(userHasRole('admin') && !$is_super_admin) disabled @endif type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus fa-fw"></i>
                                        Create
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <script>
        function delConfirmation(strg, id){
            let elementName = "delForm" + id;
            customConfirmation(strg)
            setTimeout(() => {
                $('#btn1').click(function(e){
                    document.getElementById(elementName).submit()
                })
            }, 1000);
        }
    </script>

@endsection
