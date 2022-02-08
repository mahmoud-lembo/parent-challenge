<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/api/v1/users', 'ProviderController@callback');
