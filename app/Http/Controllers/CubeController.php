<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CubeController extends Controller
{
    //
    public function Index()
    {
        return view('cube.index');
    }
}
