@extends('layout.template-default')


@section('content')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

    @include('job.includes.interview-head')
    <section class="">
        <div class="container">
            <div class="row">

                <div class="col-sm-8 col-sm-offset-2">
                    <a href="{{ route('interview-note-templates') }}" class=""><i class="fa fa-chevron-left"></i> Back to template</a>

                    @include('layout.alerts')
                </div>

                <div class="col-sm-8 col-sm-offset-2"><br>

                    <div class="">
                        <form action="{{ route('interview-note-template-create') }}" method="POST">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="no-margin">Add Interview Note Template</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" rows="7" id="summernote" class="form-control" required>

                                        </textarea>
                                    </div>
                                </div>


                                <div class="panel-footer">
                                    <div class="text-right">
                                        <button class="btn btn-primary">Save template</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>




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
