@extends('layout.template-default')


@section('content')



<section class="">
        <div class="container">
            <div class="row">

                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-center">
                    <h3>Embed Code</h3>
                    <small>Copy and place code where you want the job listing to show</small>
                </div>

                <div class="col-sm-8 col-sm-offset-2">

                    <div class="form-group">
                        <textarea class="form-control" id="embed_code" rows="6">{{ $embed_code }}</textarea>
                    </div>

                    <div class="form-group text-center">
                        <button class="btn btn-primary btn-lg copy-btn" > <i class="fa fa-copy"></i> Copy</button>
                    </div>

                </div>


            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function(){
                $('.copy-btn').on('click',function(){
                      document.getElementById('embed_code').select();
                      document.execCommand('copy');
                });
            });
        </script>
</section>


@endsection
