@extends('layout.template-default')


@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

<section class="">
        <div class="container">
            <div class="row">

                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-center">
                    <h3>Edit {{ ucwords( $interview_note_template->name ) }}</h3>
                    <!-- <p class="text-muted">Africa's fastest growing network of professionals</p> -->

                    @include('layout.alerts')
                </div>

                <div class="col-sm-8 col-sm-offset-2">

                    <div class=" white padbox rounded">
                        <form action="{{ route('interview-note-template-edit', ['id' => $interview_note_template->id ]) }}" method="POST">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ @$interview_note_template->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="summernote" class="form-control" required>
                                    {{ @$interview_note_template->description }}
                                </textarea>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-primary">Save</button>
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
