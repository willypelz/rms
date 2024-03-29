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
                    <h4>Edit Step</h4>
                    <div class="panel panel-default">
                        <div class="panel-body">

                            @include('layout.alerts')

                            <form action="{{ route('step-edit', ['id' => $workflowStep->id]) }}" method="post">

                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="put">

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text"
                                                   name="name"
                                                   id="name"
                                                   value="{{ old('name', $workflowStep->name) }}"
                                                   placeholder="Waiting List"
                                                   class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type">Type</label>
                                            <select name="type"
                                                    id="type"
                                                    class="select2"
                                                    style="width: 100%;" required>
                                                <option value="">- select -</option>
                                                @foreach(config('workflowStepTypes') as $stepSlug => $stepLabel)
                                                    <option value="{{ $stepSlug }}" @if($workflowStep->type == $stepSlug) selected = "selected" @endif>{{ $stepLabel }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="hidden"
                                           name="requires_approval"
                                           id=""
                                           class="control-check"
                                           value="0">
                                    <input type="checkbox"
                                           name="requires_approval"
                                           id="requireApproval"
                                           class="control-check"
                                           value="1"
                                           @if(old('requires_approval', $workflowStep->requires_approval) == 1) checked @endif>
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
                                            <option @if(in_array($currentCompanyUser->id, $step_approvals->toArray())) selected @endif value="{{ $currentCompanyUser->id }}">
                                                {{ $currentCompanyUser->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <input type="hidden"
                                           name="visible_to_applicant"
                                           id="visibleToApplicant"
                                           value="0">
                                    <input type="checkbox"
                                           name="visible_to_applicant"
                                           id="visibleToApplicant"
                                           value="1"
                                           @if(old('visible_to_applicant', $workflowStep->visible_to_applicant) == 1) checked @endif>
                                    <label for="visibleToApplicant">Visible to Applicant</label>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description"
                                              id="description"
                                              placeholder="A short note about this workflow"
                                              class="form-control">{{ old('description', $workflowStep->description) }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="messageTemplate">Message Template</label>
                                    <div class="form-group">
                                        <input type="hidden" name="message_to_applicant" id="" class="control-check" value="0">
                                        <input type="checkbox" name="message_to_applicant" id="messageToApplicant" value="1" @if(
                                            $workflowStep->message_to_applicant == 1) checked @endif>
                                        <label for="messageToApplicant">Send Message to Applicant</label>
                                    </div>
                                    <div id="messageTemplateBlock">
                                        <textarea name="message_template" id="messageTemplate" placeholder="... ... .."
                                            class="form-control">{{ old('message_template', $workflowStep->message_template) }}</textarea>
                                    </div>

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
                                <div class="form-group">
                                    <a href="#" class="btn btn-warning"
                                       onclick="history.back()">
                                        <i class="fa fa-arrow-left fa-fw"></i>
                                        Cancel
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-refresh fa-fw"></i>
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

