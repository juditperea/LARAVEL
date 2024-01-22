<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Impresora;
use App\Models\Trabajo;

class ImpresorasController extends Controller
{
    //mostrar las impresoras
    public function showAll(){
      //coge todas las impresoras de la bd
        $impresoras = Impresora::all();
        //creo un array que tendra los mensajes y su impresora
      $impresorasConMensajes = [];
      //itera sobre las impresoras
      foreach($impresoras as $impresora) {
        //cojo los mensajes de la tabla de trabajos solo cuando coincida el id
        $trabajos = Trabajo::where('idImpresora', $impresora->id)->get();
        
        $impresoraConMensaje = new \stdClass();//creo un objeto
        $impresoraConMensaje->impresora = $impresora;//meto en impresora las impresoras
        $mensajes = [];//creo un array de mensajes
        foreach($trabajos as $trabajo) {
          array_push($mensajes, $trabajo->mensaje);//por cada mensaje lo subo al array de mensajes
        }
        $impresoraConMensaje->mensajes = $mensajes;//actualizo la variable
        array_push($impresorasConMensajes, $impresoraConMensaje);//subo impresorasconmensaje a la lista
      }
         // Crear impresoras iniciales
        /* $impresora1 = new Impresora;
         $impresora2 = new Impresora;
         $impresora3 = new Impresora;
       
         $impresora1->fill([
           'papel' => 'A2', 
           'magenta' => 200,
           'black' => 200,
           'cyan' => 200,  
           'yellow' => 200
         ]);
       
         $impresora2->fill([
           'papel' => 'A3',
           'magenta' => 250,
           'black' => 250,
           'cyan' => 250,
           'yellow' => 250
         ]);
       
         $impresora3->fill([
           'papel' => 'A4',
           'magenta' => 500,
           'black' => 500,
           'cyan' => 500,
           'yellow' => 500
         ]);
       
         // Guardar en BBDD
         $impresora1->save();
         $impresora2->save(); 
         $impresora3->save();*/
        return view('impresora', [
          'impresoras' => $impresoras,
          'impresorasConMensajes' => $impresorasConMensajes
        ]);
    }

    public function imprimir(Request $request, $idImpresora) {
        // Obtener la impresora
        $impresora = Impresora::find($idImpresora);
      
        $trabajos = Trabajo::where('idImpresora', $idImpresora)->get();
        // Obtener trabajos asociados
       
        // Primer trabajo  
        $primerTrabajo = $trabajos->first();
        if($primerTrabajo == null){
          return back()->with('error', 'No hay mensajes');
        }
      
        // Calcular tinta necesaria
        $caracteres = strlen($primerTrabajo->mensaje);
        $magenta = $caracteres; 
        $black = $caracteres * 2;
        $cyan = $caracteres;
        $yellow = $caracteres;

        $hojas = 0;
      
        // Validar tinta disponible
        if($impresora->magenta <= $magenta || $impresora->black <= $black) {
          return back()->with('error', 'No hay tinta suficiente');
        }
      
        // Restar tinta
        $impresora->magenta -= $magenta;
        $impresora->black -= $black;
        $impresora->cyan -= $cyan; 
        $impresora->yellow -= $yellow;
      
        // Actualizar impresora
        $impresora->save();
      
        // Eliminar primer trabajo
        $primerTrabajo->delete();
      
        // Incrementar hojas 
        $hojas++;
      
        return redirect('/imprimir/idImpresora');
      
      }

public function colas(Request $r)
{
    // Obtener los datos del formulario
    $opciones = $r->input('opciones');
    $texto = $r->input('Text');
    // Validar que el campo "mensaje" no esté vacío
    if (empty($texto)) {
        return back()->with('error', 'El campo mensaje no puede estar vacío');
    }

    // Crear un nuevo objeto Trabajo
    $trabajo = new Trabajo();
    $trabajo->mensaje = $texto;
    $trabajo->idImpresora = $opciones;

    // Guardar el trabajo en la base de datos
    $trabajo->save();

    $mensaje = [$opciones, $texto];

    return redirect('/trabajo');
}

  

}

