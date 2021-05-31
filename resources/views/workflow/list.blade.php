@extends('layout.template-default')

@section('content')
    
    <section>
        <div class="container">
            @php
                $user_role = getCurrentLoggedInUserRole();
                $is_super_admin = auth()->user()->is_super_admin;
            @endphp
            @include('layout.alerts')
            
            <div class="row">
                
                <div class="col-md-6">
                    <h4>Workflows</h4>
                    
                    @if(count($workflows))
                        @foreach($workflows as $workflow)
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="worflow-top-part clearfix">
                                        
                                        <div class="pull-left">
                                            <a @if((isset($user_role) && !is_null($user_role) && !in_array($user_role->name, ['admin'])) || !$is_super_admin) href="#" @else  href="{{ route('workflow-edit', ['id' => $workflow->id]) }}" @endif>
                                                <h5>{{ $workflow->name }}</h5>
                                            </a>
                                            <p class="text-muted">{{ $workflow->description }}</p>
                                        </div>
                                        
                                        <div class="pull-right">
                                        <!--
                                                <a href="{{ route('workflow-show', ['id' => $workflow->id]) }}"
                                                   class="btn btn-info btn-sm pull-right">
                                                    <i class="fa fa-eye fa-fw"></i>
                                                    View
                                                </a>
                                             -->
                                             @if((isset($user_role) && !is_null($user_role) && in_array($user_role->name, ['admin'])) || $is_super_admin)
                                            <a href="{{ route('workflow-steps-add', ['id' => $workflow->id]) }}"
                                               class="btn btn-primary btn-sm">
                                                <i class="fa fa-plus fa-fw"></i>
                                                Add Steps
                                            </a>
                                            
                                            <a href="{{ route('workflow-edit', ['id' => $workflow->id]) }}"
                                               class="btn btn-warning btn-sm">
                                                <i class="fa fa-pencil fa-fw"></i>
                                                Edit
                                            </a>
                                            <a href="{{ route('workflow-duplicate', ['id' => $workflow->id]) }}"
                                                class="btn btn-info btn-sm">
                                                 <i class="fa fa-copy fa-fw"></i>
                                                 Duplicate
                                             </a>
                                            @endif
                                            @if(!$workflow->jobs()->exists())
                                                <form action="{{ route('workflow-delete', ['id' => $workflow->id]) }}"
                                                      method="post"
                                                      class="delete-spoof">
                                                    {{ csrf_field() }}
                                                    
                                                    <input type="hidden" name="_method" value="delete">
                                                    
                                                    <button  onclick="return confirm('Are you sure you want to delete workflow?');" type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash fa-fw"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Some little info about this current workflow -->
                                    <div class="workflow-bottom-part clearfix">
                                        
                                        <div class="pull-left">
                                            <p class="text-info">
                                                <a href="{{ route('workflow-steps-add', ['id' => $workflow->id]) }}">
                                                    {{ $workflow->workflowSteps()->count() }} Steps
                                                </a>
                                            </p>
                                        </div>
                                        
                                        <div class="pull-right text-warning">
                                            Attached to <strong>{{ ($attachments_count = $workflow->jobs()->count()) > 0 ? $attachments_count : 'No' }} Jobs</strong>
                                        </div>
                                    
                                    </div>
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
                                    <button @if((isset($user_role) && !is_null($user_role) && !in_array($user_role->name, ['admin'])) || !$is_super_admin) disabled @endif type="submit" class="btn btn-primary">
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
