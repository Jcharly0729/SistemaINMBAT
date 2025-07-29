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
$qery = "SELECT s.StudentName,s.rol_id,sl.reg_date,s.StudentId,s.Status,c.ClassName,c.Section from tblstudents as s join tblclasses as c on c.id=s.ClassId inner join tblstudents_log sl on sl.student_id = s.StudentId where s.usuario = :user and s.PassStu = :pass";
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

<br >    
<p style ="text-align:center;  color: #2f2fc3"  ><b style ="font-size: 40px; color: #2f2fc3;">Recibo Matricula </b> <br><br>Todos Tenemos El Poder De Aprender</p>
<button id="btnReportePDF" align="right" style = "margin-left: 80%;"> PDF</button>
<p>        
    <div style = "border-style: ridge; border-color: #8383e0; margin-left: 50px;margin-right: 40px; padding-top: 10px;">
        <p>
            <b style = "margin-left: 20px; color: #3535bd;">no. </b>
            <b style = "margin-left: 20px; padding-right: 30px; border-color: #8383e0;">
                <?php echo htmlentities($row->StudentId);?>
            </b>
        </p>
        <p> 
            <b style = "margin-left: 20px; color: #3535bd;">Nombre de Estudiante </b>
            <b style = "margin-left: 20px; padding-right: 100px; border-color: #8383e0;"> 
                <?php echo htmlentities($row->StudentName); $StudentId = $row->StudentId;?>
            </b>             
        </p>                          
    </div>
<?php }}

    ?></div>
     <div class="panel-body p-20"><table class="table table-hover table-bordered">
      <thead>
     <tr>     
     <th rowspan="2" style = "color: #3535bd;">Areas Curriculares</th>   
     
     <th colspan="2" style = "text-align:center; color: #3535bd;"> Detalle </th>     
     </tr>
     <tr>
     <th style = "color: #3535bd;">Credito</th>
     <th style = "color: #3535bd;">Costo</th> 
     </tr>     
    </thead>   

    
  <tbody>
<?php                                              
// Code for result SELECT s.StudentName, s.rol_id, r.ClassId, r.ciclo1, r.ciclo2, r.ciclo3, r.ciclo4, r.comentario, r.ausencias, sj.SubjectName, s.usuario, s.PassStu FROM tblresult r inner join tblstudents s on s.StudentId = r.StudentId inner join tblsubjects sj on sj.id = r.SubjectId WHERE s.usuario = 'fer.flores' and s.PassStu = 'contrasena'

 $query ="SELECT a.id, CONCAT(d.ClassName, ' - ',d.ClassNameNumeric, ' - ',d.Section) as classes, a.estado,
 e.descripcion as horario, f.SubjectName, f.Creditos, f.Costo, g.Name as teacher
 FROM tblcalificaciones a
 INNER JOIN tblinscripcion_matricula b on a.inscripcion_matricula_id = b.id
 INNER JOIN tblclasses_asignacion c on a.clase_asignacion_id = c.idClassAsig
 INNER JOIN tblclasses d on c.classes_id = d.id
 INNER JOIN tblhorario e on c.horario_id = e.id
 INNER JOIN tblsubjects f on c.subject_id = f.id
 INNER JOIN tblteacher g on c.teacher_id = g.idTeacher
 WHERE (b.Estado = 1 and b.student_id = '$StudentId' and a.estado = 1)";
$query= $dbh -> prepare($query);
$query-> execute();  
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($countrow=$query->rowCount()>0)
{ 
$costototal=0;
$creditototal = 0;
foreach($results as $result){
    $costototal += $result->Costo;
    $creditototal += $result->Creditos;
        ?>
    <tr>
        <td><?php echo htmlentities($result->SubjectName);?></td>
        <td><?php echo htmlentities($result->Creditos);?></td>      
        <td><?php echo htmlentities($result->Costo);?></td>                                
    </tr> 
    <?php
        }
        ?> 
    <tr>
        <td style = "color: #3535bd;">Totales</td>        
        <td style = "color: #3535bd;"> <?php echo htmlentities($creditototal); ?> </td>
        <td style = "color: #3535bd;"> <?php echo htmlentities($costototal); ?> </td>            
    </tr>                                                  
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
