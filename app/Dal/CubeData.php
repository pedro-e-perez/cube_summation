<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CubeData
 *
 * @author pedro_2
 */

namespace App\Dal;

class CubeData {

    private $request,$cubeMatriz;

    function __construct($request) {
        $this->request = $request;
    }

   

    public function GuadarMatriz($n) {
         for ($i = 0; $i <= $n; $i++) {
            for ($j = 0; $j <= $n; $j++) {
                for ($k = 0; $k <= $n; $k++) {
                    $this->cubeMatriz[$i][$j][$k] = 0;
                }
            }
        }
        $this->request->session()->put('cubeSum', $this->cubeMatriz);
    }

    
    public function GetMatriz() {
        if ($this->request->session()->has('cubeSum')) {
            return $this->request->session()->get('cubeSum');
        } else {
            return "No existe";
        }
    }

}
