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

	Route::get('/activities/ideastudent', function() {
	return view('/activities/ideastudent');
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
	Route::get('/terms', function () {
	    return view('terms');
	});

	// Route::get('/products/index/filter_a', array('as' => 'shop_Price_fitler_Desc', 'uses' => 'ProductController@filterUp'));
	Route::get('/products/index/filter_priceasc', 'ProductController@filterUp');
	Route::get('/products/index/filter_pricedesc', 'ProductController@filterDown');
	Route::get('/products/index/filter_typeasc', 'ProductController@filterAZ');
	Route::get('/products/index/filter_typedesc', 'ProductController@filterZA');

	Route::get('/products', 'ProductController@index');
	Route::post('/products/fetch', 'ProductController@fetch')->name('autocomplete.fetch');

	Route::get('/autocomplete', 'AutocompleteController@index');
	Route::post('/autocomplete/fetch', 'ProductController@fetch')->name('autocomplete.fetch');

	Route::get('/products/index/filterBar/{title}', 'ProductController@filterBar');
	Route::get('/products/index/filterBar', 'ProductController@filterBar');



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


	Route::resource('participates', 'ParticipateController');



	// Route::put('/participates', function() {
	// 	return view('participates/create');
	// });

	// Route::get('/participates', function() {
	// 	return view('participates/index');
	// });

	// Route::get('/participates/create', 'ParticipateController@create');
	// Route::post('/participates', 'ParticipateController@store');
	// Route::get('/participates', 'ParticipateController@index');
	

// 	Route::get('/demo', function () {
//     return view('demo');

//     Route::middleware('auth')->group(function () {
//     Route::resource('image', 'ImageController', [
//         'only' => ['create', 'store', 'destroy']
//     ]);
// });
// });





