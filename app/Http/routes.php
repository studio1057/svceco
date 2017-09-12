<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'HomeController@index');



Route::get('dashboard', ['middleware' => 'auth', 'uses' => 'DashboardController@index']);
Route::get('dashboard/search', ['middleware' => 'auth', 'uses' => 'DashboardController@search']);
Route::get('dashboard/reset', ['middleware' => 'auth', 'uses' => 'DashboardController@getReset']);


Route::get('dashboard/screening', ['middleware' => 'auth', 'uses' => 'DashboardController@getScreening']);
Route::post('dashboard/screening', ['middleware' => 'auth', 'uses' => 'DashboardController@postVerifyUser']);

Route::get('dashboard/password', ['middleware' => 'auth', 'uses' => 'Auth\ChangePasswordController@get']);
Route::post('dashboard/password', ['middleware' => 'auth', 'uses' => 'Auth\ChangePasswordController@post']);

Route::get('dashboard/edit', ['middleware' => 'auth', 'uses' => 'DashboardController@getEdit']);
Route::post('dashboard/edit', ['middleware' => 'auth', 'uses' => 'DashboardController@postEdit']);

Route::post('dashboard/hours', ['middleware' => 'auth', 'uses' => 'DashboardController@postHours']);

Route::post('dashboard/adduser', ['uses' => 'DashboardController@postInviteUser']);

Route::get('dashboard/filter', ['middleware' => 'auth', 'uses' => 'DashboardController@getFilter']);
Route::post('dashboard/filter/organization', ['middleware' => 'auth', 'uses' => 'DashboardController@postFilterOrganization']);
Route::post('dashboard/filter/events', ['middleware' => 'auth', 'uses' => 'DashboardController@postFilterEvents']);

Route::get('dashboard/blacklist', ['middleware' => 'auth', 'uses' => 'DashboardController@getBlacklist']);

Route::get('dashboard/blacklist/list', ['middleware' => 'auth', 'uses' => 'DashboardController@getBlacklistData']);
Route::get('dashboard/blacklist/add/{id}', ['middleware' => 'auth', 'uses' => 'DashboardController@postAddBlacklist']);
Route::get('dashboard/blacklist/delete/{id}', ['middleware' => 'auth', 'uses' => 'DashboardController@postDelBlacklist']);


Route::post('dashboard/approval', ['middleware' => 'auth', 'uses' => 'DashboardController@postApproval']);


Route::get('/', 'Auth\AuthController@getLogin');
Route::post('/', 'Auth\AuthController@postLogin');

Route::get('logout', 'Auth\AuthController@getLogout');
Route::post('logout', 'Auth\AuthController@postLogout');

Route::post('contact', 'ContactController@postIndex');


Route::get('/events',['uses' => 'EventController@getEvents']);

Route::post('/events',['uses' => 'EventController@postFilterEvents']);

Route::get('{OrganizationSlug}/events/{EventSlug}', ['uses' => 'EventController@getEvent']);
Route::post('{OrganizationSlug}/events/{EventSlug}/join', ['uses' => 'EventController@postJoinEvent']);
Route::post('{OrganizationSlug}/events/{EventSlug}/cancelAttendance', ['middleware' => 'auth', 'uses' => 'EventController@postCancelAttendance']);

Route::get('{OrganizationSlug}/events/{EventSlug}/roster', ['uses' => 'EventController@getRoster']);
Route::post('{OrganizationSlug}/events/{EventSlug}/roster', ['uses' => 'EventController@postCheckIn']);

Route::get('{OrganizationSlug}/events/{EventSlug}/cancel', ['uses' => 'EventController@getCancel']);


Route::get('{OrganizationSlug}/events/{EventSlug}/edit', ['uses' => 'EventController@getEditEvent']);

Route::post('{OrganizationSlug}/events/{EventSlug}/edit', function($OrganizationSlug, $EventSlug,  Illuminate\Http\Request $request) {
    $app = app();
    $controller = $app->make('App\Http\Controllers\EventController');
    return $controller->callAction('postEditEvent', $parameters = array($OrganizationSlug, $EventSlug, $request));
});


Route::get('{OrganizationSlug}/events/{EventSlug}/complete', ['uses' => 'EventController@getComplete']);

Route::get('{OrganizationSlug}/events/{EventSlug}/featured', ['uses' => 'EventController@toggleFeatured']);

Route::get('/events/create', 'EventController@getCreateEvent');
Route::post('/events/create', 'EventController@postCreateEvent');


Route::controllers([
	'register' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::group(['prefix' => 'api/v1'], function() {

    route::resource('group','API\GroupController');
    route::resource('notify','API\NotificationController');

});



Route::get('/profile/{OrganizationSlug}', ['uses' => 'OrganizationController@getProfile']);



Route::get('invite/{InviteCode}', ['uses' => 'InviteController@getInvite']);
Route::post('invite/{InviteCode}', function($InviteCode, Illuminate\Http\Request $request) {
    $app = app();
    $controller = $app->make('App\Http\Controllers\InviteController');
    return $controller->callAction('postInvite', $parameters = array($InviteCode, $request));
});



Route::get('screening/{id}', ['uses' => 'ScreeningController@getScreenForm']);

Route::post('/screening/verify/{id}', function($id,  Illuminate\Http\Request $request) {
    $app = app();
    $controller = $app->make('App\Http\Controllers\ScreeningController');
    return $controller->callAction('postVerifyUser', $parameters = array($id, $request));
});



Route::get('/events/screen/{id}', ['uses' => 'ScreeningController@getScreenFormForOrg']);
Route::post('/events/screen/{id}', function($id,  Illuminate\Http\Request $request) {
    $app = app();
    $controller = $app->make('App\Http\Controllers\ScreeningController');
    return $controller->callAction('postScreenData', $parameters = array($id, $request));
});

Route::get('/screening/data/{id}',  ['uses' => 'ScreeningController@getFormData']);
