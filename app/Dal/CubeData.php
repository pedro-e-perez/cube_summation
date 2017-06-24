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
    //put your
    function __construct()
    {
    }
    
    public function GetMatriz( $request)
    {
       if($request->session()->has('cubeSum'))
       {
           return "existe";
           
       }
       else
       {
             return "No existe";
           
       }
               
        
    }
}
