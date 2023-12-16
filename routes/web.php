<?php

use App\Http\Controllers\AgentInputController;
use App\Http\Controllers\checker;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UpdateTicketController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::post('/searchdataform', [AgentInputController::class, 'searchdataform'])->name('searchdataform');
Route::post('/ticketsubmit', [AgentInputController::class, 'ticketsubmit'])->name('ticketsubmit');
Route::post('/dealershiplocation', [AgentInputController::class, 'dealershiplocation'])->name('dealershiplocation');
Route::post('/pincode', [AgentInputController::class, 'pincode'])->name('pincode');
Route::get('/NewTicket', [AgentInputController::class, 'newticket'])->name('newticketshow');
Route::post('/contactreason', [AgentInputController::class, 'contactreason'])->name('contactreason');
Route::post('/contactreasonsub', [AgentInputController::class, 'contactreasonsub'])->name('contactreasonsub');

Route::get('/AgentInput', [AgentInputController::class, 'ShowPage'])->name('AgentInputShow');
Route::post('/SearchShow', [AgentInputController::class, 'SearchShow'])->name('SearchShow');
Route::post('/location_code', [AgentInputController::class, 'location_code'])->name('location_code');


Route::middleware('auth', 'UserTypeCheck')->group(function () {
    Route::get('/Report', [ReportController::class, 'reportshow'])->name('reportshow');
    Route::any('/getreportdata', [ReportController::class, 'getreportdata'])->name('getreportdata');
    Route::get('/exportreport', [ReportController::class, 'exportreport'])->name('exportreport');

    Route::get('/usermanagement', [HomeController::class, 'usermanagementshow'])->name('usermanagementshow');
    Route::post('/AddUser', [HomeController::class, 'AddUser'])->name('AddUser');
    Route::get('/EditUser/{id}', [HomeController::class, 'EditUserForm'])->name('EditUserForm');
    Route::get('/delete/{id}', [HomeController::class, 'delete'])->name('delete');
    Route::post('/EditUser', [HomeController::class, 'EditUser'])->name('EditUser');
    Route::get('/updateticket', [UpdateTicketController::class, 'updateticket'])->name('updateticket');
    Route::get('/searchupdateticket', [UpdateTicketController::class, 'searchupdateticket'])->name('searchupdateticket');
    Route::post('postupdateticket', [UpdateTicketController::class, 'postupdateticket'])->name('postupdateticket');
});