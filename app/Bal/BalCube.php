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
    private $IsError;
    private $MsgError;

    function __construct($request) {
        $this->request = $request;
        $this->IsError = false;
    }

    public function IsError() {
        return $this->IsError;
    }

    public function Error() {
        return $this->MsgError;
    }

    public function SetError($ErrorNew) {
        $this->MsgError = $this->MsgError . "<br> " . $ErrorNew;
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

        return ["matriz" => $data->GetMatriz($this->request), "historia" => $queryData->GetHistoria(), "IsError" => $this->IsError(), "MsgError" => $this->Error()];
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
        if ($size == 1 && strpos($query, "UPDATE") === false && strpos($query, "QUERY") === false) {
            return "T";
        } else if ($size == 2 && strpos($query, "UPDATE") === false && strpos($query, "QUERY") === false) {
            return "N-M";
        } else {

            if (strpos($query, "UPDATE") >= 0 && strpos($query, "QUERY") === false) {
                return "UPDATE";
            } else if (strpos($query, "QUERY") >= 0 && strpos($query, "UPDATE") === false) {
                return "QUERY";
            } else {
                return null;
            }
        }
    }

    function ExecuteQuery($tipo, $query) {
        $data = new \App\Dal\CubeData($this->request);
        if ($tipo == "UPDATE") {
            return "UPDATE <span class=\"label label-primary\"> Resultado </span>" . $this->Update($query);
        } else if ($tipo == "QUERY") {
            return "QUERY" . $this->Select($query);
        } else if ($tipo == "T") {
            $this->request->session()->put('numT', $query);
            if ((int) $query <= 50) {
                return "<br><span class=\"label label-primary\"> Resultado </span>T se haran  " . $this->request->session()->get('numT') . " pruebas.";
            } else {

                $this->SetError("T >50");
                $this->IsError = true;
            }
        } else if ($tipo == "N-M") {
            return "N-M " . $this->Evalua_N_M($query);
        } else {
            $this->SetError("No se pudo ejecutar el Query");
            $this->IsError = true;
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
                    if ((int) $exQuery <= 100) {
                        $data->GuadarMatriz($exQuery);
                        $this->request->session()->put('numN', $exQuery);
                        $result = $result . "<br> <span class=\"label label-primary\"> Resultado </span> se creo una matriz de " . $exQuery . " * " . $exQuery . " * " . $exQuery;
                    } else {

                        $this->SetError("N >50");
                        $this->IsError = true;
                    }
                } else {
                    if ((int) $exQuery <= 1000) {
                        $this->request->session()->put('numM', $exQuery);
                        $result = $result . "<br><span class=\"label label-primary\"> Resultado </span>  se pueden hacer " . $exQuery . " consultas ";
                    } else {

                        $this->SetError("M >50");
                        $this->IsError = true;
                    }
                }
                $contador++;
            } else {
                $this->SetError("No se pudo ejecutar el Query");
                $this->IsError = true;
                $result = "Han ocurrido errores";
            }
        }
        return $result;
    }

    function Update($query) {
        $query = trim(str_replace("UPDATE", "", $query));
        $ltsquery = explode(" ", $query);
        $contador = 0;
        $result = "";
        $data = new \App\Dal\CubeData($this->request);
        $x = $ltsquery[0];
        $y = $ltsquery[1];
        $z = $ltsquery[2];
        $valor = $ltsquery[3];
        $data->updateMatrix($x, $y, $z, $valor);
        $result = "<br> <span class=\"label label-primary\"> Resultado </span> Se actualizo el campo x=" . $x . " y=" . $y . " z=" . $z . " Valor=" . $data->GetValue($x, $y, $z);
        return $result;
    }

    function Select($query) {
        $query = trim(str_replace("QUERY", "", $query));
        $ltsquery = explode(" ", $query);
        $nValue =(int) $this->request->session()->get('numN');
        $contador = 1;
        $result = "";
        $data = new \App\Dal\CubeData($this->request);
        $x = 0;
        $y = 0;
        $z = 0;
        $x2 = 0;
        $y2 = 0;
        $z2 = 0;
        foreach ($ltsquery as &$exQuery) {
            if (is_numeric($exQuery)) {
                $value = (int) $exQuery;
                if ($contador == 1) {
                    $x = $value;
                } else if ($contador == 2) {
                    $y = $value;
                } else if ($contador == 3) {
                    $z = $value;
                } else if ($contador == 4) {
                    $x2 = $value;
                } else if ($contador == 5) {
                    $y2 = $value;
                } else if ($contador == 6) {
                    $z2 = $value;
                }

                $contador ++;
            }
        }

        if (($x <= $x2 && $x2 <= $nValue) && ($y <= $y2 && $y2 <= $nValue) && ($z <= $z2 && $z2 <= $nValue)) {
            $result = "<br> <span class=\"label label-primary\"> Resultado </span>  La consulta arroja el siguiente valor:" . $data->Select($x, $y, $z, $x2, $y2, $z2);
        } else {

            $this->SetError("1 <= x1 <= x2 <= N 
1 <= y1 <= y2 <= N 
1 <= z1 <= z2 <= N ".$nValue);
            $this->IsError = true;
        }


       
        return $result;
    }

}
