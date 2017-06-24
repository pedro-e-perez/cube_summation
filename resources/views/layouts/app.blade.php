<!-- Stored in resources/views/layouts/app.blade.php -->
<html lang="en">
    <head>
        <title>Rappi Test</title>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js" type="text/javascript"></script>
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    </head>
    <body>
        <style>
            .hvr-sweep-to-right:hover:before, .hvr-sweep-to-right:focus:before, .hvr-sweep-to-right:active:before {
                -webkit-transform: scaleX(1);
                transform: scaleX(1);
            }
            .hvr-sweep-to-right:before {
                border: 1px solid #b2a6ce;
                background-color: #ffffff;
            }
        </style>
        @section('sidebar')
        <div class="row" style="height: 80px;">
            <div class="col-lg-12">
                <a class="navbar-brand pull-left" href="#"> <i class="fa fa-cubes fa-4x" aria-hidden="true"></i></a>
                <h1>Cube Summation</h1>

            </div>
        </div>
        @show

        <div class="container">
            @yield('content')
        </div>
        <hr>
        <footer>


            <div class="row">
                <div  class="col-sm-4" ></div>
                <div  class="col-sm-4" ><p>Copyright © <span itemprop="name">
                            <a href="http:\\www.rolavsp.com"> Pedro Enrique PErez</a></span> <?php echo date("Y"); ?></p></div>
                <div  class="col-sm-4" ></div>
            </div>

        </footer>

        <!-- scripts-->
        @yield('scriptsPage')
    </body>
</html>