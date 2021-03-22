<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('top');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/upload', 'UploadController@index')->name('upload');

Route::get('/upload/register', 'UploadController@register')->name('uploadRegister');
