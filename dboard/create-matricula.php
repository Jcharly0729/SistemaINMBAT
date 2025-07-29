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
$student=$_POST['student'];
$monto=$_POST['monto']; 
$status=1;

$sql2="INSERT INTO tblmatricula (StudentId,MontoMatricula,Status, FechaMatricula) VALUES(:student,:monto,:status,NOW())";

$query2 = $dbh->prepare($sql2);
$query2->bindParam(':student',$student,PDO::PARAM_STR);
$query2->bindParam(':monto',$monto,PDO::PARAM_STR);
$query2->bindParam(':status',$status,PDO::PARAM_STR);
$query2->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Matricula Registrada exitósamente";
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
        <title>Añadir Matricula</title>
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
   <h2 class="title">Añadir Matricula</h2></div></div>
                            <!-- /.row -->
<div class="row breadcrumb-div">
 <div class="col-md-6">
  <ul class="breadcrumb">
   <li><a href="admin.php"><i class="fa fa-home"></i> Inicio</a></li>
    <li><a href="#">Matricula </a></li>
    <li class="active">Registrar Matricula</li></ul></div></div></div>
<section class="section">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-8 col-md-offset-2">
    <div class="panel">
     <div class="panel-heading">
      <div class="panel-title">
       <h5>Registrar Matricula</h5></div></div>
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Bien hecho!</strong><?php echo htmlentities($msg); ?></div><?php } 
else if($error){?> <div class="alert alert-danger left-icon-alert" role="alert">
<strong>Ha ocurrido un error</strong> <?php echo htmlentities($error); ?></div><?php } ?>
  
<div class="panel-body">
 <form method="post">

 <?php 
 $data = intval($_GET['value']);
 if (isset($_GET['value'])){

    $sql1 = "SELECT COUNT(m.MontoMatricula) as monto from tblmatricula m WHERE m.StudentId = :sid";
    $query1 = $dbh->prepare($sql1);
    $query1->bindParam(':sid',$data,PDO::PARAM_STR);
    $query1->execute();
    $results1=$query1->fetchAll(PDO::FETCH_OBJ);    
    if($query1->rowCount() > 0)
    {
        foreach($results1 as $result1)
        {
        $pagmat = $result1->monto;
        }
    }else{
        $pagmat = 0;
    }

    $sql = "SELECT * from tblstudents s inner join tblclasses c on c.id = s.ClassId where s.StudentId=:sid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':sid',$data,PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);    
    if($query->rowCount() > 0)
    {
    foreach($results as $result)
    { 

        if($pagmat == 1){
            ?>

    <div class="form-group has-success">
 <label for="success" class="control-label">Estado de matricula</label>
 <div class="">
  <input type="text" name="pagmat" value="Ya se ha realizado la matricula de este estudiante" class="form-control" id="pagmat" readonly>  
<?php } ?>

<div class="form-group has-success">
<label for="default" class="control-label">Nombre del Estudiante</label>
<div class="">
 <select name="student" class="form-control" onchange="actualizarcampos()" id="student" required="required">
<option value="<?php echo htmlentities($result->StudentId); ?>"><?php echo htmlentities($result->StudentName); ?></option>

<?php
if($rol == 1) {    
    $sql0 = "SELECT * from tblstudents WHERE rol_id = 3"; // Escuela
}else {
    $sql0="SELECT * from tblstudents WHERE rol_id = 6"; //Colegio
}

$query0 = $dbh->prepare($sql0);
$query0->execute();
$results0=$query0->fetchAll(PDO::FETCH_OBJ);
if($query0->rowCount() > 0)
{
foreach($results0 as $result0)
{   ?>
<option value="<?php echo htmlentities($result0->StudentId); ?>"><?php echo htmlentities($result0->StudentName); ?></option>
<?php }} ?>
 </select>


<div class="form-group has-success">
 <label for="success" class="control-label">Monto de matricula</label>
 <div class="">
  <input type="number" name="monto" required="required" class="form-control" id="monto">  
  

 <div class="form-group has-success">
 <label for="success" class="control-label">Clase</label>
<div class="">
 <input type="text" name="clase" class="form-control" value="<?php echo htmlentities($result->ClassName); ?> - <?php echo htmlentities($result->Section); ?> " required="required" id="clase"> 

<?php }}

}else{
 ?>
<div class="form-group has-success">
<label for="default" class="control-label">Nombre del Estudiante</label>
<div class="">
 <select name="student" class="form-control" onchange="actualizarcampos()" id="student" required="required">
<option value="">Selecciona Estudiante</option>

<?php
if($rol == 1) {    
    $sql0 = "SELECT * from tblstudents WHERE rol_id = 3"; // Escuela
}else {
    $sql0="SELECT * from tblstudents WHERE rol_id = 6"; //Colegio
}

$query0 = $dbh->prepare($sql0);
$query0->execute();
$results0=$query0->fetchAll(PDO::FETCH_OBJ);
if($query0->rowCount() > 0)
{
foreach($results0 as $result0)
{   ?>
<option value="<?php echo htmlentities($result0->StudentId); ?>"><?php echo htmlentities($result0->StudentName); ?></option>
<?php }} ?>
 </select>


<div class="form-group has-success">
 <label for="success" class="control-label">Monto de matricula</label>
 <div class="">
  <input type="number" name="monto" required="required" class="form-control" id="monto">  

 <div class="form-group has-success">
 <label for="success" class="control-label">Clase</label>
<div class="">
 <input type="text" name="clase" class="form-control" required="required" id="clase"> 
<?php }?>
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

        <script>

function actualizarcampos() {
	//campos

  var student = document.getElementById('student').value;
  window.top.location = 'create-matricula.php?value='+student;

}

</script>
    </body>
</html>
<?php  } ?>
