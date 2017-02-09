<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();
Route::group([
    "middleware" => ["auth"]
], function () {
    Route::group([
        "middleware" => ["isAdmin"]
    ], function () {
        Route::get('/operators', 'AdminController@listOperators');
        Route::any('/operators/add', 'AdminController@addOperator');
        Route::any('/operators/edit/{operator}', 'AdminController@editOperator');
        Route::any('/operators/delete/{operator}', 'AdminController@deleteOperator');

    });
    Route::group([
        "middleware" => ["isAdminOrOperator"]
    ], function () {
    	Route::get('/patients', 'PatientOperatorController@listPatients');
        Route::any('/patients/add', 'PatientOperatorController@addPatient');
        Route::any('/patients/edit/{patient}', 'PatientOperatorController@editPatient');
        Route::any('/patients/delete/{patient}', 'PatientOperatorController@deletePatient');

        Route::any('/reports', 'ReportOperatorController@listOfReports');
        Route::get('/reports/add', 'ReportOperatorController@showAddReportForm');

        Route::post('/reports/add', 'ReportOperatorController@addReport');
        Route::get('/reports/edit/{report}', 'ReportOperatorController@showEditReportForm');

        Route::get('/reports/delete/{report}', 'ReportOperatorController@deleteReport');
        Route::post('/reports/edit/{report}', 'ReportOperatorController@editReport');

        Route::get('/reports/download/{report}', 'ReportOperatorController@exportPdfReport');
        Route::get('/reports/show/{report}', 'ReportOperatorController@showReport');

    });

    Route::group([
        "middleware" => ["isPatient"]
    ], function () {
        Route::any('/patients/reports', 'PatientController@listOfReports');
        Route::get('/patients/reports/download/{report}', 'PatientController@exportPdfReport');
        Route::get('/patients/reports/show/{report}', 'PatientController@showReport');
        Route::get('/patients/reports/email/{report}', 'PatientController@emailReport');
    });


    Route::get('/logout', function () {
        Auth::logout();
        return redirect("/home");
    });
});
Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');
Route::get('/patients/get/email/{email}', 'PatientController@getPatientByEmail');
