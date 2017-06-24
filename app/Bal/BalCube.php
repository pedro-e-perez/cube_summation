<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BalCube
 *
 * @author pedro_2
 */

namespace App\Bal;

class BalCube {

    private $request;

    function __construct($request) {
        $this->request = $request;
    }

    //put your code here
    public function EjecutarQuery($query) {

        $ltsquery = explode("\n", $query);
        $queryData = new \App\Dal\QueryData($this->request);
        foreach ($ltsquery as &$exQuery) {
            $resultado = $this->EvaluarQuery($exQuery);
            $queryData->GuardarQuery($exQuery . $resultado);
        }

        $data = new \App\Dal\CubeData($this->request);

        return ["matriz" => $data->GetMatriz($this->request), "historia" => $queryData->GetHistoria()];
    }

    function Existe() {
        return $this->request->session()->has('cubeSum');
    }

    function EvaluarQuery($query) {

        $resultado = "";
        $exQuerytrim = trim($query);
        $tipo = $this->tipoQuery(strlen($exQuerytrim), $exQuerytrim);
        $resultadoT = "Ejecutado " . $this->ExecuteQuery($tipo, $exQuerytrim);
        $resultado = $resultado . "<br>" . $resultadoT;

        return $resultado;
    }

    function tipoQuery($size, $query) {
        if ($size == 1) {
            return "T";
        } else if ($size == 2) {
            return "N-M";
        } else {

            if (strpos($query, "UPDATE")) {
                return "UPDATE";
            } else if (strpos($query, "QUERY")) {
                return "QUERY";
            } else {
                return null;
            }
        }
    }

    function ExecuteQuery($tipo, $query) {
        $data = new \App\Dal\CubeData($this->request);
        if ($tipo == "UPDATE") {
            return "UPDATE";
        } else if ($tipo == "QUERY") {
            return "QUERY";
        } else if ($tipo == "T") {
             $this->request->session()->put('numT', $query);
            return "T se haran ".$this->request->session()->get('numT')." consultas.";
        } else if ($tipo == "N-M") {
             $data->GuadarMatriz($query);
            return "N-M";
        } else {
            return null;
        };
    }

}
