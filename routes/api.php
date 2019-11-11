<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('user')->group(function(){
    Route::get('getAllAbout', 'AboutController@getAllAbout');
    Route::get('getAllVisimisi', 'VisiMisiController@getAllVisimisi');

    // case user
    Route::get('getAllCasestudy', 'CaseController@getAllCasestudy');
    Route::get('getAllCasestudyPopuler', 'CasePopulerController@getallcase');
    Route::get('casePaginate', 'CaseController@getAllCasePaginate');

    // blog user
    Route::get('getAllBlog', 'BlogController@getAllBlog');
    Route::get('getAllBlogPopuler', 'BlogPopulerController@getAllBlogPopuler');
    Route::get('blogPaginate', 'BlogController@getAllBlogPaginate');
    Route::post('blogPaginateSearch', 'BlogController@getAllBlogPaginateSearch');
    // Route::get('page', 'BlogController@getAllBlogPaginateSearch2');

    Route::post('kirimform','ServiceController@store');
    Route::post('kirimformcontact','ContactController@store');
    // Route::post('sendEmailService', 'ServiceController@index');
    // Route::post('sendEmailService', 'ServiceController@store');
});

Route::prefix('admin')->group(function(){
    Route::resource('kelolaAbout', 'AboutController');
    Route::post('updatedataAbout', 'AboutController@update');
    Route::get('hapusdataAbout/{id}', 'AboutController@destroy');

    Route::resource('kelolaVisiMisi', 'VisiMisiController');
    Route::post('updatedataVisiMisi', 'VisiMisiController@update');
    Route::get('hapusdataVisiMisi/{id}', 'VisiMisiController@destroy');

    Route::resource('kelolaCase', 'CaseController');
    Route::post('updatedataCase', 'CaseController@update');
    Route::get('hapusdataCase/{id}', 'CaseController@destroy');
    Route::get('getallcase', 'CaseController@getallcase'); // for admin

    Route::resource('kelolaCasePopuler', 'CasePopulerController');
    Route::post('updatedataCasePopuler', 'CasePopulerController@update');
    Route::get('hapusdataCasePopuler/{id}', 'CasePopulerController@destroy');
    Route::get('getallcasePopuler', 'CasePopulerController@getallcase'); // for admin

    Route::resource('kelolaBlog', 'BlogController');
    Route::post('updatedataBlog', 'BlogController@update');
    Route::get('hapusdataBlog/{id}', 'BlogController@destroy');
    Route::get('getallblog', 'BlogController@getallblogadmin'); // for admin

    Route::resource('kelolaBlogPopuler', 'BlogPopulerController');
    Route::post('updatedataBlogPopuler', 'BlogPopulerController@update');
    Route::get('hapusdataBlogPopuler/{id}', 'BlogPopulerController@destroy');
    Route::get('getallblogPopuler', 'BlogPopulerController@getallblogadmin'); // for admin
});

// Route::post('loginpost', 'Auth\LoginController@loginpost');
// Route::get('getAllData', 'Auth\LoginController@getAllData');

// api teknisi



