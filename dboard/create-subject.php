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

$subjectname=$_POST['subjectname'];
$teacher = $_POST['teacher'];

if($rol == 1) {    
    $sql="INSERT INTO tblsubjects(SubjectName, teacher_id, rol_id, Status) VALUES(:subjectname, :teacher, 7,1)";
}else {
    $sql="INSERT INTO tblsubjects(SubjectName, teacher_id, rol_id, Status) VALUES(:subjectname, :teacher, 8,1)";
}

$query = $dbh->prepare($sql);
$query->bindParam(':subjectname',$subjectname,PDO::PARAM_STR);
$query->bindParam(':teacher',$teacher,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Curso creado exitosamente";
}
else 
{
$error="Algo salio mal. Intentelo de nuevo!";
}

}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CREAR CURSO </title>
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
                                    <h2 class="title">CREAR CURSO</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="admin.php"><i class="fa fa-home"></i> Inicio</a></li>
                                        <li> Curso</li>
                                        <li class="active">CREAR CURSO</li>
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
                                                    <h5>CREAR CURSO</h5>
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
                                                        <label for="default" class="col-sm-2 control-label">Nombre del Curso</label>
                                                        <div class="col-sm-6">
 <input type="text" name="subjectname" class="form-control" id="default" placeholder="Nombre del Curso" required="required">
                                                        </div>
                                                    </div>
                                                    
<div class="form-group">
<label for="default" class="col-sm-2 control-label">Docente</label>
<div class="col-sm-6">
 <select name="teacher" class="form-control" id="default" required="required">
<option value="">Seleccionar Docente </option>

<?php
if($rol == 1) {    
    $sql0 = "SELECT * from tblteacher  WHERE rol_id = 2 and Status = 1 "; // Escuela
}else {
    $sql0="SELECT * from tblteacher  WHERE rol_id = 5 and Status = 1"; //Colegio
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
                                                    

                                                    
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-2 col-sm-10">
                                                            <button type="submit" name="submit" class="btn btn-primary">Crear</button>
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
