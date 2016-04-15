<?php

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

Route::group(['middleware' => ['web']], function () {
    
    Route::controller('schedule', 'ScheduleController');
    
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', function () {
        return view('guest.landing');
    });

    Route::get('simple-pay', function(){

        // dd(save_activities(4, 'Job application', '', '', 'THis is a very nice comment'));
        return view('payment.simplepay');
    });

    Route::get('log-in', 'Auth\AuthController@showLoginForm');

    Route::post('log-in', 'Auth\AuthController@login');

    // Route::get('sign-up', 'Auth\AuthController@showRegistrationForm');

    // Route::post('sign-up', 'Auth\AuthController@register');
    
    Route::match(['get', 'post'], 'auth/ajax_login', ['uses' => 'Auth\AuthController@AjaxLogin', 'as' => 'ajax_login']);
    Route::match(['get', 'post'], 'sign-up', ['uses' => 'Auth\AuthController@Registration', 'as' => 'registration']);

    Route::match(['get', 'post'], 'cart', ['uses' => 'CvSalesController@Cart', 'as' => 'cart']);
    Route::match(['get', 'post'], 'cart_details', ['uses' => 'CvSalesController@CartDetails', 'as' => 'cartDe']);
    Route::match(['get', 'post'], 'output', ['uses' => 'CvSalesController@Output', 'as' => 'out']);
    Route::match(['get', 'post'], 'ajax_cart', ['uses' => 'CvSalesController@Ajax_cart', 'as' => 'ajax_cart']);
    Route::match(['get', 'post'], 'ajax_checkout', ['uses' => 'CvSalesController@Ajax_checkout', 'as' => 'ajax_checkout']);
    Route::match(['get', 'post'], 'payment/{type?}', ['uses' => 'CvSalesController@Payment', 'as' => 'payment']);
    
    Route::match(['get', 'post'], 'simplepay', ['uses' => 'JobsController@SimplePay', 'as' => 'simplepay']);
    
    Route::match(['get', 'post'], 'transactions', ['uses' => 'CvSalesController@Transactions', 'as' => 'transactions']);
    Route::match(['get', 'post'], 'emails-test', ['uses' => 'CvSalesController@TestEmail', 'as' => 'emails']);

    //JOB
    Route::match(['get', 'post'], 'jobs/save-job', ['uses' => 'JobsController@SaveJob', 'as' => 'job-draft']);
    Route::match(['get', 'post'], 'jobs/refer-job', ['uses' => 'JobsController@ReferJob', 'as' => 'refer-job']);
    Route::match(['get', 'post'], 'jobs/post-a-job', ['uses' => 'JobsController@PostJob', 'as' => 'post-job']);
    Route::match(['get', 'post'], 'edit-job/{jobid}', ['uses' => 'JobsController@EditJob', 'as' => 'edit-job']);

    Route::match(['get', 'post'], 'jobs/advertise-your-job/{jobID}', ['uses' => 'JobsController@Advertise', 'as' => 'advertise']);
    Route::match(['get', 'post'], 'jobs/share-your-job/{jobID}', ['uses' => 'JobsController@Share', 'as' => 'share-job']);
    Route::match(['get', 'post'], 'jobs/add-candidates/{jobID}', ['uses' => 'JobsController@AddCandidates', 'as' => 'add-candidates']);
    
    Route::match(['get', 'post'], 'my-jobs', ['uses' => 'JobsController@JobList', 'as' => 'job-list']);
    Route::match(['get', 'post'], 'job/view/{jobID}/{jobSlug?}', ['uses' => 'JobsController@JobView', 'as' => 'job-view']);
    
    Route::match(['get', 'post'], 'job/dashboard/{jobID}', ['uses' => 'JobsController@JobBoard', 'as' => 'job-board']);
    Route::match(['get', 'post'], 'job/activities/{jobID}', ['uses' => 'JobsController@JobActivities', 'as' => 'job-activities']);
    Route::match(['get', 'post'], 'job/candidates/{jobID}', ['uses' => 'JobsController@JobCandidates', 'as' => 'job-candidates']);
    Route::match(['get', 'post'], 'job/team/{jobID}', ['uses' => 'JobsController@JobTeam', 'as' => 'job-team']);
    Route::match(['get', 'post'], 'job/matching/{jobID}', ['uses' => 'JobsController@JobMatching', 'as' => 'job-matching']);
    
    Route::match(['get', 'post'], 'jobs/teamedit', ['uses' => 'JobsController@Ajax', 'as' => 'ajax-edit-team']);
    
    Route::match(['get', 'post'], 'job/import-cv-file', ['uses' => 'JobsController@UploadCVfile', 'as' => 'upload-file']);

    // Route::match(['get', 'post'], 'job/dashboard/{jobID}', ['uses' => 'JobsController@JobDashboard', 'as' => 'job-view']);

    Route::match(['get', 'post'], 'job/apply/{jobID}/{slug}', ['uses' => 'JobsController@jobApply', 'as' => 'job-apply']);
    Route::match(['get', 'post'], 'job-status', ['uses' => 'JobsController@JobStatus', 'as' => 'job-status']);
	// Route::any('log-in', function () {
	//     return view('auth.login');
	// });

    Route::get('boss', function () {
        return view('cv-sales.tobi');
    });

    Route::get('about', function () {
        return view('guest.about');
    });

    Route::get('register2', function () {
        return view('auth.register2');
    });

    Route::get('dashboard', function () {
        return view('talent-pool.dashboard');
    });

    /**
     * Route Group for everything cv
     */
    Route::group(['prefix'=>'cv'], function(){

        Route::get('search-results', function () {
            return view('cv-sales.search-results');
        });

         Route::post('filter_search', 'CvSalesController@filter_search');
         Route::post('get_cv_preview', 'CvSalesController@getCvPreview');

        
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


        Route::post('get-my-folders', 'CvSalesController@getMyFolders');

        Route::post('add-folder', 'CvSalesController@addFolders');

        Route::post('save-to-folder', 'CvSalesController@saveToFolder');

        Route::post('save-to-solr', 'CvSalesController@saveCvPreview');
        
        
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

        Route::get('add-candidates', function () {
            return view('job.add-candidates');
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




    Route::get('/{c_url}', 'JobsController@company');

    Route::get('/{c_url}/job/{job_id}', 'JobsController@JobView');
    Route::get('/{c_url}/job/{job_id}/{job_slug}', 'JobsController@JobView');

    /**
     * Route Group for everything applicant
     */ 

    Route::group(['prefix'=>'applicant'], function(){

        Route::get('profile/{appl_id}', ['uses' => 'JobApplicationsController@Profile', 'as' => 'applicant-profile']);
        Route::get('messages/{appl_id}', ['uses' => 'JobApplicationsController@Messages', 'as' => 'applicant-messages']);


        Route::get('profile', function () {
            return view('applicant.profile');
        });



        Route::get('compose-mail', function () {
            return view('applicant.compose-mail');
        });

        Route::get('view-mail', function () {
            return view('applicant.messages');
        });

        Route::get('notes', function () {
            return view('applicant.notes');
        });

        Route::get('b-check', function () {
            return view('applicant.b-check');
        });

    });


    

});
