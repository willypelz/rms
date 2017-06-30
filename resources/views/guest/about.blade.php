@extends('layout.template-default')

@section('content')


  <section class="s-div homepage" style="background: #10588a fixed top url(img/home-bg1.jpg);">
        <div class="container">

            <div class="row text-center text-brandon text-light text-white"><br>
                <h1> SeamlessHiring</h1>
                <p class="lead">Now you may look forward to hiring again.</p>
            </div>

        </div>
    </section>


    <section class="white" style="">
        <div class="container">
            <div class="row">

                <div class="col-sm-8 col-sm-offset-2">
                    <p>Hiring Managers and employers know going through the traditional process of recruitment is not particularly fun, or at least not something most look forward to. Except that finding and hiring talents is however crucial to the success of any business.</p>

                    <p class="lead">Hence our SeamlessHiring Solution.</p>

                    <p>Would you like to ease the usual frustrations that accompany finding the right candidates? Would you like to extend the frontiers of your job posts till the best applicants show interest? Would you like to make faster and less expensive collaborative decisions with your team?
                    </p><p>
                    With SeamlessHiring, you have the best tool for these and more, as we offer you everything you need to hire in one place.
                    </p>
                    <br>
                    <p><a href="{{ url('register') }}" class="btn btn-success"> Show me how to begin</a></p>
                    
                </div>
            </div>
        </div>
    </section>


@endsection