<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['rol']=="")
    {   
    header("Location: login.php"); 
    }
    else{
        $rol = $_SESSION['rol'];

        if(isset($_GET['delid']))
        {
            $acid=intval($_GET['delid']);            

            //$sql="DELETE FROM tblstudents WHERE StudentId =:delid";   ELIMINAR ESTUDIANTE     
            $sql="UPDATE tblstudents SET Status = 0 where StudentId=:delid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':delid',$acid,PDO::PARAM_STR);
            $query->execute();
            $msg="Eliminacion de Estudiante exitosa";
        }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gestionar Estudiantes</title>
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
                                    <h2 class="title">Gestionar Estudiantes - <?php if($rol == 1){echo "INMBAT";}else{echo "Colegio";}
                                     ?></h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="admin.php"><i class="fa fa-home"></i> Inicio</a></li>
                                        <li> Estudiantes</li>
            							<li class="active"> Gestionar Estudiantes</li>
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
                                                    <h5>Ver Información de Estudiantes</h5>
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

                                                <table id="example" class="display table table-striped table-bordered" cellspacing="grid-width-100" width="100%">
                                                    <thead>
                                                        <tr>                                                            
                                                            <th>No.</th>
                                                            <th>Nombres y Apellidos</th> 
                                                            <th>Código Personal</th>                                                             
                                                            <!-- <th>domicilio</th> -->  
                                                            <th>Teléfono</th>                                                                                                                          
                                                            <th>Usuario</th>    
                                                            <th>Contraseña</th>                                                                                                                 
                                                            <th>Grado</th>   
                                                            <th>Modificación</th>     
                                                            <th>Modificar</th>                                                         
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>                                                            
                                                            <th>No.</th>                                                           
                                                            <th>Nombres y Apellidos</th>     
                                                            <th>Código Personal</th>                                                             
                                                           <!-- <th>domicilio</th> -->
                                                            <th>Teléfono</th>                                                                                                                          
                                                            <th>Usuario</th>    
                                                            <th>Contraseña</th>                                                                                                                 
                                                            <th>Grado</th>   
                                                            <th>Modificación</th>    
                                                            <th>Modificar</th>                                                        
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
<?php 

if($rol == 1) {
    $sql ="SELECT s.StudentId, s.StudentName, s.cedula, s.Telefono1, s.usuario, s.PassStu, sl.reg_date, sl.upd_date, c.ClassName, c.ClassNameNumeric, c.Section from tblstudents s left join tblclasses c on c.id=s.ClassId left join tblstudents_log sl on sl.student_id = s.StudentId where s.rol_id = 3"; //escuela
}else {
    $sql ="SELECT s.StudentId, s.StudentName, s.cedula, s.Telefono1, s.usuario, s.PassStu, sl.reg_date, sl.upd_date,  c.ClassName, c.ClassNameNumeric, c.Section from tblstudents s left join tblclasses c on c.id=s.ClassId left join tblstudents_log sl on sl.student_id = s.StudentId where s.rol_id = 6"; //colegio
}

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
 <td><?php echo htmlentities($result->cedula);?></td>
 <!--<td><?php //echo htmlentities($result->Domicilio);?></td> -->
 <td><?php echo htmlentities($result->Telefono1);?></td> 
 <td><?php echo htmlentities($result->usuario);?></td>
 <td><?php echo htmlentities($result->PassStu);?></td>
<td><?php echo htmlentities($result->ClassName. ' - ' .$result->ClassNameNumeric);?> - <?php echo htmlentities($result->Section);?></td>
<td><?php echo htmlentities($result->upd_date);?></td>
<td>
    <a href="edit-student.php?stid=<?php echo htmlentities($result->StudentId);?>"><i class="fa fa-edit" title="Edit Record"></i></a>
    <a href="manage-students.php?delid=<?php echo htmlentities($result->StudentId);?>" onclick="confirm('Realmente deseas eliminar este estudiante');"> <img src="images/borrar.png" alt="borrar" style = "width: 20px;
    height: 20px; "> </a>
    <a href="manage-students_class.php?stid=<?php echo htmlentities($result->StudentId);?>" > <img src="images/ver.png" alt="ver" style = "width: 20px;
    height: 20px; "> </a>
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

