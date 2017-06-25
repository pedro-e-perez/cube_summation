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
         if ($this->request->session()->has('cubeSum')) {
              $this->cubeMatriz=$this->request->session()->get('cubeSum');
         }
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

    private function ActualizaSession()
    {
        $this->request->session()->put('cubeSum', $this->cubeMatriz);
        
    }
    public function GetMatriz() {
        if ($this->request->session()->has('cubeSum')) {
            return $this->request->session()->get('cubeSum');
        } else {
            return "No existe";
        }
    }
    public function updateMatrix($x, $y, $z, $valor)
    {
        $this->cubeMatriz[$x][$y][$z] = $valor;
        $this->ActualizaSession();
    }
    public function GetValue($x, $y, $z)
    {
        return $this->cubeMatriz[$x][$y][$z] ;
    }
    public function Select($x, $y, $z, $x2, $y2, $z2)
    {
        $sum = 0;
        for ($i = $x; $i <= $x2; $i++) {
            for ($j = $y; $j <= $y2; $j++) {
                for ($k = $z; $k <= $z2; $k++) {
                    $sum += $this->cubeMatriz[$i][$j][$k];
                }
            }
        }
        return $sum;
    }

}
