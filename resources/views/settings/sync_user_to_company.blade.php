@extends('layout.template-default')

@section('content')

    <div class="separator separator-small"></div>
    <section class="no-pad">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page">
                        <div class="row">
                                <h5 class="">
                                <span><i class="fa fa-arrow-left"></i> <a href="{{route('change-admin-role')}}">Go Back To Manage Super Admin</a></span>
                                    </h5>
                            <h5 class="no-margin text-center l-sp-5 text-brandon text-uppercase">
                                Attach Admin To Other Companies
                            </h5>
                            <hr>
                            <br>
                    

                            <div class="col-md-12">
                                @include('layout.alerts')
                            <form method="POST" action="{{route('sync-user-to-company',['user_id'=>$userId])}}" >
                                   
                                        
                                     <select class="form-control select-multiple" name="companies[]" id="company" multiple="multiple"> 
                                            <option value="">Select Company</option>   
                                                 @forelse($companies as $company)
                                                 {{-- @if( $company->id == get_current_company()->id)
                                                     @php continue; @endphp
                                                 @endif --}}
                                                        <option value="{{$company->id}}" @if(in_array($company->id,$userCompanies)) selected @endif>
                                                            {{$company->name}}</option>
                                                  @empty
                                                        <option value="">No additional company found</option>
                                                  @endforelse
                                    </select>
                                                    <hr/>
                                                    <div class="ad-mgt-scroll"> 
                                                        <div class="pb-5 mb-5 text-center" style="padding-bottom: 15px">
                                                            <button class="btn btn-primary btn-md" type="submit">Attach To Company</button>
                                                         
                                                      </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                    

                                    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">

                                </form>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!--/tab-content-->
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script>
        $(document).ready(function () {        
             $('.select-multiple').select2();
        });
    </script>

@endsection
