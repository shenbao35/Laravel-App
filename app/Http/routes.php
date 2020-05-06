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
//moved this resource to a Route group down the page
// Route::resource('/admin/users', 'AdminUsersController');

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

//check if the collective form is included in this project
//go to config/app.php, if not then do this in the termimal
//composer require laravelcollective/html or do this in the composer.json
// "require": {
//     "laravelcollective/html": "^5.2"
//   },
//and do composer uppdate
//add providers and alises of collective form to config/app.php 

//to prevent sending empty data into the database do
//php artisan make:request RequestName
//fix the parameter in store method in the controller

//adding new column to the users table, cannot edit the migration file otherwise it will remove all the stored data
//php artisan make:migration add_photo_id_to_users --table=users
//modify added migration file
//add the added column to the fillable field in the user model
//dont forget to migrate

//make a new model called Photo
//modify photo migration file
//make sure the form of create blade is a model and enable file


//create a new request file
//php artisan make:request UsersEditRequest
//this new request is when the user is editing the profile and can successfully update it without entering the password


//------------ctrl + shift + . ----------------------------
//this will show all method in the class

//create a new middleware
//php artisan make:middleware Admin
//go to kernel.php to add a new middleware
//admin = when user is admin, then it can access the admin/user route
//active = when user is active then it can access the admin/user route
//auth = when user is logged in then it can access the admin/user route
Route::group(['middleware' => ['admin','active','auth']], function () {
    Route::resource('/admin/users', 'AdminUsersController');
});


//add new methods in the user model for the middleware
//modify admin middleware
//creating a a custom 404 page in the views
//