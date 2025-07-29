<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: login.php"); 
    }
    else{
if(isset($_POST['submit']))
{
$teacher=$_POST['teacher']; 
$subject=$_POST['subject'];
$class=$_POST['class'];
$status=1;
$sql="INSERT INTO tblsubjectcombination(ClassId,SubjectId,idTeacher,status) VALUES(:class,:subject,:teacher,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':class',$teacher,PDO::PARAM_STR);
$query->bindParam(':subject',$subject,PDO::PARAM_STR);
$query->bindParam(':teacher',$class,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Materia agregada a Docente exitósamente";
}
else 
{
$error="Ha ocurrido un error. Por favor intente de nuevo";
}

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Agregar Materias a Docente</title>
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
    <h2 class="title">Agregar Materias a Docente</h2></div></div>
            <!-- /.row -->
<div class="row breadcrumb-div">
 <div class="col-md-6">
  <ul class="breadcrumb">
   <li><a href="admin.php"><i class="fa fa-home"></i> Inicio</a></li>
    <li> Materias</li>
     <li class="active">Agregar Materias</li></ul></div></div></div>
<div class="container-fluid">
 <div class="row">
  <div class="col-md-12">
   <div class="panel">
    <div class="panel-heading">
     <div class="panel-title">
      <h5>Agregar Materias</h5></div></div>

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
 <label for="default" class="col-sm-2 control-label">Docente</label>

 <!--Seleccionar Docente -->
  <div class="col-sm-10">
  <select name="teacher" class="form-control" id="default" required="required">
   <option value="">Selecciona Docente</option>
    <?php $sql = "SELECT * from tblteacher";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
    foreach($results as $result)
    {   ?>
    <option value="<?php echo htmlentities($result->idTeacher); ?>"><?php echo htmlentities($result->Name); ?></option>
    <?php }} ?></select></div></div>

<!--Seleccionar materias -->

<div class="form-group">
 <label for="default" class="col-sm-2 control-label">Materia</label>
  <div class="col-sm-10">
  <select name="subject" class="form-control" id="default" required="required">
  <option value="">Selecciona Materia</option>
   <?php $sql = "SELECT * from tblsubjects";
   $query = $dbh->prepare($sql);
   $query->execute();
   $results=$query->fetchAll(PDO::FETCH_OBJ);
   if($query->rowCount() > 0)
   {
   foreach($results as $result)
   {   ?>
   <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->SubjectName); ?></option>
   <?php }} ?></select></div></div>

<!--Seleccionar materias -->

<div class="form-group">
 <label for="default" class="col-sm-2 control-label">Grado Escolar </label>
  <div class="col-sm-10">
  <select name="class" class="form-control" id="default" required="required">
  <option value="">Selecciona Grado Escolar</option>
   <?php $sql = "SELECT * from tblclasses";
   $query = $dbh->prepare($sql);
   $query->execute();
   $results=$query->fetchAll(PDO::FETCH_OBJ);
   if($query->rowCount() > 0)
   {
   foreach($results as $result)
   {   ?>
   <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->ClassName); ?></option>
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
