<?php
ob_start();
?>
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['rol']!=1 && $_SESSION['rol']!=4)
    {   
    header("Location: login.php"); 
    }
    else{

?>
<!DOCTYPE html>
<html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gestionar Resultados</title>
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
   <?php include('includes/topbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">
<?php include('includes/leftbar.php');?>  

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">Gestionar Resultados</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="admin.php"><i class="fa fa-home"></i> Inicio</a></li>
                                        <li> Estudiantes</li>
            							<li class="active">Gestionar Resultados</li>
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
                                                    <h5>Resultados de Estudiantes</h5>
                                                </div>
                                            </div>
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Bien hecho!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Ha havido algún problema</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                            <div class="panel-body p-20">

                                                <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nombre de Estudiante</th>
                                                            <th>Materia</th>
                                                            <th>Clase</th>
                                                            <th>Primer Bimestre</th>
                                                            <th>Segundo Bimestre</th>
                                                            <th>Tercer Bimestre</th>
                                                            <th>Cuarto Bimestre</th>
                                                            <th>Nota Final</th>
                                                            <th>Estado</th>
                                                            <th>Modificar</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nombre de Estudiante</th>
                                                            <th>Materia</th>
                                                            <th>Clase</th>
                                                            <th>Primer Bimestre</th>
                                                            <th>Segundo Bimestre</th>
                                                            <th>Tercer Bimestre</th>
                                                            <th>Cuarto Bimestre</th>
                                                            <th>Nota Final</th>
                                                            <th>Estado</th>
                                                            <th>Modificar</th> 
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
<?php $sql = "SELECT d.StudentId, d.StudentName, a.id,
                    CONCAT(e.ClassName, ' - ',e.ClassNameNumeric, ' - ',e.Section) as classes,
                    f.descripcion as horario, g.SubjectName as materia,
                    a.primer_corte, a.segundo_corte, a.tercer_corte,a.cuarta_corte, a.nota_final, a.estado
                    FROM tblcalificaciones a 
                    INNER JOIN tblclasses_asignacion b on a.clase_asignacion_id = b.idClassAsig 
                    INNER JOIN tblinscripcion_matricula c on a.inscripcion_matricula_id = c.id
                    INNER JOIN tblstudents d on c.student_id = d.StudentId 
                    INNER JOIN tblclasses e on b.classes_id = e.id 
                    INNER JOIN tblhorario f on b.horario_id = f.id
                    INNER JOIN tblsubjects g on b.subject_id = g.id;";
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
 <td><?php echo htmlentities($result->StudentName);?></td>
 <td><?php echo htmlentities($result->materia);?></td>
 <td><?php echo htmlentities($result->classes);?></td>
  <td><?php echo htmlentities($result->primer_corte);?></td>
  <td><?php echo htmlentities($result->segundo_corte);?></td>
  <td><?php echo htmlentities($result->tercer_corte);?></td>
  <td><?php echo htmlentities($result->cuarta_corte);?></td>
  <td><?php echo htmlentities($result->nota_final);?></td>
  <td><?php if($result->estado==1){
echo htmlentities('Calificando');
}
else if($result->estado==2){
   echo htmlentities('Finalizado'); 
}else{
    echo htmlentities('Bloqueado'); 
}
                                                                ?></td>
                                                                
<td>
    
<a href="edit-result.php?id=<?php echo htmlentities($result->id);?>"><i class="fa fa-edit" title="Edit Record">Modificar</i> </a> 

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

