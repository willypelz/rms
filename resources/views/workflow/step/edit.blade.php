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

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           value="{{ old('name', $workflowStep->name) }}"
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
                                           value="{{ old('rank', $workflowStep->rank) }}"
                                           placeholder="10"
                                           class="form-control">
                                </div>

                                <div class="form-group">
                                    <input type="hidden"
                                           name="requires_approval"
                                           id="requireApproval"
                                           class="control-check"
                                           value="0">
                                    <input type="checkbox"
                                           name="requires_approval"
                                           id="requireApproval"
                                           class="control-check"
                                           value="1"
                                           @if(old('requires_approval', $workflowStep->requires_approval) == 1) checked @endif>
                                    Requires Approval
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
                                    Visible to Applicant
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
                                    <textarea name="message_template"
                                              id="messageTemplate"
                                              placeholder="... ... .."
                                              class="form-control">{{ old('message_template', $workflowStep->message_template) }}</textarea>
                                </div>

                                <div class="form-group">
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

