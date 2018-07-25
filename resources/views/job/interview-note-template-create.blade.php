@extends('layout.template-default')


@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

<section class="">
        <div class="container">
            <div class="row">

                <div class="col-sm-8 col-sm-offset-2 text-center">
                    <a href="{{ route('interview-note-templates') }}" class="btn btn-info pull-left">Back</a>
                    <h3>Add Interview Note Template</h3>
                    <!-- <p class="text-muted">Africa's fastest growing network of professionals</p> -->

                    @include('layout.alerts')
                </div>

                <div class="col-sm-8 col-sm-offset-2">

                    <div class=" white padbox rounded">
                        <form action="{{ route('interview-note-template-create') }}" method="POST">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="summernote" class="form-control" required>

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
