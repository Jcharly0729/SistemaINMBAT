<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['rol']=="")
    {   
    header("Location: login.php"); 
    }
    else{
 // for activate Subject   	
if(isset($_GET['acid']))
{
$acid=intval($_GET['acid']);
$status=1;
$sql="update tblclasses_asignacion set Status=:status where idClassAsig=:acid ";
$query = $dbh->prepare($sql);
$query->bindParam(':acid',$acid,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$msg="Activación exitosa de materia";
}

 // for Deactivate Subject
if(isset($_GET['did']))
{
$did=intval($_GET['did']);
$status=0;
$sql="update tblclasses_asignacion set Status=:status where idClassAsig=:did ";
$query = $dbh->prepare($sql);
$query->bindParam(':did',$did,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$msg="Materia desactivada exitósamente";
}

if(isset($_GET['delid']))
{
$acid=intval($_GET['delid']);

$sql="DELETE FROM tblclasses_asignacion where idClassAsig=:delid ";
$query = $dbh->prepare($sql);
$query->bindParam(':delid',$acid,PDO::PARAM_STR);
$query->execute();
$msg="Eliminacion de materia exitosa";
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title> EDITAR CURSOS </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" > <!-- USED FOR DEMO HELP - YOU CAN REMOVE IT -->
        <link rel="stylesheet" type="text/css" href="js/DataTables/datatables.min.css"/>
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
}
        </style>
    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

            <!-- ========== TOP NAVBAR ========== -->
   <?php include('includes/topbar.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">
<?php include('includes/leftbar.php');?>  

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-md-6">
                                    <h2 class="title">EDITAR CURSOS</h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
            							<li><a href="admin.php"><i class="fa fa-home"></i> Inicio</a></li>
                                        <li> CURSO</li>
            							<li class="active">EDITAR CURSOS</li>
            						</ul>
                                </div>
                             
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.container-fluid -->

                        <section class="section">
                            <div class="container-fluid">

                             

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="panel">
                                            <div class="panel-heading">
                                                <div class="panel-title">
                                                    <h5>ACTIVAR CURSO</h5>
                                                </div>
                                            </div>
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Bien hecho!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>oh rayos!!</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                            <div class="panel-body p-20">

                                                <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Año Escolar</th>
                                                            <th>Curso</th>
                                                            <th>Horario</th>
                                                            <th>Docente</th>
                                                            <th>Estado</th>
                                                            <th>Modificar</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                          <th>#</th>
                                                            <th>Año Escolar</th>
                                                            <th>Curso</th>
                                                            <th>Horario</th>
                                                            <th>Docente</th>
                                                            <th>Estado</th>
                                                            <th>Modificar</th>
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
<?php $sql = "SELECT c.ClassName, c.ClassNameNumeric ,c.Section,s.SubjectName,ca.idClassAsig as scid,ca.Status, t.Name, h.descripcion from tblclasses_asignacion ca join tblclasses c on c.id=ca.classes_id  join tblsubjects s on s.id=ca.subject_id join tblhorario h on h.id = ca.horario_id join tblteacher t on t.idTeacher=ca.teacher_id";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>
<tr>
 <td><?php echo htmlentities($cnt);?></td>
                                                            <td><?php echo htmlentities($result->ClassName. ' - '.$result->ClassNameNumeric);?> &nbsp; Section - <?php echo htmlentities($result->Section);?></td>
                                                            <td><?php echo htmlentities($result->SubjectName);?></td>
                                                            <td><?php echo htmlentities($result->descripcion);?></td>
                                                            <td><?php echo htmlentities($result->Name);?></td>                                                            
                                                             <td><?php $stts=$result->Status;
if($stts=='0')
{
	echo htmlentities('Inactive');
}
else
{
	echo htmlentities('Active');
}
                                                             ?></td>
                                                            
<td>
<?php if($stts=='0')
{ ?>
<a href="manage-subjectcombination.php?acid=<?php echo htmlentities($result->scid);?>" onclick="confirm('Realmente deseas activar esta materia');"><i class="fa fa-check" title="Acticvate Record"></i> </a>
<?php } else {?>
<a href="manage-subjectcombination.php?did=<?php echo htmlentities($result->scid);?>" onclick="confirm('Realmente deseas desactivar esta materia');"><i class="fa fa-times" title="Deactivate Record"></i> </a>
<?php }?>

<a href="manage-subjectcombination.php?delid=<?php echo htmlentities($result->scid);?>" onclick="confirm('Realmente deseas eliminar esta materia');"> <img src="images/borrar.png" alt="borrar" style = "width: 20px;
    height: 20px; margin-left:25px"> </a>
</td>
</tr>
<?php $cnt=$cnt+1;}} ?>
                                                       
                                                    
                                                    </tbody>
                                                </table>

                                         
                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-6 -->

                                                               
                                                </div>
                                                <!-- /.col-md-12 -->
                                            </div>
                                        </div>
                                        <!-- /.panel -->
                                    </div>
                                    <!-- /.col-md-6 -->

                                </div>
                                <!-- /.row -->

                            </div>
                            <!-- /.container-fluid -->
                        </section>
                        <!-- /.section -->

                    </div>
                    <!-- /.main-page -->

                    

                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->

        </div>
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/DataTables/datatables.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $('#example').DataTable();

                $('#example2').DataTable( {
                    "scrollY":        "300px",
                    "scrollCollapse": true,
                    "paging":         false
                } );

                $('#example3').DataTable();
            });
        </script>
    </body>
</html>
<?php } ?>

