<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/welcome', function () {
    return "I'm Pakita";
});

Route::get('/welcome2', function () {
    return '<input type="button" value="Click me!!" onclick="alert(\'Hello!\')"/>';
});

Route::get('/about', function () {
    return view('about',  ['name' => 'Pakita', 'lastname' => 'Fedora']); //return view('about',  ['name' => 'Pakita Fedora']);
});//in about.blade.php {{$name}} {{$lastname}}

Route::fallback(function () {//locate it at the end of the routes
    return 'Wrong URL';
});
