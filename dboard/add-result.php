<?php
session_start();
error_reporting(0);
include('includes/config.php');
if($_SESSION['rol']!=1 && $_SESSION['rol']!=4)
    {   
        header("Location: login.php");
    }
    else{
        if(isset($_POST['submit']))
        {
    
        $marks=array();
        $calificacionid=$_POST['calificacionid'];
        $corte=$_POST['corte']; 
        $nota=$_POST['nota'];
    
        if($corte=="1")
        {       
                $sql="UPDATE tblcalificaciones a SET a.primer_corte = '$nota' WHERE a.id = '$calificacionid'";
                $query = $dbh->prepare($sql);        
                $query->execute();            
                if($query->rowCount() > 0)
                {
                    $msg="Calificaciones ingresadas correctamente ";
                }
                else 
                {
                    $error="Something went wrong. Please try again";
                }
            
        }else if($corte=="2"){
            $sql="UPDATE tblcalificaciones a SET a.segundo_corte = '$nota' WHERE a.id = '$calificacionid'";
                $query = $dbh->prepare($sql);        
                $query->execute();            
                if($query->rowCount() > 0)
                {
                    $msg="Calificaciones ingresadas correctamente";
                }
                else 
                {
                    $error="Something went wrong. Please try again";
                }
        }else if($corte=="3"){        
            $sql="UPDATE tblcalificaciones a SET a.tercer_corte = '$nota',
            a.nota_final = (select ((a.primer_corte + a.segundo_corte+$nota)/3) as nota), a.estado = 2 
            WHERE a.id = '$calificacionid'";
           $query = $dbh->prepare($sql);        
           $query->execute();               

        }
        else if($corte=="4"){        
        $sql="UPDATE tblcalificaciones a SET a.cuarta_corte = '$nota',
        a.nota_final = (select ((a.primer_corte + a.segundo_corte+ a.tercera_corte+$nota)/4) as nota), a.estado = 2 
        WHERE a.id = '$calificacionid'";
       $query = $dbh->prepare($sql);        
       $query->execute();               

       if($query->rowCount() > 0)
       {
               $msg="Resultados publicados exitósamente";

               $sqlfinal = "UPDATE tblinscripcion_matricula a 
               SET a.Estado = 2 
               WHERE a.id = (SELECT X.inscripcion_matricula_id FROM tblcalificaciones X WHERE X.id = '$calificacionid') 
               AND 1 not in (SELECT b.estado from tblcalificaciones b 
               WHERE b.inscripcion_matricula_id = (SELECT Y.inscripcion_matricula_id FROM tblcalificaciones Y WHERE Y.id = '$calificacionid'))";
               $query2 = $dbh->prepare($sqlfinal);        
               $query2->execute();                               
               if($query2->rowCount() > 0)
               {
                   $msg="Se han calificado todas las Materias del Alumno";
               }
   
           }
            else 
            {
                $error="Something went wrong. Please try again";
            }
        }else
        {
            $error="Debe Seleccionar un ciclo";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Publicar Resultados</title>
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
              <h2 class="title">Registrar Calificaciones</h2></div>
                                <!-- /.col-md-6 text-right -->
                            </div>
                            <!-- /.row -->
    <div class="row breadcrumb-div">
     <div class="col-md-6">
      <ul class="breadcrumb">
       <li><a href="admin.php"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active">Resultados Estudiantiles</li></ul></div></div></div>

    <div class="container-fluid">
     <div class="row">
       <div class="col-md-12">
        <div class="panel">
         <div class="panel-body">

<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Bien hecho!</strong><?php echo htmlentities($msg); ?>
 </div><?php } 
else if($error){?>
    <div class="alert alert-danger left-icon-alert" role="alert">
    <strong>Hubo un error, intente de nuevo!!</strong> <?php echo htmlentities($error); ?></div>
    
<?php } ?>
<form class="form-horizontal" method="post">

<div class="form-group"><label for="date" class="col-sm-2 control-label ">Nombre del Estudiante</label>
    <div class="col-sm-8">
        <select name="calificacionid" class="form-control stid" id="calificacionid" required="required" >
            <option value="">Selecciona el Estudiante</option>
            <?php $sql = "SELECT d.StudentId, d.StudentName, a.id,
                    CONCAT(e.ClassName, ' - ',e.ClassNameNumeric, ' - ',e.Section) as classes,
                    f.descripcion as horario, g.SubjectName as materia
                    FROM tblcalificaciones a 
                    INNER JOIN tblclasses_asignacion b on a.clase_asignacion_id = b.idClassAsig 
                    INNER JOIN tblinscripcion_matricula c on a.inscripcion_matricula_id = c.id
                    INNER JOIN tblstudents d on c.student_id = d.StudentId 
                    INNER JOIN tblclasses e on b.classes_id = e.id 
                    INNER JOIN tblhorario f on b.horario_id = f.id
                    INNER JOIN tblsubjects g on b.subject_id = g.id
                    WHERE a.estado = 1 and c.Estado = 1";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);
            if($query->rowCount() > 0)
            {
            foreach($results as $result)
            {   ?>
            <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->StudentName);?> - <?php echo htmlentities($result->materia);?> - <?php echo htmlentities($result->classes);?></option>
            <?php }} ?>
        </select>
    </div>
</div>
                    
<div class="form-group">
    <label for="date" class="col-sm-2 control-label ">Ingrese Calificación</label>
    <div class="col-sm-8">
        <select name="corte" class="form-control" id="default" required="required">
            <option value="" class="fadeIn">Seleccione el bimestre</option>
            <option value="1" class="fadeIn">Primer Bimestre</option>
            <option value="2" class="fadeIn">Segundo Bimestre</option>
            <option value="3" class="fadeIn">Tercer Bimestre</option>
            <option value="3" class="fadeIn">Cuarto Bimestre</option>                         
        </select>
    </div>
</div>

<div class="form-group">
    <label for="default" class="col-sm-2 control-label">Calificacion</label>
    <div class="col-sm-6">    
        <input type="number" name="nota"  class="form-control" id="default" placeholder="" required>
    </div>           
</div>


<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" id="submit" class="btn btn-success">Publicar Resultados</button>
    </div>
</div>

</form>

</div></div></div></div></div></div></div></div>
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
  $(".js-states-limit").select2({ maximumSelectionLength: 2 });
                $(".js-states-hide").select2({minimumResultsForSearch: Infinity});
            });
        </script>
    </body>
</html>
<?PHP } ?>
