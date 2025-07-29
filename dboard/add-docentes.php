<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['rol']=="")
    {   
    header("Location: login.php "); 
    }
    else{
        $rol_id = $_SESSION['rol'];
if(isset($_POST['submit']))
{
$name=$_POST['name'];
$classId=$_POST['classId'];
$user=$_POST['user'];
$pass=$_POST['pass'];
$rol=$_POST['rol'];

$status=1;

$sql="INSERT INTO tblteacher(Name, ClassId, Status, User, Pass, rol_id) VALUES (:name, :classId, :status, :user, :pass, :rol)";


$query = $dbh->prepare($sql);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':classId',$classId,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':user',$user,PDO::PARAM_STR);
$query->bindParam(':pass',$pass,PDO::PARAM_STR);
$query->bindParam(':rol',$rol,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Docente Ingresado Exitósamente";
}
else 
{
$error="Ha ocurrido un erro. Por favor intente de nuevo";
}

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Agregar Docente</title>
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
                                    <h2 class="title">Agregar Docente</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="admin.php"><i class="fa fa-home"></i> Inicio</a></li>
                                
                                        <li class="active">Agregar Docente</li>
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
                                                    <h5>Registro de  Docentes</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body">
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Bien hecho!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Ha ocurrido un error. Intente de nuevo!!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                                <form class="form-horizontal" method="post">

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Nombres y Apellidos</label>
<div class="col-sm-6">
<input type="text" name="name" class="form-control" id="name" required="required" autocomplete="off"></div></div>


<div class="form-group">
<label for="default" class="col-sm-2 control-label">Grados que imparte</label>
<div class="col-sm-6">
 <select name="classId" class="form-control" id="default" required="required">
<option value="">Selecciona el año escolar</option>
<?php 



if($rol_id == 1) {    
    $sql = "SELECT * from tblclasses  WHERE rol_id = 7"; // Escuela
}else {
    $sql="SELECT * from tblclasses  WHERE rol_id = 8"; //Colegio
}

$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
<option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->ClassName); ?>&nbsp; Section-<?php echo htmlentities($result->Section); ?></option>
<?php }} ?>
 </select>
</div>
</div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Usuario</label>
<div class="col-sm-6">
<input type="text" name="user" class="form-control" id="user"  autocomplete="off"></div></div>


<div class="form-group">
<label for="default" class="col-sm-2 control-label">Contraseña</label>
<div class="col-sm-6">
<input type="text" name="pass" class="form-control" id="pass" autocomplete="off"></div></div>

<div class="form-group">
<label for="default" class="col-sm-2 control-label">Cargo del Docente</label>
<div class="col-sm-6">
 <select name="rol" class="form-control" id="default" required="required">
<option value="">Selecciona año escolar</option> 
<?php if($rol_id ==1){?>
<option value="1">Administrador</option> 
<option value="2">Docente</option> 
<?php }else{ ?>
    <option value="4">Administrador</option> 
    <option value="5">Docente</option> 
<?php }?>
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
