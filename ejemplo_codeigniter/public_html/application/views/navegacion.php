<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WIN 7-24</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/stylesheets/style.css" type="text/css" media="all" />
<!--[if lte IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" /><![endif]-->

<link rel="stylesheet" href="<?php echo base_url(); ?>/public/scroll/css/normalize.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>/public/scroll/css/font-awesome.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>/public/scroll/css/ospb.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>/public/scroll/css/horizontal.css">
<script src="<?php echo base_url(); ?>/public/scroll/js/modernizr.js"></script>
</head>
<body oncontextmenu="return false" onkeydown="return false">
	<!-- Header -->
	<div id="header">
		<div class="shell">
			<!-- Logo -->
			<h1 id="logo" class="notext">
				<a href="#">WIN 7-24 Portal</a>
			</h1>
			<!-- End Logo -->
		</div>
	</div>
	<!-- End Header -->
	<!-- Navigation -->
	<div id="navigation">
		<div class="shell">
			<div class="cl">&nbsp;</div>
			<ul>
				<li><a href="http://win7-24.com/par">Partidos</a></li>
				<li><a href="http://win7-24.com/resultados">Resultados</a></li>
				<li><a href="http://win7-24.com/ingresar">Comunidad</a></li>
			</ul>
			<div class="cl">&nbsp;</div>
		</div>
	</div>
	<!-- End Navigation -->
	<!-- Heading -->
	<div id="heading">
		<div class="shell">
			<div id="heading-cnt">
				<!-- Sub nav -->
				<div style="left: 0; padding-top: 10px;">
				
				
				<script type="text/javascript">
					<!--
					padding = "5";
					width = "300px";
					bgColor = "#FFFFFF";
					linkColor = "#426200";
					textColorA = "#7CA726";
					textColorB = "#52701B";
					border = "1px solid #DDDDDD";
					textFont = "12px Arial, Helvetica, Sans serif";
					 //-->
					</script>
					<script language="javascript" src="http://www.resultados-futbol.com/scripts/api/api.php?key=392d39e295dac8cf41c55993fff09f14&format=widget&req=w_results&category=50&grated=1&extra=logo&comments=1"></script>
					<a target="_blank" style="margin-left:110px;font-size:10px;color:#426200;" href="http://www.resultados-futbol.com/">Resultados de F&uacute;tbol</a>
					
					

					
				</div>

				<!-- End Sub nav -->
				<!-- Widget -->
				<div id="heading-box">

					<div id="heading-box-cnt">
						<div class="cl">&nbsp;</div>
						<!-- Main Slide Item -->
						<div class="featured-main">
							<a href="#"><img src="<?php echo base_url(); ?>public/images/featured-main.jpg" alt="" /></a>

							<div class="featured-main-details">
								<div class="featured-main-details-cnt">
									<h4>
										<a href="#">Realiza las mejores apuestas con nosotros.</a>
									</h4>
									<p>La seriedad y el complimiento nos ha llevado al éxito en
										los juegos de azar .</p>
								</div>
							</div>

						</div>
						<!-- End Main Slide Item -->
						<div class="featured-side"></div>

						<div class="cl">&nbsp;</div>

					</div>
					<div style="position: absolute; top: 1px; left: 460px;">
						<object width='250' height='330' id='flashLatestPhoto'
							classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000'>
							<param name='movie'
								value='http://www.fifa.com/flash/widgets/photogallery/app.swf?lang=' es'/>
							<param name='bgcolor' value='#ffffff' />
							<param name='quality' value='high' />
							<param name='wmode' value='transparent' />
							<param name='flashvars' value='lang=es'>
								<embed width='250' height='330' flashvars='lang=es'
									wmode='transparent' quality='high' bgcolor='#ffffff'
									name='flashLatestPhoto' id='flashLatestPhoto'
									src=http://www.fifa.com/flash/widgets/photogallery/app.swf?lang=es type='application/x-shockwave-flash' />
						</object>
					</div>
				</div>

				<!-- End Widget -->
			</div>
		</div>
	</div>
	<!-- End Heading -->
	<!-- Main -->
	<div id="main">
		<div class="wrap">
			<h2>Partidos Disponibles <small>- habilitados para que registre su apuesta</small></h2>

			<div class="scrollbar">
				<div class="handle">
					<div class="mousearea"></div>
				</div>
			</div>
			<!-- http://darsa.in/sly/examples/horizontal.html -->
			<div class="frame" id="basic">
				<ul class="clearfix">
					<?php foreach($listPartidos as $equipo): ?>
						<?php
							echo '<li>'.$equipo['par_equipo1'].' -Vs- '.$equipo['par_equipo2'].'<br> ( '.$equipo['par_fecha'].'<br> ( '.$equipo['par_hora'].' )</li>';
						?>
					<?php endforeach; ?>
				</ul>
			</div>

			<ul class="pages"></ul>

			<div class="controls center">
				<button class="btn prevPage"><i class="icon-chevron-left"></i><i class="icon-chevron-left"></i> Anterior</button>
				<button class="btn nextPage">Siguiente <i class="icon-chevron-right"></i><i class="icon-chevron-right"></i></button>
			</div>
		
		</div>
		</div>
	</div>
	<!-- End Main -->
	<!-- Footer  
	<div id="footer">
		<div class="shell">
			<div class="cl">&nbsp;</div>
			<p class="right">
				&copy; Sitename.com. Design by <a href="http://chocotemplates.com">ChocoTemplates.com</a>
			</p>
			<div class="cl">&nbsp;</div>
		</div>
	</div>  -->
	<!-- End Footer -->
</body>

<!-- Scripts -->
	<script src="<?php echo base_url(); ?>/public/scroll/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>/public/scroll/js/plugins.js"></script>
	<script src="<?php echo base_url(); ?>/public/scroll/js/sly.min.js"></script>
	<script src="<?php echo base_url(); ?>/public/scroll/js/horizontal.js"></script>
</html>