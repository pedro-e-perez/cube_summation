<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CubeController extends Controller {

    //
    public function Index(Request $request) {
        $request->session()->forget('cubeSum');
        $request->session()->forget('recordingQuery');
        return view('cube.index');
    }

    public function ValidateQuery(Request $request) {
        $queryText = $request->input('queryText');
        $datos = new \App\Bal\BalCube($request);
        return response()->json(["Resultado" => $datos->EjecutarQuery($queryText)]);
    }

}
