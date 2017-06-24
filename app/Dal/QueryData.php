<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Dal;

/**
 * Description of QueryData
 *
 * @author pedro_2
 */
class QueryData {

    private $request;

    function __construct($request) {
        $this->request = $request;
    }

    //put your code here
    public function GuardarQuery($query) {
        $saveQuery = $this->request->session()->get('recordingQuery');
        $query += "\n" + $saveQuery;
        return $saveQuery;
    }

    public function GetHistoria() {
        if ($this->request->session()->has('recordingQuery')) {
            return $this->request->session()->get('recordingQuery');
        } else {
            return "No existe";
        }
    }

}
