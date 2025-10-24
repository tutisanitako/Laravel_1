<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', function () {
//     return view('home');
// });

Route::view('/home', 'home', ['name'=>"tako"]);

Route::get('/test1', function () {
    return "Hello Laravel!";
});

Route::get('/user/{id?}', function (?string $id=null) {
    return 'User '.$id;
});

use App\Http\Controllers\TestController;

Route::get('/test', [TestController::class, 'func_1']);

Route::get('/greeting', [App\Http\Controllers\GreetingController::class, 'showForm']);
Route::post('/greeting', [App\Http\Controllers\GreetingController::class, 'generateGreeting']);

use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('student');
});

Route::post('/add-student', [StudentController::class, 'store']);
