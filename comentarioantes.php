<?php
$nombre = $_POST['Nombres'];
$correo = $_POST['Correo'];
$telefono = $_POST['Telefono'];
$subject = $_POST['Subject'];
$mensaje= $_POST['Mensaje'];

$header = 'Enviado Dedes: Colegio Infantil Atala' . $correo . " \r\n";
$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/plain";

$message = "Este mensaje fue enviado por: " . $nombre . " \r\n";
$message .= "Su e-mail es: " . $correo . " \r\n";
$message .= "Teléfono de contacto: " . $telefono . " \r\n";
$message .= "Mensaje: " . $_POST['Mensaje'] . " \r\n";
$message .= "Enviado el: " . date('d/m/Y', time());

$para = 'cjmesa28@gmail.com';
$asunto = 'Mensaje de Colegio Infantil Atala';

mail($para, $asunto, utf8_decode($message), $header);

echo "<script>alert(Correo enviado exitosamente.</scrip>";
echo "<script> m_setTimeout(\"Location.href='index.html'\",1000)</scrip>";

?>	