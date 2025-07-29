<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['StudentId'])=="")
    {   
    header("Location: login.php"); 
    }
    else{

        if(isset($_GET['delid']))
        {
            $acid=intval($_GET['delid']);            

            $sql="DELETE FROM tblcalificaciones WHERE id =:delid";   //ELIMINAR INCRIPCION     
            //$sql="UPDATE tblstudents SET Status = 0 where StudentId=:delid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':delid',$acid,PDO::PARAM_STR);
            $query->execute();
            $msg="Eliminacion de Inscripcion exitosa";
        }

        $StudentId = $_SESSION['StudentId'];
        $nombre = "";

    $data = "SELECT * FROM tblstudents a WHERE a.StudentId = '$StudentId'";
   $querydata = $dbh->prepare($data);
   $querydata->execute();
   $dataresult=$querydata->fetchAll(PDO::FETCH_OBJ);
   if($querydata->rowCount() > 0)
   {
    foreach($dataresult as $user)
        { 
          $nombre = $user->StudentName;
        }
    } 

if(isset($_POST['submit']))
{

$materia_id=$_POST['materia_id']; 
$idinscripcion=$_POST['idinscripcion']; 
$credito=$_POST['credito']; 
$credito2=$_POST['credito2']; 
$status=1;

if($idinscripcion == 0){ //nuevo registro inscripcion
    $creditousado = 0;
    $costopagar = 0;
    $costopagado = 0;    
    
    $sql="INSERT INTO  tblinscripcion_matricula(credito_usado,costo_pagar,costo_pagado,Estado,student_id,reg_date,upd_date)
     VALUES('$creditousado','$costopagar', '$costopagado', '$status', '$StudentId', now(),now())";
    $query = $dbh->prepare($sql);
    $query->execute();
    
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {   
        
        $msg="Puede Comenzar a Matricular Materias"; 
    }
    else 
    {
            $error="Ha ocurrido un error al crear Inscripcion. Por favor intente de nuevo";
    }
}else{
    if(($credito + $credito2) <= 15){
        $mat = "INSERT INTO  tblcalificaciones(inscripcion_matricula_id,clase_asignacion_id,primer_corte,segundo_corte,tercer_corte,nota_final,estado)
        VALUES('$idinscripcion','$materia_id', 0, 0,0,0, '$status')";

        $rest = $dbh->prepare($mat);
        $rest->execute();
        $lastInsert = $dbh->lastInsertId();
        if($lastInsert)
        { 
            $msg="Matricula de Materia agregada exitósamente";
        }
        else 
        {
                $error="Ha ocurrido un error. Por favor intente de nuevo";
        }
    }else 
    {
            $error="La Materia Seleccionada Supera el Limite de Creditos ";
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Agregar Matricula de Materias</title>
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
  <?php include('includes/topbar_alu.php');?> 
            <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
            <div class="content-wrapper">
                <div class="content-container">

                    <!-- ========== LEFT SIDEBAR ========== -->
                   <?php include('includes/leftbar_alu.php');?>  
                    <!-- /.left-sidebar -->
<div class="main-page">
 <div class="container-fluid">
  <div class="row page-title-div">
   <div class="col-md-6">
    <h2 class="title">Agregar Matricula de Materias</h2></div></div>
            <!-- /.row -->
<div class="row breadcrumb-div">
 <div class="col-md-6">
  <ul class="breadcrumb">
   <li><a href="estudiante_panel.php"><i class="fa fa-home"></i> Inicio</a></li>
    <li> Matricula </li>
     <li class="active">Matriculas de Materias</li></ul></div></div></div>
<div class="container-fluid">
 <div class="row">
  <div class="col-md-12">
   <div class="panel">
    <div class="panel-heading">
     <div class="panel-title">
      <h5>Agregar Matricula - <?php echo ($nombre); ?></h5></div></div>

<div class="panel-body">
<?php if($msg){?>
<div class="alert alert-success left-icon-alert" role="alert">
 <strong>Bien hecho!</strong><?php echo htmlentities($msg); ?></div>
<?php } 
else if($error){?>
 <div class="alert alert-danger left-icon-alert" role="alert">
  <strong>oh rayos!!</strong> <?php echo htmlentities($error); ?></div><?php } ?>

<form class="form-horizontal" method="post">


<?php 
    $inscripcion = "SELECT a.id, a.credito_usado, a.costo_pagar
    FROM tblinscripcion_matricula a
    WHERE a.Estado = 1 and a.student_id = '$StudentId'";

   $queryinscripcion = $dbh->prepare($inscripcion);
   $queryinscripcion->execute();
   $datainscripcion=$queryinscripcion->fetchAll(PDO::FETCH_OBJ);
   if($queryinscripcion->rowCount() > 0)
   {
    foreach($datainscripcion as $ins)
        { 
            if( $ins->credito_usado <15){

            
            ?>
                <div class="panel-title">
                    <h5>Creditos disponibles!.. continue con la Matricula de Materias</h5>
                    <br><br>
                </div>                

                <div class="form-group" style="margin-left: 20%;">
                    <div class="col-sm-3">    
                    <label for="default" class="col-sm-16 control-label">Credito. Max: 15.</label>
                        <input type="hidden" name="idinscripcion" value="<?php echo htmlentities($ins->id); ?>"  class="form-control"   readonly> 
                        <input type="text" name="credito" value="<?php echo htmlentities($ins->credito_usado); ?>" class="form-control" id="credito_select" placeholder="Creditos" readonly>             
                        <input type="hidden" name="credito2" class="form-control" id="credito2_select" placeholder="Creditos" readonly>                        
                    </div>  
                    <div class="col-sm-3">    
                    <label for="default" class="col-sm-2 control-label">Costo</label>
                        <input type="text" name="costo" value="<?php echo htmlentities($ins->costo_pagar); ?>" class="form-control" id="costo_select" placeholder="Costo" readonly>
                    </div>
                </div>

                <!--Seleccionar materia -->
                <div class="form-group">
                <label for="default" class="col-sm-2 control-label">Materia</label>
                    <div class="col-sm-6">
                        <select name="materia_id" class="form-control" id="materia_select" required="required">
                            <option value="">Selecciona Materia</option> 
                                <?php 
                                //validaciones que implica
                                //1. mostrar las materias que no esten ya inscritas
                                //2. mostrar las materias que no ha aprobado y que aun no esta llevando
                                //3. mostrar materias que no choquen entre horarios
                                //4. mostrar materias que no esten deshabilitadas
                                //5. ocultar materias que se seleccionaron en horario distinto para evitar inscribir una repetida
                                //6. mostrar las materias correspondientes a la inscripcion actuan (no involucre las inscripciones pasadas)
                                //7. excluir las materias aprobadas (estado 2 y calificacion mayor a 3.5)
                                $sql = "SELECT b.idClassAsig, a.SubjectName, a.Creditos, a.Costo, c.descripcion as Horario,
                                                CONCAT(d.ClassName, '(',d.ClassNameNumeric, ' . ',d.Section, ')') as classes 
                                                FROM tblsubjects a
                                                INNER JOIN tblclasses_asignacion b on a.id = b.subject_id
                                                INNER JOIN tblhorario c on b.horario_id = c.id
                                                INNER JOIN tblclasses d on b.classes_id = d.id
                                                WHERE b.Status = 1 and a.rol_id = 7 and b.idClassAsig not in 
                                                (SELECT y.clase_asignacion_id from tblinscripcion_matricula x 
                                                inner join tblcalificaciones y on x.id = y.inscripcion_matricula_id 
                                                inner join tblclasses_asignacion z on y.clase_asignacion_id = z.idClassAsig
                                                inner JOIN tblsubjects w on z.subject_id = w.id
                                                where (x.student_id = '$StudentId' and x.Estado = 1) or z.subject_id in
                                                (SELECT z.subject_id from tblinscripcion_matricula x 
                                                inner join tblcalificaciones y on x.id = y.inscripcion_matricula_id 
                                                inner join tblclasses_asignacion z on y.clase_asignacion_id = z.idClassAsig
                                                inner JOIN tblsubjects w on z.subject_id = w.id
                                                where (x.student_id = '$StudentId' and x.Estado = 1))) and c.id not in 
                                                (SELECT z.horario_id from tblinscripcion_matricula x 
                                                inner join tblcalificaciones y on x.id = y.inscripcion_matricula_id 
                                                INNER JOIN tblclasses_asignacion z on y.clase_asignacion_id = z.idClassAsig 
                                                where x.student_id = '$StudentId' and x.Estado = 1) and b.subject_id not in 
                                                (SELECT i.subject_id from tblinscripcion_matricula g 
                                                inner join tblcalificaciones h on g.id = h.inscripcion_matricula_id 
                                                INNER JOIN tblclasses_asignacion i on h.clase_asignacion_id = i.idClassAsig
                                                where g.student_id = '$StudentId' and h.Estado = 2 and h.nota_final >= 3.5)";
                                $query = $dbh->prepare($sql);
                                $query->execute();
                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                if($query->rowCount() > 0)
                                {
                                foreach($results as $result)
                                {   ?>
                                <option value="<?php echo htmlentities($result->idClassAsig); ?>" data-credito="<?php echo htmlentities($result->Creditos); ?>" data-horario="<?php echo htmlentities($result->Horario); ?>" data-costo="<?php echo htmlentities($result->Costo); ?>"><?php echo htmlentities($result->SubjectName. ' - ' .$result->classes. ' - ' .$result->Horario. ' - #'.$result->Creditos); ?></option>
                                <?php }} ?>
                        </select>
                    </div><br>   
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-1 col-sm-10">
                        <button type="submit" name="submit" class="btn btn-success" style="margin-left: 20%;">Matricular</button>
                        <a href="ReciboMatricula.php" target="_blank" class="btn btn-success fa fa-file" style="margin-left: 20%; color:white;"> Generar Recibo de Matricula</a>
                    </div>                    
                </div>
            <?php      
            }  else if ($ins->credito_usado >=15){
            ?>
                <div class="panel-title">
                    <h5>Matricula de Materias Completado</h5>
                    <br><br>

                    <a href="ReciboMatricula.php" target="_blank" class="btn btn-success fa fa-file" style="margin-left: 20%; color:white;"> Generar Recibo de Matricula</a>
                </div>
            <?php
            }
        }
        }else{
        ?>
                <div class="panel-title">
                    <h5>Matricula de Materias Por primera vez</h5>
                    <br><br>
                </div>

                <div class="form-group" style="margin-left: 20%;">
                    <div class="col-sm-2">    
                        <input type="hidden" name="idinscripcion" value="0"  class="form-control"   readonly>    
                        <input type="hidden" name="credito"  class="form-control" id="credito_select" placeholder="Creditos" value="0" readonly>
                    </div>  
                    <div class="col-sm-2">    
                        <input type="hidden" name="costo"  class="form-control" id="costo_select" placeholder="Costo" value="0" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="submit" class="btn btn-success" style="margin-left: 20%;">Empezar Matricula</button>
                    </div>
                </div>
            <?php  
    }
    ?>

</form>

<table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>                                                            
                                                            <th>Docente</th>   
                                                            <th>Clase</th>                                                           
                                                            <th>Materia</th>
                                                            <th>Horario</th>
                                                            <th>Credito</th>
                                                            <th>Costo</th>
                                                            <th>Accion</th>                                                            
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>                                                            
                                                            <th>Docente</th>   
                                                            <th>Clase</th>                                                           
                                                            <th>Materia</th>
                                                            <th>Horario</th>
                                                            <th>Credito</th>
                                                            <th>Costo</th>
                                                            <th>Accion</th>                                                            
                                                        </tr>
                                                    </tfoot>
                                                    <tbody>
<?php 



    $sql ="SELECT a.id, CONCAT(d.ClassName, ' - ',d.ClassNameNumeric, ' - ',d.Section) as classes, a.estado as Status,
        e.descripcion as horario, f.SubjectName, f.Creditos, f.Costo, g.Name as teacher
        FROM tblcalificaciones a
        INNER JOIN tblinscripcion_matricula b on a.inscripcion_matricula_id = b.id
        INNER JOIN tblclasses_asignacion c on a.clase_asignacion_id = c.idClassAsig
        INNER JOIN tblclasses d on c.classes_id = d.id
        INNER JOIN tblhorario e on c.horario_id = e.id
        INNER JOIN tblsubjects f on c.subject_id = f.id
        INNER JOIN tblteacher g on c.teacher_id = g.idTeacher
        WHERE (b.Estado = 1 and b.student_id = '$StudentId' and a.estado = 1)"; //escuela

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
                                                            <td><?php echo htmlentities($result->teacher);?></td>
                                                            <td><?php echo htmlentities($result->classes);?></td>                                                            
                                                            <td><?php echo htmlentities($result->SubjectName);?></td>
                                                            <td><?php echo htmlentities($result->horario);?></td>
                                                            <td><?php echo htmlentities($result->Creditos);?></td>      
                                                            <td><?php echo htmlentities($result->Costo);?></td>                                                                                                                        
<td>
    
<a href="add-inscripcion-alu.php?delid=<?php echo htmlentities($result->id);?>"><i class="fa fa-trash" title="Delete Record"></i> Borrar </a> 
</td>
</tr>
<?php $cnt=$cnt+1;}} ?>
                                                       
                                                    
                                                    </tbody>
                                                </table>

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
    $('#materia_select').change(function(){
		var parent = $(this).parent()
		var id = $(this).val()
		var credito = $(this).find('option[value="'+id+'"]').attr('data-credito')
        var horario = $(this).find('option[value="'+id+'"]').attr('data-horario')
        var costo = $(this).find('option[value="'+id+'"]').attr('data-costo')

        $('#credito2_select').val(credito);

		if(parent.find('small').length > 0)
			parent.find('small').remove()
		parent.append("<small><b><i>Credito: "+credito+"</i></b></small> <br>")	
        parent.append("<small><b><i>Horario: "+horario+"</i></b></small> <br>")	
        parent.append("<small><b><i>Costo: "+costo+"</i></b></small>")	
	})

    $(function($) {
     $(".js-states").select2();
     $(".js-states-limit").select2({maximumSelectionLength: 2});
                $(".js-states-hide").select2({minimumResultsForSearch: Infinity});
            });
</script>
    </body>
</html>
<?PHP } ?>
