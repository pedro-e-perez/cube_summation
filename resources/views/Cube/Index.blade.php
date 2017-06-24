
@extends('layouts.app')

@section('title', 'Inicio')

@section('sidebar')
@parent

@endsection

@section('content')

<h1>www.hackerrank.com</h1>
 <input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-bar-chart" aria-hidden="true"></i> Resumen </div>
    <div class="panel-body">
        <div class="resumen">
            <div class="contresumen"></div>
            
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-terminal" aria-hidden="true"></i> Queryes </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-10">       
                <textarea id="txtQuey" rows="4" cols="50" class="terminal"></textarea>

            </div> 
            <div class="col-lg-2">
                <button id="btnEjecutar" class="btn btn-success"><i class="fa fa-play" aria-hidden="true"></i> Ejecutar</button>
            </div>

        </div>   


    </div>
</div>


@endsection
@section('scriptsPage')

<script src="../../../js/App/Cube.js" type="text/javascript"></script>

<script>
    $(document).ready(page.init());

</script>
@endsection