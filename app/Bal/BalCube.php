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
        $ltsquery = explode(" ", $query);

        $tipo = $this->tipoQuery(count($ltsquery), $exQuerytrim);
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
            return "T se haran " . $this->request->session()->get('numT') . " pruebas.";
        } else if ($tipo == "N-M") {
            return "N-M ".$this->Evalua_N_M($query);
        } else {
            return null;
        }
    }

    function Evalua_N_M($query) {
        $ltsquery = explode(" ", $query);
        $contador = 0;
        $result = "";
        $data = new \App\Dal\CubeData($this->request);

        foreach ($ltsquery as &$exQuery) {
            if (is_numeric($exQuery)) {
                if ($contador == 0) {
                    $data->GuadarMatriz($exQuery);
                    $result = $result . " se creo una matriz de " . $exQuery . " * " . $exQuery . " * " . $exQuery;
                } else {
                    $this->request->session()->put('numM', $exQuery);
                    $result = $result . " se pueden hacer " . $exQuery . " consultas ";
                }
                $contador++;
            } else {
                $result= "Han ocurrido errores";
            }
        }
        return $result;
    }

}
