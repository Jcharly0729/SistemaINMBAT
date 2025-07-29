<?php
ob_start();
?>

<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['StudentId'])=="")
    {   
    header("Location: login.php"); 
    }
    else{
        $StudentId = $_SESSION['StudentId'];
        $nombre = "";

        $data = "SELECT * FROM tblstudents a WHERE a.StudentId = '$StudentId'";
        $querydata = $dbh->prepare($data);
        $querydata->execute();
        $dataresult=$querydata->fetchAll(PDO::FETCH_OBJ);
        if($querydata->rowCount() > 0)
        {
         foreach($dataresult as $user)
             { 
               $nombre = $user->StudentName;
             }
         } 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Revisar Matricula de Materias</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
          <style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
        </style>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
   <?php include('includes/topbar_alu.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">
<?php include('includes/leftbar_alu.php');?>  

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Revisar Matricula de Materias</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="estudiante_panel.php"><i class="fa fa-home"></i> Inicio</a></li>
                                        <li> Matricula</li>
            							<li class="active">Ver Matricula</li>
            						</ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">

                             

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Ver Información de Matricula - <?php echo ($nombre); ?></h5>
                                                </div>
                                            </div>
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Bien hecho!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>oh rayos!!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                            <div class="panel-body p-20">

                                                <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>                                                            
                                                            <th>Docente</th>   
                                                            <th>Clase</th>                                                           
                                                            <th>Materia</th>
                                                            <th>Horario</th>
                                                            <th>Credito</th>
                                                            <th>Costo</th>
                                                            <th>Estado</th>                                                            
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>                                                            
                                                            <th>Docente</th>   
                                                            <th>Clase</th>                                                           
                                                            <th>Materia</th>
                                                            <th>Horario</th>
                                                            <th>Credito</th>
                                                            <th>Costo</th>
                                                            <th>Estado</th>                                                            
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
<?php 



    $sql ="SELECT a.id, CONCAT(d.ClassName, ' - ',d.ClassNameNumeric, ' - ',d.Section) as classes, a.estado as Status,
        e.descripcion as horario, f.SubjectName, f.Creditos, f.Costo, g.Name as teacher
        FROM tblcalificaciones a
        INNER JOIN tblinscripcion_matricula b on a.inscripcion_matricula_id = b.id
        INNER JOIN tblclasses_asignacion c on a.clase_asignacion_id = c.idClassAsig
        INNER JOIN tblclasses d on c.classes_id = d.id
        INNER JOIN tblhorario e on c.horario_id = e.id
        INNER JOIN tblsubjects f on c.subject_id = f.id
        INNER JOIN tblteacher g on c.teacher_id = g.idTeacher
        WHERE (b.Estado = 1 and b.student_id = '$StudentId' and a.estado = 1)"; //escuela

$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
<tr>
 <td><?php echo htmlentities($cnt);?></td>
                                                            <td><?php echo htmlentities($result->teacher);?></td>
                                                            <td><?php echo htmlentities($result->classes);?></td>                                                            
                                                            <td><?php echo htmlentities($result->SubjectName);?></td>
                                                            <td><?php echo htmlentities($result->horario);?></td>
                                                            <td><?php echo htmlentities($result->Creditos);?></td>      
                                                            <td><?php echo htmlentities($result->Costo);?></td>                                                            
                                                            <td><?php if($result->Status==1){
                                                                echo htmlentities('Activo');
                                                                }
                                                                else{
                                                                echo htmlentities('Bloqueado'); 
                                                                }?></td>
<td>
    <!--
<a href="edit-class.php?classid=<?php //echo htmlentities($result->idPension);?>"><i class="fa fa-edit" title="Edit Record"></i> </a> 
-->
</td>
</tr>
<?php $cnt=$cnt+1;}} ?>
                                                       
                                                    
                                                    </tbody>
                                                </table>

                                         
                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-6 -->

                                                               
                                                </div>
                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                        <!-- /.panel -->
                                    </div>
                                    <!-- /.col-md-6 -->

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
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $('#example').DataTable();

                $('#example2').DataTable( {
                    "scrollY":        "300px",
                    "scrollCollapse": true,
                    "paging":         false
                } );

                $('#example3').DataTable();
            });
        </script>
    </body>
</html>
<?php } ?>
<?php
ob_end_flush();
?>

