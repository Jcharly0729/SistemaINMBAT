<?php
session_start();
error_reporting(0);
include('includes/config.php');?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema de Gestión de Resultados Escolares</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="CSS/Maste.css">
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/icheck/skins/flat/blue.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        
    </head>
    <body class="">
        <div class="wrapper fadeInDown">
            <div id="formContent" >
                <div class="fadeIn first">
                    <div class="col-smush-1">
                    <img src="images/logo (2).png"></div> </div>
                    <h3 class="active">Consulta de calificaciones </h3>

                    <form action="result.php" method="post">                                	
                
                        <div class="form-group">
                            <select name="periodo" class="form-control" id="default" required="required">
                                <option value="" class="fadeIn">Seleccione el periodo escolar</option>
                                <option value="1" class="fadeIn">Primer Periodo</option>
                                <option value="2" class="fadeIn">Segundo Periodo</option>
                            </select>
                        </div>

                        <div class="form-group mt-20">
                            <div class="button">                            
                                <input type="submit" class="fadeIn second" id="buscar" name="buscar" value="Buscar"></input>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <a href="estudiante_panel.php"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver </a>
                        </div>
                    </form>

                    <hr>

                </div>
            </div>
        </div>

       <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/modernizr/modernizr.min.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/icheck/icheck.min.js"></script>
       

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function(){
                $('input.flat-blue-style').iCheck({
                    checkboxClass: 'icheckbox_flat-blue'
                });
            });
        </script>

        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>