<?php

use App\Http\Controllers\ImpresorasController;
use Illuminate\Support\Facades\Route;


Route::get('/',[ImpresorasController::class,'showAll']);//muestra las impresoras(view inicial)


Route::get('/imprimir/{idImpresora}', [ImpresorasController::class, 'imprimir']);

//para cuando clico en una impresora y se procesa la cola

//falta una ruta para procesar el formulario y enviar los datos a la cola de impresion
Route::get('/trabajo',[ImpresorasController::class,'colas']);


//hacer un boton de reinicio y redirigirlo a otra ruta que llame a un metodo y vuelva a crear la base de datos