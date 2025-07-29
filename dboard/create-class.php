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
if(isset($_POST['submit']))
{
$classname=$_POST['classname'];
$section=$_POST['section'];

if($rol == 1) {    
    $sql="INSERT INTO  tblclasses(ClassName,Section, rol_id, Status) VALUES(:classname,:section, 7, 1)";
}else {
    $sql="INSERT INTO  tblclasses(ClassName,Section, rol_id, Status) VALUES(:classname,:section, 8, 1)";
}

$query = $dbh->prepare($sql);
$query->bindParam(':classname',$classname,PDO::PARAM_STR);
$query->bindParam(':section',$section,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Grado Escolar creado";
}
else 
{
$error="Algo salió mal. Favor reintentar";
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Añadir Grado Escolar</title>
        <link rel="stylesheet" href="css/bootstrap.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
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
}</style></head>
    
<body class="top-navbar-fixed">
 <div class="main-wrapper">
<?php include('includes/topbar.php');?>   
 <div class="content-wrapper">
 <div class="content-container">

<?php include('includes/leftbar.php');?>                   
 <!-- /.left-sidebar -->
<div class="main-page">
 <div class="container-fluid">
  <div class="row page-title-div">
   <div class="col-md-6">
   <h2 class="title">Añadir Grado Escolar</h2></div></div>
                            <!-- /.row -->
<div class="row breadcrumb-div">
 <div class="col-md-6">
  <ul class="breadcrumb">
   <li><a href="admin.php"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Grado Escolar </a></li>
    <li class="active">Crear Grado Escolar</li></ul></div></div></div>
<Sección class="Sección">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-8 col-md-offset-2">
    <div class="panel">
     <div class="panel-heading">
      <div class="panel-title">
       <h5>Añadir Grado Escolar</h5></div></div>
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Bien hecho - </strong><?php echo htmlentities($msg); ?></div><?php } 
else if($error){?> <div class="alert alert-danger left-icon-alert" role="alert">
<strong>Ha ocurrido un error</strong> <?php echo htmlentities($error); ?></div><?php } ?>
  
<div class="panel-body">
 <form method="post">
  <div class="form-group has-success">
   <label for="success" class="control-label">Nombre Grado Escolar</label>
  <div class="">
   <input type="text" name="classname" class="form-control" required="required" id="success">
<div class="form-group has-success">
 <label for="success" class="control-label">Sección</label>
<div class="">
 <input type="text" name="section" class="form-control" required="required" id="success">
<div class="form-group has-success">
<div class="">
 <button type="submit" name="submit" class="btn btn-success btn-labeled">Añadir<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button></div></form></div></div></div></div></div></section></div></div></div></div>
 <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->
    </body>
</html>
<?php  } ?>
