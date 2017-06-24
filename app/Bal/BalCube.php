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
class BalCube {
    //put your code here
    public function EjecutarQuery($request)
    {
        $data= new App\Dal\CubeData();
        return $data->GetMatriz($request);
        
    }
}
