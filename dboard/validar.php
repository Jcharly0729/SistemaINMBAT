<?php
$usuario=$_POST['usuario'];
$contrasena=$_POST['Contraseña'];
session_start();


$conexion=mysqli_connect("localhost","root","","sistemainmbat");

$consulta="SELECT*FROM tblteacher where User='$usuario' and Pass='$contrasena'";
$resultado=mysqli_query($conexion,$consulta);

$filas = mysqli_fetch_array($resultado);

$consulta2="SELECT*FROM tblstudents where usuario='$usuario' and PassStu='$contrasena'";
$resultado2=mysqli_query($conexion,$consulta2);

$filas2 = mysqli_fetch_array($resultado2);

if($filas!= null)
{
    $_SESSION['user']=$usuario;
    $_SESSION['pass']=$contrasena;

    if($filas['rol_id']==1){ //Administrador Escuela
        $_SESSION['rol']=1;        
    header("location:admin.php");    
    }else
    
    if($filas['rol_id']==2){ //Docente  Escuela
        //$_SESSION['rol']=2;
        $_SESSION['DocenteId']=$filas['idTeacher'];
    header("location:docente.php");
    }else
    
    if($filas['rol_id']==4){ //Administrador  Colegio
        $_SESSION['rol']=4;
    header("location:admin.php");
    }else
    
    if($filas['rol_id']==5){ //Docente  Colegio
        //$_SESSION['rol']=5;
        $_SESSION['DocenteId']=$filas['idTeacher'];
    header("location:docente.php");
    }
} else if($filas2!= null){
    $_SESSION['user']=$usuario;
    $_SESSION['pass']=$contrasena;

    if($filas2['rol_id']==3){ //Estudiante Escuela
        //$_SESSION['rol']=3;
        $_SESSION['StudentId']=$filas2['StudentId'];
    header("location:estudiante_panel.php");
    }else    
    if($filas2['rol_id']==6){ //Estudiante  Escuela
        //$_SESSION['rol']=6;
        $_SESSION['StudentId']=$filas2['StudentId'];
    header("location:estudiante_panel.php");   
    } 

}else{

    ?>
    <?php
    include("login.php");
    ?>
    <h1 class="bad">ERROR DE USUARIO O CONTRASEÑA</h1>
    <?php

}
mysqli_free_result($resultado);
mysqli_close($conexion);
