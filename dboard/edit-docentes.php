<?php
ob_start();
?>
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])=="")
    {   
    header("Location: login.php"); 
    }
    else{

$stid=intval($_GET['stid']);

if(isset($_POST['submit']))
{
$name=$_POST['name'];
$section=$_POST['section']; 
$classid=$_POST['classid'];
$status=$_POST['status'];
$sql="update tblteacher set Name=:name,Section=:section,ClassId=:classid,Status=:status where idTeacher=:stid ";
$query = $dbh->prepare($sql);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':section',$section,PDO::PARAM_STR);
$query->bindParam(':classid',$classid,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':stid',$stid,PDO::PARAM_STR);
$query->execute();

$msg="Información de docente actualizada exitósamente";
}


?>
<!DOCTYPE html>
<html lang="en">
    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
        
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMS Admin| Editar Docente></title>
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
                                    <h2 class="title">Actualizar Datos del Docente</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="admin.php"><i class="fa fa-home"></i> Inicio</a></li>
                                
                                        <li class="active">Gestionar Docente</li>
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
                                                    <h5>Datos del Docente</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body">
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Bien hecho!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Algo ha salido mal</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                                <form class="form-horizontal" method="post">
<?php 

$sql= "SELECT t.Name,t.Section, t.ClassId,t.Status,c.ClassName, c.id,c.Section FROM tblteacher as t join tblclasses as c on c.id=t.ClassId where t.idTeacher=:stid";
$query = $dbh->prepare($sql);
$query->bindParam(':stid',$stid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=0;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>


<div class="form-group">
 <label for="default" class="col-sm-2 control-label">Nombre Completo</label>
  <div class="col-sm-10">
  <input type="text" name="name" class="form-control" id="name" value="<?php echo htmlentities($result->Name)?>" required="required" autocomplete="off"></div></div>


<div class="form-group">
 <label for="default" class="col-sm-2 control-label">Seccion</label>
  <div class="col-sm-10">
   <input type="text" name="section" class="form-control" id="section" value="<?php echo htmlentities($result->Section)?>" maxlength="5" required="required" autocomplete="off"></div></div>


<div class="form-group">
 <label for="default" class="col-sm-2 control-label">Año escolar</label>
  <div class="col-sm-10">  
  <select name="classid" class="form-control" id="default" required="required">
<option value="<?php echo htmlentities($result->id)?>"><?php echo htmlentities($result->ClassName)?></option>
<?php $sql2 = "SELECT * from tblclasses";
$query2 = $dbh->prepare($sql2);
$query2->execute();
$results2=$query2->fetchAll(PDO::FETCH_OBJ);
if($query2->rowCount() > 0)
{
foreach($results2 as $result2)
{   ?>
<option value="<?php echo htmlentities($result2->id); ?>"><?php echo htmlentities($result2->ClassName); ?>&nbsp; Section-<?php echo htmlentities($result2->Section); ?></option>
<?php }} ?>
 </select>
 </div>
</div>

<div class="form-group">
 <label for="default" class="col-sm-2 control-label">Estado</label>
  <div class="col-sm-10">
  <?php  $stats=$result->Status;
 if($stats=="1")
 {
  ?>
  <input type="radio" name="status" value="1" required="required" checked>Activo <input type="radio" name="status" value="0" required="required">Bloqueado 
  <?php }?>
  <?php  
 if($stats=="0")
 {
  ?>
 <input type="radio" name="status" value="1" required="required" >Activar <input type="radio" name="status" value="0" required="required" checked>Bloquear
<?php }?>
</div>
</div>

<?php }} ?>                                                    

<div class="form-group">
 <div class="col-sm-offset-2 col-sm-10">
  <button type="submit" name="submit" class="btn btn-primary">Actualizar</button>
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

<?php
ob_end_flush();
?>