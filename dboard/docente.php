<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['DocenteId'])=="")
    {
    header("Location: login.php");
    }
    else{

        $DocenteId = $_SESSION['DocenteId'];
        $nombre = "";

        $data = "SELECT * FROM tblteacher a WHERE a.idTeacher = '$DocenteId'";
        $querydata = $dbh->prepare($data);
        $querydata->execute();
        $dataresult=$querydata->fetchAll(PDO::FETCH_OBJ);
        if($querydata->rowCount() > 0)
        {
         foreach($dataresult as $user)
             { 
               $nombre = $user->Name;
             }
         } 


        ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sistema de Gestió de Calificaciosnes</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/toastr/toastr.min.css" media="screen" >
        <link rel="stylesheet" href="css/icheck/skins/line/blue.css" >
        <link rel="stylesheet" href="css/icheck/skins/line/red.css" >
        <link rel="stylesheet" href="css/icheck/skins/line/green.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">
              <?php include('includes/topbar_doc.php');?>
            <div class="content-wrapper">
                <div class="content-container">

                    <?php include('includes/leftbar_doc.php');?>

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-sm-10">
                                    <h2 class="title">Panel de Control - <?php echo ($nombre);?></h2>

                                </div>
                                <!-- /.col-sm-6 -->
                            </div>
                            <!-- /.row -->

                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat bg-primary" href="manage-students_doc.php">
<?php
$sql1 ="SELECT d.StudentId, d.StudentName, 
CONCAT(e.ClassName, ' - ',e.ClassNameNumeric, ' - ',e.Section) as classes,
f.descripcion as horario, g.SubjectName as materia
FROM tblcalificaciones a 
INNER JOIN tblclasses_asignacion b on a.clase_asignacion_id = b.idClassAsig 
INNER JOIN tblinscripcion_matricula c on a.inscripcion_matricula_id = c.id
INNER JOIN tblstudents d on c.student_id = d.StudentId 
INNER JOIN tblclasses e on b.classes_id = e.id 
INNER JOIN tblhorario f on b.horario_id = f.id
INNER JOIN tblsubjects g on b.subject_id = g.id
WHERE b.teacher_id = '$DocenteId' and a.estado = 1 and c.Estado = 1";
$query1 = $dbh -> prepare($sql1);
$query1->execute();
$results1=$query1->fetchAll(PDO::FETCH_OBJ);
$totalstudents=$query1->rowCount();
?>

                                            <span class="number counter"><?php echo htmlentities($totalstudents);?></span>
                                            <span class="name">Estudiantes</span>
                                            <span class="bg-icon"><i class="fa fa-users"></i></span>
                                        </a>
                                        <!-- /.dashboard-stat -->
                                    </div>
                                    <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->
 <?php
$sql3="SELECT d.StudentId, d.StudentName, 
CONCAT(e.ClassName, ' - ',e.ClassNameNumeric, ' - ',e.Section) as classes,
f.descripcion as horario, g.SubjectName as materia
FROM tblcalificaciones a 
INNER JOIN tblclasses_asignacion b on a.clase_asignacion_id = b.idClassAsig 
INNER JOIN tblinscripcion_matricula c on a.inscripcion_matricula_id = c.id
INNER JOIN tblstudents d on c.student_id = d.StudentId 
INNER JOIN tblclasses e on b.classes_id = e.id 
INNER JOIN tblhorario f on b.horario_id = f.id
INNER JOIN tblsubjects g on b.subject_id = g.id
WHERE b.teacher_id = '$DocenteId' and a.estado = 1 and c.Estado = 2";
$query3 = $dbh -> prepare($sql3);
$query3->execute();
$results3=$query3->fetchAll(PDO::FETCH_OBJ);
$totalresults=$query3->rowCount();
?>

                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                        <a class="dashboard-stat bg-danger" href="manage-results_doc.php">
                                            <span class="number counter"><?php echo htmlentities($totalresults);?></span>
                                            <span class="name">Resultados Publicados</span>
                                            <span class="bg-icon"><i class="fa fa-file-text"></i></span>
                                        </a>
                                        <!-- /.dashboard-stat -->
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
        <!-- /.main-wrapper -->

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
                toastr["success"]( "¡Bienvenido al sistema de gestión de resultados para estudiantes!");

            });
        </script>
    </body>

    <div class="foot"><footer>

</footer> </div>

<style> .foot{text-align: center; */}</style>
</html>
<?php } ?>
