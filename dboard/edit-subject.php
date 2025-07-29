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
if(isset($_POST['Update']))
{
$sid=intval($_GET['subjectid']);
$subjectname=$_POST['subjectname'];
$subjectcode=$_POST['subjectcode']; 
$Creditos=$_POST['Creditos']; 
$Costo=$_POST['Costo']; 
$teacher=$_POST['teacher']; 
$status=$_POST['status'];

$sql="update  tblsubjects set SubjectName=:subjectname,SubjectCode=:subjectcode, Creditos=:Creditos, Costo=:Costo, teacher_id=:teacher, Status=:status where id=:sid";

$query = $dbh->prepare($sql);
$query->bindParam(':subjectname',$subjectname,PDO::PARAM_STR);
$query->bindParam(':subjectcode',$subjectcode,PDO::PARAM_STR);
$query->bindParam(':teacher',$teacher,PDO::PARAM_STR);
$query->bindParam(':Creditos',$Creditos,PDO::PARAM_STR);
$query->bindParam(':Costo',$Costo,PDO::PARAM_STR);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$msg="Información de curso actualizado";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Editar Curso</title>
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
                                    <h2 class="title">Editar Curso</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="admin.php"><i class="fa fa-home"></i> Inicio</a></li>
                                        <li> Curso</li>
                                        <li class="active">Editar Curso</li>
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
                                                    <h5>Editar Curso</h5>
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

 <?php
$sid=intval($_GET['subjectid']);
$sql = "SELECT s.SubjectName, s.SubjectCode, s.Creditos, s.Costo, s.teacher_id, t.Name, s.Status  from tblsubjects s inner join tblteacher t on t.idTeacher = s.teacher_id where s.id=:sid";
$query = $dbh->prepare($sql);
$query->bindParam(':sid',$sid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>                                               
                                                    <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">Nombre de Curso</label>
                                                        <div class="col-sm-10">
 <input type="text" name="subjectname" value="<?php echo htmlentities($result->SubjectName);?>" class="form-control" id="default" placeholder="Nombre de Curso" required="required">
                                                        </div>
                                                    </div>
                                                    <?php }} ?>

                                                    <div class="form-group">
                                                    <label for="default" class="col-sm-2 control-label">Docente Responsable</label>
                                                    <div class="col-sm-6">
                                                    <select name="teacher" class="form-control" id="default" required="required">
                                                    <option value="<?php echo htmlentities($result->teacher_id)?>"><?php echo htmlentities($result->Name)?></option>
                                                    <?php 

                                                    if($rol == 1) {    
                                                        $sql0 = "SELECT * from tblteacher  WHERE rol_id = 2"; // Escuela
                                                    }else {
                                                        $sql0="SELECT * from tblteacher  WHERE rol_id = 5"; //Colegio
                                                    }

                                                    $query0 = $dbh->prepare($sql0);
                                                    $query0->execute();
                                                    $results0=$query0->fetchAll(PDO::FETCH_OBJ);
                                                    if($query0->rowCount() > 0)
                                                    {
                                                    foreach($results0 as $result0)
                                                    {   ?>
                                                    <option value="<?php echo htmlentities($result0->idTeacher); ?>"><?php echo htmlentities($result0->Name); ?></option>
                                                    <?php }} ?>
                                                    </select></div></div>

                                                    
<br><br>

<div class="form-group">
<label for="default" class="col-sm-2 control-label"></label>
<div class="col-sm-6">
<?php  $stats=$result->Status;
if($stats=="1")
{
?>
<input type="radio" name="status" value="1" required="required" checked> <input type="radio" name="status" value="0" required="required"> 
<?php }?>
<?php  
if($stats=="0")
{
?>
<input type="radio" name="status" value="1" required="required" > <input type="radio" name="status" value="0" required="required" checked>
<?php }?>


                                                    
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-6 col-sm-50">
                                                            <button type="submit" name="Update" class="btn btn-primary">Modificar</button>
                                                            <a class="btn btn-primary" href="manage-subjects.php">Cancelar</a> 
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
