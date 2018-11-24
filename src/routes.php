<?php

Route::post('/ulogin', 'LaravelUloginController@postUlogin')->middleware('web')->name('laravel-ulogin');