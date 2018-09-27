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

    <section>
        <div class="container">

            <div class="row">

                <div class="col-md-6">
                    <h4>
                        {{ $workflow->name }} <span class="text-muted">-> Workflow</span>
                    </h4>

                    @if($workflow->workflowSteps()->exists())
                        @foreach($workflow->workflowSteps as $workflowStep)
                            <div class="panel panel-default">
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
                                        <div class="">
                                            - {{ $workflowStep->rank }} -
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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

                            @include('layout.alerts')

                            <form action="{{ route('workflow-steps-store', ['id' => $workflow->id]) }}" method="post">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           value="{{ old('name') }}"
                                           placeholder="Waiting List"
                                           class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="rank">Rank/Priority</label>
                                    <input type="number"
                                           min="0"
                                           step="1"
                                           name="rank"
                                           id="rank"
                                           value="{{ old('rank') }}"
                                           placeholder="10"
                                           class="form-control">
                                </div>

                                <div class="form-group">
                                    <input type="checkbox"
                                           name="requires_approval"
                                           id="requireApproval"
                                           class="control-check"
                                           value="1"
                                           @if(old('requires_approval') == 1) checked @endif>
                                    Requires Approval
                                </div>

                                <div class="form-group">
                                    <input type="checkbox"
                                           name="visible_to_applicant"
                                           id="visibleToApplicant"
                                           value="1"
                                           @if(old('visible_to_applicant') == 1) checked @endif>
                                    Visible to Applicant
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
                                    <textarea name="message_template"
                                              id="messageTemplate"
                                              placeholder="... ... .."
                                              class="form-control">{{ old('messageTemplate') }}</textarea>
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

