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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// ----------------------Front End Routes starts----------------------//

Route::get('/','FrontendController@home')->name('home');

Route::get('/frontpage/search', 'FrontendController@search')->name('front.search');

// ----------------------Front-End Routes ends----------------------//



// ----------------------Back-End Routes starts----------------------//

Route::group(['prefix'=>'admin','middleware'=>['auth']],function(){
    Route::get('/','HomeController@admin')->name('admin');
    // Category section
    Route::resource('/user','UserController');
    Route::resource('/category','CategoryController');
    // Posts section
    Route::resource('/post','PostController');
    Route::post('category/{id}/child','CategoryController@getChildByParent');
    // Post Tab manager
    // Route::get('/post-tab','PostController@postTab')->name('post-tab-manager');
    // Route::get('/post-tab/create','PostController@postCreate')->name('post.tab.create');
    // Route::post('/post-tab/store','PostController@postStore')->name('post.tab.store');
    
    Route::put('/post-tab/{id}/edit','PostController@postTabEdit')->name('post-tab-edit');
    Route::delete('/post-tab/delete/{id}','PostController@postDelete')->name('post.tab.delete');

    Route::post('/post-tab/{id}/child','PostController@getTabType');

    // Tab section
    Route::resource('/tab','TabController');

    //ajax get tab detail
    Route::get('/ajaxTab', 'TabController@ajaxTab')->name('postTab.ajaxTab');
    Route::post('/postTabManager/save', 'PostController@postTabManager')->name('postTabManager.save');
});



// ----------------------Back End Routes ends----------------------//
