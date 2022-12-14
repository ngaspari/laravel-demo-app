<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\ApiContactsController;

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
    return view('welcome');
});

Route::get('info/', function () {
    return view('info');
});


Route::controller(ContactsController::class)->group(function () {
    Route::get('/contacts/details/{id}', 'contactDetailsAction')->name('contacts.details');
    Route::get('/contacts/delete/{id}', 'contactDeleteAction')->name('contacts.delete');
    Route::get('/contacts', 'listContactsAction')->name('contacts.list');
    Route::get('/contacts/list', 'listContactsAction')->name('contacts.list2');
});

    
Route::controller(ApiContactsController::class)->group(function () {
    Route::get('/api/contacts', 'listContactsAction');
    Route::delete('/api/contacts', 'deleteContactAction');
    Route::put('/api/contacts', 'updateContactAction')->name('contacts.edit');
    Route::post('/api/contacts', 'createContactAction')->name('contacts.create');
});