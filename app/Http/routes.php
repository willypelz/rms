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
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

 //    Route::controllers([
 //        'auth' => 'Auth\AuthController', 
 //        'password' => 'Auth\PasswordController',
 //    ]);
    Route::get('/', function () {
        return view('guest.landing');
    });
    Route::get('log-in', 'Auth\AuthController@showLoginForm');

    Route::post('log-in', 'Auth\AuthController@login');

    Route::get('sign-up', 'Auth\AuthController@showRegistrationForm');

    Route::post('sign-up', 'Auth\AuthController@register');
    
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

    // ================Added by familoni for preview sake ================//

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

    Route::get('cv_pool', function () {
        return view('cv-sales.cv_pool');
    });

    Route::get('cv_purchased', function () {
        return view('cv-sales.cv_purchased');
    });


    Route::get('cv_saved', function () {
        return view('cv-sales.cv_saved');
    });


    //================Added by familoni for preview sake ================//

    /**
     * Route Group for everything cv
     */
    Route::group(['prefix'=>'cv'], function(){

        Route::get('search-results', function () {
            return view('cv-sales.search-results');
        });

         Route::post('filter_search', 'CvSalesController@filter_search');


        
        /**
         * Post Variable for cv search form search box
         */
        Route::post('search', 'CvSalesController@search');


        Route::get('cv_pool', function () {
            return view('cv-sales.cv_pool');
        });

        Route::get('cv_purchased', function () {
            return view('cv-sales.cv_purchased');
        });


        Route::get('cv_saved', function () {
            return view('cv-sales.cv_saved');
        });



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
    });
});
