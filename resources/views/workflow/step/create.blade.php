<?php
/**
 * Description
 *
 * @package     seamlesshiring.vcom
 * @category    Source
 * @author      Michael Akanji <matscode@gmail.com>
 * @date        2018-09-26
 */
?>
@extends('layout.template-default')

@section('content')
    @php
        $user_role = getCurrentLoggedInUserRole()->name;
    @endphp
    <section>
        <div class="container">
            
            @include('layout.alerts')
            
            <div class="row">
                
                <div class="col-md-6">
                    <p>
                        <span class="text-muted">
                            
                        </span>
                        <a href="{{ route('workflow') }}" class="text-muted">Workflows</a>
                    </p>
                    <h3>
                        {{ $workflow->name }}
                    </h3>
                    
                    @if($workflow->workflowSteps()->exists())
                        <div id="sortableSteps" data-workflow-id="{{ $workflow->id }}">
                            @foreach($workflow->workflowSteps as $workflowStep)
                                <div class="panel panel-default workflow-steps"
                                     id="{{ $workflowStep->id }}">
                                    <div class="panel-body clearfix">
                                        <div class="pull-left">
                                            <h5>{{ $workflowStep->name }}</h5>
                                            <p class="text-muted">
                                                Require Approval :
                                                {{ ($workflowStep->requires_approval) ? 'Yes' : 'No' }}
                                            </p>
                                            <p class="text-muted">
                                                Visible to Applicant :
                                                {{ ($workflowStep->visible_to_applicant) ? 'Yes' : 'No' }}
                                            </p>
                                            <p class="text-muted">
                                                Send Message to Applicant :
                                                {{ ($workflowStep->message_to_applicant) ? 'Yes' : 'No' }}
                                            </p>
                                            <div class="">
                                                {!! $workflowStep->is_readonly
                                           ? '- <span class="text-warning">System Generated</span> -'
                                           : '' !!}
                                            </div>
                                        </div>
                                        
                                        @if(!$workflowStep->is_readonly && $user_role == 'admin')
                                            <div class="pull-right">
                                                <a href="{{ route('step-edit', ['id' => $workflowStep->id]) }}"
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil fa-fw"></i>
                                                    Edit
                                                </a>
                                                {{--
                                                <form action="{{ route('step-delete', ['id' => $workflowStep->id]) }}"
                                                      method="post"
                                                      class="delete-spoof">
                                                    {{ csrf_field() }}

                                                    <input type="hidden" name="_method" value="delete">

                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-times-circle fa-fw"></i>
                                                    </button>
                                                </form>--}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="panel panel-danger">
                            <div class="panel-body">
                                No steps attached to this workflow, add some!
                            </div>
                        </div>
                    @endif
                
                </div>
                
                <div class="col-md-6">
                    <h4>Create Steps</h4>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            
                            <form action="{{ route('workflow-steps-store', ['id' => $workflow->id]) }}" method="post">
                                
                                {{ csrf_field() }}
                                
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text"
                                                   name="name"
                                                   id="name"
                                                   value="{{ old('name') }}"
                                                   placeholder="Waiting List"
                                                   class="form-control">
                                        </div>
                                    </div>
                                <!-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="order">Order</label>
                                            <input type="number"
                                                   min="1"
                                                   step="1"
                                                   name="order"
                                                   id="order"
                                                   value="{{ old('order') }}"
                                                   placeholder="10"
                                                   class="form-control">
                                        </div>
                                    </div> -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Type</label>
                                            <select name="type"
                                                    id="type"
                                                    class="select2"
                                                    style="width: 100%;">
                                                <option value="">- select -</option>
                                                @foreach(config('workflowStepTypes') as $stepSlug => $stepLabel)
                                                    <option value="{{ $stepSlug }}">{{ $stepLabel }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <input type="checkbox"
                                           name="requires_approval"
                                           id="requireApproval"
                                           class="control-check"
                                           value="1"
                                           @if(old('requires_approval') == 1) checked @endif>
                                    <label for="requireApproval">Requires Approval</label>
                                </div>
                                
                                <div class="form-group" id="approvalUsersBlock">
                                    <label for="approvalUsers">Approval Users</label>
                                    <select class="select2"
                                            name="approval_users[]"
                                            id="approvalUsers"
                                            multiple
                                            style="width: 100%;">
                                        @foreach($currentCompanyUsers as $currentCompanyUser)
                                            <option value="{{ $currentCompanyUser->id }}">
                                                {{ $currentCompanyUser->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <input type="checkbox"
                                           name="visible_to_applicant"
                                           id="visibleToApplicant"
                                           value="1"
                                           @if(old('visible_to_applicant') == 1) checked @endif>
                                    <label for="visibleToApplicant">Visible to Applicant</label>
                                </div>
                                
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description"
                                              id="description"
                                              placeholder="A short note about this workflow"
                                              class="form-control">{{ old('description') }}</textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="messageTemplate">Message Template</label>
                                    <div class="form-group">
                                        <input type="checkbox" name="message_to_applicant" id="messageToApplicant" value="1"
                                            @if(old('message_to_applicant')==1) checked @endif>
                                        <label for="messageToApplicant">Send Message to Applicant</label>
                                    </div>
                                    <div id="messageTemplateBlock">
                                        <textarea name="message_template" id="messageTemplate" placeholder="... ... .."
                                            class="form-control">{{ old('message_template') }}</textarea>
                                
                                        <!-- Message Template Placeholder Buttons -->
                                        <div class="msg-template-placeholders" style="margin: 10px auto;">
                                            <button type="button" class="btn btn-sm btn-secondary templateBtn" value="{applicant_name}">
                                                Applicant Name
                                            </button>
                                            |
                                            <button type="button" class="btn btn-sm btn-secondary templateBtn" value="{company_name}">
                                                Company Name
                                            </button>
                                            <button type="button" class="btn btn-sm btn-secondary templateBtn" value="{job_detail}">
                                                Job Detail
                                            </button>
                                            <button type="button" class="btn btn-sm btn-secondary templateBtn" value="{job_title}">
                                                Job Title
                                            </button>
                                        </div>
                                    </div>
                                
                                </div>
                                @if($user_role == 'admin')
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus fa-fw"></i>
                                        Create
                                    </button>
                                </div>
                               @endif
                            
                            </form>
                        
                        </div>
                    </div>
                
                </div>
            
            </div>
        </div>
    </section>

@endsection

