@extends('layout.template-default')

@section('content')
    @php
        $user_role = getCurrentLoggedInUserRole();
        $is_super_admin = auth()->user()->is_super_admin;
    @endphp
    <section>
        <div class="container">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    @include('layout.alerts')

                    <h4>Update Specialization</h4>
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <form action="{{ route('store-specialization') }}" method="POST">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           value="{{ old('name', $specialization->name) }}"
                                           class="form-control">
                                </div>

                                <input type="hidden" name="id" value="{{ $specialization->id }}">

                                <div class="form-group">

                                    <a href="{{ route('specialization') }}"" type="submit" class="btn btn-warning">
                                        <i class="fa fa-arrow-left fa-fw"></i>
                                        Cancel
                                    </a>

                                    <button @if(!$is_super_admin) disabled @endif type="submit" class="btn btn-primary">
                                        <i class="fa fa-pencil fa-fw"></i>
                                        Update
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

