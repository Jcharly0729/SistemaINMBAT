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
if(isset($_POST['update']))
{
$classname=$_POST['classname'];
$classnamenumeric=$_POST['classnamenumeric']; 
$section=$_POST['section'];
$cid=intval($_GET['classid']);
$sql="update  tblclasses set ClassName=:classname,ClassNameNumeric=:classnamenumeric,Section=:section where id=:cid ";
$query = $dbh->prepare($sql);
$query->bindParam(':classname',$classname,PDO::PARAM_STR);
$query->bindParam(':classnamenumeric',$classnamenumeric,PDO::PARAM_STR);
$query->bindParam(':section',$section,PDO::PARAM_STR);
$query->bindParam(':cid',$cid,PDO::PARAM_STR);
$query->execute();
$msg="Datos actualizados exitosamente";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Actualizar Grado Escolar</title>
        <link rel="stylesheet" href="css/bootstrap.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
            <?php include('includes/topbar.php');?>   
          <!-----End Top bar>
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
                                    <h2 class="title">Editar Grado Escolar </h2>
                                </div>
                                
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="admin.php"><i class="fa fa-home"></i> Inicio</a></li>
            							<li><a href="#">Grado Escolar </a></li>
            							<li class="active">Actualizar Grado Escolar</li>
            						</ul>
                                </div>
                               
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">

                             

                              

                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>Editar Información de Grado Escolar</h5>
                                                </div>
                                            </div>
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Bien hecho - </strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>oh rayos!!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>

                                                <form method="post">
<?php 
$cid=intval($_GET['classid']);
$sql = "SELECT * from tblclasses where id=:cid";
$query = $dbh->prepare($sql);
$query->bindParam(':cid',$cid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>

                                                    <div class="form-group has-success">
                                                        <label for="success" class="control-label">Nombre Grado Escolar</label>
                                                		<div class="">
                                                			<input type="text" name="classname" value="<?php echo htmlentities($result->ClassName);?>" required="required" class="form-control" id="success">
                                                		</div>
                                                	</div>
                                                       <div class="form-group has-success">
                                                        <label for="success" class="control-label">Sección</label>
                                                        <div class="">
                                                            <input type="text" name="section" value="<?php echo htmlentities($result->Section);?>" class="form-control" required="required" id="success">
                                                        </div>
                                                    </div>
                                                    <?php }} ?>
  <div class="form-group has-success">

                                                        <div class="">
                                                           <button type="submit" name="update" class="btn btn-success btn-labeled">Actualizar<span class="btn-label btn-label-right"><i class="fa fa-check"></i></span></button>
                                                           <a class="btn btn-primary" href="manage-classes.php">Cancelar</a> 
                                                    </div>


                                                    
                                                </form>

                                              
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-8 col-md-offset-2 -->
                                </div>
                                <!-- /.row -->

                               
                               

                            </div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->

                    </div>
                    <!-- /.main-page -->

             
                    <!-- /.right-sidebar -->

                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->

        </div>
        <!-- /.main-wrapper -->

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
