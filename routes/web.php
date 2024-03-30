<?php

use Illuminate\Support\Facades\Route;
use App\Models\Building;

Route::get('/', function () {
    echo '<pre>';
    var_dump('aaaa');die;
    // return view('layouts.nav');
});

Route::get('/buildings/{buildId}', function ($buildId) {
    // echo '<pre>';
    // var_dump($buildId);die;
    // return Building::get();
    // return view('welcome');
});
