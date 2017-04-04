<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Next 3 lines are complusory -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title> - Insidify Testing</title>

  <!-- Bootstrap Base Stylesheet -->
  <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

  <!--Font Awesome  -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="../../dist/css/main.css">

  <!--  Project Specfic -->
  <link rel="stylesheet" href="../../dist/css/sites/b2c-testing.css">

  <!-- Vendor Styles -->
  <link rel="stylesheet" href="../../dist/css/flaticon/flaticon.css">
  <link rel="stylesheet" href="../../dist/css/animate.css">
  <link rel="stylesheet" href="../../dist/css/owl.carousel-testing.css">
  <link rel="stylesheet" href="../../dist/css/owl.theme.default.min.css">

<!-- Favicon -->
  <link rel="shortcut icon" href="../../dist/img/favicon.png">

</head>

<body class="wooden">

    <div class="navbar-fixed-top navbar navbar-adjust text-center">
        <div class="container">

            <a href="#" class="logo pull-left">
                <img src="../../dist/img/logos/seamlesstesting.svg" alt="">
            </a>

            <a style="margin-top:13px" id="in-link" href="#" class="text-uppercase btn btn-cta-circle btn-primary btn-lg pull-right" data-toggle="modal" data-target="#instructions">
                <i class="flaticon-information-button"></i> <span class="labeller hidden-xs">Instructions</span>
            </a>
            <span id="clock" class="clock h3 animated flipInX">00:00:00</span>
            <!-- <a id="opt-link" href="#" class="top-link pull-right" data-toggle="modal" data-target="#options">
                <span class="labeller hidden-xs">Options</span> <i class="flaticon-menu-options"></i>
            </a> -->
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 col-xs-12 col-sm-12">

                <div class="question-paper">
                    <div id="timeStarter" class="well no-shadow top-liner well-lg text-center">
                        <h1><!-- <i class="flaticon-contract"></i>--> <br>Title of Test comes here</h1>
                        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima nisi, id. Dignissimos optio, vitae nesciunt. Eum dolor itaque alias quo, debitis iusto quod impedit nisi cupiditate, beatae eligendi officiis, ipsum?</p>
                        <hr>
                        <a href="#" id="start-test" class="btn-cta-circle btn btn-x-lg btn-danger text-uppercase">Start Test</a>
                        <div class="clearfix"></div>
                        <br>
                    </div>

                    <div id="timeEnder" class="well well-lg text-center hidden animated zoomIn">
                        <h1><!-- <i class="flaticon-contract"></i>--> :( Time Up!</h1>
                        <h3 class="">Unfortunately you have run out of time. Would you like to submit test?</h3>

                        <hr>
                        <a href="test-success.php" id="end-test" class="btn-cta-circle btn btn-x-lg btn-danger text-uppercase">Submit Test</a>
                        <div class="clearfix"></div>
                        <br>
                    </div>

                    <h4 class="test-title text-muted text-capitalize">Test: Quality Assurance Test for Scrum Masters</h4>
                    <div class="owl-carousel owl-theme hidden">
                        <?php include 'exam-questions.php' ?>
                    </div>
                </div>

                <p class="small text-muted text-center" style="margin-top:-110px">
                    &copy; 2017 Insidify Testing. All Rights Reserved
                </p>

            </div>
        </div>
    </div>

    <div class="foot-deck">
        <div class="vid-con float animated slideInUp collapse" id="camCoder">
            <video src=""></video>
        </div>
        <div class="container-fluid">
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group" role="group" aria-label="First group">
                    <button id="in-cctv" type="button" class="btn-lg btn btn-default" role="button" data-toggle="collapse" href="#camCoder" aria-expanded="false" aria-controls="camCoder"><i class="flaticon-cctv"></i> </button>
                    <span class="col-sm-6 hidden">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum commodi quaerat, ullam. Esse, totam hic quo ut dicta, provident animi eius architecto odit asperiores et magnam sed voluptates est impedit?</span>
                </div>
                <div class="btn-group pull-right" role="group" aria-label="Second group">
                    <button type="button" id="prev-btn" class="btn-lg btn btn-default"><i class="flaticon-back"></i> &nbsp; </button>
                    <button type="button" id="next-btn" class="btn-lg btn btn-default"> &nbsp; <i class="flaticon-next icon-x2"></i></button>
                </div>
            </div>
        </div>
    </div>



    <!-- Instructions Modals -->
    <div class="modal fade" id="instructions" tabindex="-1" role="dialog" aria-labelledby="instructionsLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header wooden-bg">
                  <div class="container">
                      <div class="row text-center">
                      <div class="pad pad-xs"></div>
                          <div class="col-sm-10 col-sm-offset-1">
                              <div class="col-sm-12 hidden-xs">
                                <img src="//dummyimage.com/120x120/fff/2889ce" class="img-circle" alt="">
                                
                              </div>
                              <div class="col-sm-12 col-xs-12"><br>
                                <h1 class="text-capitalize text-black no-margin-top text-lighter" id="myModalLabel">Presonalty Test</h1>
                                <!-- <p class="text-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident culpa nulla dolorum, saepe commodi tenetur. Dignissimos, aspernatur quam cumque voluptates praesentium tempora? Unde odio facilis consectetur autem, consequuntur, veritatis cum!</p> -->
                              </div>
                          </div>
                          <div class="clearfix"></div>
                      </div>
                  </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <div class="col-xs-12"><br>
                        <p class="lead text-danger text-bold text-center text-capitalize"><i class="flaticon-information"></i> &nbsp; Carefully read below the following instruction to guide you in ...</p>
                                <hr>
                    </div>
                        <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                            
                            <ol class="inst-number-list">
                                <li class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet itaque magni, nam. Dicta voluptas, perspiciatis consequuntur quidem. Odio quia quis illo aliquid aperiam eum, eius. Inventore ipsam, nostrum libero explicabo!
                                    <hr>
                                </li>
                                <li class="lead">Something about Camera. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium ipsa fugit molestias omnis accusantium dolore reiciendis molestiae ullam aperiam deserunt ex, porro et dolor delectus, unde quia. Iste, quae, at.
                                    <hr>
                                </li>
                                <li class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam, officia iusto alias. Optio dolorum quae ab, magnam quas culpa rem in incidunt animi eius, molestiae a omnis maxime? Porro, laudantium.
                                    <hr>
                                </li>
                                <li class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi quae repellendus dicta dolore earum vitae suscipit quam sint eligendi accusantium, voluptas enim adipisci nemo possimus neque dignissimos eaque rerum provident.</li>
                            </ol>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
                            <a href="#" type="button" class="btn btn-success btn-lg" data-dismiss="modal">Ok, Continue &nbsp; <i class="flaticon-next"></i></a>
                            <a href="#" type="button" class="not-ready btn btn-default btn-lg pull-left"><i class="flaticon-wrong"></i> I'm not Ready</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Options -->
    <div class="modal animated slideInRight" id="options" tabindex="-1" role="dialog" aria-labelledby="optionsLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="flaticon-cancel"></i></span></button>
                    <h4 class="modal-title pull-right" id="myModalLabel">Preferences</h4>
                </div>
                <div class="modal-body no-padding">
                    <div class="">
                        <div class="list-group no-margin">

                            <a href="#" class="h4 no-margin list-group-item"><i class="flaticon-cctv"></i> &nbsp; See Instructions</a>
                            <a href="#" class="h4 no-margin list-group-item"><i class="flaticon-cctv"></i> &nbsp; View Test Gallery</a>
                            <a href="#" class="h4 no-margin list-group-item"><i class="flaticon-cctv"></i> &nbsp; Hide Camera</a>
                            <a href="#" class="h4 no-margin list-group-item"><i class="flaticon-cctv"></i> &nbsp; Restart Class</a>
                            <a href="#" class="h4 no-margin list-group-item"><i class="flaticon-cctv"></i> &nbsp; Cancel Class</a>
                            <a title="Feature not yet available" href="#" class="h4 list-group-item no-margin disabled">
                                <i class="flaticon-cctv"></i> &nbsp; Read Questions out
                            </a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer hidden">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Understood, Start Class</button>
                    <button type="button" class="btn btn-default">I'm not Ready</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery (necessary for JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../dist/js/owl.carousel.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../dist/js/jquery.countdown.min.js"></script>


    <!-- Onpage Scripts-->

    <script type="text/javascript">
        //When Document is fully loaded

        $(document).ready(function () {

            // $('#instructions').modal('show');
            $('#in-cctv').click();
            $('#cover-up').hide();
            $('#prev-btn,#next-btn,.test-title').addClass('hidden');


            // Scroller

            $('.owl-carousel').owlCarousel({
                loop: false,
                margin: 75,
                nav: true,
                navText: ['&laquo; Prev', 'Next &raquo;'],
                dots: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            });

            //Custom navigation for scroller

            $('#next-btn').click(function () {
                $('.owl-next').click();
            });

            $('#prev-btn').click(function () {
                $('.owl-prev').click();
            });

            //Starting a test
            $('#start-test').click(function () {

                $('.owl-carousel,#prev-btn,#next-btn,.test-title').removeClass('hidden').addClass('animated fadeIn');
                $('#timeStarter,.not-ready').hide();

                //Countdown clock

                var testPeriod = new Date().getTime() + 60000;

                $('#clock').countdown(testPeriod, function (event) {

                    $(this).html(event.strftime('%H:%M:%S'));

                }).on('finish.countdown', function () {

                    $('.owl-carousel').fadeOut(function () {

                        $('#timeEnder').removeClass('hidden');
                        $('.test-title').hide();

                    });


                });

                //                $.ajaxSetup({
                //                    beforeSend:function(){
                //                        $('#team-ajax, #services-ajax, #products-ajax').html('<br/><h3 class="text-center"><i class="fa fa-inverse fa-hourglass-half fa-spin fa-fw"></i></h3>');
                //                    },
                //                    error:function(){
                //                        $('#team-ajax, #services-ajax, #products-ajax').html('<br/><h5 class="text-center"><i class="fa fa-inverse fa-2x fa-cogs"></i><br><br> Connection Error. Pls check your internet connection</h5>');
                //                    }
                //                });

                //                $.ajax({
                //                    url : 'exam-questions.php',
                //                    success: function(data){
                //                        $('.owl-carousel').html(data);
                //                        $('.well').fadeOut();
                //                    }
                //                });
            });

        });
    </script>
</body>
</html>
