<?php

use Illuminate\Support\Facades\Route;

Route::post('/registrar', 'AuthController@registrar')->name('auth.registrar');
Route::post('/entrar', 'AuthController@entrar')->name('auth.entrar');
Route::post('/eu', 'AuthController@eu')->middleware('auth:sanctum')->name('auth.eu');
Route::post('/sair', 'AuthController@sair')->middleware('auth:sanctum')->name('auth.sair');

Route::post('/enviar-email-trocar-senha', 'AuthController@enviarEmailTrocarSenha')->name('auth.senha.enviar-email');
Route::post('/trocar-senha', 'AuthController@trocarSenha')->name('auth.senha.trocar');
