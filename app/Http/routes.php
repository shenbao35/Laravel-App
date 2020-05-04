<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

//first, configure the .env
//then add the necessary views, admin,users,categories,posts
//then modify users migration table
//add Role model, php artisan make:model Role -m
//register a new user in the browser
//modify the role of user in database
//add user by using register in the browser
//check the user role by using tinker

//create new controller, php artisan make:controller --resource AdminUsersController
Route::resource('/admin/users', 'AdminUsersController');

//install node.js on the machine, we will be using gulp, it will help speed up the application when requesting something from the server
//in cmd, npm install --global gulp
//however, on laravel version 5.4, gulp is not supported anymore and replaced by webpack,
//only version lower than 5.4 will get to work the gulp,  in the cmd, npm install --global gulp

//copy the css and js files into the resources/assets
//copy the fonts into the public
//version of node has to be 6.x and laravel is 12.x
//modify the gulpfile.js, must be exactly as the format of the files in resources and public
// npm install
// gulp to compile sass files

//add admin.blade.php to layouts folder in views folder
//apps.css in public folder can write custom css, while lib.css are the compiled stuffs

//when modifying anything on assets, must do gulp afterwards     

Route::get('/admin', function () {
    // will look for a file called index in the admin folder
    return view('admin.index');
});