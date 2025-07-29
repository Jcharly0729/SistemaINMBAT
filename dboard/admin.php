<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['rol']==1 or $_SESSION['rol']==4)
    {
        $rol = $_SESSION['rol'];
        ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema de Gestion de Calificaciones  | INMBAT </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/toastr/toastr.min.css" media="screen" >
        <link rel="stylesheet" href="css/icheck/skins/line/blue.css" >
        <link rel="stylesheet" href="css/icheck/skins/line/red.css" >
        <link rel="stylesheet" href="css/icheck/skins/line/green.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="https://use.fontawesome.com/d5a577972d.js"></script>
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">
              <?php include('includes/topbar.php');?>
            <div class="content-wrapper">
                <div class="content-container">

                    <?php include('includes/leftbar.php');?>

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-sm-6">
                                    <h2 class="title"> SISTEMA WEB - <?php if($rol == 1){echo "INMBAT";}else{echo "Colegio";}
                                     ?></h2>

                                </div>
                                <!-- /.col-sm-6 -->
                            </div>
                            <!-- /.row -->

                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid form-horizontal">
                                <div class="row">
                                    <div class="col-lg-2.5 col-md-3 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat bg-primary" href="manage-students.php">
<?php
$sql1 = "";
if($rol == 1) {
    $sql1 ="SELECT s.StudentId from tblstudents s where s.rol_id = 3";
}else {
    $sql1 ="SELECT s.StudentId from tblstudents s where s.rol_id = 6";
}

$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$totalstudents=$query1->rowCount();
?>

                                            <span class="number counter"><?php echo htmlentities($totalstudents);?></span>
                                            <span class="name">ESTUDIANTES</span>
                                            <span class="bg-icon"><i class="fa fa-users"></i></span>
                                        </a>
                                        <!-- /.dashboard-stat -->
                                    </div>

                                    <!-- /.-->


                                    <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->

                                    <div class="col-lg-2.5 col-md-3 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat bg-danger" href="manage-subjects.php">
 
<?php 

if($rol == 1) {
    $sql ="SELECT id from  tblsubjects where rol_id = 7"; //escuela
}else {
    $sql ="SELECT id from  tblsubjects where rol_id = 8"; //colegio
}

$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$totalsubjects=$query->rowCount();
?> 
                                            <span class="number counter"><?php echo htmlentities($totalsubjects);?></span>
                                            <span class="name">CURSOS</span>
                                            <span class="bg-icon"><i class="fa fa-"></i></span>
                                        </a>
                                        <!-- /.dashboard-stat -->
                                    </div>

                                    <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->
                                    
                                     <div class="col-lg-2.5 col-md-3 col-sm-3 col-xs-12">
                                        <a class="dashboard-stat bg-info" href="manage-docentes.php">
<?php
if($rol == 1) {
$sql5 ="SELECT idTeacher from tblteacher where rol_id = 2";
}else {
$sql5 ="SELECT idTeacher from tblteacher where rol_id = 5";
}
$query5 = $dbh -> prepare($sql5);
$query5->execute();
$results5=$query5->fetchAll(PDO::FETCH_OBJ);
$totalteacher=$query5->rowCount();
?>

<?php
if($rol == 1) {
$sql6 ="SELECT id from tblhorario where rol_id = 7";
}else {
$sql6 ="SELECT id from tblhorario where rol_id = 8";
}
$query6 = $dbh -> prepare($sql6);
$query6->execute();
$results6=$query6->fetchAll(PDO::FETCH_OBJ);
$totalhorario=$query6->rowCount();
?>

                                            <span class="number counter"><?php echo htmlentities($totalhorario);?></span>
                                            <span class="name">HORARIOS</span>
                                            <span class="bg-icon"><i class="fa fa-edit"></i></span>
                                        </a>

                                        
                                        <!---->
                                    </div>
                                    

                                    <div class="col-lg-2.5 col-md-3 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat bg-warning" href="manage-classes.php">
                                        <?php

if($rol == 1) {
    $sql2 ="SELECT id from  tblclasses where rol_id = 7"; //escuela
}else {
    $sql2 ="SELECT id from  tblclasses where rol_id = 8"; //colegio
}

$query2 = $dbh -> prepare($sql2);
$query2->execute();
$results2=$query2->fetchAll(PDO::FETCH_OBJ);
$totalclasses=$query2->rowCount();
?>
                                            <span class="number counter"><?php echo htmlentities($totalclasses);?></span>
                                            <span class="name">GRADO</span>
                                            <span class="bg-icon"><i class="fa fa-bank"></i></span>
                                        </a>                                    
                                        </div>
<div><br><br><br><br><br><br></div>

                                        <!---->

                                        <div class="col-lg-2.5 col-md-3 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat bg-warning" href="manage-pension.php">
                                        <?php

if($rol == 1) {
    $sql4 ="SELECT m.idPension from  tblpensiones m inner join tblstudents s on s.StudentId = m.StudentId where s.rol_id = 3 and m.Status = 1"; //escuela
}else {
    $sql4 ="SELECT m.idPension from  tblpensiones m inner join tblstudents s on s.StudentId = m.StudentId where s.rol_id = 6 and m.Status = 1"; //colegio
}

$query4 = $dbh -> prepare($sql4);
$query4->execute();
$results4=$query4->fetchAll(PDO::FETCH_OBJ);
$totalpensiones=$query4->rowCount();
?>

<?php
$sql3="SELECT  distinct StudentId from  tblmatricula ";
$query3 = $dbh -> prepare($sql3);
$query3->execute();
$results3=$query3->fetchAll(PDO::FETCH_OBJ);
$totalresults=$query3->rowCount();
?>

  <span class="number counter"><?php echo htmlentities($totalresults);?></span>
  <span class="name">CALIFICACIONES</span>
  <span class="bg-icon"><i class="fa fa-file-text"></i></span></a></div>
                                    </div>
                                    <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->                              
                     
          
           
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->

                    </div>
                    <!-- /.main-page -->


                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- /.main-w -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>
        <script src="js/waypoint/waypoints.min.js"></script>
        <script src="js/counterUp/jquery.counterup.min.js"></script>
        <script src="js/amcharts/amcharts.js"></script>
        <script src="js/amcharts/serial.js"></script>
        <script src="js/amcharts/plugins/export/export.min.js"></script>
        <link rel="stylesheet" href="js/amcharts/plugins/export/export.css" type="text/css" media="all" />
        <script src="js/amcharts/themes/light.js"></script>
        <script src="js/toastr/toastr.min.js"></script>
        <script src="js/icheck/icheck.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script src="js/production-chart.js"></script>
        <script src="js/traffic-chart.js"></script>
        <script src="js/task-list.js"></script>
        <script>
            $(function(){

                // Counter for dashboard stats
                $('.counter').counterUp({
                    delay: 10,
                    time: 1000
                });

                // Welcome notification
                toastr.options = {
                  "closeButton": true,
                  "debug": false,
                  "newestOnTop": false,
                  "progressBar": false,
                  "positionClass": "toast-top-right",
                  "preventDuplicates": false,
                  "onclick": null,
                  "showDuration": "300",
                  "hideDuration": "1000",
                  "timeOut": "5000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut"
                }
                toastr["success"]( "BIENVENIDOS A NEUSTRO SISTEMA DE AUTOMATIZACIÓN DE CALIFICACIONES Y DATOS PERSONALES DE ESTUDIANTES");

            });
        </script>
    </body>

    <div class="foot"><footer>

</footer> </div>

<style> .foot{text-align: center; */}</style>
</html>
    <?php
    }
    else{
        header("Location: login.php");
 } ?>
