@extends('layout.template-user')

@section('content')
    <script src="{{ asset('js/embed.js') }}"></script>
    @php
        $user_role = getCurrentLoggedInUserRole();
        $is_super_admin = auth()->user()->is_super_admin;
    @endphp
    <div id="page-refresh">
     <section class="s-div">
        <div class="container">
            <div class="row no-pad">
                <div class="col-xs-6 no-margin">
                    <br>
                    <h3 class="text-green-light no-margin">
                        {{ $active + $expired + $suspended + $private }} {{ $company->name }}  @if($active + $suspended > 1)
                            Jobs @else Job @endif
                        &nbsp;
                        @if($user_role == 'admin')
                            <a href="{{ route('post-job') }}" class="btn btn-success"><i class="fa fa-plus"></i> Post a New
                                Job</a>
                        @endif
                    </h3>
                </div>
                <div class="col-xs-6 no-margin">
                    <br>
                    <div class="btn-group pull-right" role="group">
                        <a href="{{ route('post-job') }}" type="button"
                           class="btn text-capitalize in" style="background:white">
                            <span class="fa-lg"><i class="fa fa-briefcase"></i>
                                <span class="hidden-xs text-brandon">Create a job</span><br></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="separator separator-small"></div>

    <section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-md-8 col-sm-12" id="filter">
                    <button class="btn btn-primary active" type="button" data-target="all">
                        All <span class="badge">{{ $active + $expired + $suspended + $private }}</span>
                    </button>
                    <button class="btn btn-primary" type="button" data-target="active">
                        Active <span class="badge">{{ $active }}</span>
                    </button>
                    <button class="btn btn-primary" type="button" data-target="suspended">
                        Suspended <span class="badge">{{ $suspended }}</span>
                    </button>
                    <button class="btn btn-primary" type="button" data-target="expired">
                        Expired <span class="badge">{{ $expired }}</span>
                    </button>
                    <button class="btn btn-primary" type="button" data-target="draft">
                        Draft <span class="badge">{{ $draft }}</span>
                    </button>
                    <button class="btn btn-primary" type="button" data-target="private">
                        Private <span class="badge">{{ $private }}</span>
                    </button>
                </div>
                <script>
                    $(document).ready(function () {
                        //on page refresh, retain the current tab you were in previously
                        if(localStorage.getItem("current_tab")){
                            var tab_name = localStorage.getItem("current_tab");
                            $('#filter button').removeClass('active');
                            $('body .job-block').hide();
                            $("body .job-" + tab_name).fadeIn();
                        }
                        $('#filter button').on('click', function () {
                            $('#filter button').removeClass('active');
                            $('body .job-block').hide();
                            $(this).addClass('active');
                            $("body .job-" + $(this).data('target')).fadeIn();
                            localStorage.setItem("current_tab",$(this).data('target'));
                        })
                    });
                </script>

                <div class="col-md-4 col-sm-12" style="margin-top: -40px;margin-bottom: 20px;">
                    <form action="" class="form-group"><br>

                        <div class="form-lg">
                            <div class="col-xs-10">
                                <div class="row"><input placeholder="Search" name="q" id="q" value="{{ @$q }}"
                                                        class="form-control input-lg" type="text"></div>
                            </div>
                            <div class="col-xs-2">
                                <div class="row">
                                    <button type="submit" class="btn btn-lg btn-block btn-success ">
                                        <!-- Find <span class="hidden-sm hidden-xs">Candidates</span>  -->
                                        <i class="fa fa-search fa-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="clearfix"></div>


                @if( @$q !== null && count( $jobs ) == 0 )

                    <h2 class="text-center">No Jobs with "{{ @$q }}" Found</h2>

                @endif

                <div id="tag_container">
                    @include('job.includes.jobs-partial')
                                        </div>
                </div>

                <span class="col-xs-6"></span>
            </div>

        </div>
        <h1></h1>
    </section>
    </div>

    <div class="modal widemodal fade" id="deleteJob" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="false">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin: 18px;">
                        ×
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Delete Job?</h4>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this job?

                    <div class="clearfix"></div>
                    <div class="pull-right">
                        <a href="javascript://" onclick="Kolo();" class="btn btn-success pull-right">Yes</a>
                        <div class="separator separator-small"></div>
                    </div>

                    <div class="pull-right" style="margin-right:10px;">
                        <a href="javascript://" id="closeRejectModal" onclick = "$('#deleteJob').modal('hide');"class="btn btn-danger pull-right">No</a>
                        <div class="separator separator-small"></div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
