<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Contacto - Colegio Infantil Atala</title>
	<link rel="favicon" href="assets/images/favicon.png">
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen">
	<link rel="stylesheet" href="assets/css/style.css">
	
</head>

<body>
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
				<a class="navbar-brand" href="index.html">
					<img src="assets/images/logo.png" alt="Techro HTML5 template"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right mainNav">
					<li><a href="index.html">Inicio</a></li>
					<li><a href="nosotros.html">Nosotros</a></li>                    
                    <li><a href="admision.html">Admiciones</a></li>
                    <li class="active"><a href="contacto.php">Contacto</a></li>
					<ul class="nav navbar-nav navbar-right">
    			    <li><a href="dboard/login.php"><span class=""></span> Ingreso docentes</a></li>
    			    <li><a href="dboard/estudiante.php"><span class=""></span> Ingreso Padres</a></li></ul>
								
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</div>
	<!-- /.navbar -->

	<header id="head" class="secondary">
		<div class="container">
			<div class="row">
				<div class="col-sm-8">
					<h1>Contactanos</h1>
				</div>
			</div>
		</div>
	</header>

	<!-- container -->
	<div class="container">
				<div class="row">
					<div class="col-md-6">
						<h3 class="section-title">Envianos tus preguntas</h3>
							<div class="form-group">			
						<form action="comentario.php" class="form-light mt-20" method="post" name="form1" role="form">
							
								<input type="text" class="form-control" name="Nombres" placeholder="Nombre Completo" required="">
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
									<input type="email" class="form-control" name="Correo" placeholder="Correo" required="">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" name="Telefono" placeholder="Telefono" required="">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label></label>
								<input type="text" class="form-control" name="Subject" placeholder="Subject" required="">
							</div>
							<div class="form-group">
								<textarea class="form-control" id="message"name="Mensaje" placeholder="Escribe tu memsaje..." style="height:100px;"></textarea>
							</div>
							<input type="submit" name="Enviar" action="mailto:cjmesa28@gmail.com" class="btn btn-two" placeholder="Enviar"><p><br/></p>
						</form>
					</div>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<h3 class="section-title">Nuestra Dirección</h3>
								<div class="contact-info">
								
									<h5>Email</h5>
									<p>colegioinfantilatala@gmail.com </p>
									
									<h5>Telefono</h5>
									<p>(809) 533-4662</p>
								</div>
							</div>
							<div class="col-md-6">								
								<h3 class="section-title">Horario</h3>
								<div class="contact-info">
									<h5>Lunes - Viernes</h5>
									<p>07:00 AM - 2:00 PM</p>
									
									<h5>Sabados</h5>
									<p>Cerrado  </p>
									
									<h5>Sunday</h5>
									<p>Cerrado </p>
								</div>
							</div>
						</div>

				</div>
			</div>
			<section>
						<div class="container">							
						<h3 class="section-title">Ubicacion</h3>
							<h5>Dirección</h5>
									<p>Calle Bartolomé Olegario Pérez 12, Santo Domingo</p>
									
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3784.8773130102!2d-69.942886285874!3d18.443878787453624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8ea56217ae84af5b%3A0xdbdf0c8df4680cea!2sColegio%20infantil%20Atala!5e0!3m2!1ses-419!2sdo!4v1623590853836!5m2!1ses-419!2sdo" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>				
					</div>
			</section>
	<!-- /container -->

	

	<footer id="footer">
           <div class="social text-center">
                <a href="https://www.facebook.com/Colegio-Infantil-Atala-103261961843323"><i class="fa fa-facebook"></i></a>
                <a href="https://www.instagram.com/colegioinfantilatala/?hl=es-la"><i class="fa fa-instagram" aria-hidden="true"></i> </a>
                <a href="https://api.whatsapp.com/send?phone=+18294777039"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></a>

            </div>
                <div class="clear"></div>
			<!--CLEAR FLOATS-->
		</div>
		<div class="footer2">
			<div class="container">
				<div class="row">

					<div class="col-md-6 panel">
						<div class="panel-body">
							<p class="simplenav">
								<a href="index.html">Inicio</a> | 
								<a href="nosotros.html">Nosotros</a> |
								<a href="admision.html">Admiciones</a> |
								<a href="contacto.php">Contacto</a>
							</p>
						</div>
					</div>
					</div>

					<div class="col-md-6 panel">
						<div class="panel-body">
							<p class="text-right">
								Copyright &copy; 2021. 
							</p>
						</div>
					</div>

				</div>
				<!-- /row of panels -->
			</div>
		</div>
	</footer>


	<!-- JavaScript libs are placed at the end of the document so the pages load faster -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>

	<!-- Google Maps -->
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	<script src="assets/js/google-map.js"></script>
	<script src="https://use.fontawesome.com/d5a577972d.js"></script>

</body>
</html>
