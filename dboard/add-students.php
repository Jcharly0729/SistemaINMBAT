<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['rol']=="")
    {   
    header("Location: login.php "); 
    }
    else{
        $rol = $_SESSION['rol'];
if(isset($_POST['submit']))
{
$studentname=$_POST['fullname'];
$cedula=$_POST['cedula'];
$domicilio=$_POST['domicilio'];
$telefono1=$_POST['telefono1'];
$gender=$_POST['gender']; 
$dob=$_POST['dob']; 
$edad=$_POST['edad']; 
$nacionalidad=$_POST['nacionalidad']; 
$comentario=$_POST['comentario']; 
$usuario=$_POST['usuario'];
$pass=$_POST['pass'];
$classid=$_POST['class']; 
$status=1;

if($rol == 1) {    
    $sql="INSERT INTO  tblstudents(StudentName,cedula, Domicilio, Telefono1, Gender, DOB, Edad, Nacionalidad, Comentarios, ClassId, Status, usuario, PassStu, rol_id) VALUES(:studentname, :cedula,:domicilio,:telefono1,:gender,:dob,:edad,:nacionalidad,:comentario,:classid,:status,:usuario,:pass, 3)";
}else {
    $sql="INSERT INTO  tblstudents(StudentName,cedula, Domicilio, Telefono1, Gender, DOB, Edad, Nacionalidad, Comentarios, ClassId, Status, usuario, PassStu, rol_id) VALUES(:studentname, :cedula,:domicilio,:telefono1,:gender,:dob,:edad,:nacionalidad,:comentario,:classid,:status,:usuario,:pass, 6)";
}


$query = $dbh->prepare($sql);
$query->bindParam(':studentname',$studentname,PDO::PARAM_STR);
$query->bindParam(':cedula',$cedula,PDO::PARAM_STR);
$query->bindParam(':domicilio',$domicilio,PDO::PARAM_STR);
$query->bindParam(':telefono1',$telefono1,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':edad',$edad,PDO::PARAM_STR);
$query->bindParam(':nacionalidad',$nacionalidad,PDO::PARAM_STR);
$query->bindParam(':comentario',$comentario,PDO::PARAM_STR);
$query->bindParam(':usuario',$usuario,PDO::PARAM_STR);
$query->bindParam(':pass',$pass,PDO::PARAM_STR);
$query->bindParam(':classid',$classid,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Estudiante ingresado correctamente ";
}
else 
{
$error="Something went wrong. Please try again";
}

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>REGISTRO DE ESTUDIANTES </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/select2/select2.min.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
  <?php include('includes/topbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->
                   <?php include('includes/leftbar.php');?>  
                    <!-- /.left-sidebar -->

                    <div class="main-page">

                     <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title"> REGISTRO DE ESTUDIANTES - <?php if($rol == 1){echo "INMBAT";}else{echo "Colegio";}
                                     ?></h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="admin.php"><i class="fa fa-home"></i> Inicio</a></li>
                                
                                        <li class="active">Agregar Alumno</li>
                                    </ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <div class="container-fluid">
                           
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>REGISTRO DE ESTUDIANTES </h5>
                                                </div>
                                            </div>
                                            <div class="panel-body">
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Bien hecho - </strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Algo ha salido mal</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                                <form class="form-horizontal" method="post">

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Nombres y Apellidos </label>
<div class="col-sm-6">
<input type="text" name="fullname" class="form-control" id="fullname" required="required" autocomplete="off"></div></div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Código Personal</label>
<div class="col-sm-6">
<input type="text" name="cedula" class="form-control" id="cedula" required="required" autocomplete="off"></div></div>


<div class="form-group">
<label for="default" class="col-sm-2 control-label">Dirección</label>
<div class="col-sm-6">
<input type="text" name="domicilio" class="form-control" id="domicilio" required="required" autocomplete="off"></div></div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Teléfono</label>
<div class="col-sm-6">
<input type="text" name="telefono1" class="form-control" id="telefono1" required="required" autocomplete="off"></div></div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Género</label>
<div class="col-sm-6">
<input type="radio" name="gender" value="Male" required="required" checked=""> Masculino <input type="radio" name="gender" value="Female" required="required"> Femenino </div></div>

<div class="form-group">
<label for="date" class="col-sm-2 control-label">Fecha de Nacimiento</label>
<div class="col-sm-6">
<input type="date"  name="dob" class="form-control" id="dob"></div></div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Edad</label>
<div class="col-sm-6">
<input type="number" name="edad" class="form-control" id="edad" required="required" autocomplete="off"></div></div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Usuario</label>
<div class="col-sm-6">
<input type="text" name="usuario" class="form-control" id="usuario" required="required" autocomplete="off"></div></div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Contraseña</label>
<div class="col-sm-6">
<input type="text" name="pass" class="form-control" id="pass" required="required" autocomplete="off"></div></div>


<div class="form-group">
<label for="default" class="col-sm-2 control-label">Grado Escolar</label>
<div class="col-sm-6">
 <select name="class" class="form-control" id="default" required="required">
<option value="">Selecciona grado a cursar</option>
<?php 


if($rol == 1) {    
    $sql3 = "SELECT * from tblclasses  WHERE rol_id = 7"; // Escuela
}else {
    $sql3="SELECT * from tblclasses  WHERE rol_id = 8"; //Colegio
}

$query3 = $dbh->prepare($sql3);
$query3->execute();
$results3=$query3->fetchAll(PDO::FETCH_OBJ);
if($query3->rowCount() > 0)
{
foreach($results3 as $result3)
{   ?>
<option value="<?php echo htmlentities($result3->id); ?>"><?php echo htmlentities($result3->ClassName. ' - ' .$result3->ClassNameNumeric); ?>&nbsp; Section-<?php echo htmlentities($result3->Section); ?></option>
<?php }} ?>
 </select>
                                                        </div>
                                                    </div>


<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" name="submit" class="btn btn-primary">Registrar</button>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-12 -->
                                </div>
                    </div>
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/select2/select2.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $(".js-states").select2();
                $(".js-states-limit").select2({
                    maximumSelectionLength: 2
                });
                $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
                });
            });
        </script>
    </body>
</html>
<?PHP } ?>
