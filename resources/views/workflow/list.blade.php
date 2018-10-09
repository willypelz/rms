@extends('layout.template-default')

@section('content')

    <section>
        <div class="container">

            @include('layout.alerts')

            <div class="row">

                <div class="col-md-6">
                    <h4>Workflows</h4>

                    @if(count($workflows))
                        @foreach($workflows as $workflow)
                            <div class="panel panel-default">
                                <div class="panel-body clearfix">
                                    <div class="pull-left">
                                        <h5>{{ $workflow->name }}</h5>
                                        <p class="text-muted">{{ $workflow->description }}</p>
                                        <p class="text-info">{{ $workflow->workflowSteps()->count() }} Steps</p>
                                    </div>

                                    <div class="pull-right">
                                        <a href="{{ route('workflow-steps-add', ['id' => $workflow->id]) }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-plus fa-fw"></i>
                                            Add Steps
                                        </a>

                                        <a href="{{ route('workflow-edit', ['id' => $workflow->id]) }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="fa fa-pencil fa-fw"></i>
                                            Edit
                                        </a>

                                        <form action="{{ route('workflow-delete', ['id' => $workflow->id]) }}"
                                              method="post"
                                              class="delete-spoof">
                                            {{ csrf_field() }}

                                            <input type="hidden" name="_method" value="delete">

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-times-circle fa-fw"></i>
                                            </button>
                                        </form>
                                    </div>
                                <!--
                                    <a href="{{ route('workflow-show', ['id' => $workflow->id]) }}"
                                       class="btn btn-info btn-sm pull-right">
                                        <i class="fa fa-eye fa-fw"></i>
                                        View
                                    </a>
                                     -->
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="panel panel-danger">
                            <div class="panel-body">
                                No workflow is available click <a href="#">here</a> to create
                            </div>
                        </div>
                    @endif

                </div>

                <div class="col-md-6">
                    <h4>Create Workflows</h4>
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <form action="{{ route('workflow-store') }}" method="post">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           value="{{ old('name') }}"
                                           placeholder="Manager Hire"
                                           class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description"
                                              id="description"
                                              placeholder="A short note about this workflow"
                                              class="form-control">{{ old('description') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
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

@endsection
