<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['rol']!=1 && $_SESSION['rol']!=4)
    {   
    header("Location: login.php"); 
    }
    else{

$id=intval($_GET['id']);

if(isset($_POST['submit']))
{

$primer_corte=$_POST['primer_corte']; 
$segundo_corte=$_POST['segundo_corte']; 
$tercer_corte=$_POST['tercer_corte']; 
$cuarta_corte=$_POST['cuarta_corte'];
$nota_final=($primer_corte+$segundo_corte+$tercer_corte+$cuarta_corte)/4; 

$sql="UPDATE tblcalificaciones set primer_corte=$primer_corte, segundo_corte=$segundo_corte,
            tercer_corte=$tercer_corte, cuarta_corte=$cuarta_corte, nota_final=$nota_final 
        where id=$id ";
$query = $dbh->prepare($sql);
$query->execute();

$msg= "Información de Calificacion actualizada exitósamente";
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SMS Admin|  Informacion estudiantil < </title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" >
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
        <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
        <link rel="stylesheet" href="css/select2/select2.min.css" >
        <link rel="stylesheet" href="css/main.css" media="screen" >
        <script src="js/modernizr/modernizr.min.js"></script>

        <script>
function getStudent(val) {
    $.ajax({
    type: "POST",
    url: "get_student.php",
    data:'classid='+val,
    success: function(data){
        $("#studentid").html(data);
        
    }
    });
$.ajax({
        type: "POST",
        url: "get_student.php",
        data:'classid1='+val,
        success: function(data){
            $("#subject").html(data);
            
        }
        });
}
    </script>
<script>

function getresult(val,clid) 
{   
    
var clid=$(".clid").val();
var val=$(".stid").val();;
var abh=clid+'$'+val;
//alert(abh);
    $.ajax({
        type: "POST",
        url: "get_student.php",
        data:'studclass='+abh,
        success: function(data){
            $("#reslt").html(data);
            
        }
        });
}
</script>
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
                                    <h2 class="title">Actualizar Calificacion </h2>
                                
                                </div>
                                
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
                            <div class="row breadcrumb-div">
                                <div class="col-md-6">
                                    <ul class="breadcrumb">
                                        <li><a href="admin.php"><i class="fa fa-home"></i> Inicio</a></li>
                                
                                        <li> Estudiantes</li>
            							<li class="active">Gestionar Calificaciones</li>
                                        <li class="active">Calificaciones</li>
                                        <li class="active">Actualizar Calificacion</li>
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
                                                    <h5>Actualizar Resultados</h5>
                                                </div>
                                            </div>
                                            <div class="panel-body">
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Bien hecho!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
                                            <strong>Ha habido un problema</strong> <?php echo htmlentities($error); ?>
                                        </div>
                                        <?php } ?>
                                                <form class="form-horizontal" method="post">

<?php 

$ret = "SELECT d.StudentId, d.StudentName, a.id,
        CONCAT(e.ClassName, ' - ',e.ClassNameNumeric, ' - ',e.Section) as classes,
        f.descripcion as horario, g.SubjectName as materia,
        a.primer_corte, a.segundo_corte, a.tercer_corte, a.cuarta_corte, a.nota_final, a.estado
        FROM tblcalificaciones a 
        INNER JOIN tblclasses_asignacion b on a.clase_asignacion_id = b.idClassAsig 
        INNER JOIN tblinscripcion_matricula c on a.inscripcion_matricula_id = c.id
        INNER JOIN tblstudents d on c.student_id = d.StudentId 
        INNER JOIN tblclasses e on b.classes_id = e.id 
        INNER JOIN tblhorario f on b.horario_id = f.id
        INNER JOIN tblsubjects g on b.subject_id = g.id
        WHERE a.id = :id;";
$stmt = $dbh->prepare($ret);
$stmt->bindParam(':id',$id,PDO::PARAM_STR);
$stmt->execute();
$result=$stmt->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($stmt->rowCount() > 0)
{
foreach($result as $row)
{  ?>


    <div class="form-group">
        <label for="default" class="col-sm-2 control-label">Estudiante</label>
            <div class="col-sm-10">
                <?php echo htmlentities($row->StudentName);?>
            </div>
    </div>

    <div class="form-group">
        <label for="default" class="col-sm-2 control-label">Grado Escolar</label>
            <div class="col-sm-10">
                <?php echo htmlentities($row->classes)?>
            </div>
    </div>

    <div class="form-group">
        <label for="default" class="col-sm-2 control-label">Materia</label>
            <div class="col-sm-10">
                <?php echo htmlentities($row->materia);?>
            </div>
    </div>
   

    <div class="form-group">
        <label for="default" class="col-sm-2 control-label">Primer Corte</label>
            <div class="col-sm-10">
                <input type="text" name="primer_corte" class="form-control" id="primer_corte" value="<?php echo htmlentities($row->primer_corte);?>" maxlength="4"  autocomplete="off">
            </div>
    </div>


    <div class="form-group">
        <label for="default" class="col-sm-2 control-label">Segundo Corte</label>
            <div class="col-sm-10">
                <input type="text" name="segundo_corte" class="form-control" id="segundo_corte" value="<?php echo htmlentities($row->segundo_corte);?>" maxlength="4"  autocomplete="off">
            </div>
    </div>

    <div class="form-group">
        <label for="default" class="col-sm-2 control-label">Tercer Corte</label>
            <div class="col-sm-10">
                <input type="text" name="tercer_corte" class="form-control" id="tercer_corte" value="<?php echo htmlentities($row->tercer_corte);?>" maxlength="4"  autocomplete="off">
            </div>
    </div>  

    <div class="form-group">
        <label for="default" class="col-sm-2 control-label">Cuarta Corte</label>
            <div class="col-sm-10">
                <input type="text" name="cuarta_corte" class="form-control" id="cuarta_corte" value="<?php echo htmlentities($row->cuarta_corte);?>" maxlength="4"  autocomplete="off">
            </div>
    </div>  
    
<?php } }?>
        <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" class="btn btn-primary">Actualizar</button>
        <a href="manage-results.php" class="btn btn-danger">Cancelar</a>
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