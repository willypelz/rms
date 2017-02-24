<?php
use Mail;
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/






/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


URL::forceSchema('https');



Route::group(['middleware' => ['web']], function () {
    
    Route::controller('schedule', 'ScheduleController');
    
});



Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');
    
    Route::get('/', function () {

        return view('guest.landing');
    });

    route::get('error', [
    'as' => 'errors.defaultError', function(){
        return view('errors.500');
    }]);

     Route::get('/contact', function () {


        
        return view('guest.contact');
    });

     Route::post('/contact', function () {
        $data = $request->all();


        $mail = Mail::queue('emails.new.contact', [ $data => $data ], function ($m)  use($data) {
                            $m->from($data->email, 'New Job Paid');
                            // $m->to('babatopeoni@gnmail.com')->subject('Contact');
                            $m->to('support@seamlesshiring.com')->subject('Contact');
                        });
        
        $request->session()->flash('flash_message', 'You have exceeded your daily Provide Help limit.');
                return redirect()->back();

    });

     

     Route::get('/faq', function () {
        
        return view('guest.faq');
    });

     Route::get('fixQua', [ 'uses' => 'JobsController@correctHighestQualification']);

     Route::get('/whoops', function () {
        
        return view('guest.whoops');
    });

     Route::get('/talentSource', function () {
        
        return view('guest.talentSource');
    });

     Route::get('/success', function () {
        
        return view('guest.success');
    });

     Route::get('/company_success', function () {
        
        return view('guest.company_success');
    });

    //  Route::get('embed-view', function(){
    //     echo "good one";
    // });

    Route::get('embed-test', [ 'as' => 'embed', 'uses' => 'JobsController@getEmbedTest' ]);
    Route::get('embed-view', [ 'as' => 'embed', 'uses' => 'JobsController@getEmbed' ]);
    Route::post('embed-view', [ 'as' => 'embed', 'uses' => 'JobsController@getEmbed' ]);
    

     Route::get('payment_successful', function () {
        return view('payment.payment_succes');
    });

    Route::get('simple-pay', function(){

        $user = 'AYolana';
        $email = Mail::send('emails.cv-sales.invoice', ['user' => $user], function ($message) {
            $message->from('us@example.com', 'Laravel');

            $message->to('lanaayodele@gmail.com');
        });

       if( count(Mail::failures()) > 0 ) {
        dd(Mail::failures());

} else {
    echo "No errors, all sent successfully!";
}

        // dd('here');
        // dd(save_activities('APPLIED', '10', '9', ''));
        //return view('payment.simplepay');
    });

    Route::get('log-in', 'Auth\AuthController@showLoginForm');

    Route::post('log-in', 'Auth\AuthController@login');

    // Route::get('sign-up', 'Auth\AuthController@showRegistrationForm');

    // Route::post('sign-up', 'Auth\AuthController@register');
    
    Route::match(['get', 'post'], 'auth/ajax_login', ['uses' => 'Auth\AuthController@AjaxLogin', 'as' => 'ajax_login']);
    Route::match(['get', 'post'], 'sign-up', ['uses' => 'Auth\AuthController@Registration', 'as' => 'registration']);
    Route::match(['get', 'post'], 'add-company', ['uses' => 'JobsController@AddCompany', 'as' => 'add-company']);
    Route::match(['get', 'post'], 'select-company/{slug?}', ['uses' => 'JobsController@selectCompany', 'as' => 'select-company']);


    Route::match(['get', 'post'], 'cart', ['uses' => 'CvSalesController@Cart', 'as' => 'cart']);
    Route::match(['get', 'post'], 'cart_details', ['uses' => 'CvSalesController@CartDetails', 'as' => 'cartDe']);
    Route::match(['get', 'post'], 'output', ['uses' => 'CvSalesController@Output', 'as' => 'out']);
    Route::match(['get', 'post'], 'ajax_cart', ['uses' => 'CvSalesController@Ajax_cart', 'as' => 'ajax_cart']);
    Route::match(['get', 'post'], 'ajax_checkout', ['uses' => 'CvSalesController@Ajax_checkout', 'as' => 'ajax_checkout']);
    Route::match(['get', 'post'], 'payment/{type?}', ['uses' => 'CvSalesController@Payment', 'as' => 'payment']);
    
    Route::match(['get', 'post'], 'simplepay/{type?}', ['uses' => 'JobsController@SimplePay', 'as' => 'simplepay']);
    
    Route::match(['get', 'post'], 'transactions', ['uses' => 'CvSalesController@Transactions', 'as' => 'transactions']);
    Route::match(['get', 'post'], 'emails-test', ['uses' => 'CvSalesController@TestEmail', 'as' => 'emails']);

    //JOB
    Route::match(['get', 'post'], 'jobs/duplicate', ['uses' => 'JobsController@DuplicateJob', 'as' => 'duplicate-job']);
    Route::match(['get', 'post'], 'jobs/send-job', ['uses' => 'JobsController@SendJob', 'as' => 'send-to-friends']);
    Route::match(['get', 'post'], 'jobs/save-to-mailbox', ['uses' => 'JobsController@SavetoMailbox', 'as' => 'savetoMailbox']);
   
    Route::match(['get', 'post'], 'jobs/save-job', ['uses' => 'JobsController@SaveJob', 'as' => 'job-draft']);
    Route::match(['get', 'post'], 'jobs/refer-job', ['uses' => 'JobsController@ReferJob', 'as' => 'refer-job']);
    Route::match(['get', 'post'], 'jobs/post-a-job', ['uses' => 'JobsController@PostJob', 'as' => 'post-job']);
    Route::match(['get', 'post'], 'edit-job/{jobid}', ['uses' => 'JobsController@EditJob', 'as' => 'edit-job']);

    Route::match(['get', 'post'], 'jobs/post-success/{jobID}/{slug?}', ['uses' => 'JobsController@PostSuccess', 'as' => 'post-success']);
    Route::match(['get', 'post'], 'jobs/advertise-your-job/{jobID}/{slug?}', ['uses' => 'JobsController@Advertise', 'as' => 'advertise']);
    Route::match(['get', 'post'], 'jobs/share-your-job/{jobID}', ['uses' => 'JobsController@Share', 'as' => 'share-job']);
    Route::match(['get', 'post'], 'jobs/add-candidates/{jobID}', ['uses' => 'JobsController@AddCandidates', 'as' => 'add-job-candidates']);
    Route::match(['get', 'post'], 'jobs/add-candidates', ['uses' => 'JobsController@AddCandidates', 'as' => 'add-candidates']);
    
    Route::match(['get', 'post'], 'my-jobs', ['uses' => 'JobsController@JobList', 'as' => 'job-list']);
    Route::match(['get', 'post'], 'job/view/{jobID}/{jobSlug?}', ['uses' => 'JobsController@JobView', 'as' => 'job-view']);
    Route::match(['get', 'post'], 'job/preview/{jobID}', ['uses' => 'JobsController@Preview', 'as' => 'job-preview']);
    
    Route::match(['get', 'post'], 'job/activities/{jobID}', ['uses' => 'JobsController@JobActivities', 'as' => 'job-board']);
    Route::match(['get', 'post'], 'job/activities-content', ['uses' => 'JobsController@ActivityContent', 'as' => 'get-activity-content']);
    Route::match(['get', 'post'], 'job/promote/{jobID}', ['uses' => 'JobsController@JobPromote', 'as' => 'job-promote']);
    
    Route::match(['get', 'post'], 'job/team/{jobID}', ['uses' => 'JobsController@JobTeam', 'as' => 'job-team']);
    Route::match(['get', 'post'], 'job/teams/add', ['uses' => 'JobsController@JobTeamAdd', 'as' => 'job-team-add']);
    Route::match(['get', 'post'], 'job/matching/{jobID}', ['uses' => 'JobsController@JobMatching', 'as' => 'job-matching']);
    
    Route::match(['get', 'post'], 'jobs/teamedit', ['uses' => 'JobsController@Ajax', 'as' => 'ajax-edit-team']);
    Route::match(['get', 'post'], 'job/import-cv-file', ['uses' => 'JobsController@UploadCVfile', 'as' => 'upload-file']);
    // Route::match(['get', 'post'], 'job/dashboard/{jobID}', ['uses' => 'JobsController@JobDashboard', 'as' => 'job-view']);
    Route::match(['get', 'post'], 'job/apply/{jobID}/{slug}', ['uses' => 'JobsController@jobApply', 'as' => 'job-apply']);
    Route::match(['get', 'post'], 'job/applied/{jobID}/{slug}', ['uses' => 'JobsController@JobApplied', 'as' => 'job-applied']);
    Route::match(['get', 'post'], 'job/video-application/{jobID}/{slug}/{appl_id}', ['uses' => 'JobsController@JobVideoApplication', 'as' => 'job-video-application']);
    
    Route::match(['get', 'post'], 'job-status', ['uses' => 'JobsController@JobStatus', 'as' => 'job-status']);
	
    // Route::any('log-in', function () {
	//     return view('auth.login');
	// });


    Route::match(['get', 'post'], 'job/candidates/{jobID}', ['uses' => 'JobApplicationsController@viewApplicants', 'as' => 'job-candidates']);
    Route::match(['get', 'post'], 'job/candidates/{jobID}/{start}', ['uses' => 'JobApplicationsController@viewApplicants', 'as' => 'job-candidates-infinite']);
    Route::match(['get', 'post'], 'job-list-data', ['uses' => 'JobApplicationsController@JobListData', 'as' => 'job-list-data']);
    Route::match(['get', 'post'], 'job-view-data', ['uses' => 'JobApplicationsController@JobViewData', 'as' => 'job-view-data']);
    Route::match(['get', 'post'], 'download-applicant-spreadsheet', ['uses' => 'JobApplicationsController@downloadApplicantSpreadsheet', 'as' => 'download-applicant-spreadsheet']);
    Route::match(['get', 'post'], 'download-applicant-cv', ['uses' => 'JobApplicationsController@downloadApplicantCv', 'as' => 'download-applicant-cv']);
    
    Route::post('job/applicant/mass-action', ['uses' => 'JobApplicationsController@massAction', 'as' => 'mass-action']);
    Route::post('job/applicant/write-review', ['uses' => 'JobApplicationsController@writeReview', 'as' => 'write-review']);


    
    Route::get('pricing', function () {
        return view('guest.pricing');
    });

    Route::post('request-a-call', [ 'as' => 'request-a-call', 'uses' => 'HomeController@requestACall' ]);


    Route::get('about', function () {
        return view('guest.about');
    });
    
    Route::get('terms', function () {
        return view('guest.terms');
    });

    Route::get('privacy', function () {
        return view('guest.privacy');
    });

    Route::get('register2', function () {
        return view('auth.register2');
    });

    Route::get('dashboard', ['uses'=>'HomeController@dashbaord', 'as'=>'dashboard']);

    /**
     * Route Group for everything cv
     */
    Route::group(['prefix'=>'cv'], function(){

        Route::get('search-results', function () {
            return view('cv-sales.search-results');
        });

         Route::post('filter_search', 'CvSalesController@filter_search');
         Route::post('cv-preview', ['uses'=>'CvSalesController@getCvPreview', 'as'=>'cv-preview']);

        
        /**
         * Post Variable for cv search form search box
         */
        Route::get('search', 'CvSalesController@search');


        Route::get('cv_pool', function () {
            return view('cv-sales.cv_pool');
        });

        Route::get('cv_purchased', function () {
            return view('cv-sales.cv_purchased');
        });


        Route::get('cv_saved', function () {
            return view('cv-sales.cv_saved');
        });

        Route::get('saved', 'CvSalesController@viewSaved');
        Route::get('purchased', 'CvSalesController@viewPurchased');
        Route::get('talent-pool', 'CvSalesController@viewTalentPool');
        


        Route::post('get-my-folders', 'CvSalesController@getMyFolders');

        Route::post('add-folder', 'CvSalesController@addFolders');

        Route::post('save-to-folder', 'CvSalesController@saveToFolder');

        Route::get('save-to-solr', 'CvSalesController@saveCvPreview');
        
        
    });

    /**
     * Route Group for everything jobs
     */
    Route::group(['prefix'=>'jobs'], function(){

        Route::get('list', function () {
            return view('job.job-list');
        });

        Route::get('dashboard', function () {
            return view('job.dashboard');
        });

        Route::get('matching', function () {
            return view('job.matching');
        });

        Route::get('applicants', function () {
            return view('job.applicants');
        });

        Route::get('team', function () {
            return view('job.team');
        });

        Route::get('applicant', function () {
            return view('job.profile');
        });

        Route::get('activities', function () {
            return view('job.activities');
        });

        Route::get('create', function () {
            return view('job.create');
        });
        
        Route::get('advertise', function () {
            return view('job.advertise');
        });

        Route::get('share', function () {
            return view('job.share');
        });

        
        Route::get('preview', function () {
            return view('job.preview');
        });

        Route::get('applied', function () {
            return view('job.applied');
        });

        Route::get('listing', function () {
            return view('job.listing');
        });
        Route::get('matching', function () {
            return view('job.matching');
        });

        Route::get('applicants', function () {
            return view('job.applicants');
        });

        Route::get('team', function () {
            return view('job.team');
        });

        Route::get('activities', function () {
            return view('job.activities');
        });

    });

    Route::get('/test-mail', function(){

        dd(Mail::send('emails.sample', ['name' => 'Deji Lana'], function ($m){
                $m->from('alerts@insidify.com', 'Ndidi, Insidify.com');

                $m->to('deji@insidify.com', 'Deji Lana')->subject('Your Reminder!');
            }));
    });


    Route::get('/migrate-inf', 'TalentPoolController@MigrateInfrastructure');
    Route::get('/migrate-inf2', 'TalentPoolController@InfMigrate2');
    Route::get('/migrate-inf3', 'TalentPoolController@InfMigrate3');


    Route::get('/my-career-page', 'JobsController@MyCompany');

    // Route::get('/{c_url}/job/{job_id}', 'JobsController@JobView');
    Route::get('/{c_url}/job/{job_id}/{job_slug}', 'JobsController@JobView');

    Route::get('/{c_url}', 'JobsController@company');

    


    /**
     * Route Group for everything applicant
     */ 

    Route::group(['prefix'=>'applicant'], function(){

        Route::get('profile/{appl_id}', ['uses' => 'JobApplicationsController@Profile', 'as' => 'applicant-profile']);
        Route::get('messages/{appl_id}', ['uses' => 'JobApplicationsController@Messages', 'as' => 'applicant-messages']);
        Route::get('activities/{appl_id}', ['uses' => 'JobApplicationsController@activities', 'as' => 'applicant-activities']);
        Route::get('checks/{appl_id}', ['uses' => 'JobApplicationsController@checks', 'as' => 'applicant-checks']);
        Route::get('notes/{appl_id}', ['uses' => 'JobApplicationsController@notes', 'as' => 'applicant-notes']);
        Route::get('assess/{appl_id}', ['uses' => 'JobApplicationsController@assess', 'as' => 'applicant-assess']);
        Route::get('medicals/{appl_id}', ['uses' => 'JobApplicationsController@medicals', 'as' => 'applicant-medicals']);


        Route::get('profile', function () {
            return view('applicant.profile');
        });

        Route::get('checks', function () {
            return view('applicant.checks');
        });

        Route::get('view-mail', function () {
            return view('applicant.messages');
        });

        Route::get('notes', function () {
            return view('applicant.notes');
        });

        Route::get('activities', function () {
            return view('applicant.activities');
        });

    });
    


    /**
     * Route Group for modals
     */

    

    Route::get('modal/default', [ 'as' => 'get-modal', function () {
            return view('applicant.messages');
        } ]);
    Route::get('modal/assess', [ 'as' => 'modal-assess', 'uses' => 'JobApplicationsController@modalAssess']);

    Route::get('modal/comment', [ 'as' => 'modal-comment', 'uses' => 'JobApplicationsController@modalComment' ]);

    Route::get('modal/shortlist', [ 'as' => 'modal-shortlist', 'uses' => 'JobApplicationsController@modalShortlist' ]);

    Route::get('modal/return-to-all', [ 'as' => 'modal-return-to-all', 'uses' => 'JobApplicationsController@modalReturnToAll' ]);

    Route::get('modal/add-to-waiting', [ 'as' => 'modal-add-to-waiting', 'uses' => 'JobApplicationsController@modalAddToWaiting' ]);

    Route::get('modal/hire', [ 'as' => 'modal-hire', 'uses' => 'JobApplicationsController@modalHire' ]);

    Route::get('modal/dossier', [ 'as' => 'modal-dossier', 'uses' => 'JobApplicationsController@modalDossier' ]);

    Route::get('download/dossier', [ 'as' => 'download-dossier', 'uses' => 'JobApplicationsController@downloadDossier' ]);

    
    

    Route::get('modal/reject', [ 'as' => 'modal-reject', 'uses' => 'JobApplicationsController@modalReject' ]);

    Route::get('modal/interview', [ 'as' => 'modal-interview', 'uses' => 'JobApplicationsController@modalInterview' ]);
    Route::get('modal/interview-notes', [ 'as' => 'modal-interview-notes', 'uses' => 'JobApplicationsController@modalInterviewNotes' ]);

    

    Route::get('modal/background-check', [ 'as' => 'modal-background-check', 'uses' => 'JobApplicationsController@modalBackgroundCheck' ]);
    Route::get('modal/medical-check', [ 'as' => 'modal-medical-check', 'uses' => 'JobApplicationsController@modalMedicalCheck' ]);

    Route::get('job/get_all_applicant_status', [ 'as' => 'get-all-applicant-status', 'uses' => 'JobApplicationsController@getAllApplicantStatus' ]);

    

    

    Route::post('checkout', [ 'as' => 'checkout', 'uses' => 'JobApplicationsController@Checkout' ]);
   
    Route::post('request/test', [ 'as' => 'request-test', 'uses' => 'JobApplicationsController@requestTest' ]);
    Route::post('save/test-result', [ 'as' => 'save-test-result', 'uses' => 'JobApplicationsController@saveTestResult' ]);
    Route::post('request/check', [ 'as' => 'request-check', 'uses' => 'JobApplicationsController@requestCheck' ]);
    Route::post('invite/interview', [ 'as' => 'invite-for-interview', 'uses' => 'JobApplicationsController@inviteForInterview' ]);
    Route::post('save-interview-note', [ 'as' => 'save-interview-note', 'uses' => 'JobApplicationsController@saveInterviewNote' ]);
    



    Route::post('cart/get-count', [ 'as' => 'getCartCount', 'uses' => 'CvSalesController@getBoardCartCount' ]);

    
    

});
