<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Calificaciones</title>
  <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
  <link rel="shortcut icon" href="#" /> 
  <link rel="stylesheet" href="css/font-awesome.min.css" media="screen" >
  <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen" >
  <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen" >
  <link rel="stylesheet" href="css/prism/prism.css" media="screen" >
  <link rel="stylesheet" href="css/main.css" media="screen" >
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">  
  <script src="js/modernizr/modernizr.min.js"></script>
    </head>
    <body>
     <div class="main-wrapper">
       <div class="content-wrapper">
        <div class="content-container">
                <!-- /.left-sidebar -->
                       
                            <!-- /.row -->
                          <!-- /.row --></div>
                        <!-- /.container-fluid -->
                <section class="section">
                <div class="container-fluid">
                
                 <div class="col-md-8 col-md-offset-2">
                  <div class="panel">
                  <div class="panel-heading">
                  <div class="panel-title">
<?php
// code Student Data


$periodo=$_POST['periodo'];

$_SESSION['periodo']=$periodo;

$user = $_SESSION['user'];
$pass = $_SESSION['pass'];
$rol = $_SESSION['rol'];
$StudentId =0;

$comentario="";
$ausencias=0;
$qery = "SELECT s.StudentName, s.cedula,s.rol_id,sl.reg_date,s.StudentId,s.Status,c.ClassName,c.Section from tblstudents as s join tblclasses as c on c.id=s.ClassId inner join tblstudents_log sl on sl.student_id = s.StudentId where s.usuario = :user and s.PassStu = :pass";
$stmt = $dbh->prepare($qery);
$stmt->bindParam(':user',$user,PDO::PARAM_STR);
$stmt->bindParam(':pass',$pass,PDO::PARAM_STR); 
$stmt->execute();
$resultss=$stmt->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($stmt->rowCount() > 0)
{
foreach($resultss as $row)
{   
?>
    
<button id="btnReportePDF" align="right" style = "margin-left: 80%;">PDF</button>
<img src="images/iebclogo.png" alt="informacion">
<br><br><br>
      
    <div style = "margin-left: 50px;margin-right: 40px; padding-top: 10px;">        
            <b style = "margin-left: 20px; color: gray; font-size:14px;">DATOS DEL ESTUDIANTE</b>                    
        <p>             
            <b style = "margin-left: 20px; padding-right: 20px; border-bottom: ridge; border-color: gray;"> 
                <?php echo htmlentities($row->StudentName); $StudentId = $row->StudentId;?>
            </b>
            <b style = "float: right; background-color: #e7bdbd; color:black; padding:10px; padding-left:40px; padding-right:40px;"> 
                <?php echo htmlentities($row->cedula); ?>
            </b>
            <br>
            <b style = "margin-left: 20px; color: gray; font-size:12px;">NOMBRES Y APELLIDOS </b>          
        </p>                                  
    </div>

    <div style = "margin-left: 30px; padding-top: 10px;" class="col-md-12">        
            <b style = "margin-left: 20px; color: gray; font-size:14px;">DATOS DE LA INSTITUCION</b>                    
        <p>             
            <b style = "margin-left: 20px; padding-right: 10px; border-bottom: ridge; border-color: gray; font-size:12px; color:black;"> 
                <?php echo 'INEB "BERNARDO ALVARADO TELLO" INMBAT, SAN PEDRO SOLOMA, HUEHUETENANGO'?>
            </b>    

            <?php

            $query ="SELECT d.StudentId, d.StudentName, a.id,
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
            WHERE a.inscripcion_matricula_id in (SELECT x.id 
            FROM tblinscripcion_matricula x 
            where x.student_id = '$StudentId' and x.Estado = 2) and a.nota_final >=3.5";
            $query= $dbh -> prepare($query);
            $query-> execute();  

            $results = $query -> fetchAll(PDO::FETCH_OBJ);                
            $cnt=1;
            if($countrow=$query->rowCount()>0)
            { 
            $costototal=0;
            $creditototal = 0;
            foreach($results as $result){
            $cont += 1;
            $promediototal += $result->nota_final;

            }
            $prom = $promediototal/$cont;
            }
            ?>

            <b style=" float: right; background-color: white; color:black; margin-right: 50px; border: ridge; border-color: gray; padding:10px"  > 
                <?php echo htmlentities($prom) ?>
            </b>             
            <b style=" float: right; background-color: gray; color:white; " class="col-md-2" > 
                <?php echo "PROMEDIO ACUMULADO" ?>                   
            </b>                                                                                                               
            <br>
        </p>                                  
    </div>
<?php }}

    ?></div>
     <div class="panel-body p-20"><table class="table table-hover table-bordered">
      <thead>
     <tr>     
     <th rowspan="2" style = "text-align:center; color: white; background-color: gray; ">CURSOS</th>   
     <th rowspan="2" style = "text-align:center; color: white; background-color: gray; ">GRADO Y SECCIÓN</th>   
     <th colspan="4" style = "text-align:center; color: white; background-color: gray; ">BIMESTRES</th>     
     <th rowspan="2" style = "text-align:center; color: white; background-color: gray; ">PROMEDIO FINAL</th>   
     </tr>
     <tr>
     <th style = "text-align:center; color: white; background-color: gray; ">1</th>
     <th style = "text-align:center; color: white; background-color: gray; ">2</th>
     <th style = "text-align:center; color: white; background-color: gray; ">3</th> 
     <th style = "text-align:center; color: white; background-color: gray; ">4</th> 
     </tr>     
    </thead>   

    
  <tbody>
<?php                                              

$query ="SELECT d.StudentId, d.StudentName, a.id,
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
WHERE a.inscripcion_matricula_id in (SELECT x.id 
FROM tblinscripcion_matricula x 
where x.student_id = '$StudentId' and x.Estado = 2) and a.nota_final >=3.5";
$query= $dbh -> prepare($query);
$query-> execute(); 
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($countrow=$query->rowCount()>0)
{ 
$costototal=0;
$creditototal = 0;
foreach($results as $result){
    $cont += 1;
    $promediototal += $result->nota_final;
        ?>
    <tr>
        <td><?php echo htmlentities($result->materia);?></td>
        <td><?php echo htmlentities($result->classes);?></td>   
        <td><?php echo htmlentities($result->primer_corte);?></td>   
        <td><?php echo htmlentities($result->segundo_corte);?></td>   
        <td><?php echo htmlentities($result->tercer_corte);?></td>  
        <td><?php echo htmlentities($result->cuarta_corte);?></td>     
        <td><?php echo htmlentities($result->nota_final);?></td>                                
    </tr> 
    <?php
        }
        ?>                                                   
 <?php 
 } else {?>

<div class="alert alert-danger left-icon-alert" role="alert">
<strong>Hubo un error intenta de nuevo!!</strong>
<?php
 }
?>
   </div>
  </tbody>
 </table>
</div>
</div>

<!-- /.col-md-6 -->
<div class="form-group">
    <div class="col-sm-6">
    <a href="estudiante_panel.php">Volver </a></div></div></div>
                                <!-- /.row --></div>
                            <!-- /.container-fluid --></section>
                        <!-- /.section -->        </div>
                    <!-- /.main-page --></div>
                <!-- /.content-container --></div>
            <!-- /.content-wrapper --></div>
        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="../html2pdf/html2pdf.bundle.min.js"></script>
        <script src="../html2pdf/script.js"></script>
        

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script>
            $(function($) {

            });
        </script>
         <script type="text/javascript" src="main.js"></script> 
          <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>    
     
    <!-- para usar botones en datatables JS -->  
    <script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
      

        <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->

    </body>
</html>
