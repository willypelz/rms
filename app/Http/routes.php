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
use App\Libraries\Solr;
use Illuminate\Support\Facades\Route;

// URL::forceSchema('https');
Route::group(['middleware' => ['web']], function () {
    Route::get('/sso/auto/login/verify/{email}/{key}', 'Auth\LoginController@singleSignOnVerify');
    Route::get('/sso/auto/login/{url}/{user_id}/{token}', 'Auth\LoginController@loginUser');
    Route::get('/sso/auto/login/verify/role/{email}/{key}', 'Auth\LoginController@verifyUserHasRole');
    Route::any('admin-accept-invite/{id}/{company_id}',['uses' => 'AdminsController@adminAcceptInvite', 'as' => 'admin-accept-invite']);
    Route::match( ["get", "post"],'jobs/post-a-job/{id?}', ['uses' => 'JobsController@createJob', 'as' => 'create-post-job']);
    Route::post('/third-party/entry', 'ThirdPartyEntryController@index');

    Route::get('setup', 'SetupController@index');
    Route::get('generate-key', 'SetupController@generateApiKey')->name('generate-key');
    Route::get('save-setup', 'SetupController@saveSetup')->name('save-setup');
});

Route::post("/api/v1/delete-super-admin", "HrmsIntegrationController@deleteSuperAdmin")->name("delete-super-admin");
Route::group(['middleware' => ['web','auth','admin']], function () {
    Route::get('clientEnv/edit/{id?}', 'SystemSettingsController@edit')->name('edit-env');
    Route::get('clientEnv', 'SystemSettingsController@index')->name('index-env');
    Route::post('client/update/{id}', 'SystemSettingsController@update')->name('update-env');
    Route::get('clientEnv/delete/{id}', 'SystemSettingsController@delete')->name('delete-env');
});

Route::group(
    ['prefix'=>'client', 'middleware' => 'allowUrl'], 
    function () {
        Route::get('/signup', 'SelfSignupController@index')->name('client-signup-index');
        Route::post('/signup', 'SelfSignupController@create')->name('client-signup-create');
    }
);

// admin company 
Route::group(['middleware' => ['web', 'auth', 'companyList']], function () {
    Route::get('/view-company-list', 'CompanyController@index')->name('view-company-list');
});
/** ---------
 * Start: Administrator Panel Routes
 * Make admin group and apply a guard to it
 */

Route::group(['middleware' => ['web',"auth", 'admin']], function () {

    Route::get('/download-bulk-upload-applicant-to-workflow-stage-template', "BulkUploadApplicantsToWorkflowStepContoller@downloadBulkApplicantsToWorkflowStagesTemplate")->name("download-bulk-upload-applicant-to-workflow-stage-template");

    Route::get('/ping', 'SolariumController@ping');
    Route::get('/audit-trails', 'AuditController@index')->name('audit-trails');
    Route::resource('schedule', 'ScheduleController');

    Route::middleware(["admin:interviewer"])->match(['get', 'post'], '/admin/assign', 'JobsController@manageRoles')->name('change-admin-role');
    Route::match(['get', 'post'], 'job/teams/delete', ['uses' => 'JobsController@JobTeamDelete', 'as' => 'job-team-admin-delete']);
    Route::match(['get', 'post'], '/sys/roles', 'AdminsController@manageRoles')->name('list-role');
    Route::match(['get', 'post'], '/sys/roles/create', 'AdminsController@createRole')->name('create-role');
    Route::match(['get', 'post'], '/sys/roles/edit/{id}', 'AdminsController@editRole')->name('role-edit');
    Route::match(['get', 'post'], '/sys/roles/delete/{id}', 'AdminsController@deleteRole')->name('role-delete');
    Route::post('upload-document/{appl_id}/{job_id}', ['uses' => 'JobsController@adminUploadDocument', 'as' => 'upload-document']);
    Route::group([
        'prefix' => '/admin',
        'middleware' => 'admin'
    ], function () {
        Route::get('auth/logout', 'Auth\LoginController@logout');
    });

    /** -- End: Administrator Panel Route -- */

    Route::get('switcher', 'Auth\LoginController@switchUser')->name('switcher');

    Route::get('/workflow-select/{job_id}/{user_id}', 'JobsController@workflowSelect')->name('workflow-select');

    Route::get('/invoices', ['as' => 'invoice-list', 'uses' => 'PaymentController@allInvoices']);

    Route::get('fixQua', ['uses' => 'JobsController@correctHighestQualification']);

    Route::get('simple-pay', function () {

        $user  = 'AYolana';
        $email = Mail::send('emails.cv-sales.invoice', ['user' => $user], function ($message) {
            $message->from('us@example.com', 'Laravel');

            $message->to('lanaayodele@gmail.com');
        });

        if (count(Mail::failures()) > 0) {

        } else {
            echo "No errors, all sent successfully!";
        }

        //return view('payment.simplepay');
    });

    Route::match(['get', 'post'], 'add-company', ['uses' => 'JobsController@AddCompany', 'as' => 'add-company']);
     Route::match(['get', 'post'], 'edit-company', ['uses' => 'JobsController@editCompany', 'as' => 'edit-company']);


	/************************
	 * Data privacy routes **
	 *************************/

	Route::match(['get', 'post'], 'settings/set-privacy-policy', ['uses' => 'PrivacyPolicyController@setPrivacyPolicy', 'as' => 'set-privacy-policy']);
	Route::match(['get', 'post'], 'settings/save-privacy-policy', ['uses' => 'PrivacyPolicyController@savePrivacyPolicy', 'as' => 'save-privacy-policy']);

	/************************
	 * Subsidiaries routes **
	 *************************/

	Route::resource('company/subsidiaries',  'SubsidiariesController');

	/************************
	 * Settings  routes    **
	 *************************/
	Route::get('settings', ['uses' => 'SettingsController@showSettings', 'as' => 'page-settings']);


	//JOB
    Route::match(['get', 'post'], 'jobs/duplicate', ['uses' => 'JobsController@DuplicateJob', 'as' => 'duplicate-job']);
    Route::match(['get', 'post'], 'jobs/send-job', ['uses' => 'JobsController@SendJob', 'as' => 'send-to-friends']);
    Route::match(['get', 'post'], 'jobs/save-to-mailbox',
        ['uses' => 'JobsController@SavetoMailbox', 'as' => 'savetoMailbox']);

    Route::match(['get', 'post'], 'jobs/save-job', ['uses' => 'JobsController@SaveJob', 'as' => 'job-draft']);
    Route::match(['get', 'post'], 'job/edit/progress/{id}', ['uses' => 'JobsController@continueJob', 'as' => 'continue-draft']);
    Route::match(['get', 'post'], 'job/edit/confirm/{id}', ['uses' => 'JobsController@confirmJobDetails', 'as' => 'confirm-job-post']);
    Route::match(['get', 'post'], 'jobs/refer-job', ['uses' => 'JobsController@ReferJob', 'as' => 'refer-job']);
    Route::match(['get', 'post'], 'jobs/create-a-job', ['uses' => 'JobsController@createJob', 'as' => 'post-job']);
    
    Route::match(['get', 'post'], 'jobs/create-a-job/{id?}', ['uses' => 'JobsController@createJob', 'as' => 'create-job']);
    Route::match(['get', 'post'], 'jobs/approve/{id}', ['uses' => 'JobsController@approveJobPost', 'as' => 'approve-job-post']);
    Route::match(['get', 'post'], 'edit-job/{jobid}', ['uses' => 'JobsController@EditJob', 'as' => 'edit-job']);

    Route::match(['get', 'post'], 'jobs/post-success/{jobID}/{slug?}',
        ['uses' => 'JobsController@PostSuccess', 'as' => 'post-success']);
    Route::match(['get', 'post'], 'jobs/advertise-your-job/{jobID}/{slug?}',
        ['uses' => 'JobsController@Advertise', 'as' => 'advertise']);
    Route::match(['get', 'post'], 'jobs/share-your-job/{jobID}',
        ['uses' => 'JobsController@Share', 'as' => 'share-job']);
    Route::match(['get', 'post'], 'jobs/add-candidates/{jobID}',
        ['uses' => 'JobsController@AddCandidates', 'as' => 'add-job-candidates']);
    Route::match(['get', 'post'], 'jobs/add-candidates',
        ['uses' => 'JobsController@AddCandidates', 'as' => 'add-candidates']);

    Route::match(['get', 'post'], 'job/preview/{jobID}', ['uses' => 'JobsController@Preview', 'as' => 'job-preview']);



    Route::match(['get', 'post'], 'job/activities/{jobID}',
    ['uses' => 'JobsController@JobActivities', 'as' => 'job-board']);
    Route::match(['get', 'post'], 'job/activities-content',
        ['uses' => 'JobsController@ActivityContent', 'as' => 'get-activity-content']);
    Route::match(['get', 'post'], 'job/promote/{jobID}',
        ['uses' => 'JobsController@JobPromote', 'as' => 'job-promote']);

    Route::match(['get', 'post'], 'job/team/{jobID}', ['uses' => 'JobsController@JobTeam', 'as' => 'job-team']);
    Route::match(['get', 'post'], 'job/settings/team/{job_id}', ['uses' => 'JobsController@jobTemSettings', 'as' => 'job-team-setting']);
    Route::match(['get', 'post'], 'job/teams/add', ['uses' => 'JobsController@JobTeamAdd', 'as' => 'job-team-add']);
    Route::match(['get', 'post'], 'job/teams/delete-invitee', ['uses' => 'JobsController@JobTeamInviteeDelete', 'as' =>  'delete-job-team-invitee']);
    Route::match(['get','post'],'job/teams/remove', ['uses' => 'JobsController@removeJobTeamMember', 'as' => 'remove-job-team-member']);
    Route::match(['get','post'],'job/teams/resend/invite/{id}', ['uses' => 'JobsController@resendInvite', 'as' => 'resend-job-team-invite']);
    Route::match(['get','post'],'job/teams/cancel/invite/{id}', ['uses' => 'JobsController@cancelInvite', 'as' => 'cancel-job-team-invite']);


    Route::get('job/teams/decline', ['uses' => 'JobsController@JobTeamDecline', 'as' => 'job-team-decline']);

    Route::get('/get-all-roles', 'JobsController@getAllRoles')->name('get-all-roles');
    Route::post('/persis-role', 'JobsController@persisRole')->name('persis-role');

    Route::match(['get', 'post'], '/accept-team-invite/{id}', 'JobsController@acceptTeamInvite')
        ->name('accept-team-invite');

    Route::match(['get', 'post'], 'account-expired/{c_url}', 'JobsController@accountExpired');

    Route::match(['get', 'post'], 'job/matching/{jobID}',
        ['uses' => 'JobsController@JobMatching', 'as' => 'job-matching']);

    Route::match(['get', 'post'], 'jobs/teamedit', ['uses' => 'JobsController@Ajax', 'as' => 'ajax-edit-team']);
    Route::match(['get', 'post'], 'job/import-cv-file', ['uses' => 'JobsController@UploadCVfile', 'as' => 'upload-file']);

    Route::get('/one_applicant', 'JobApplication@oneApplicantData');
    
    Route::resource('schedule', 'JobApplicationsController');

    Route::get('/download-applicants-interview-file/{filename}', 'JobApplicationsController@downloadApplicantsInterviewFile')->name("download-applicants-interview-file");

    Route::match(['get', 'post'], 'one_applicant',
        ['uses' => 'JobApplicationsController@oneApplicantData']);

    Route::match(['get', 'post'], 'job/candidates/{jobID}',
        ['uses' => 'JobApplicationsController@viewApplicants', 'as' => 'job-candidates']);
        
    Route::match(['get', 'post'], 'job/candidates/{jobID}/{start}',
        ['uses' => 'JobApplicationsController@viewApplicants', 'as' => 'job-candidates-infinite']);
    Route::match(['get', 'post'], 'job-list-data',
        ['uses' => 'JobApplicationsController@JobListData', 'as' => 'job-list-data']);

    Route::match(['get', 'post'], 'get-job-data',
        'JobApplicationsController@getJobsData')->name('get-job-data');

    Route::match(['get', 'post'], 'get-one-job-data',
        'JobApplicationsController@getOneJobsData')->name('get-one-job-data');

    Route::match(['get', 'post'], 'job-view-data',
        ['uses' => 'JobApplicationsController@JobViewData', 'as' => 'job-view-data']);
    Route::match(['get', 'post'], 'download-applicant-spreadsheet',
        ['uses' => 'JobApplicationsController@downloadApplicantSpreadsheet', 'as' => 'download-applicant-spreadsheet']);
    Route::match(['get', 'post'], 'download-applicant-cv',
        ['uses' => 'JobApplicationsController@downloadApplicantCv', 'as' => 'download-applicant-cv']);

    Route::match(['get', 'post'], 'download-interview-notes',
        ['uses' => 'JobApplicationsController@downloadInterviewNotes', 'as' => 'download-interview-notes']);

    Route::match(['get', 'post'], 'download-interview-notes-csv',
        ['uses' => 'JobApplicationsController@downloadInterviewNotesCSV', 'as' => 'download-interview-notes-csv']);

    Route::post('job/applicant/mass-action', ['uses' => 'JobApplicationsController@massAction', 'as' => 'mass-action']);
    Route::post('job/applicant/write-review',
        ['uses' => 'JobApplicationsController@writeReview', 'as' => 'write-review']);
    //PrivateJobs
    Route::delete('privatejob-email/remove/{id}','PrivateJobController@destroy')->name('remove-attached-email');

    //Specialization
    Route::get('list-job-specialization', 'SpecializationController@index')->name('specialization');;
    Route::post('store-job-specialization', 'SpecializationController@store')->name('store-specialization');
    Route::get('update-job-specialization/{id}', 'SpecializationController@update')->name('update-specialization');
    Route::delete('delete-job-specialization/{id}', 'SpecializationController@delete')->name('delete-specialization');

    Route::get('dashboard', ['uses' => 'HomeController@dashbaord', 'as' => 'dashboard'])->middleware("admin");
    Route::match(['get','post'],'user-permission', ['uses' => 'UserPermissionController@userPermissionPage', 'as' => 'user-permission'])->middleware("admin");
    Route::post('user-permission/{id}', ['uses' => 'UserPermissionController@userPermissionUpdate', 'as' => 'update-user-permission'])->middleware("admin");
    Route::get('sync-user-to-company-index/{user_id}', ['uses' => 'SyncUserToCompanyController@syncUserToCompanyIndex', 'as' => 'sync-user-to-company-index'])->middleware("admin");
    Route::post('sync-user-to-company', ['uses' => 'SyncUserToCompanyController@syncUserToCompany', 'as' => 'sync-user-to-company'])->middleware("admin");
    
   
    /**
     * Route Group for everything jobs
     */
    Route::group(['prefix' => 'jobs'], function () {


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
            return view('job.create-step1');
        });

        Route::get('create/next', function () {
            return view('job.create-step2');
        });

        Route::get('create/confirm', function () {
            return view('job.create-step3');
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


    Route::get('/test-mail', function () {

        dd(Mail::send('emails.sample', ['name' => 'Deji Lana'], function ($m) {
            $m->from('alerts@insidify.com', 'Ndidi, Insidify.com');

            $m->to('deji@insidify.com', 'Deji Lana')->subject('Your Reminder!');
        }));
    });

    Route::get('/migrate-inf', 'TalentPoolController@MigrateInfrastructure');
    Route::get('/migrate-inf2', 'TalentPoolController@InfMigrate2');
    Route::get('/migrate-inf3', 'TalentPoolController@InfMigrate3');

        /**
     * Onbarding routes
     */
    Route::get('onboard/noAction1', ['as' => 'onboard-no-action-1', 'uses' => 'OnboardingController@noAction1']);
    Route::get('onboard/noAction2', ['as' => 'onboard-no-action-2', 'uses' => 'OnboardingController@noAction2']);
    Route::get('onboard/noAction3', ['as' => 'onboard-no-action-3', 'uses' => 'OnboardingController@noAction3']);


    Route::get('settings/embed',
    ['as' => 'settings-embed', 'uses' => 'JobsController@embed']);

    Route::get('cron/delete-temp-files',
        ['as' => 'delete-temp-files', 'uses' => 'JobApplicationsController@deleteTmpFiles']);
    Route::get('modal/assess', ['as' => 'modal-assess', 'uses' => 'JobApplicationsController@modalAssess']);

    Route::get('modal/comment', ['as' => 'modal-comment', 'uses' => 'JobApplicationsController@modalComment']);
    Route::get('message/bulk/modal', ['as' => 'send-bulk-message-modal', 'uses' => 'CandidateController@sendBulkMessageModal']);
    Route::any('message/bulk/{ids}', ['as' => 'send-bulk-message', 'uses' => 'CandidateController@sendBulkMessage']);

    Route::get('modal/shortlist', ['as' => 'modal-shortlist', 'uses' => 'JobApplicationsController@modalShortlist']);

    Route::get('modal/return-to-all',
        ['as' => 'modal-return-to-all', 'uses' => 'JobApplicationsController@modalReturnToAll']);

    Route::get('modal/add-to-waiting',
        ['as' => 'modal-add-to-waiting', 'uses' => 'JobApplicationsController@modalAddToWaiting']);

    Route::get('modal/hire', ['as' => 'modal-hire', 'uses' => 'JobApplicationsController@modalHire']);

    Route::get('modal/dossier', ['as' => 'modal-dossier', 'uses' => 'JobApplicationsController@modalDossier']);

    Route::get('download/dossier', ['as' => 'download-dossier', 'uses' => 'JobApplicationsController@downloadDossier']);

    Route::get('modal/test-result',
        ['as' => 'modal-test-result', 'uses' => 'JobApplicationsController@modalTestResult']);


    Route::get('modal/reject', ['as' => 'modal-reject', 'uses' => 'JobApplicationsController@modalReject']);

    Route::get('modal/interview', ['as' => 'modal-interview', 'uses' => 'JobApplicationsController@modalInterview']);
    Route::get('modal/interview/bulk', ['as' => 'modal-interview-bulk', 'uses' => 'JobApplicationsController@modalInterview']);
    // Route::get('modal/interview-notes', [ 'as' => 'modal-interview-notes', 'uses' => 'JobApplicationsController@modalInterviewNotes' ]);

    Route::get('modal/interview-notes',
        ['as' => 'modal-interview-notes', 'uses' => 'JobApplicationsController@takeInterviewNote']);

    Route::get('settings/interview-notes/templates',
        ['as' => 'interview-note-templates', 'uses' => 'JobApplicationsController@viewInterviewNoteTemplates']);

    Route::match(['get', 'post'], 'settings/interview-notes/template/edit/{id}',
        ['as' => 'interview-note-template-edit', 'uses' => 'JobApplicationsController@editInterviewNoteTemplate']);

    Route::match(['get', 'post'], 'settings/interview-notes/template/create',
        ['as' => 'interview-note-template-create', 'uses' => 'JobApplicationsController@createInterviewNoteTemplate']);

    Route::match(['get', 'post'], 'settings/interview-notes/template/duplicate/{id}',
        ['as' => 'interview-note-template-duplicate', 'uses' => 'JobApplicationsController@duplicateInterviewNoteTemplate']);

    Route::match(['get', 'post'], 'settings/interview-notes/template/delete/',
        ['as' => 'interview-note-template-delete', 'uses' => 'JobApplicationsController@deleteInterviewNoteTemplate']);


    Route::get('settings/interview-notes/options/{interview_template_id}',
        ['as' => 'interview-note-options', 'uses' => 'JobApplicationsController@viewInterviewNoteOptions']);

    Route::match(['get', 'post'], 'settings/interview-notes/options/edit/{interview_template_id}/{id}',
        ['as' => 'interview-note-option-edit', 'uses' => 'JobApplicationsController@editInterviewNoteOptions']);

    Route::match(['get', 'post'], 'settings/interview-notes/options/create/{interview_template_id}',
        ['as' => 'interview-note-option-create', 'uses' => 'JobApplicationsController@createInterviewNoteOptions']);

    Route::match(['get', 'post'], 'settings/interview-notes/options/template/delete/',
        ['as' => 'interview-note-option-delete', 'uses' => 'JobApplicationsController@deleteInterviewNoteOptions']);

    Route::get('settings/interview-notes/options/template/sort/',
        ['as' => 'interview-note-option-sort', 'uses' => 'JobApplicationsController@sortInterviewNoteOptions']);

    Route::get('modal/background-check',
        ['as' => 'modal-background-check', 'uses' => 'JobApplicationsController@modalBackgroundCheck']);
    Route::get('modal/medical-check',
        ['as' => 'modal-medical-check', 'uses' => 'JobApplicationsController@modalMedicalCheck']);

    Route::get('job/get_all_applicant_status',
        ['as' => 'get-all-applicant-status', 'uses' => 'JobApplicationsController@getAllApplicantStatus']);


    Route::post('checkout', ['as' => 'checkout', 'uses' => 'JobApplicationsController@Checkout']);

    Route::post('request/test', ['as' => 'request-test', 'uses' => 'JobApplicationsController@requestTest']);

    Route::post('request/check', ['as' => 'request-check', 'uses' => 'JobApplicationsController@requestCheck']);
    Route::post('invite/interview',
        ['as' => 'invite-for-interview', 'uses' => 'JobApplicationsController@inviteForInterview']);

    Route::post('preview/interview',
        ['as' => 'invite-for-interview-preview', 'uses' => 'JobApplicationsController@previewInterview']);
        

    Route::post('save-interview-note',
        ['as' => 'save-interview-note', 'uses' => 'JobApplicationsController@takeInterviewNote']);


    Route::post('cart/get-count', ['as' => 'getCartCount', 'uses' => 'CvSalesController@getBoardCartCount']);


    Route::group([
        'prefix' => '/settings'
    ], function () {
        Route::get('workflow', 'WorkflowController@index')->name('workflow');
        Route::post('workflow', 'WorkflowController@store')->name('workflow-store');

        Route::group([
            'prefix' => '/workflow'
        ], function () {
            // Workflow
            Route::get('/{id}/view', 'WorkflowController@show')->name('workflow-show');
            Route::get('/steps/view/{id}', 'WorkflowController@getSteps')->name('get-workflow-steps');
            Route::get('/create', 'WorkflowController@create')->name('workflow-create');
            Route::get('/{id}/edit', 'WorkflowController@editView')->name('workflow-edit');
            Route::get('/{id}/duplicate', 'WorkflowController@duplicate')->name('workflow-duplicate');
            Route::match(['put', 'patch'], '/{id}/edit', 'WorkflowController@update')->name('workflow-update');
            Route::delete('/{id}', 'WorkflowController@destroy')->name('workflow-delete');

            // Workflow <-> Steps
            Route::get('/{id}/steps/add', 'WorkflowStepController@create')->name('workflow-steps-add');
            Route::post('/{id}/steps/add', 'WorkflowStepController@store')->name('workflow-steps-store');

            // API calls
            Route::post('/steps/reorder', 'WorkflowStepController@reorderSteps');
        });

        // Steps
        Route::get('/step/{id}/edit', 'StepController@edit')->name('step-edit');
        Route::match(['put', 'patch'], '/step/{id}/edit', 'StepController@update');
        Route::delete('/step/{id}', 'StepController@destroy')->name('step-delete');

        Route::get('modal/step-action/{step}/{stepSlug}/{stepId}', 'JobApplicationsController@modalStepAction')
            ->name('modal-step-action');

        Route::match(['get', 'post'], 'modal/approve', 'JobApplicationsController@modalApprove')->name('modal-approve');

        Route::get('modal/approve-bulk-upload-to-current-workflow-stage', 'BulkUploadApplicantsToWorkflowStepContoller@getBulkUploadToCurrentWorkflowStage')->name('get-modal-bulk-upload-to-current-workflow-stage');
        Route::post('modal/approve-bulk-upload-to-current-workflow-stage', 'BulkUploadApplicantsToWorkflowStepContoller@postBulkUploadToCurrentWorkflowStage')->name('post-modal-bulk-upload-to-current-workflow-stage');

    });

    Route::get('/settings/api-key', 'ApiController@index')->name('view-api-key');
    Route::post('/settings/api-key', 'ApiController@update');

    Route::get('/my-career-page', 'JobsController@MyCompany');
    Route::middleware('auth')->match(['get', 'post'], 'my-jobs', ['uses' => 'JobsController@JobList', 'as' => 'job-list']);
    Route::get('my-jobs-content', ['uses' => 'JobsController@JobList', 'as' => 'job-list-content']);

});
/*********************************/
/* End Of Admin Routes */
/**********************************/

/* API Routes */
Route::group([
    'prefix' => '/api/v1',
    'namespace' => 'API'
], function () {
    Route::get('/list/companies', 'JobController@listCompanies');
    Route::get('/jobs/{jobType?}/{company_id?}', 'JobController@company');
    Route::get('/job/{job_id}/{status_slug}/applicants', 'JobController@applicants');
    Route::post('/jobs/apply', 'JobController@apply');
    Route::get('/get/employees', 'JobController@fetchEmployees')->name('fetch-employees')->middleware(['web','auth']);

    Route::get('/get/user-jobs', 'JobController@getUserJobs')->name('get-user-jobs');
    Route::get('/get/user-jobs/activities', 'JobController@getUserJobActivities');
    Route::post('/save-super-admin', 'JobController@createSuperAdmin');
});
Route::post('/api/v1/messages/send','CandidateController@sendMessage');
Route::any('candidate-invite/{id}/{token}',['uses' => 'CandidateController@candidateAccept', 'as' => 'candidate-invite']);



/* Easily update Solr via URL*/
Route::get('/solr/update/{redirect?}', function ($redirect = '') {
    SolrPackage::update_core(null, 'full-import');

    if ($redirect == 'false') {
        return '';
    }
    return redirect()->back();
});


Route::get('hospital-project', function () {
    $agent = new \Jenssegers\Agent\Agent();
    return view('lifeplan', compact('agent'));
});

Route::group(['middleware' => 'web'], function () {

    Route::auth();

    Route::match(['get', 'post'], 'talent-source',['uses' => 'HomeController@viewTalentSource', 'as' => 'talent-source']);

    Route::post('save/test-result', ['as' => 'save-test-result', 'uses' => 'JobApplicationsController@saveTestResult']);

    Route::get('user/activation/{token}', 'Auth\LoginController@activateUser')->name('user.activate');

    Route::post('user/auth/verify', 'Auth\LoginController@verifyUser')->name('verify-user-details');
    Route::any('', 'HomeController@home')->name('candidate-login');
    Route::any('register', 'HomeController@register')->name('candidate-register');
    Route::any('forgot', 'CandidateController@forgot')->name('candidate-forgot');
    Route::get('forgot/sent', 'CandidateController@forgotSent')->name('candidate-forgot-sent');
    Route::any('reset/{token}', 'CandidateController@reset')->name('candidate-reset');

    // Candidate
    Route::group(['prefix' => 'candidate'], function () {

        Route::match(['get', 'post'], '/login', 'HomeController@home');

        Route::match(['get', 'post'], '/logout', 'CandidateController@logout')->name('candidate-logout');
        Route::match(['get', 'post'], '/profile', 'CandidateController@profile')->name('candidate-profile');

        // TODO
        // Route::match(['get', 'post'], '/register', 'CandidateController@register')->name('candidate-register');
        // Route::match(['get', 'post'], '/forgot', 'CandidateController@forgot')->name('candidate-reset');
        // Route::match(['get', 'post'], '/reset', 'CandidateController@reset')->name('candidate-reset');

        Route::match(['get', 'post'], '/dashboard', 'CandidateController@dashboard')->name('candidate-dashboard');
        Route::match(['get', 'post'], '/{application_id}/activities',
            'CandidateController@activities')->name('candidate-activities');
        Route::match(['get', 'post'], '/jobs', 'CandidateController@jobs')->name('candidate-jobs');
        Route::get('job-listing/{company_id}', 'CandidateController@jobList')->name('job-listing');
        Route::match(['get', 'post'], '/{application_id}/documents',
            'CandidateController@documents')->name('candidate-documents');


        Route::match(['get', 'post'], '/{application_id}/messages',
            'CandidateController@messages')->name('candidate-messages');

        Route::match(['get', 'post'], '/messages/send',
            'CandidateController@sendMessage')->name('candidate-send-message');
    });

    Route::get('invoice/{invoice_id}', ['as' => 'show-invoice', 'uses' => 'PaymentController@showInvoice']);

    Route::post('/invoice-pop', ['as' => 'show-invoice-pop', 'uses' => 'PaymentController@createInvoice']);


    Route::get('error', [
        'as' => 'errors.defaultError',
        function () {
            return view('errors.500');
        }
    ]);

    Route::get('/contact', function () {
        return view('guest.contact');
    });

    Route::get('/test/solr', ['as' => 'test-solr', 'uses' => 'TestSolrController@index']);
    Route::post('/test/solr', ['as' => 'test-solr-create', 'uses' => 'TestSolrController@runSolrUpdate']);

    Route::get('/test/setup', ['as' => 'test-setup', 'uses' => 'TestSetupController@index']);
    Route::post('/test/setup/create', ['as' => 'test-setup-create', 'uses' => 'TestSetupController@create']);

    

    Route::get('download-csv-template',
    ['uses' => 'PrivateJobController@exportCsvTemplate', 
    'as' => 'download-privatejob-template']);

    Route::post('/contact', function () {
        $request = request();
        $data = $request->all();

        $mail = Mail::send('emails.new.contact', $data, function ($m) use ($data) {
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

    Route::get('/whoops', function () {

        return view('guest.whoops');
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

    Route::get('payment_successful', function () {
        return view('payment.payment_succes');
    });

    Route::get('log-in', 'Auth\LoginController@showLoginForm');
    Route::get('/logout', 'Auth\LoginController@logout');

    Route::post('log-in', 'Auth\LoginController@login');

    Route::get('/auto-login/{code}', 'Auth\LoginController@autoLogin');


    // Route::get('sign-up', 'Auth\AuthController@showRegistrationForm');

    // Route::post('sign-up', 'Auth\AuthController@register');

    Route::match(['get', 'post'], 'auth/ajax_login', ['uses' => 'Auth\LoginController@AjaxLogin', 'as' => 'ajax_login']);
    Route::match(['get', 'post'], 'sign-up', ['uses' => 'Auth\AuthController@Registration', 'as' => 'registration']);



    Route::match(['get', 'post'], 'cart', ['uses' => 'CvSalesController@Cart', 'as' => 'cart']);
    Route::match(['get', 'post'], 'cart_details', ['uses' => 'CvSalesController@CartDetails', 'as' => 'cartDe']);
    Route::match(['get', 'post'], 'output', ['uses' => 'CvSalesController@Output', 'as' => 'out']);
    Route::match(['get', 'post'], 'ajax_cart', ['uses' => 'CvSalesController@Ajax_cart', 'as' => 'ajax_cart']);
    Route::match(['get', 'post'], 'ajax_checkout',
        ['uses' => 'CvSalesController@Ajax_checkout', 'as' => 'ajax_checkout']);
    Route::match(['get', 'post'], 'payment/{type?}', ['uses' => 'CvSalesController@Payment', 'as' => 'payment']);

    Route::match(['get', 'post'], 'simplepay/{type?}', ['uses' => 'JobsController@SimplePay', 'as' => 'simplepay']);

    Route::match(['get', 'post'], 'job/view/{jobID}/{jobSlug?}', ['uses' => 'JobsController@JobView', 'as' => 'job-view']);

    Route::match(['get', 'post'], 'job/share/{jobID}/{jobSlug?}', ['uses' => 'JobsController@jobShare', 'as' => 'job-share']);

    Route::match(['get', 'post'], 'job/apply/{jobID}/{slug}',['uses' => 'JobsController@jobApply', 'as' => 'job-apply']);

    Route::post('fetch/schools', ['uses'=>'JobsController@fetchSchools', 'as' => 'ajax-fetch-schools']);

    Route::match(['get', 'post'], 'job/applied/{jobID}/{slug}',['uses' => 'JobsController@JobApplied', 'as' => 'job-applied']);

    Route::match(['get', 'post'], 'job/video-application/{jobID}/{slug}/{appl_id}',['uses' => 'JobsController@JobVideoApplication', 'as' => 'job-video-application']);

    Route::match(['get', 'post'],'embed-view', ['as' => 'embed', 'uses' => 'JobsController@getEmbed']);

    // Route::post('embed-view', ['as' => 'embed', 'uses' => 'JobsController@getEmbed']);

    Route::get('embed-test', ['as' => 'embed-test', 'uses' => 'JobsController@getEmbedTest']);

    Route::match(['get', 'post'], 'accept-invite/{id}',['uses' => 'JobsController@acceptInvite', 'as' => 'accept-invite']);

    Route::match(['get', 'post'], 'decline-invite/{id}',  ['uses' => 'JobsController@declineInvite', 'as' => 'decline-invite']);

    Route::match(['get', 'post'], 'select-company', ['uses' => 'JobsController@selectCompany', 'as' => 'select-company'])->middleware('auth');

    Route::get('/admin/force-create-admins', 'JobsController@makeOldStaffsAdmin');

    Route::get('/{c_url}', 'JobsController@company');

    Route::match(['get', 'post'], 'transactions', ['uses' => 'CvSalesController@Transactions', 'as' => 'transactions']);
    Route::match(['get', 'post'], 'emails-test', ['uses' => 'CvSalesController@TestEmail', 'as' => 'emails']);

    // Route::match(['get', 'post'], 'job/dashboard/{jobID}', ['uses' => 'JobsController@JobDashboard', 'as' => 'job-view']);

    Route::match(['get', 'post'], 'job-status', ['uses' => 'JobsController@JobStatus', 'as' => 'job-status']);
    Route::match(['get', 'post'], 'make-private', ['uses' => 'JobsController@makeJobPrivateOrPublic', 'as' => 'make-job-private']);


    // Route::any('log-in', function () {
    //     return view('auth.login');
    // });


    Route::get('/pricing/page', ['as' => 'pricing-page', 'uses' => 'HomeController@pricing']);

    Route::post('request-a-call', ['as' => 'request-a-call', 'uses' => 'HomeController@requestACall']);

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



    /**
     * Route Group for everything cv
     */
    Route::group(['prefix' => 'cv'], function () {

        Route::get('search-results', function () {
            return view('cv-sales.search-results');
        });

        Route::post('filter_search', 'CvSalesController@filter_search');
        Route::post('cv-preview', ['uses' => 'CvSalesController@getCvPreview', 'as' => 'cv-preview']);


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



    // Route::get('/{c_url}/job/{job_id}', 'JobsController@JobView');
    Route::get('/{c_url}/job/{job_id}/{job_slug}', 'JobsController@JobViewOld');

    /**
     * Route Group for everything applicant
     */

    Route::group(['prefix' => 'applicant'], function () {


        Route::get('profile/{appl_id}', ['uses' => 'JobApplicationsController@Profile', 'as' => 'applicant-profile']);

        Route::get('messages/{appl_id}',
            ['uses' => 'JobApplicationsController@Messages', 'as' => 'applicant-messages']);
        Route::match(['get', 'post'], '/messages/send',
            'JobApplicationsController@sendMessage')->name('admin-send-message');

        Route::get('activities/{appl_id}',
            ['uses' => 'JobApplicationsController@activities', 'as' => 'applicant-activities']);
        Route::get('checks/{appl_id}', ['uses' => 'JobApplicationsController@checks', 'as' => 'applicant-checks']);
        Route::get('notes/{appl_id}', ['uses' => 'JobApplicationsController@notes', 'as' => 'applicant-notes']);
        Route::get('assess/{appl_id}', ['uses' => 'JobApplicationsController@assess', 'as' => 'applicant-assess']);
        Route::get('medicals/{appl_id}',
            ['uses' => 'JobApplicationsController@medicals', 'as' => 'applicant-medicals']);

        Route::get('documents/{appl_id}',
            ['uses' => 'JobApplicationsController@documents', 'as' => 'applicant-documents']);

        Route::get('interviews/{appl_id}',
            ['uses' => 'JobApplicationsController@interviews', 'as' => 'applicant-interviews']);


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
    Route::get('modal/default', [
        'as' => 'get-modal',
        function () {
            return view('applicant.messages');
        }
    ]);


    Route::get(
        '/download-applicants-interview-file/{filename}',
        'JobApplicationsController@downloadApplicantsInterviewFile'
    )->name("download-applicants-interview-file");

});

Route::get(
        '/download-applicants-interview-file/{filename}',
        'JobApplicationsController@downloadApplicantsInterviewFile'
    )->name("download-applicants-interview-file");




Route::group(['prefix' => 'api/v2', 'namespace' => 'API'], function () {
    Route::get('rms-company-subsidiaries', ['uses' => 'SyncController@companyAndSubsidiaries', 'as' => 'rms-company-subsidiaries']);
});


