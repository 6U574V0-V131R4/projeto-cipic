<?php

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

#***************************************************************************
#                                   Geral
#***************************************************************************
Route::get('/', 'Geral@index')->name('paginaInicial');

Route::get('/home', 'Geral@home')->name('home');

#***************************************************************************
#                                   Usuario
#***************************************************************************

Route::get('/login', 'Usuarios@login')->name('login');
Route::post('/login_post', 'Usuarios@login')->name('login_post');

Route::get('/signup', 'Usuarios@signup')->name('signup');
Route::post('/signup_post', 'Usuarios@signup')->name('signup_post');

Route::get('/logout', 'Usuarios@logout')->name('logout');

#***************************************************************************
#                                   Aplicacao
#***************************************************************************

Route::get('/aplicacao', 'Aplicacao@index')->name('aplicacao');

Route::get('/adicionar/{usuario?}', 'Aplicacao@adicionar_get')->name('adicionar');

Route::post('/adicionar_post/{usuario}', 'Aplicacao@adicionar')->name('adicionar_post');

Route::get('/minhas', 'Aplicacao@minhas')->name('minhas');



Route::get('/eliminar/{id}', 'Aplicacao@eliminar')->name('eliminar');

Route::get('/privada/{id}', 'Aplicacao@privada')->name('privada');

Route::get('/publica/{id}', 'Aplicacao@publica')->name('publica');
