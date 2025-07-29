<?php
$usuario=$_POST['usuario'];
$contrasena=$_POST['contrasena'];
session_start();
$_SESSION['usuario']=$usuario;

$conexion=mysqli_connect("localhost","root","admin1","sistemainmbat");

$consulta="SELECT*FROM tblusuario where usuario='$usuario' and contrasena='$contrasena'";
$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_fetch_array($resultado);

if($filas['idroles']==1){ //Administrador
    header("location:user/admin.php");

}else

if($filas['idroles']==2){ //Docente 
header("location: docente.php");
}else

if($filas['idroles']==3){ //Estudiante 
header("location: dboard/user/admin.php");
}
else{
    ?>
    <?php
    include("login.php");
    ?>
    <h1 class="bad">ERROR EN LA AUTENTIFICACION</h1>
    <?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);
