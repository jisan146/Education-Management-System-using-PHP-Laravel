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
Route::get('/home', 'pagesController@home') ;
Route::get('/', 'pagesController@index') ;
Route::get('/att/{p}/{c}/{id}', 'pagesController@att') ;
Route::get('/login', 'pagesController@loginPage') ;
Route::post('/login', 'pagesController@login') ;
Route::get('/list/{id}', 'pagesController@listt') ;
Route::get('/listedit/{id}/{te}', 'pagesController@listEditt') ;
Route::post('/listedit/{id}/{te}', 'pagesController@listupdate') ;
Route::get('/register/{id}', 'pagesController@register') ;
Route::post('/register/{id}', 'pagesController@register') ;
Route::post('/active_branch', 'pagesController@active_branch') ;
Route::get('/stdFeesColl', 'pagesController@stdFeesColl') ;
Route::post('/stdFeesColl', 'pagesController@stdFeesCollr') ;

Route::get('/stuffFeesColl', 'pagesController@stuffFeesColl') ;
Route::get('/accColl', 'pagesController@accColl') ;
Route::post('/accCollr', 'pagesController@accCollr') ;


Route::get('/report', 'pagesController@report') ;
Route::get('/report_print/{report}/{id}', 'pagesController@report_print') ;
Route::get('/rp/{id}', 'pagesController@receiptPrint') ;

Route::get('/id/{sms}/{id}', 'pagesController@id') ;


Route::get('/install', 'pagesController@gen') ;
Route::get('/wait', 'pagesController@wait') ;
Route::get('/chk', 'pagesController@chk') ;
Route::get('/reg', 'pagesController@reg') ;
Route::get('/atd/{id}', 'pagesController@atd') ;
Route::get('/lc/{cd}', 'pagesController@login_client') ;
//Route::get('/b', 'pagesController@blank') ; 


Route::get('/payment_info/{h}', 'pagesController@FeeList') ;
Route::get('/salary_info/{h}', 'pagesController@salFeeList') ;
Route::get('/sms/{id}', 'pagesController@sms') ;
Route::get('/report_update/{id}', 'pagesController@report_update') ;
Route::get('/stdFeeList/{id}', 'pagesController@stdRevlistt') ;
Route::get('/empSalrylist/{id}', 'pagesController@empRevlistt') ;

Route::get('/revenuePrint', 'pagesController@revenuePrint') ;
Route::post('/revenuePrint', 'pagesController@revenuePrint') ;
Route::get('/resultEntry', 'pagesController@resultEntry') ;
Route::post('/resultEntry', 'pagesController@resultEntry') ;
Route::get('/smsPanel/{tbl}', 'pagesController@smsPanel') ;
Route::post('/smsPanel/{tbl}', 'pagesController@smsPanel') ;
Route::get('/reSendSms', 'pagesController@reSendSms') ;
Route::get('/clearSMS', 'pagesController@clearSMS') ;
Route::get('/meritList', 'pagesController@meritList') ;
Route::get('/cardReg', 'pagesController@cardReg') ;
Route::post('/cardReg', 'pagesController@cardReg') ;


Route::get('/ftp', 'pagesController@ftp') ;
Route::get('/ftpv/{sl}/', 'pagesController@ftpv') ;
Route::post('/ftp', 'pagesController@ftp') ;
Route::get('/chimage', 'pagesController@chimage') ;
Route::post('/chimage', 'pagesController@chimage') ;
Route::get('/chpw', 'pagesController@chpw') ;
Route::post('/chpw', 'pagesController@chpw') ;

Route::get('/meal', 'pagesController@meal') ;
Route::post('/meal', 'pagesController@meal') ;
Route::get('/manatt', 'pagesController@manAtt') ;
Route::post('/manatt', 'pagesController@manAtt') ;

