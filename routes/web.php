<?php
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Route;


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


Route::get('/send_mail',function (){

    $data = ['message' => 'This is first test with laravel from mohammed alkilani localhost'];

    Mail::to('email here')->send(new TestEmail($data));
});


