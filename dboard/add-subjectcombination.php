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

$class=$_POST['class'];
$subject=$_POST['subject']; 
$horario=$_POST['horario'];
$teacher=$_POST['teacher']; 
$status=1;
$sql="INSERT INTO  tblclasses_asignacion (classes_id,horario_id, subject_id, teacher_id,Status) VALUES(:class,:horario,:subject,:teacher,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':class',$class,PDO::PARAM_STR);
$query->bindParam(':subject',$subject,PDO::PARAM_STR);
$query->bindParam(':horario',$horario,PDO::PARAM_STR);
$query->bindParam(':teacher',$teacher,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Curso agregado exitosamente";
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
        <title>Agregar Curso </title>
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
    <h2 class="title">Agregar Curso</h2></div></div>
            <!-- /.row -->
<div class="row breadcrumb-div">
 <div class="col-md-6">
  <ul class="breadcrumb">
   <li><a href="admin.php"><i class="fa fa-home"></i> Inicio</a></li>
    <li> Curso</li>
     <li class="active">Agregar Curso</li></ul></div></div></div>
<div class="container-fluid">
 <div class="row">
  <div class="col-md-12">
   <div class="panel">
    <div class="panel-heading">
     <div class="panel-title">
      <h5>Agregar Curso</h5></div></div>

<div class="panel-body">
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Bien hecho!</strong><?php echo htmlentities($msg); ?></div>
<?php } 
else if($error){?>
 <div class="alert alert-danger left-icon-alert" role="alert">
  <strong>oh rayos!!</strong> <?php echo htmlentities($error); ?></div><?php } ?>

<form class="form-horizontal" method="post">
<div class="form-group">
 <label for="default" class="col-sm-2 control-label">Grado Escolar</label>
  <div class="col-sm-10">
  <select name="class" class="form-control" id="default" required="required">
<option value="">Selecciona el grado escolar</option>
<?php



if($rol == 1) {    
    $sql = "SELECT * from tblclasses c where c.rol_id = 7 and c.Status = 1";
}else {
    $sql="SELECT * from tblclasses c where c.rol_id = 8 and c.Status = 1";
}

$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
<option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->ClassName. ' - '.$result->ClassNameNumeric); ?>&nbsp; Sección - <?php echo htmlentities($result->Section); ?></option>
<?php }} ?></select></div></div>


<div class="form-group">
 <label for="default" class="col-sm-2 control-label">Curso</label>
  <div class="col-sm-10">
 <select name="subject" class="form-control" id="default" required="required">
<option value="">Selecciona el curso</option>
<?php 


if($rol == 1) {    
    $sql = "SELECT * from tblsubjects s where s.rol_id = 7 and s.Status = 1";
}else {
    $sql="SELECT * from tblsubjects s where s.rol_id = 8 and s.Status = 1";
}

$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
<option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->SubjectName); ?></option>
<?php }} ?></select></div></div>


<div class="form-group">
 <label for="default" class="col-sm-2 control-label">Horario</label>
  <div class="col-sm-10">
 <select name="horario" class="form-control" id="default" required="required">
<option value="">Selecciona el horario</option>
<?php 

if($rol == 1) {    
    $sql = "SELECT * from tblhorario h where h.rol_id = 7";
}else {
    $sql="SELECT * from tblhorario h where h.rol_id = 8";
}

$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
<option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->descripcion); ?></option>
<?php }} ?></select></div></div>


<div class="form-group">
 <label for="default" class="col-sm-2 control-label">Docente</label>
  <div class="col-sm-10">
 <select name="teacher" class="form-control" id="default" required="required">
<option value="">Selecciona el docente</option>
<?php

if($rol == 1) {    
    $sql = "SELECT * from tblteacher t where t.rol_id = 2 and t.Status = 1";
}else {
    $sql="SELECT * from tblteacher t where t.rol_id = 5 and t.Status = 1";
}

$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
<option value="<?php echo htmlentities($result->idTeacher); ?>"><?php echo htmlentities($result->Name); ?></option>
<?php }} ?></select></div></div>

<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
  <button type="submit" name="submit" class="btn btn-primary">Agregar</button></div></div></form></div></div></div></div></div></div></div></div>
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
     $(".js-states-limit").select2({maximumSelectionLength: 2});
                $(".js-states-hide").select2({minimumResultsForSearch: Infinity});
            });
        </script>
    </body>
</html>
<?PHP } ?>
