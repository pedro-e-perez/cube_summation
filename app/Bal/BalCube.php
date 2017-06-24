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
        $queryData= new \App\Dal\QueryData( $this->request);
        foreach ($ltsquery as &$exQuery) {
         $queryData->GuardarQuery($exQuery);
        }

        $data = new \App\Dal\CubeData($this->request);
        if (!$this->Existe()) {
            $data->GuadarMatriz(2);
        }
        return ["matriz"=>$data->GetMatriz($this->request),"historia"=>$queryData->GetHistoria()];
    }

    function Existe() {
        return $this->request->session()->has('cubeSum');
    }

}
