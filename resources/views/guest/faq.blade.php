@extends('layout.template-default')

<body class="">

@section('content')

<section class="s-div homepage">
        <div class="container"><br>

            <div class="text-center text-white">
                <i class="fa fa-4x fa-question-circle"></i>
                <h2>Your Question(s) Answered</h2>
            </div>

        </div>
    </section>


    <section class="white">
        <div class="container">
            <div class="row">
                <div class="col-xs-8 col-xs-offset-2">
                <h5 class="text-center">
                    Click on any of the following questions. The corresponding answer will be displayed immediately below it.
If you however don’t find the answers you seek, kindly <a href="contact">send us a message here</a>. We’ll be happy to answer you directly.
                </h5>
                <br>
                    <span class="faq-section">
                        <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group faq-panel">

                          <div class="panel panel-default">
                            <div id="headingOne" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="collapseOne" aria-expanded="true" href="#collapseOne" data-parent="#accordion" data-toggle="collapse" role="button">
                                  We currently use desktop folders and paper records. Can we migrate existing data?
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse" id="collapseOne">
                              <div class="panel-body">
                               Yes, you can. We understand our users might need help through this migration into our easily accessible technology and we are always available to support.
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div id="headingTwo" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="collapseTwo" aria-expanded="false" href="#collapseTwo" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">
                                  Is SeamlessHiring really affordable?
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="headingTwo" role="tabpanel" class="panel-collapse collapse" id="collapseTwo">
                              <div class="panel-body">
                                Of course! In creating this recruitment solution, we also considered affordability for small and growing enterprises to large corporations. Call Us to discuss the most suitable plan for you from our “everything you need to hire” offering.
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div id="headingThree" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="collapseThree" aria-expanded="false" href="#collapseThree" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">
                                  Will I get after-sales support?
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="headingThree" role="tabpanel" class="panel-collapse collapse" id="collapseThree">
                              <div class="panel-body">
                                In addition to a consistent follow-up and feedback, a SeamlessHiring Champ is assigned you and your team and always available to address your feedback and enquiries. 
                              </div>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div id="heading1" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="collapseOne1" aria-expanded="true" href="#collapseOne1" data-parent="#accordion" data-toggle="collapse" role="button">
                                  How many team members can collaborate?
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="heading1" role="tabpanel" class="panel-collapse collapse" id="collapseOne1">
                              <div class="panel-body">
                                As many as you require to arrive at the best decision for your recruitment process. After the primary user has sent an invitation, admin creates an account for these team members which allows them to log-in and carry out various actions visible to all. Remember our technology allows all process to be tracked and downloaded.
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div id="heading2" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="collapseTwo2" aria-expanded="false" href="#collapseTwo2" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">
                                 What is an “Active” job?
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="heading2" role="tabpanel" class="panel-collapse collapse" id="collapseTwo2">
                              <div class="panel-body">
                                A job is active on SeamlessHiring (job page) when it’s live on job boards (your career page and/or newspapers), or open for applications.
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div id="heading3" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="collapseThree3" aria-expanded="false" href="#collapseThree3" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">
                                  And if I only need updates and reports instead of handling the recruitment process from beginning to end?
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="heading3" role="tabpanel" class="panel-collapse collapse" id="collapseThree3">
                              <div class="panel-body">
                                Yes, this option is fully covered (this is only available in the Large Enterprise Plan/Premium Plan). A dedicated SeamlessHiring Champ approved by you works with you all through. Please Call Us to discuss in more detail.
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div id="heading4" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="collapseThree45" aria-expanded="false" href="#collapseThree45" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">
                                 Is my selection process secure and transparent with SeamlessHiring?
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="heading4" role="tabpanel" class="panel-collapse collapse" id="collapseThree45">
                              <div class="panel-body">
                                We recognize integrity and transparency as cores of sustainable partnerships, hence an SSL connection that you can rely on for a complete secure data infrastructure on our cloud services.
We have also implemented multiple layers of tracking to this effect where activities/actions on candidates are all provided.
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div id="heading5" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="collapseThree12" aria-expanded="false" href="#collapseThree12" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">
                                 Can I use SeamlessHiring without internet connection?
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="heading5" role="tabpanel" class="panel-collapse collapse" id="collapseThree12">
                              <div class="panel-body">
                                You do require internet access to fully utilize the SeamlessHiring experience.
                              </div>
                            </div>
                          </div>
                          
                          <div class="panel panel-default">
                            <div id="heading6" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="collapseThree77" aria-expanded="false" href="#collapseThree77" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">
                                 Can I upgrade or downgrade my plan?
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="heading6" role="tabpanel" class="panel-collapse collapse" id="collapseThree77">
                              <div class="panel-body">
                                Yes, you can upgrade a plan at any time during your subscription or downgrade when your current subscription expires.
                              </div>
                            </div>
                          </div>
                          
                          <!-- <div class="panel panel-default">
                            <div id="heading7" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="collapseThree09" aria-expanded="false" href="#collapseThree09" data-parent="#accordion2" data-toggle="collapse" role="button" class="collapsed">
                                 When does my Insidify account expire?
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="heading7" role="tabpanel" class="panel-collapse collapse" id="collapseThree09">
                              <div class="panel-body">
                                Your account never expires. Get used to it!
                              </div>
                            </div>
                          </div> -->
                        </div>
                    </span>



                    <span class="faq-section hidden">
                        <h3>Insidify Job Search</h3>
                        <div aria-multiselectable="true" role="tablist" id="accordion3" class="panel-group faq-panel">
                          <div class="panel panel-default">
                            <div id="abx" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="serach-1" aria-expanded="true" href="#serach-1" data-parent="#accordion3" data-toggle="collapse" role="button">
                                  How do I find a job using Insidify?
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="abx" role="tabpanel" class="panel-collapse collapse" id="serach-1">
                              <div class="panel-body">
                                You can search for jobs from the Insidify home page. To run a search, simply type the job you want into the search box and click on “Find Job”. You can search for jobs by verification (jobs that have been screened by Insidify to ensure they aren’t scam jobs), specialization, location, website, and cadre.
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div id="def" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="serach-2" aria-expanded="false" href="#serach-2" data-parent="#accordion3" data-toggle="collapse" role="button" class="collapsed">
                                  How do you rank the search results?
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="def" role="tabpanel" class="panel-collapse collapse" id="serach-2">
                              <div class="panel-body">
                                Jobs are ranked solely by relevance or date. We do not accept payments to include jobs in the search engine or to improve their ranking.
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div id="erty" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="search-3" aria-expanded="false" href="#search-3" data-parent="#accordion3" data-toggle="collapse" role="button" class="collapsed">
                                  My search is not returning enough results. What can I do?
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="erty" role="tabpanel" class="panel-collapse collapse" id="search-3">
                              <div class="panel-body">
                                Check the spellings of your job title and/or location. We do a lot extra work to make sure you get enough results.
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div id="werty" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="search-4" aria-expanded="false" href="#search-4" data-parent="#accordion3" data-toggle="collapse" role="button" class="collapsed">
                                  Can I save my Job search?
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="werty" role="tabpanel" class="panel-collapse collapse" id="search-4">
                              <div class="panel-body">
                                We understand you may need to refer to past job searches in the future, so yes, you can save your job search on your account.
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div id="dfilwe" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="search-5" aria-expanded="false" href="#search-5" data-parent="#accordion3" data-toggle="collapse" role="button" class="collapsed">
                                  How do I submit my CV and apply for jobs?
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="dfilwe" role="tabpanel" class="panel-collapse collapse" id="search-5">
                              <div class="panel-body">
                                Login to your account, click on “My Brand Page”, scroll down to find a CV maker and edit by providing your details. With this you can apply to jobs on Insidify. Alternatively, you can upload your CV directly in .doc or pdf formats.
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div id="erowen" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="search-6" aria-expanded="false" href="#search-6" data-parent="#accordion3" data-toggle="collapse" role="button" class="collapsed">
                                  Must I have a PC before I can visit Insidify.com?
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="erowen" role="tabpanel" class="panel-collapse collapse" id="search-6">
                              <div class="panel-body">
                               No, you do not. You have the same quality experience irrespective of the device you are using, PCs, tablets, and smartphones.
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div id="erowen" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="search-7" aria-expanded="false" href="#search-7" data-parent="#accordion3" data-toggle="collapse" role="button" class="collapsed">
                                  How can I apply for a job on Insidify?
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="erowen" role="tabpanel" class="panel-collapse collapse" id="search-7">
                              <div class="panel-body">
                               Because there are different kinds of jobs out there and Insidify pulls them from different sources, the application process varies from job to job. Some might require that you send your document to an email address while others might require that you register on the prospective employer’s career portal in which case you will be redirected to those portals from Insidify.
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div id="erowen" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="search-8" aria-expanded="false" href="#search-8" data-parent="#accordion3" data-toggle="collapse" role="button" class="collapsed">
                                  What kind of jobs can I find on Insidify?
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="erowen" role="tabpanel" class="panel-collapse collapse" id="search-8">
                              <div class="panel-body">
                               There are two types of jobs on Insidify. Those posted by Insidify and thus exclusive to Insidify account holders and those acquired from jobsites, newspapers and company career pages. 
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div id="erowen" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="search-9" aria-expanded="false" href="#search-9" data-parent="#accordion3" data-toggle="collapse" role="button" class="collapsed">
                                  How do I identify an Insidify job?
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="erowen" role="tabpanel" class="panel-collapse collapse" id="search-9">
                              <div class="panel-body">
                               It will be clearly stated on the job details that it is exclusive to Insidify. 
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div id="erowen" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="search-10" aria-expanded="false" href="#search-10" data-parent="#accordion3" data-toggle="collapse" role="button" class="collapsed">
                                  Will I be required to remit a part of my salary to get a job through Insidify? 
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="erowen" role="tabpanel" class="panel-collapse collapse" id="search-10">
                              <div class="panel-body">
                               Absolutely no! At no point will Insidify ever require you to pay a part of your salary. See our Terms of Services page.
                              </div>
                            </div>
                          </div>
                        </div>
                        </span>


                    <span class="faq-section hidden">
                        <h3>Insidify Alerts</h3>
                        <div aria-multiselectable="true" role="tablist" id="accordion4" class="panel-group faq-panel">
                          <div class="panel panel-default">
                            <div id="roiweh" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="ind-101" aria-expanded="true" href="#ind-101" data-parent="#accordion4" data-toggle="collapse" role="button">
                                  How many jobs do I get in an alert?
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="roiweh" role="tabpanel" class="panel-collapse collapse" id="ind-101">
                              <div class="panel-body">
                                As many jobs as available based on the specialization you choose. You can click on “Jobs that match me” to find more fitting jobs.
                              </div>
                            </div>
                          </div>
                          <div class="panel panel-default">
                            <div id="dfilorem" role="tab" class="panel-heading">
                              <h4 class="panel-title">
                                <a aria-controls="ind-102" aria-expanded="false" href="#ind-102" data-parent="#accordion4" data-toggle="collapse" role="button" class="collapsed">
                                  Do I have to confirm my email/SMS before receiving alerts?
                                </a>
                              </h4>
                            </div>
                            <div aria-labelledby="dfilorem" role="tabpanel" class="panel-collapse collapse" id="ind-102">
                              <div class="panel-body">
                                No, you don’t. You can start getting your alerts immediately. 
                              </div>
                            </div>
                          </div>
                        </div></span>
                </div>
            </div>
        </div>
    </section>


<section class="s-div dark no-margin">
  <div class="container">
    <div class="row text-center">
      <div class="col-sm-12">
        <p class="lead text-brandon text-white">Recruitment Made Unbelievably Easy.</p>
        <a href="{{ url('register') }}" class="btn btn-danger btn-lg"> Get started with a free trial</a>
      </div>
    </div><div class="clearfix"><br></div>
  </div><br>
</section>



@stop