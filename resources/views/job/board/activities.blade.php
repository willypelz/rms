@extends('layout.template-user')

@section('content')
    {{-- {!! Charts::assets() !!} --}}
    @include('job.board.jobBoard-header')

    @if($job['status'] != 'DELETED')
        <div class="row">

            <div class="col-sm-12">
                <div class="page no-bod-rad">
                    <div class="row">


                        @include('job.board.job-board-tabs')

                        <div class="tab-content">

                            <div class="row">
                                <!-- applicant -->

                                <div class="col-xs-8">

                                    <div class="" id="">

                                        <div class="row">

                                            <div class="col-xs-12">

                                                <h6 class="no-margin " id="your-statistics" style="display:none;">
                                                    <span class="text-brandon text-uppercase"> Applications per day</span>
                                                </h6>
                                                <div class="clearfix">
                                                    <hr>
                                                </div>

                                                <script src="https://code.highcharts.com/highcharts.js"></script>
                                                <script src="https://code.highcharts.com/modules/funnel.js"></script>
                                                <script src="https://code.highcharts.com/modules/data.js"></script>
                                                <script src="https://code.highcharts.com/modules/exporting.js"></script>


                                                <div id="container"  style="min-width: 410px; max-width: 600px; height: 400px; margin: 0 auto"></div>


                                                <br><br>


                                                <h6 class="no-margin " id="your-statistics" >
                                                    <span class="text-brandon text-uppercase"> Applications per stage</span>
                                                </h6>
                                                <div class="clearfix">
                                                    <hr>
                                                </div>
                                                <div id="fun"  style="min-width: 410px; max-width: 600px; height: 400px; margin: 0 auto"></div>

                                                <script type="text/javascript">

                                                    var application_key = <?php echo json_encode(array_keys($applications)); ?>;
                                                    var application_value = <?php echo json_encode(array_values($applications)); ?>;


                                                    Highcharts.chart('container', {
                                                        chart: {
                                                            type: 'line'
                                                        },
                                                        title: {
                                                            text: 'APPLICATIONS PER DAY'
                                                        },
                                                        subtitle: {
                                                            text: 'RMS'
                                                        },
                                                        xAxis: {
                                                            categories: application_key
                                                        },
                                                        yAxis: {
                                                            title: {
                                                                text: 'Applicants'
                                                            }
                                                        },
                                                        plotOptions: {
                                                            line: {
                                                                dataLabels: {
                                                                    enabled: true
                                                                },
                                                                enableMouseTracking: false
                                                            }
                                                        },
                                                        series: [{
                                                            name: 'Date',
                                                            data: application_value
                                                        }]
                                                    });


                                                    var applicant_funnel = [<?php echo $applicant_funnel; ?>];
                                                    $(function () {


                                                      
                                                        var chartype = {
                                                            type: 'funnel',
                                                            marginRight: 100
                                                        }
                                                        var chartitle = {
                                                            text: ' ',
                                                            x: -50
                                                        }
                                                        var chartplotoptions = {
                                                            series: {
                                                                dataLabels: {
                                                                    enabled: true,
                                                                    format: '<b>{point.name}</b> ({point.y:,.0f})',
                                                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
                                                                    softConnector: true
                                                                },
                                                                center: ['40%', '50%'],
                                                                neckWidth: '30%',
                                                                neckHeight: '25%',
                                                                width: '80%'
                                                            }
                                                        }
                                                        var chartlegend = {
                                                            enabled: false
                                                        }
                                                        var chartseries = [{
                                                            name: 'Applicants',
                                                            data: applicant_funnel
                                                        }]
                                                        $('#fun').highcharts({
                                                            chart:chartype,
                                                            title: chartitle,
                                                            plotOptions:chartplotoptions,
                                                            legend:chartlegend,
                                                            series: chartseries,
                                                            credits: false,
                                                            responsive:true
                                                        });
                                                    });
                                                </script>
                                             

                                                <h6 class="no-margin">
                                                  <span class="text-brandon text-uppercase">
                                                  Job Activities
                                                  </span>
                                                    <!-- <span class="pull-right"><a href=""><i class="fa fa-cog"></i>Notification Settings</a></span> -->
                                                </h6>
                                                <div class="clearfix">
                                                    <hr>
                                                </div>

                                                <div id="ActivityContent"></div>
                                                <!-- <a href="background-check" class="btn btn-success btn-sm pull-right"><i class="fa fa-commenting-o"></i> &nbsp; Add a Comment</a> -->

                                                <div class="clearfix"></div>

                                                <div class="row" id="showAll" style="display:none">
                                                    <div class="col-sm-6 col-sm-offset-3 text-center">
                                                        <button onclick="getCon(true); $('#showAll').hide();"
                                                                class="btn btn-default">See all activities
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/tab-content-->

                                    </div>
                                    <!--/tab-content-->

                                    <!--/tab-content-->

                                </div>

                                <script>

                                    $("#ActivityContent").html('{!! preloader() !!}');


                                    var url = "{{ route('get-activity-content') }}"

                                    setTimeout(function () {
                                        getCon();
                                    }, 2000);

                                    function getCon(allActivities = false) {
                                        $.ajax

                                        ({
                                            type: "POST",
                                            url: url,
                                            data: ({
                                                rnd: Math.random() * 100000,
                                                jobid: "{{ $job->id }}",
                                                allActivities: allActivities
                                            }),
                                            success: function (response) {
                                                $("#ActivityContent").html(response);
                                                $('#showAll').show();
                                            }
                                        });
                                    }


                                </script>

                                <div class="col-xs-4 well stat-well">
                                    <div class="">

                                        <h6 class="no-margin text-center" id="your-statistics" style="">
                                            <span class="text-danger text-brandon text-uppercase"><i
                                                        class="fa fa-bar-chart"></i> Overview</span>
                                        </h6>

                                        <br>

                                        <!-- <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td class="text-center"><h1 class="no-margin text-bold"><a href="jos/list" id="no_applicants" ></a></h1><small class="text-muted">Applicants</small></td>
                                            <td class="text-center"><h1 class="no-margin text-bold"><a href="cv/cv_saved">12,234</a></h1><small class="text-muted">Matching Candidates</small></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center"><h1 class="no-margin text-muted">24</h1><small class="text-muted">Days Opended</small></td>
                                            <td class="text-center"><h1 class="no-margin text-bold"><a href="cv/cv_saved">13,234</a></h1><small class="text-muted">Amount Spent</small></td>
                                        </tr>
                                        </tbody>
                                        </table> -->

                                        <div id="job_view_stats_table"></div>


                                    </div>
                                    <br><br>

                                    <!-- <div class="">

                                        <h6 class="no-margin text-center">
                                            <span class="text-danger text-brandon text-uppercase"><i class="fa fa-bar-chart"></i> Applications per day</span>
                                        </h6>

                                        <br>


                                        <div id="job_view_stats_table"></div>



                                    </div> -->
                                </div>


                            </div>

                        </div>
                    </div>

                </div>
                <!--/tab-content-->

            </div>
        </div>
        @else
        @include('job.board.includes.job-deleted')
        @endif
        </div>

        </section>

        <div class="separator separator-small"><br></div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>


        <script>
            $(document).ready(function () {

                $.ajax
                ({
                    type: "POST",
                    url: "{{ route('job-view-data') }}",
                    data: ({rnd: Math.random() * 100000, job_id:{{$job->id }}  }),
                    success: function (response) {
                        $('#your-statistics').show();
                        $("#job_view_stats_table").html(response);
                        // console.log(response);

                    }
                });

            });
        </script>
        <script>
            /* Highcharts.chart('funnelBlueprint', {
                 chart: {
                     type: 'funnel'
                 },
                 title: {
                     text: 'Applicants Funnel'
                 },
                 plotOptions: {
                     series: {
                         dataLabels: {
                             enabled: true,
                             format: '<b>{point.name}</b> ({point.y:,.0f})',
                             color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
                             softConnector: true
                         },
                         center: ['40%', '50%'],
                         neckWidth: '30%',
                         neckHeight: '25%',
                         width: '80%'
                     }
                 },
                 legend: {
                     enabled: false
                 },
                 series: [{
                     name: 'Applicants',
                     data: [
                         ['Website visits', 15654],
                         ['Downloads', 4064],
                         ['Requested price list', 1987],
                         ['Invoice sent', 976],
                         ['Finalized', 846]
                     ]
                 }]
             });*/

        </script>

@endsection