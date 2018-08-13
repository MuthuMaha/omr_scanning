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
//     return $request->user();delete
// });
use App\Employee;
use App\Http\Resources\Employee as UserResource;

Route::get('/user', function () {
    return new UserResource(Employee::find(1));
});
Route::group([ 'prefix' => 'token' ], function () {
	Route::post('userLogin', 'AuthController@tokenAuthAttempt');
	Route::post('uploadResults','AuthController@upload');
	Route::group([ 'middleware' => 'auth:token' ], function () {
		Route::post('getExamData', 'AuthController@tokenAuthCheck'); 
		Route::post('uploadTemplate','AuthController@templateData');
		Route::post('deleteTemplate','AuthController@templateDelete');
		Route::post('getTemplates','AuthController@gettemplateData');
		Route::post('getTemplateData','AuthController@templatedataDownload');
	});
});

