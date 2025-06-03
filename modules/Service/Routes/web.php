<?php
use Illuminate\Support\Facades\Route;
//Contact
Route::get('/service','ServiceController@index')->name("service.index");
// Route::post('/contact/store','ContactController@store')->name("contact.store");
