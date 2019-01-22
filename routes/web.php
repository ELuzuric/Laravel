<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



		Auth::routes();

	Route::group(['middleware' => ['web', 'auth']], function(){
		Route::get('/', function () {
	    return view('home');
		});

		Route::get('/home', function(){
			if(Auth::user()->permission == 0) {
				return view('home');
			} else if(Auth::user()->permission == 1) {
				$users['users'] = \App\User::all();
				return view('home', $users);
			} else if(Auth::user()->permission == 2) {
				$users['users'] = \App\User::all();
				return view('home', $users);
			}

		});

	});




	Route::get('/pastactivities', function () {
	    return view('pastactivities');
	});

	Route::get('/activities', function () {
	    return view('activities');
	});

	Route::get('/shop', function () {
	    return view('shop');
	});



	Route::resource('ideas', 'IdeaController');
	Route::resource('activities', 'ActivityController');
	Route::resource('comments', 'CommentController');
	Route::resource('products', 'ProductController');

	Route::get('/demo', function () {
    return view('demo');

    Route::middleware('auth')->group(function () {
    Route::resource('image', 'ImageController', [
        'only' => ['create', 'store', 'destroy']
    ]);
});
    
});





