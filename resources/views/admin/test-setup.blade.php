@extends('layout.template-default')

@section('content')


  <section class="s-div homepage" style="background: #10588a fixed bottom url(img/home-bg2.jpg);">
        <div class="container">

            <div class="row text-center text-light text-white"><br>
                <h1> Test Setup</h1>
                <h1 class="lead">Setup all that is required to take a test.</h1>
            </div>

        </div>
    </section>


 <section class="white">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">

                    <div class="">
                        <br>
                        <div class="pagehead">
                        <form method="post" action="{{route('test-setup-create')}}">
                            @csrf
                            @include('layout.alerts')
                                <div class="col-xs-4 col-xs-offset-1">
                                        <div class="form-group well">
                                                <label for="">Created Products for {{get_current_company()->name}}</label>
                                                <hr>
                                                <ol>
                                                @forelse ($created_products as $product)
                                                    
                                                    <li>
                                                        <p>Name: {{$product->name}}</p>
                                                        <p>Desc: {{$product->details ?? 'N/A'}}</p>
                                                    </li>
                                                    <hr>
                                                   
                                                @empty
                                                    <span>No test product available</span>
                                                @endforelse    
                                            </ol>
                                            </div>
                                    <div class="well">
                                    <p>For any enquiries, questions or suggestions. <!-- Visit our FAQs to browse popular support topics --></p>
                                    <hr>
                                    <p class="">
                                        <!-- <i class="fa fa-envelope"></i> --> Mail Address: <b>support@seamlesshiring.com</b>
                                    </p>
                                    <hr>
                                    <p>
                                        <!-- <i class="fa fa-phone"></i> --> Put a call to us on <b>01-2911091</b> or <b>08167134495</b> (Mon - Fri, 8:30am - 5:00pm)
                                    </p>
                                    </div>
                                
                                           
                                            
                                </div>
                                <div class="col-xs-7 contact">
                                  @if(Session::has('flash_message'))
                          <div class="alert alert-success">
                            {{Session::get('flash_message')}}<br>
                          </div>
                        @endif
                        
                                    <div class="clearfix">

                                        <span class="col-xs-11">
                                           
                                            <div class="form-group">
                                            <label for="test_id">Test category</label>
                                            <select name="test_id" id="test_id" class="form-control angular">
                                                <option value="">--select option--</option>
                                                  @foreach($tests as $test)
                                                <option value="{{$test->name}}">{{$test->name}}</option>
                                              @endforeach
                                            </select>
                                            </div>
                                            <div class="form-group">
                                                    <label for="test_type">Test Category not found? Create one below</label>
                                                    <input type="text" value="{{old('test_type')}}"" id="test_type" name="test_type" class="form-control angular" placeholder="enter test category e.g Aptitude Test">
                                            </div>

                                            <div class="form-group">
                                                <label>Select Test</label>
                                                <br>
                                            <select class="form-control" name="test_name">
                                                    <option value="">--select test name--</option>
                                                @forelse($test_names as $test_name)
                                                     <option value="{{$test_name->name}}">{{$test_name->name}}</option>
                                                @empty
                                                  <option value="">No question is setup on the question platform, contact admin to help you create one </option>
                                                @endforelse
                                            </select>
                                              
                                            </div>
                                       
                                            <div class="form-group">
       
                                            <label>Test Summary</label>
                                            <br>
                                            <textarea placeholder="" name="test_summary" class="form-control" rows="3">{{old('test_summary')}} </textarea>
                                            <br>
                                            <label>Test Details </label>
                                            <br>
                                            <textarea placeholder="" name="test_details" class="form-control" rows="3">{{old('test_details')}} </textarea>

                                            <br>
                                            <input type="submit" value="Create Test" class="btn btn-primary">
                                       
                                            </div>
                                        </span>
                                        
                                </div>
                            </form>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


<section class="s-div dark no-margin">
  <div class="container">
    <div class="row text-center">
      <div class="col-sm-12">
        <p class="lead text-brandon text-white">Recruitment Made Unbelievably Easy.</p>
        <a href="{{ url('register') }}" class="btn btn-danger btn-lg"> Get Started</a>
      </div>
    </div><div class="clearfix"><br></div>
  </div>
</section>


@endsection