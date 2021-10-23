<?php

use Illuminate\Support\Facades\Route;

define('PAGINATION_COUNT' , 6);
define('PAGINATION_COUNTBU' , 3);

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth' ] , function(){
    
    route::resource('states', App\Http\Controllers\StatesController::class)->except(['show']);
    route::resource('local', App\Http\Controllers\LocalController::class)->except(['show']);
    route::resource('adminUnit', App\Http\Controllers\AdministrativUnitController::class)->except(['show']);
    route::resource('work', App\Http\Controllers\WorkController::class)->except(['show']);
    route::resource('causeLawsuit', App\Http\Controllers\CauseLawsuitController::class)->except(['show']);
    route::resource('proseText', App\Http\Controllers\ProseTextController::class)->except(['show']);
    route::resource('contractSubject', App\Http\Controllers\ContractSubjectController::class)->except(['show']);
    route::resource('consultSubject', App\Http\Controllers\SubjectConsultController::class)->except(['show']);
    route::resource('users', App\Http\Controllers\UserController::class)->except(['show']);
    route::resource('lawyers', App\Http\Controllers\LawyersController::class)->except(['show']);
    route::resource('claimants', App\Http\Controllers\ClaimantsController::class)->except(['show']);
    route::resource('customers', App\Http\Controllers\CustomerController::class)->except(['show']);
    route::resource('customersTo', App\Http\Controllers\CustomerToController::class)->except(['show']);
    route::resource('judges', App\Http\Controllers\JudgesController::class)->except(['show']);
    route::resource('courts', App\Http\Controllers\CourtsController::class)->except(['show']);
    route::resource('clients', App\Http\Controllers\ClientsController::class)->except(['show']);
    route::resource('clientsTo', App\Http\Controllers\ClientsToController::class)->except(['show']);
    route::resource('witness', App\Http\Controllers\WitnessController::class)->except(['show']);
    route::resource('prosecution', App\Http\Controllers\ProsecutionController::class)->except(['show']);
    route::resource('sessions', App\Http\Controllers\SessionsController::class)->except(['show']);
    route::resource('sessionWitness', App\Http\Controllers\sessionsWitnessController::class)->except(['show']);
    route::resource('appeal', App\Http\Controllers\AppealController::class)->except(['show']);
    route::resource('consults', App\Http\Controllers\ConsultsController::class)->except(['show']);
    route::resource('contract', App\Http\Controllers\ContractController::class)->except(['show']);
    route::resource('authorization', App\Http\Controllers\AuthorizationController::class)->except(['show']);
    route::resource('address', App\Http\Controllers\AddressController::class)->except(['show']);
    route::resource('messages', App\Http\Controllers\MessagesController::class)->except(['show']);
    route::resource('subjectAuthorization', App\Http\Controllers\SubjectAuthorizationController::class)->except(['show']);

    
    
});
