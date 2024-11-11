<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservasController extends Controller
{
    function guardar(Request $request){
        $c = new Reserva();
        $c -> reservado = 1;
        $c -> fila = $request['fila'];
        $c -> columna = $request['columna'];
        $c -> save(); // El método save es nativo de laravel
    }

    function actualizar(Request $request){
        // Actualizar registros que cumplen con una condición
        $actualizacion = DB::table('reservas')
        ->where('id', $request['id'])
        ->update([
            'reservado' => $request['reservado'],
        ]);

        return view('dashboard')->with('actualizacion', $actualizacion);

    }
    
    function ocupar(Request $request){
        // Actualizar registros que cumplen con una condición
        $actualizacion = DB::table('reservas')
        ->where('id', $request['libre'])
        ->update([
            'reservado' => '1',
        ]);
        
        return view('dashboard')->with('actualizacion', $actualizacion);
        
    }
    
    function obtener(){
        
        $registros = DB::table('reservas')
        ->get();
        
        // dd($registros[0]->reservado);
        return view('dashboard')->with('registros', $registros);
        
    }

    function liberar(Request $request){
        // Actualizar registros que cumplen con una condición
        $actualizacion = DB::table('reservas')
        ->where('id', $request['ocupado'])
        ->update([
            'reservado' => '0',
        ]);
        // $this->obtener();
        return view('dashboard')->with('actualizacion', $actualizacion);

    }

    function buscarAsiento(){

        $asientoLibre = DB::table('reservas')
        ->select('id', 'reservado')
        ->where('reservado', 0)
        ->first();
        // ->get();

        $asiento = $asientoLibre->id;

        return view('dashboard')->with('asiento', $asiento);

    }


    function asientosOcupados(){

        $asientosOcupados = DB::table('reservas')
        ->select('reservado')
        ->where('reservado', 1)
        ->get();

        $recuento = count($asientosOcupados);

        // dd($registros[0]->reservado);
        return view('dashboard')->with('recuento', $recuento);

    }


}
