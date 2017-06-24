<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CubeController extends Controller
{
    //
    public function Index()
    {
        return view('cube.index');
    }
    public function ValidateQuery(Request $request)
    {
        $datos = new \App\Bal\BalCube($request);
        return response()->json(["Resultado"=>$datos->EjecutarQuery($request)]);
        
    }
}
