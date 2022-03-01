@extends('layout.template-default')


@section('content')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

    @include('job.includes.interview-head')
    <section class="">
        <div class="container">
            <div class="row">

                <div class="col-sm-8 col-sm-offset-2">

                    <div class="form-group">
                        <a href="{{ route('interview-note-templates') }}" class=""><i class="fa fa-chevron-left"></i> Back to template</a>
                    </div>

                <!-- <h3>Edit {{ ucwords( $interview_note_template->name ) }}</h3> -->
                    <!-- <p class="text-muted">Africa's fastest growing network of professionals</p> -->

                    @include('layout.alerts')


                    <form action="{{ route('interview-note-template-edit', ['id' => $interview_note_template->id ]) }}" method="POST">

                        <div class="panel panel-default no-border">
                            <div class="panel-heading h4">Editing <b>{{ ucwords( $interview_note_template->name ) }}</b></div>
                            <div class="panel-body no-border">
                                <div class="">
                                    <div class="form-group text-left">
                                        <label for="name">Name <span style="color: red">*</span></label>
                                        <input type="text" name="name" class="form-control" value="{{ $interview_note_template->name }}" required>
                                    </div>

                                    <div class="form-group text-left">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="summernote" class="form-control" rows="6" required>
                                        {{ $interview_note_template->description }}
                                    </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer text-right">
                                <button class="btn btn-success">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>


@endsection
