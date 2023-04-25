<?php

use App\Http\Controllers\MainController;
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

Route::get('/', [MainController::class, 'home'])
        ->name('home');

Route::get('/get_component_status', [MainController::class, 'get_component_status'])
        ->name('get_component_status');

Route::get('/activate_component/{component_number?}', [MainController::class, 'activate_component'])
        ->name('activate_component');
    
Route::get('/deactivate_component/{component_number?}', [MainController::class, 'deactivate_component'])
        ->name('deactivate_component');

Route::get('/test', [MainController::class, 'test'])
        ->name('test');

Route::post('/send_pattern', [MainController::class, 'send_pattern'])
        ->name('send_pattern');
        
Route::post('/send_password', [MainController::class, 'send_password'])
        ->name('send_password');

Route::post('/set_difficulty', [MainController::class, 'set_difficulty'])
        ->name('set_difficulty');

Route::get('/reset', [MainController::class, 'reset'])
        ->name('reset');

Route::get('/loop', [MainController::class, 'loop'])
        ->name('loop');