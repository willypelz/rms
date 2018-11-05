@extends('layout.template-default')

@section('content')
    
    <section>
        <div class="container">
            
            
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    @include('layout.alerts')
                    <h4>API Key</h4>
                    
                    <div class="panel panel-default">
                        <div class="panel-body">
                            @if(!$CurrentCompany->api_key)
                                <div class="alert alert-warning">
                                    You current do not have an API Key, You can click the generate button to create one
                                </div>
                            @endif
                            
                            <form action="{{ route('view-api-key') }}" method="post">
                                <div class="form-control">
                                    {{ $CurrentCompany->api_key }}
                                </div>
                                
                                {{ csrf_field() }}
                                
                                <input type="hidden"
                                       class="form-control"
                                       name="generate_key"
                                       value="1">
                                
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 15px;">
                                        <i class="fa fa-cloud-upload fa-fw"></i>
                                        Generate
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
