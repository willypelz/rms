<html lang="en" class="gr__cdn_insidify_com"><head>
        <!-- Next 3 lines are complusory -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>An International Hospital is Hiring</title>
        <!-- Bootstrap Base Stylesheet -->
        <link href="{{ env('CDN_PATH') }}css/bootstrap.min.css" rel="stylesheet">
        <!--Font Awesome  -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- Main Stylesheet -->
        <link rel="stylesheet" href="{{ env('CDN_PATH') }}css/main.css">
        <!--  Project Specfic -->
        <link rel="stylesheet" href="{{ env('CDN_PATH') }}css/sites/b2c-home.css">
        <link rel="stylesheet" href="{{ env('CDN_PATH') }}css/animate.css">
        <link rel="stylesheet" href="{{ env('CDN_PATH') }}css/owl.carousel.min.css">
        <link rel="stylesheet" href="{{ env('CDN_PATH') }}css/owl.theme.default.min.css">
        <link rel="shortcut icon" href="img/favicon.png">
    </head>
    <body class="body-bc body-jobs fixed-header" data-gr-c-s-loaded="true">
        <style>
        img.lifeplan{
        border: 5px solid #fff;
        border-radius: 5px;
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.41);
        }
        .panel-title a{
        font-size: 18px;
        line-height: 30px;
        }
        .carousel.lifeplan{
            position: fixed;
            width: 100%;
            z-index: -1;
            top: 58px;
        }
        .start-from-top{
            background-color: rgba(0, 0, 0, 0.36);
            transition: all ease-in 0.75s;
        }
        .start-from-top:hover{
            /* background-color: rgba(0, 0, 0, 0); */
            transition: all ease-in 1s;
        }
        .list-group-item.com {
            position: relative;
            display: block;
            padding: 20px 0px;
            margin-bottom: -1px;
            background-color: #fff;
            border: none;
            border-top: 1px solid #ddd;
        }
        .btn-apply{
                margin-top: -5px;
        }
        /* .ht-min{
            height: 300px;
            overflow: auto;
        } */
        hr{
            border-color: #ccc;
            margin:10px 0;
        }
        @media (max-width: 768px){
            .start-from-top{
              background-image: url('{{ env('CDN_PATH') }}img/lifeplan/img6.jpg');
            background-size: cover;
            background-position: center bottom;  
            } 
        }
        @media (max-width: 992px){

        .carousel.lifeplan img{
            width: 125%;
            max-width: 125%;
        }
        }
        .well{
            padding: 10px;
        }
        .p-sm{
            line-height: 1.75;
        }
        .panel-heading:hover h4 p{
            text-decoration: none;
        }
        .panel-heading:hover{
            text-decoration: none;
        }

        .panel:hover{
            text-decoration: none;
        }
        .panel:hover a,
        .panel:visited a,
        .panel:focus a{
            text-decoration: none;
        }
        
        </style>
        <nav class="navbar navbar-jobs navbar-default navbar-bc navbar-fixed-top no-lower-nav" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <span>menu &nbsp;</span>
                        <span><i class="fa fa-bars fa-lg"></i></span>
                    </button>
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-more">
                        <span><i class="fa fa-th-large fa-lg"></i></span>
                    </button>

                    <a class="navbar-brand" href="#">
                        <img src="{{ env('CDN_PATH').'img/logos/seamlesshiring.svg' }}" alt="" style="width:250px;" class="img-trans animated slideInDown">

                        <img src="{{ env('CDN_PATH').'img/logos/seamlesshiring.svg' }}" alt="" style="width:250px;" class="img-hue animated slideInDown">
                    </a>
                </div>

                <div class="hidden-xs" id="navbar">

                    <ul class="nav navbar-nav" role="tablist">
                        <!-- <li class="active"><a href="{{ url('/') }}">Home</a></li> -->
                        <!-- <li><a href="{{ env('JOBS_URL') }}">Jobs</a></li>
                        <li class=""><a href="{{ env('LEARNING_URL') }}">Learning</a></li>
                        <li class=""><a href="{{ env('JOBS_URL') }}">Testing</a></li>
                        <li><a href="{{ env('DISCOVERY_URL') }}">Blog</a></li>
                        <li><a href="http://cvwriting.ng">CV services</a></li> -->

                    </ul>

                  <!--   <ul class="nav navbar-right no-margin-right">
                        
                        <li><a class="no-border pull-left btn btn-primary text-uppercase" href="{{ env('CDN_PATH') }}../Samples/LandingPage/b2b-home-out.php" target="_blank">Insidify for Companies</a></li>
                    </ul> -->

                    <ul class="nav-sm list-unstyled pull-right">
                        <li class="dropdown">
                        <a href="#" class="sneak dropdown-toggle" role="button" data-toggle="dropdown">
                        <!-- <img src="//placehold.it/40x40" class="img-circle" alt=""> -->
                        <i class="fa fa-bars fa-2x"></i>
                        &nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-profile">
                          <li><a href="b2c-home-out.php">logout</a></li>
                        </ul>
                      </li>
                    </ul>

                </div>
                <div class="navbar-collapse collapse" id="navbar-menu">
                    <ul class="nav navbar-nav visible-xs" role="tablist">
                        <li><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">4</a></li>
                        <li><a href="">5</a></li>
                    </ul>
                </div>
                <div class="navbar-collapse collapse no-padding" id="navbar-more">
                    <div class="visible-xs mobile-nav">
                        <h5 class="text-center text-uppercase">More from Us</h5>
                        <div class="col-xs-6 no-padding">
                            <a href="http://jobs.insidify.com" class="product no-border-bottom"><img class="img-responsive" src="{{ env('CDN_PATH').'img/logos/jobs-logo.svg' }}" alt=""></a>
                        </div>
                        <div class="col-xs-6 no-padding">
                            <a href="http://learning.insidify.com" class="product no-border-bottom no-border-left"><img class="img-responsive" src="{{ env('CDN_PATH').'img/logos/learning-logo.svg' }}" alt=""></a>
                        </div>
                        <div class="col-xs-6 no-padding">
                            <a href="http://testing.insidify.com" class="product"><img class="img-responsive" src="{{ env('CDN_PATH').'img/logos/testing-logo.svg' }}" alt=""></a>
                        </div>
                        <div class="col-xs-6 no-padding">
                            <a href="http://cvwriting.ng" class="product no-border-left"><img class="img-responsive" src="{{ env('CDN_PATH').'img/logos/cv-logo.svg' }}" alt=""></a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-xs-12 text-center">
                            <a href="" class="btn btn-primary no-boder text-uppercase">Insidify for Companies</a>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </nav>


<div id="carousel-example-generic" class="carousel slide lifeplan hidden-xs" data-ride="carousel">


  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <!-- <div class="item active">
      <img src="{{ env('CDN_PATH') }}img/lifeplan/img1.jpg" width="100%" alt="...">
    </div> -->
    <div class="item active">
      <img src="{{ env('CDN_PATH') }}img/lifeplan/img6.jpg" width="100%" alt="...">
    </div>
    <div class="item">
      <img src="{{ env('CDN_PATH') }}img/lifeplan/img7.jpg" width="100%" alt="...">
    </div>
    <div class="item">
      <img src="{{ env('CDN_PATH') }}img/lifeplan/img8.jpg" width="100%" alt="...">
    </div>
    <div class="item">
      <img src="{{ env('CDN_PATH') }}img/lifeplan/img4.jpg" width="100%" alt="...">
    </div>
    <div class="item">
      <img src="{{ env('CDN_PATH') }}img/lifeplan/img5.jpg" width="100%" alt="...">
    </div>
  </div>

</div>


        <section class="start-from-top no-padding-bottom">
            <div class="pad pad-xs"></div>
            <div class="spacer spacer-sm pad pad-sm hidden-xs"></div>
            <div class="container">
                <div class="row">
                    <!-- <div class="col-lg-2 col-xs-3">
                        <img src="{{ env('CDN_PATH') }}img/lifePlan-logo.png" alt="Lifeplan Logo" width="100%" class="lifeplan">
                    </div> -->
                    <div class="col-lg-8 col-lg-offset-2 text-center text-shadow-sm col-xs-12 text-white">
                        <h1 class=" fa-3x animated slideInLeft">
                        A Worldclass <br>Multispecialist Hospital is Hiring!
                        </h1>
                        <div class="col-xs-4 col-xs-offset-4"><hr></div>
                        <div class="clearfix"></div>
                        <!-- <p class="text-lighter lead animated slideInRight">
                        An international hospital company is opening a 160 bed world-class multispecialty hospital in Lagos. This will be the first truly world-class international hospital in Nigeria.</p> -->
                    </div>
                </div>
            </div>
            <div class="spacer spacer-sm pad pad-sm hidden-xs"></div>
            <div class="pad pad-xs"></div>

        </section>
        <section class="grey-lt4-bg pad pad-sm animated slideInUp">
            <div class="container">
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <p class="text-center lead animated slideInRight">
                        An international hospital company is opening a 160 bed worldclass multispecialty hospital in Lagos. This will be the first truly worldclass international hospital in Nigeria.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="pad-lg pad white-bg no-padding-bottom animated slideInUp">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                    <p class="text-uppercase lsp5">Features of the hospital</p>
                    <br>
                        <ul class="list-group">

                            <li class="list-group-item com"><i class="fa fa-star "></i> &nbsp; 6 Stories, 160 Beds, Purpose-built Hospital Building</li>
                            <li class="list-group-item com"><i class="fa fa-star "></i> &nbsp; G floor - ER with 8 Beds with Triage and Observation beds</li>
                            <li class="list-group-item com"><i class="fa fa-star "></i> &nbsp; Fully Equipped Radiology Department (CT, SPECT-CT/MRI/Digital XR, </li>Mammography etc.)
                            <li class="list-group-item com"><i class="fa fa-star "></i> &nbsp; Fully equipped Nuclear Medicine Unit</li>
                            <li class="list-group-item com"><i class="fa fa-star "></i> &nbsp; OPD floor - 20 Consultation Rooms, 6 Treatment Rooms and a Range of Minor </li>Diagnostics such as EEG, ECG, Holter, EMG, PFT/Spirometry and Dentistry, Urodynamics
                            <li class="list-group-item com"><i class="fa fa-star "></i> &nbsp; 5 Fully Equipped, Modern Chemotherapy Bays</li>
                            <li class="list-group-item com"><i class="fa fa-star "></i> &nbsp; 4 Fully Equipped Operating Theatres</li>
                            <li class="list-group-item com"><i class="fa fa-star "></i> &nbsp; Labour and Delivery Suite with Dedicated CS Theatre, Labour Rooms, Recovery </li>Rooms and Maternity Wards
                            <li class="list-group-item com"><i class="fa fa-star "></i> &nbsp; Intensive Care Unit - 20 Bed Adult ICU, 4 Bed Neonatal ICU, 6 Bed </li>Paediatric ICU
                            <li class="list-group-item com"><i class="fa fa-star "></i> &nbsp; Cath Lab</li>
                            <li class="list-group-item com"><i class="fa fa-star "></i> &nbsp; 98 non-ICU, non-HDU inpatient beds</li>
                            <li class="list-group-item com"><i class="fa fa-star "></i> &nbsp; 14 Dialysis stations ,Endoscopy Suite , Physiotherapy Unit</li>
                            <li class="list-group-item com"><i class="fa fa-star "></i> &nbsp; Full Laboratory, Blood Bank</li>
                            <li class="list-group-item com"><i class="fa fa-star "></i> &nbsp; Training Facilities</li>
                            <li class="list-group-item com"><i class="fa fa-star "></i> &nbsp; 105 Dedicated Multi-storey Car Park Spaces</li>
                        </ul>
                    </div>
                    <div class="col-md-7">

                        <div class="">
                            <div class="well blue-bg no-margin well-form white-bg well-lg animated shadow-lg bounceIn" style="background:#fff;    ">
                                <div class="heading text-center blue-bg no-margin-bottom">
                                    <h3 class="text-capitalize text-shadow-xs text-brandon text-white no-margin-bottom space-lg text-center">
                                    Our Current Openings</h3>
                                    <span class="text-white lsp3 text-light">Select an option beneath to view details</span>
                                </div>
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                 <div class="panel panel-default no-box-shadow no-border  no-border-radius">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseO" aria-expanded="true" aria-controls="collapseO">
                                                <i class="fa fa-stethoscope"></i> &nbsp; <b>Medical Officers</b>
                                                <hr><p class="h5 text-light p-sm">We are looking for young, talented, hardworking and courteous Medical officers, who are eager to be part of a world class hospital. Working with Specialists, Nurses and the rest of the healthcare team, these Medical officers will deliver excellent care to our clients whilst abiding by international standard operating procedures and key performance indices. While earning a very competitive pay package, you have front-row opportunities to learn and grow both your clinical skills and your professional life. If this interests you, apply here.</p>
                                                <br>
                                                <p>
                                                    <button class="btn btn-success btn-lg">See openings</button>
                                                    
                                                </p>
                                            </a>
                                            </h4>
                                        </div>
                                        <div id="collapseO" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <ul class="list-group ht-min">

                                                    <li class="list-group-item">Medical Officers <a href="https://seamlesshiring.com/job/apply/260/medical-officers" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

                                                    <li class="list-group-item">Emergency Medical Officers <a href="https://seamlesshiring.com/job/apply/261/emergency-medical-officers" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default no-box-shadow no-border  no-border-radius">
                                        <div class="panel-heading" role="tab" id="headingOne">
                                            <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                <i class="fa fa-stethoscope"></i> &nbsp; <b>Specialists</b> <span class="pull-right">44 Roles</span>
                                                <hr><p class="h5 text-light p-sm">Our practice will be majorly full-time Consultant led. We are hiring a team of the best specialists around the world who are willing to be part of this pioneering drive to transform healthcare in Nigeria. Leveraging our international spread the specialists that will be joining the hospital in Nigeria will have the benefit of benchmarking their work, learning and developing with colleagues across our international network, through our exchange and collegiate programs. If you have the experience, qualification and passion to transform healthcare in Nigeria for good whilst earning a competitive pay package, apply below.</p>
                                                <br>
                                                <p>
                                                    <button class="btn btn-success btn-lg">See openings</button>
                                                </p>
                                            </a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                            <div class="panel-body">
                                                <ul class="list-group ht-min">
                                                    <li class="list-group-item">Anaesthesiologist <a href="https://seamlesshiring.com/job/apply/218/anaesthesiologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Cardio-Thoracic Surgeon <a href="https://seamlesshiring.com/job/apply/249/cardio-thoracic-surgeon" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Cardiologist <a href="https://seamlesshiring.com/job/apply/221/cardiologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Dentist <a href="https://seamlesshiring.com/job/apply/258/dentist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Dermatologist <a href="https://seamlesshiring.com/job/apply/227/dermatologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Endocrinologist <a href="https://seamlesshiring.com/job/apply/228/endocrinologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">ENT Surgeon <a href="https://seamlesshiring.com/job/apply/248/ent-surgeon" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Family Physician <a href="https://seamlesshiring.com/job/apply/259/family-physician" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Gastroenterologist <a href="https://seamlesshiring.com/job/apply/224/gastroenterologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">General Surgeon <a href="https://seamlesshiring.com/job/apply/243/general-surgeon" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Gynaecological Oncologist <a href="https://seamlesshiring.com/job/apply/234/gynaecological-oncologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Haematologist <a href="https://seamlesshiring.com/job/apply/230/haematologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Intensivist / Critical Care <a href="https://seamlesshiring.com/job/apply/219/intensivist-critical-care" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Internal  and Preventive Medicine <a href="https://seamlesshiring.com/job/apply/220/internal-and-preventive-medicine" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Interventional Cardiologist <a href="https://seamlesshiring.com/a-leading-hospital/job/288/interventional-cardiologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Interventional Radiologist <a href="https://seamlesshiring.com/job/apply/253/interventional-radiologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Laparoscopic Surgeon <a href="https://seamlesshiring.com/job/apply/244/laparoscopic-surgeon" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Maxillo-facial Surgeon <a href="https://seamlesshiring.com/job/apply/256/maxillo-facial-surgeon" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Medical Oncologist <a href="https://seamlesshiring.com/job/apply/225/medical-oncologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Neonatal Intensivist <a href="https://seamlesshiring.com/job/apply/239/neonatal-intensivist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Neonatologist <a href="https://seamlesshiring.com/job/apply/237/neonatologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Nephrologist <a href="https://seamlesshiring.com/job/apply/223/nephrologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Neurologist <a href="https://seamlesshiring.com/job/apply/222/neurologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Neurosurgeon <a href="https://seamlesshiring.com/job/apply/246/neurosurgeon" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Nuclear Medicine <a href="https://seamlesshiring.com/a-leading-hospital/job/289/nuclear-medicine" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Obstetrician &amp; Gynaecologist <a href="https://seamlesshiring.com/job/apply/233/obstetrician-gynaecologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Opthalmologist <a href="https://seamlesshiring.com/job/apply/255/opthalmologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Orthopaedic Surgeon <a href="https://seamlesshiring.com/job/apply/245/orthopaedic-surgeon" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Paediatric Cardiologist <a href="https://seamlesshiring.com/job/apply/241/paediatric-cardiologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Paediatric Intensivist <a href="https://seamlesshiring.com/job/apply/238/paediatric-intensivist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Paediatric Oncologist <a href="https://seamlesshiring.com/job/apply/242/paediatric-oncologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Paediatric Pulmonologist <a href="https://seamlesshiring.com/job/apply/240/paediatric-pulmonologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Paediatric Surgeon <a href="https://seamlesshiring.com/job/apply/251/paediatric-surgeon" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Paediatrician <a href="https://seamlesshiring.com/job/apply/236/paediatrician" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Pathologist <a href="https://seamlesshiring.com/job/apply/226/pathologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Plastic Reconstructive Surgeon <a href="https://seamlesshiring.com/job/apply/257/plastic-reconstructive-surgeon" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Psychiatrist <a href="https://seamlesshiring.com/job/apply/232/psychiatrist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Radiologist <a href="https://seamlesshiring.com/job/apply/252/radiologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Respiratory Pysician <a href="https://seamlesshiring.com/job/apply/229/respiratory-pysician" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Rheumatologist <a href="https://seamlesshiring.com/job/apply/231/rheumatologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Surgical Oncologist <a href="https://seamlesshiring.com/job/apply/254/surgical-oncologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Urologist <a href="https://seamlesshiring.com/job/apply/247/urologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Vascular Surgery <a href="https://seamlesshiring.com/job/apply/250/vascular-surgery" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>


                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default no-box-shadow no-border  no-border-radius">
                                        <div class="panel-heading" role="tab" id="headingTwo">
                                            <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                <i class="fa fa-stethoscope"></i> &nbsp; <b>Nurses</b> <span class="pull-right">16 Roles</span>
                                                <hr><p class="h5 text-light p-sm">Nurses are centerpiece of patient care and experience. We are particularly keen to build a first class nursing team. Empathy, professionalism, requisite experience, emphasis on uncompromising quality and a deep rooted culture of putting patients first will be the hallmarks of our Nurses. We will be investing heavily in continuous Nursing training and development, helping our Nurses to continue to grow and sustain an impeccably high quality of care delivery. If you are interested and qualified, please apply here.</p>
                                                <br>
                                                <p>
                                                    <button class="btn btn-success btn-lg">See openings</button>
                                                </p>
                                            </a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                            <div class="panel-body">
                                                  <ul class="list-group ht-min">
                                                    <li class="list-group-item">Chief Nursing Officer <a href="https://seamlesshiring.com/job/apply/262/chief-nursing-officer" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>
<li class="list-group-item">Nursing Supervisor Endoscopy <a href="https://seamlesshiring.com/a-leading-hospital/job/291/nursing-supervisor-endoscopy" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Nursing Supervisor Dialysis <a href="https://seamlesshiring.com/a-leading-hospital/job/290/nursing-supervisor-dialysis" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Nursing Supervisor Theatre <a href="https://seamlesshiring.com/job/apply/263/nursing-supervisor-theatre" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Nursing Supervisor Oncology <a href="https://seamlesshiring.com/a-leading-hospital/job/292/nursing-supervisor-oncology" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Nursing Supervisor OPD <a href="https://seamlesshiring.com/job/apply/264/nursing-supervisor-opd" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Nursing Supervisor ICU <a href="https://seamlesshiring.com/job/apply/265/nursing-supervisor-icu" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Nursing Supervisor Adult Wards <a href="https://seamlesshiring.com/job/apply/266/nursing-supervisor-adult-wards" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Nursing Supervisor A&amp;E <a href="https://seamlesshiring.com/job/apply/267/nursing-supervisor-ae" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Nursing Supervisor Paediatrics <a href="https://seamlesshiring.com/job/apply/268/nursing-supervisor-paediatrics" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Staff Nurse- O.T <a href="https://seamlesshiring.com/job/apply/269/staff-nurse-ot" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Staff Nurse - Critical Care <a href="https://seamlesshiring.com/job/apply/270/staff-nurse-critical-care" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Oncology Nurse <a href="https://seamlesshiring.com/job/apply/271/oncology-nurse" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Staff Nurse - Emergency <a href="https://seamlesshiring.com/job/apply/272/staff-nurse-emergency" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Staff Nurse - Wards and OPD <a href="https://seamlesshiring.com/job/apply/273/staff-nurse-wards-and-opd" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Dialysis Nurse <a href="https://seamlesshiring.com/job/apply/274/dialysis-nurse" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Endoscopy Nurse <a href="https://seamlesshiring.com/job/apply/275/endoscopy-nurse" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Cath. Lab Nurse Technician <a href="https://seamlesshiring.com/job/apply/276/cath-lab-nurse-technician" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Nursing Assistants <a href="https://seamlesshiring.com/job/apply/277/nursing-assistants" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>
                                                </ul>
                                            
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default no-box-shadow no-border  no-border-radius">
                                        <div class="panel-heading" role="tab" id="headingFour">
                                            <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="true" aria-controls="collapse4">
                                                <i class="fa fa-stethoscope"></i> &nbsp; <b>Managerial and Administrative</b>
                                                <hr><p class="h5 text-light p-sm">We are looking for the dedicated and experienced managers and administrators to build the systems and structures our hospital will run on. If you are interested in being part of the team that will pioneer the future of healthcare in Nigeria, if you are keen on making sure that we deliver world-class healthcare in an enabling and supportive environment and you have the skills and required experience, then come along. Apply, below, we will love to meet you.</p>
                                                <br>
                                                <p>
                                                    <button class="btn btn-success btn-lg">See openings</button>
                                                    
                                                </p>
                                            </a>
                                            </h4>
                                        </div>
                                        <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                            <div class="panel-body">
                                                <ul class="list-group ht-min">

                                                    <li class="list-group-item">Financial Controller / Manager <a href="https://seamlesshiring.com/a-leading-hospital/job/298/financial-controller-manager" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

                                                    <li class="list-group-item">Human Resource Manager <a href="https://seamlesshiring.com/a-leading-hospital/job/293/human-resource-manager" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

                                                    <li class="list-group-item">Assistant Human Resource Manager <a href="https://seamlesshiring.com/a-leading-hospital/job/294/assistant-human-resource-manager" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>
                                                    
                                                    <li class="list-group-item">IT Manager <a href="https://seamlesshiring.com/a-leading-hospital/job/295/it-manager" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel panel-default no-box-shadow  no-border no-border-radius">
                                        <div class="panel-heading" role="tab" id="headingThree">
                                            <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                <i class="fa fa-stethoscope"></i> &nbsp; <b>Other Health Professionals</b> <span class="pull-right">10 Roles</span>
                                                <hr><p class="h5 text-light p-sm">Different people contribute different skills to ensuring our patients get the best possible care. We want to transform healthcare in Nigeria for good. We need the best Pharmacists, Scientists, Technicians and Radiographers to join the team. These professionals will be benefiting hugely from the support of competent colleagues, extensive and continuous training and exchange opportunities across our international network, while earning a very competitive compensation. Interested? Apply below.</p>
                                                <br>
                                                <p>
                                                    <button class="btn btn-success btn-lg">See openings</button>
                                                </p>
                                            </a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                            <div class="panel-body">
                                                
                                                <ul class="list-group ht-min">
                                                    <li class="list-group-item grey-lt4-bg text-uppercase">
                                                        Pharmacists <!-- <i class="fa pull-right fa-arrow-down"></i> -->
                                                    </li>
                                                    <li class="list-group-item">Chief Pharmacist  <a href="https://seamlesshiring.com/job/apply/278/chief-pharmacist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

                                                    <li class="list-group-item">Pharmacists <a href="https://seamlesshiring.com/job/apply/279/pharmacists" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>
                                                     <li class="list-group-item grey-lt4-bg text-uppercase">
                                                        Allied Healthcare Workers <!-- <i class="fa pull-right fa-arrow-down"></i> -->
                                                    </li>

                                                    <li class="list-group-item">Lab technicians <a href="https://seamlesshiring.com/job/apply/280/lab-technicians" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Radiographers <a href="https://seamlesshiring.com/job/apply/281/radiographers" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Physiotherapists <a href="https://seamlesshiring.com/job/apply/282/physiotherapists" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Respiratory therapists <a href="https://seamlesshiring.com/job/apply/283/respiratory-therapists" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Psychologist <a href="https://seamlesshiring.com/job/apply/284/psychologist" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Nutritionists <a href="https://seamlesshiring.com/job/apply/285/nutritionists" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Social Workers <a href="https://seamlesshiring.com/job/apply/286/social-workers" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>

<li class="list-group-item">Ambulance Drivers <a href="https://seamlesshiring.com/job/apply/287/ambulance-drivers" class="btn btn-apply btn-sm btn-danger pull-right">Apply <i class="fa fa-chevron-right"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="pad pad-xs"></div>
        </section>

        <section class="grey-lt5-bg pad pad-lg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12"></div>
                </div>
            </div>
        </section>

        <!--Footer-->
        <footer class="footer-bc">
    <div class="container hidden-xs">

        <div class="row">

            <div class="col-sm-3 col-xs-6">
                <ul class="list-unstyled">
                    <li>
                        <h5>Navigations</h5>
                    </li>
                    <li><a href="https://insidify.com/about_us">About us</a></li>
                    <li><a href="https://insidify.com/contact_us">Contact us</a></li>
                    <li><a href="https://insidify.com/terms">Terms of Use</a></li>
                    <li><a href="https://insidify.com/page/faq">FAQ</a></li>
                    <li><a href="https://insidify.com/privacy">Privacy Policy</a></li>

                </ul>
            </div>

            <div class="col-sm-3 col-xs-6">
                <ul class="list-unstyled">
                    <li>
                        <h5>Professional?</h5>
                    </li>
                    <li><a href="https://insidify.com/jobs/trending">Search for Jobs</a></li>
                    <li><a href="https://insidify.com/register">Get a brand page</a></li>
                    <li><a href="https://insidify.com/jobs/settings">Set up Job alert</a></li>
                    <li><a href="https://insidify.com/discovery">Insidify Discovery</a></li>
                    <li><a href="https://insidify.com/cv">CV Review</a></li>


                </ul>
            </div>

            <div class="col-sm-3 col-xs-12 text-right text-left-xs" style="border-right: 1px solid #58707f;">
                <ul class="list-unstyled">
                    <li>
                        <h5 class="text-brandon text-uppercase">Employer's Solutions</h5>
                    </li>
                    <li><a href="https://seamlesshiring.com/" target="_blank">Find Resumes</a></li>
                    <li><a href="https://seamlesshiring.com/" target="_blank">Applicant Tracking System</a></li>
                    <li><a href="https://seamlesshiring.com/talentSource" target="_blank">Seamless Talent Sourcing</a></li>
                    <li>
                        <a href="#"></a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-3 col-xs-12 text-center">
                <ul class="list-unstyled footer-logo text-left-xs text-right">
                    <li>
                        <img src="{{ env('CDN_PATH') }}img/logos/insidify-logo-white.svg" width="135px">

                    </li>
                    <li class="tagline">Better and Happier People !</li>
                </ul>
            </div>

        </div>

    </div>
    <div class="container visible-xs text-center">
        <ul class="list-inline">
            <li><a href="#">About</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Terms</a></li>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Privacy</a></li>
        </ul>
        <div class="text-center">
            <img src="{{ env('CDN_PATH') }}img/logos/insidify-logo-white.svg" width="100px">
            <span class="tagline">Better and Happier People !</span>
        </div>
    </div>
    <div class="footlet small">
        <div class="container">
            <p class="no-margin">
                <a class="social-icon fb" href="https://www.facebook.com/insidifycom?ref=hl&amp;ref_type=bookmark" target="_blank">
                    <span class="fa-stack fa-lg">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                    </span></a>
                <a class="social-icon tw" href="https://twitter.com/insidifyhq" target="_blank">
                    <span class="fa-stack fa-lg">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
          </span></a>

                <a class="social-icon in" href="https://www.linkedin.com/company/insidify-com?trk=biz-companies-cym" target="_blank">
                    <span class="fa-stack fa-lg">
                          <i class="fa fa-circle fa-stack-2x"></i>
                          <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                        </span></a>
                &nbsp;

                <span class="hidden-xs">Follow Us. Don't miss out on the conversations</span>

                <span class="pull-right text-white">© 2017. All Rights Reserved.</span>
            </p>
        </div>
    </div>
</footer>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="{{ env('CDN_PATH') }}js/bootstrap.min.js"></script>
        <script src="{{ env('CDN_PATH') }}js/owl.carousel.min.js"></script>
        <script src="{{ env('CDN_PATH') }}js/main.js"></script>
        <script>
        //Scrollers
        //    $('#testifier').owlCarousel({
        //        animateOut: 'slideOutDown',
        //        navigation: true,
        //        animateIn: 'flipInX',
        //        items:1,
        //        margin:30,
        //        stagePadding:30,
        //        smartSpeed:450
        //    });
        </script>
    
<script type="text/javascript">( function(){ window.SIG_EXT = {}; } )()</script></body></html>