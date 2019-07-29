<?php
/**
 * Description
 *
 * @package     seamlesshiring.vcom
 * @category    Source
 * @author      Michael Akanji <matscode@gmail.com>
 * @date        2018-09-27
 */
?>

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

                    <h4>Update Workflow</h4>
                    <div class="panel panel-default">
                        <div class="panel-body">

                            <form action="{{ route('workflow-update', ['id' => $workflow->id]) }}" method="post">

                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="put">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           value="{{ old('name', $workflow->name) }}"
                                           placeholder="Manager Hire"
                                           class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea name="description"
                                              id="description"
                                              placeholder="A short note about this workflow"
                                              class="form-control">{{ old('description', $workflow->description) }}</textarea>
                                </div>

                                <div class="form-group">
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

