@extends('layout.template-default')

@section('content')

<style>
.trial-over{
    opacity: 0.35;
}
</style>

  <section class="s-div homepage pricing">
        <div class="container">
          @if( !Auth::check() )
            <div class="row text-center text-brandon text-light text-white">
               <br>
                <h1>Get a Free Trial Now!</h1>
                <h5 class="text-uppercase l-sp-5"> 28 days of free and unlimited Access</h5><br>
            </div>
          @endif

          @if(  @$account->status == 'TRIAL')

            @if( @$account->has_expired == true )
              <div class="row text-center text-brandon text-light text-white">
                 <br>
                  <h1>Hey! We bet you did <br>enjoy your 28 days experience!</h1>
                  <div class="col-xs-2 col-xs-offset-5"><hr></div>
                  <div class="clearfix"></div>
              </div>

            @else

              <div class="row text-center text-brandon text-light text-white">
                 <br>
                  <h1>Keep <br>enjoying your 28 days experience!</h1>
                  <div class="col-xs-2 col-xs-offset-5"><hr></div>
                  <div class="clearfix"></div>
              </div>


            @endif
          @endif

        </div>

    </section>

@include('guest.pricing-card')



@endsection
