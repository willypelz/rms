<!DOCTYPE html>
<html style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
<head style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
    <meta charset="utf-8" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
    <meta name="description" content="" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
    <meta name="author" content="" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
    <link rel="shortcut icon" href="favicon.ico" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
    <link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">

    <title style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Lateef Koshemani Doissier | Insidify.com </title>
    
    <!-- <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/font-awesome.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/bootstrap-social.css" rel="stylesheet"> -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-top: 50px;background: #ffffff;font-family: &quot;Segoe UI&quot; sans-serif;">
<div class="" id="" style="margin: 0 auto;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
   <div class="row" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-left: -15px;margin-right: -15px;">
       <div class="" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
           <h4 class=" text-center" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-size: 18px;text-align: center;">
               <span class="text-unformat" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: normal !important;">Applicant for:</span>
               <span style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">{{ $appl->job->title }}</span>.
           </h4>
           <hr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: content-box;box-sizing: content-box;margin-top: 20px;margin-bottom: 20px;border: 0;border-top: 1px solid #eee;height: 0;">

           <div class="col-xs-2" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;width: 16.66666667%;float: left;position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;">
               <img src="{{ default_picture( $appl->cv ) }}" width="200px" class="img-responsive" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;vertical-align: middle;border: 0;display: block;max-width: 100%;height: auto;">
           </div>
           <div class="col-xs-9" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;width: 75%;float: left;position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;">
               <h2 class="no-pad-top" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-top: 0 !important;margin-bottom: 10px;padding-top: 0 !important;">{{ ucwords( $appl->cv->first_name. " " . $appl->cv->last_name ) }}</h2>
               <p class="text-muted" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;color: #999;">{{ $appl->cv->headline }}
                   {{ $appl->cv->state }}</p>
           </div>
           <div class="clearfix" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;clear: both;"></div>

           <br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
       </div>


       <div class="col-xs-12" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;width: 100%;float: left;position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;">
           <div class="d-unit d-unit-cover stack" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ccc;padding-right: 50px;padding-bottom: 50px;border-radius: 3px;margin-bottom: 55px;position: relative;padding-left: 52px;"><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
               <h3 class="" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-top: 20px;margin-bottom: 10px;">
                   <!-- <i class="fa fa-file-text"></i>&nbsp; -->
                   Cover Letter
               </h3>
               <p style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                  {{ $appl->cover_note }}
               </p>
           </div>
       </div>

       <div class="unit-box" style="margin: 0em 0 3em 1em;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;position: relative;display: inline-block;width: 100%;">
           <div class="row" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-left: -15px;margin-right: -15px;">

               <div class="col-xs-11" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;width: 91.66666667%;float: left;position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;">
                   <h5 style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 600;font-size: 15px;">PERSONAL DETAILS</h5>
                   <!-- <p class="text-muted" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;color: #999;">To build a career where I can use my skills to improve customer satisfaction and retention rates, improve earning capacity and add to the growth of any organisation I belong to</p> -->
                   <br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                   <ul class="list-unstyled" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-top: 0;margin-bottom: 10px;padding-left: 0;list-style: none;">
                       <li style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                           <strong style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Sex:</strong>&nbsp; {{ $appl->cv->gender }}</li>
                       <li style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                           <strong style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Email:</strong>&nbsp; {{ $appl->cv->email }}<script cf-hash="f9e31" type="text/javascript" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                           /* <![CDATA[ */!function(){try{var t="currentScript"in document?document.currentScript:function(){for(var t=document.getElementsByTagName("script"),e=t.length;e--;)if(t[e].getAttribute("cf-hash"))return t[e]}();if(t&&t.previousSibling){var e,r,n,i,c=t.previousSibling,a=c.getAttribute("data-cfemail");if(a){for(e="",r=parseInt(a.substr(0,2),16),n=2;a.length-n;n+=2)i=parseInt(a.substr(n,2),16)^r,e+=String.fromCharCode(i);e=document.createTextNode(e),c.parentNode.replaceChild(e,c)}}}catch(u){}}();/* ]]> */</script></li>
                       <li style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                           <strong style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Phone:</strong>&nbsp; {{ $appl->cv->phone }}</li>

                       <li style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                           <strong style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Age:</strong>&nbsp; {{ str_replace('ago', 'old', human_time($appl->cv->dob, 1)) }}
                           <span class="text-muted" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;color: #999;">({{ date('M d, Y', strtotime($appl->cv->dob)) }})</span>
                       </li>

                       <li style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                           <strong style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Address:</strong>&nbsp;   {{ $appl->cv->state }}</li>
                   </ul>

                   <!-- <li>
                         <strong>Age:</strong>&nbsp; 27 years old
                         <span class="text-muted">()</span>
                     </li>
                     <li>
                         <strong>Address:</strong>&nbsp; .</li> -->

               </div>
           </div>
       </div>
  
      <div class="unit-box" style="margin: 0em 0 3em 1em;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;position: relative;display: inline-block;width: 100%;">
           <div class="row" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-left: -15px;margin-right: -15px;">

               <div class="col-xs-11" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;width: 91.66666667%;float: left;position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;">
                   <h5 style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 600;font-size: 15px;">CAREER SUMMARY</h5>
                   <!-- <p class="text-muted" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;color: #999;">To build a career where I can use my skills to improve customer satisfaction and retention rates, improve earning capacity and add to the growth of any organisation I belong to</p> -->
                   <br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                   <ul class="list-unstyled" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-top: 0;margin-bottom: 10px;padding-left: 0;list-style: none;">
                       <li style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                           <strong style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Highest Qualification:</strong>&nbsp; {{ $appl->cv->highest_qualification }}</li>
                       <li style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                           <strong style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Years of Experience:</strong>&nbsp; {{ $appl->cv->years_of_experience }}<script cf-hash="f9e31" type="text/javascript" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                           /* <![CDATA[ */!function(){try{var t="currentScript"in document?document.currentScript:function(){for(var t=document.getElementsByTagName("script"),e=t.length;e--;)if(t[e].getAttribute("cf-hash"))return t[e]}();if(t&&t.previousSibling){var e,r,n,i,c=t.previousSibling,a=c.getAttribute("data-cfemail");if(a){for(e="",r=parseInt(a.substr(0,2),16),n=2;a.length-n;n+=2)i=parseInt(a.substr(n,2),16)^r,e+=String.fromCharCode(i);e=document.createTextNode(e),c.parentNode.replaceChild(e,c)}}}catch(u){}}();/* ]]> */</script></li>
                       <li style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                           <strong style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Last Position:</strong>&nbsp; {{ $appl->cv->last_position }}</li>

                       <li style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                           <strong style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Last Company Worked:</strong>&nbsp; {{ $appl->cv->last_company_worked }}

                       </li>

                       <li style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                           <strong style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Willing to Relocate?:</strong>&nbsp;  @if(@$appl->cv->willing_to_relocate) Yes @else No @endif.</li>
                   </ul>

                   <!-- <li>
                         <strong>Age:</strong>&nbsp; 27 years old
                         <span class="text-muted">()</span>
                     </li>
                     <li>
                         <strong>Address:</strong>&nbsp; .</li> -->

               </div>
           </div>
       </div>

       <div class="unit-box hidden" style="margin: 0em 0 3em 1em;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;position: relative;display: inline-block;width: 100%;">
           <div class="row" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-left: -15px;margin-right: -15px;">


               <div class="col-xs-11" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;width: 91.66666667%;float: left;position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;">
                   <h5 style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 600;font-size: 15px;">SKILLS</h5>
                   <p class="text-muted" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;color: #999;">
                       <!--a href="http://insidify.com/cv/search/Information technology"-->
                       Information technology,<!--/a-->                                                                              <!--a href="http://insidify.com/cv/search/ BlackBerry"-->
                       BlackBerry,<!--/a-->                                                                              <!--a href="http://insidify.com/cv/search/ Project Management"-->
                       Project Management,<!--/a-->                                                                              <!--a href="http://insidify.com/cv/search/ Ability to learn Fast"-->
                       Ability to learn Fast,<!--/a-->                                                                              <!--a href="http://insidify.com/cv/search/ Ability to adapt with new environment"-->
                       Ability to adapt with new environment,<!--/a-->                                                                           </p>
               </div>
           </div>
       </div>

       <div class="unit-box hidden" style="margin: 0em 0 3em 1em;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;position: relative;display: inline-block;width: 100%;">
           <div class="row" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-left: -15px;margin-right: -15px;">

               <div class="col-xs-11" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;width: 91.66666667%;float: left;position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;">
                   <h5 style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 600;font-size: 15px;">WORK EXPERIENCE</h5>

                   <div class="sub-box" style="margin: 2.5em 0 0 1em;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding-left: 2em;border-left: 1px solid #ccc;">
                       <p class="text-muted" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;color: #999;">
                           Jul 2014                                            till present                                        </p>
                       <h5 style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 600;font-size: 15px;">IT analyst atTranter IT infrastructure services                                        </h5>
                       <p style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Lagos</p>
                   </div>

                   <div class="sub-box" style="margin: 2.5em 0 0 1em;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding-left: 2em;border-left: 1px solid #ccc;">
                       <p class="text-muted" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;color: #999;">
                           Aug 2013                                             - Jun 2014                                        </p>
                       <h5 style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 600;font-size: 15px;">co-founder/sales rep atHouse of Spice                                        </h5>
                       <p style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">abeokuta</p>
                   </div>



               </div>
           </div>
       </div>

       <div class="unit-box hidden" style="margin: 0em 0 3em 1em;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;position: relative;display: inline-block;width: 100%;">
           <div class="row" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-left: -15px;margin-right: -15px;">

               <div class="col-xs-11" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;width: 91.66666667%;float: left;position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;">
                   <h5 style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 600;font-size: 15px;">EDUCATION</h5>

                   <div class="sub-box" style="margin: 2.5em 0 0 1em;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;padding-left: 2em;border-left: 1px solid #ccc;">
                       <p class="text-muted" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;color: #999;">
                           Sept 2006                                          - Dec 2011                                        </p>
                       <h5 style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-weight: 600;font-size: 15px;">computer science at Ladoke Akintola University of Technology <br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></h5>
                       <p style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Bachelor of Technology, <span style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Second class Upper</span></p>
                   </div>



               </div>
           </div>
       </div>


   </div>
   <div class="row" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-left: -15px;margin-right: -15px;">
       <div class="message-content" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
           <hr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: content-box;box-sizing: content-box;margin-top: 20px;margin-bottom: 20px;border: 0;border-top: 1px solid #eee;height: 0;">
           <div class="col-xs-12" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;width: 100%;float: left;position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;">
                   <h4 class="text-center text-uppercase" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-size: 18px;text-align: center;">
                       <i class="fa fa-comment-o" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>&nbsp;
                       Comments on Candidate
                   </h4><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
               @foreach( $comments as $comment )
                 <div class="media" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-top: 15px;overflow: hidden;zoom: 1;">
                     <a href="#" class="pull-left" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-right: 10px;float: left!important;">
                         <img class="media-object" src="{{ default_picture( $comment->user, 'user' ) }}" alt="" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;vertical-align: middle;border: 0;display: block; width:50px;">
                     </a>
                     <div class="media-body" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;overflow: hidden;zoom: 1;">
                         <h5 class="media-heading" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"><a href="#" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">{{ ucwords( $comment->user->name ) }}</a>
                         </h5>
                         <p style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">{{ $comment->comment }}</p>
                         <small style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                             <span class="text-muted" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;color: #999;">{{ date('D, j-n-Y, h:i A', strtotime($comment->created_at)) }}</span>&nbsp; 
                             <!-- <a href="#" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Like</a>
                             <span class="text-muted" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;color: #999;">·</span> <a href="#" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Comment</a> -->
                         </small>
                     </div>
                 </div>
               @endforeach

           </div>

           <div class="col-xs-12" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;width: 100%;float: left;position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;">
               <hr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: content-box;box-sizing: content-box;margin-top: 20px;margin-bottom: 20px;border: 0;border-top: 1px solid #eee;height: 0;">
               <div class="" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                   <h4 class="text-center text-uppercase" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-size: 18px;text-align: center;">
                       <i class="fa fa-group" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>&nbsp;
                       Interview Assesment
                   </h4><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">

                   <div class="unit-box" style="margin: 0em 0 3em 1em;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;position: relative;display: inline-block;width: 100%;">
                   <p style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">The numerical rating system is based on the following:
                       <div class="label label-default" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">5 - Exceptional</div>
                       <div class="label label-default" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">4 - Good</div>
                       <div class="label label-default" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">3 - Above Average</div>
                       <div class="label label-default" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">2 -Average</div>
                       <div class="label label-default" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">1 - Unsatisfactory</div>
                   </p>
                 </div>
                    
                    @foreach( $notes as $note )
                        <h4 class="text-center"> {{ $note->user->name }} <br><small>on {{ date('D, j-n-Y, h:i A', strtotime($note->interview_date)) }}</small></h4>
                        <table class="table table-bordered" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;max-width: 100%;background-color: transparent;border-collapse: collapse;border-spacing: 0;border: 1px solid #ddd;width: 100%;margin-bottom: 20px;">
                           <thead style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                           <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                               <th style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">#</th>
                               <th style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">Assessment</th>
                               <th style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">1</th>
                               <th style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">2</th>
                               <th style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">3</th>
                               <th style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">4</th>
                               <th style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">5</th>
                           </tr>
                           </thead>
                           <tbody style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">

                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">1</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">General Appearance</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->general_appearance == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->general_appearance == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->general_appearance == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->general_appearance == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->general_appearance == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">2</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Educational Background</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->educational_background == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->educational_background == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->educational_background == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->educational_background == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->educational_background == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">3</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Prior Work Experience</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->prior_work_experience == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->prior_work_experience == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->prior_work_experience == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->prior_work_experience == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->prior_work_experience == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">4</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Professional Qualifications</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->professional_qualifications == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->professional_qualifications == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->professional_qualifications == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->professional_qualifications == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->professional_qualifications == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">5</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Verbal Communication</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->verbal_communication == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->verbal_communication == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->verbal_communication == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->verbal_communication == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->verbal_communication == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">6</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Candidate Enthusiasm</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->candidate_enthusiasm == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->candidate_enthusiasm == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->candidate_enthusiasm == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->candidate_enthusiasm == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->candidate_enthusiasm == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">7</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Relevant Experience</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->relevant_experience == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->relevant_experience == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->relevant_experience == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->relevant_experience == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->relevant_experience == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">8</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Career Progression</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->career_progression == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->career_progression == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->career_progression == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->career_progression == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->career_progression == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">9</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Initiative</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->initiative == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->initiative == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->initiative == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->initiative == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->initiative == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">10</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Time Management</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->time_management == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->time_management == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->time_management == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->time_management == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->time_management == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">11</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Customer Service Orientation</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->customer_service_orientation == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->customer_service_orientation == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->customer_service_orientation == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->customer_service_orientation == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->customer_service_orientation == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">12</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Technology Enablement</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->technology_enablement == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->technology_enablement == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->technology_enablement == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->technology_enablement == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->technology_enablement == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">13</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Brand Projection</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->brand_projection == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->brand_projection == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->brand_projection == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->brand_projection == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->brand_projection == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">14</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Intellectual Capacity</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->intellectual_capacity == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->intellectual_capacity == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->intellectual_capacity == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->intellectual_capacity == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->intellectual_capacity == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">15</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Reasoning</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->reasoning == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->reasoning == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->reasoning == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->reasoning == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->reasoning == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">16</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">General Knowledge</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->general_knowledge == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->general_knowledge == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->general_knowledge == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->general_knowledge == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->general_knowledge == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">17</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Knowledge of Industry</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->knowledge_of_industry == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->knowledge_of_industry == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->knowledge_of_industry == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->knowledge_of_industry == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->knowledge_of_industry == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">18</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Quantitative Capacity</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->quantitative_capacity == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->quantitative_capacity == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->quantitative_capacity == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->quantitative_capacity == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->quantitative_capacity == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">19</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Attitude to Issues</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->attitude_to_issues == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->attitude_to_issues == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->attitude_to_issues == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->attitude_to_issues == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->attitude_to_issues == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">20</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Predesposition to Training</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->predesposition_to_training == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->predesposition_to_training == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->predesposition_to_training == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->predesposition_to_training == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->predesposition_to_training == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">21</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Learning Skills</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->learning_skills == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->learning_skills == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->learning_skills == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->learning_skills == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->learning_skills == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">22</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Verbal Skills</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->verbal_skills == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->verbal_skills == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->verbal_skills == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->verbal_skills == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->verbal_skills == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>


                                 <tr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                     <th scope="row" style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">23</th>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">
                                         <b style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Career Focus</b><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                         <!-- <i style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">Rate the candidate in terms of physical looks health, Dressing , etc.</i> -->
                                     </td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->career_focus == 1 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->career_focus == 2 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->career_focus == 3 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->career_focus == 4 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                     <td style="margin: 0;padding: 8px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;border: 1px solid #ddd;line-height: 1.42857143;vertical-align: top;border-top: 1px solid #ddd;">@if( $note->career_focus == 5 ) <i class="fa fa-check fa-lg" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i>  @endif</td>
                                 </tr>

                           </tbody>
                       </table>
                       <hr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: content-box;box-sizing: content-box;margin-top: 20px;margin-bottom: 20px;border: 0;border-top: 1px solid #eee;height: 0;">
                       <div class="" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                           <h4 style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-size: 18px;"><i class="fa fa-question-circle" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i> General Comments</h4>
                           <p style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">{{ $note->general_comments }}</p><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">

                           <h4 style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-size: 18px;"><i class="fa fa-question-circle" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i> Recommendation</h4>
                           <p style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">{{ $note->recommendation }}</p><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">

                       </div>
      
  

                   @endforeach


               </div>
           </div>

           <div class="col-xs-12 hidden" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;width: 100%;float: left;position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;">
               <hr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: content-box;box-sizing: content-box;margin-top: 20px;margin-bottom: 20px;border: 0;border-top: 1px solid #eee;height: 0;">
               <div class="" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                   <!--<h4 class="text-center text-uppercase">-->
                       <!--<i class="fa fa-file-word-o"></i>&nbsp;-->
                       <!--Interview Report-->
                   <!--</h4><br>-->
                   <h4 style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-size: 18px;"><i class="fa fa-question-circle" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i> Listening Skills</h4>
                   <p style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">To build a career where I can use my skills to improve customer satisfaction and retention rates, improve earning capacity and add to the growth of any organisation I belong to</p><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">

                   <h4 style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-size: 18px;"><i class="fa fa-question-circle" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i> Verbal Skills</h4>
                   <p style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">To build a career where I can use my skills to improve customer satisfaction and retention rates, improve earning capacity and add to the growth of any organisation I belong to</p><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">

                   <h4 style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-size: 18px;"><i class="fa fa-question-circle" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i> Career Focus</h4>
                   <p style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">To build a career where I can use my skills to improve customer satisfaction and retention rates, improve earning capacity and add to the growth of any organisation I belong to</p><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">

                   <h4 style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-size: 18px;"><i class="fa fa-question-circle" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i> General Comments (Overall Rating)</h4>
                   <p style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">To build a career where I can use my skills to improve customer satisfaction and retention rates, improve earning capacity and add to the growth of any organisation I belong to</p><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">

               </div>

               <br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">

               <div class="panel panel-default" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-bottom: 20px;background-color: #fff;border: 1px solid transparent;border-radius: 4px;-webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);box-shadow: 0 1px 1px rgba(0,0,0,.05);border-color: #ddd;">
                   <div class="panel-body" style="margin: 0;padding: 15px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                       <h4 class="text-center text-uppercase" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;font-size: 18px;text-align: center;"><i class="fa fa-check-square" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"></i> Recommendation/Comment</h4>  <hr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: content-box;box-sizing: content-box;margin-top: 20px;margin-bottom: 20px;border: 0;border-top: 1px solid #eee;height: 0;">
                       <p class="text-center center-block" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;text-align: center;">
                           <label class="checkbox-inline" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block;margin-bottom: 0;font-weight: 400;padding-left: 20px;vertical-align: middle;cursor: pointer;">
                               <input type="checkbox" id="inlineCheckbox1" value="option1" style="margin: 4px 0 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;outline: none;margin-top: 1px \9;line-height: normal;float: left;margin-left: -20px;"> Hire Applicant
                           </label>
                           <label class="checkbox-inline" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block;margin-bottom: 0;font-weight: 400;padding-left: 20px;vertical-align: middle;cursor: pointer;">
                               <input type="checkbox" id="inlineCheckbox2" value="option2" style="margin: 4px 0 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;outline: none;margin-top: 1px \9;line-height: normal;float: left;margin-left: -20px;"> Reject Applicant
                           </label>
                           <label class="checkbox-inline" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;display: inline-block;margin-bottom: 0;font-weight: 400;padding-left: 20px;vertical-align: middle;cursor: pointer;">
                               <input type="checkbox" id="inlineCheckbox3" value="option3" style="margin: 4px 0 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;outline: none;margin-top: 1px \9;line-height: normal;float: left;margin-left: -20px;"> Keep Applicant in view
                           </label>
                       </p><br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                       <div class="row" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-left: -15px;margin-right: -15px;">
                           <div class="col-xs-3 col-xs-offset-1" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-left: 8.33333333%;width: 25%;float: left;position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;">
                               <p class="text-right" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                   Name and Signature of Interviewer:
                               </p></div>
                           <div class="col-xs-5" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;width: 41.66666667%;float: left;position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;">
                               <textarea class="form-control" rows="2" style="min-height: 75px;margin: 0;padding: 6px 12px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;outline: none;display: block;width: 100%;height: auto;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);box-shadow: inset 0 1px 1px rgba(0,0,0,.075);-webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;"></textarea>
                               <br class="clearfix" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;clear: both;">
                           </div>

                           <div class="col-xs-3 col-xs-offset-1" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-left: 8.33333333%;width: 25%;float: left;position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;">
                               <p class="text-right" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                                   Date:
                               </p>
                           </div>
                           <div class="col-xs-5" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;width: 41.66666667%;float: left;position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;">
                               <textarea class="form-control" rows="1" style="min-height: 25px;margin: 0;padding: 6px 12px;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;outline: none;display: block;width: 100%;height: auto;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 4px;-webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);box-shadow: inset 0 1px 1px rgba(0,0,0,.075);-webkit-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;"></textarea>
                           </div>
                           <br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                           <div class="clearfix" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;clear: both;"></div>
                           <br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
                       </div>
                   </div>
               </div>
           </div>



       </div>
   </div>
    <div class="row" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;margin-left: -15px;margin-right: -15px;">
        <div class="col-xs-12" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;width: 100%;float: left;position: relative;min-height: 1px;padding-left: 15px;padding-right: 15px;">
            <br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;"><hr style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: content-box;box-sizing: content-box;margin-top: 20px;margin-bottom: 20px;border: 0;border-top: 1px solid #eee;height: 0;">
            <div class="unit-box text-center " style="margin: 0em 0 3em 1em;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;text-align: center;position: relative;display: inline-block;width: 100%;">
                <small class="text-muted center-block" style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;color: #999;">
                    © 2015. All Rights Reserved. www.insidify.com
                </small>
                <br style="margin: 0;padding: 0;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;box-sizing: border-box;">
            </div>
        </div>
    </div>
</div>
</body>
</html>