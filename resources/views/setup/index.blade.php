@extends('layout.template-user')

@section('content')

    <!-- <div class="container text-brandon text-uppercase h5 separator separator-small" style=""><i class="fa fa-tachometer"></i> Your Dashboard</div> -->

    <section class="s-div dashboard" style="background-position: center 73px;">
        <div class="container">

            <div class="row">
                @include('layout.alerts')
                <div class="clearfix"></div>
            </div>

        </div>
    </section>
    <section>
        <div class="container">
            <div class="row mr-auto">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header text-center">
                            HRMS Setup
                        </div>
                        <div class="card-body">
                            <form action="{{route('save-setup')}}">
                                <div class="form-group">
                                    <label for="">HRMS Url</label>
                                    <input type="text" name="hrms_url" value="{{$hrmsUrl}}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Api Key</label>
                                    <input id="api_key" name="api_key" value="{{$apiKey}}" type="text" class="form-control">
                                    <a onclick="generateApiKey();" class="btn">generate api key</a>
                                </div>
                                <input type="hidden" name="company_id" value="{{get_current_company()->id}}">
                                <button class="btn btn-block btn-primary">Connect</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </section>

    <script>

    function generateApiKey() {
        $.get("{{route('generate-key')}}", function(data, status){
            if(status == 'success') {
                $('#api_key').val(data.data);
            } else {
                alert("something went wrong, please try again");
            }
        })

    }
    </script>
@endsection