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
<style>
	#res {
	    background-color:black;
	    color:white;
	    text-align:center;
	    padding:5px;
	}
	
	.tbl {
		margin:0px;padding:0px;
		width:100%;
		box-shadow: 10px 10px 5px #888888;
		border:1px solid #000000;
		
		-moz-border-radius-bottomleft:0px;
		-webkit-border-bottom-left-radius:0px;
		border-bottom-left-radius:0px;
		
		-moz-border-radius-bottomright:0px;
		-webkit-border-bottom-right-radius:0px;
		border-bottom-right-radius:0px;
		
		-moz-border-radius-topright:0px;
		-webkit-border-top-right-radius:0px;
		border-top-right-radius:0px;
		
		-moz-border-radius-topleft:0px;
		-webkit-border-top-left-radius:0px;
		border-top-left-radius:0px;
	}.tbl table{
	    border-collapse: collapse;
	        border-spacing: 0;
		width:100%;
		height:100%;
		margin:0px;padding:0px;
	}.tbl tr:last-child td:last-child {
		-moz-border-radius-bottomright:0px;
		-webkit-border-bottom-right-radius:0px;
		border-bottom-right-radius:0px;
	}
	.tbl table tr:first-child td:first-child {
		-moz-border-radius-topleft:0px;
		-webkit-border-top-left-radius:0px;
		border-top-left-radius:0px;
	}
	.tbl table tr:first-child td:last-child {
		-moz-border-radius-topright:0px;
		-webkit-border-top-right-radius:0px;
		border-top-right-radius:0px;
	}.tbl tr:last-child td:first-child{
		-moz-border-radius-bottomleft:0px;
		-webkit-border-bottom-left-radius:0px;
		border-bottom-left-radius:0px;
	}.tbl tr:hover td{
		
	}
	.tbl tr:nth-child(odd){ background-color:#e5e5e5; }
	.tbl tr:nth-child(even)    { background-color:#ffffff; }.tbl td{
		vertical-align:middle;
		
		
		border:1px solid #000000;
		border-width:0px 1px 1px 0px;
		text-align:left;
		padding:7px;
		font-size:10px;
		font-family:Arial;
		font-weight:normal;
		color:#000000;
	}.tbl tr:last-child td{
		border-width:0px 1px 0px 0px;
	}.tbl tr td:last-child{
		border-width:0px 0px 1px 0px;
	}.tbl tr:last-child td:last-child{
		border-width:0px 0px 0px 0px;
	}
	.tbl tr:first-child td{
			background:-o-linear-gradient(bottom, #000000 5%, #b2b2b2 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #000000), color-stop(1, #b2b2b2) );
		background:-moz-linear-gradient( center top, #000000 5%, #b2b2b2 100% );
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#000000", endColorstr="#b2b2b2");	background: -o-linear-gradient(top,#000000,b2b2b2);
	
		background-color:#000000;
		border:0px solid #000000;
		text-align:center;
		border-width:0px 0px 1px 1px;
		font-size:14px;
		font-family:Arial;
		font-weight:bold;
		color:#ffffff;
	}
	.tbl tr:first-child:hover td{
		background:-o-linear-gradient(bottom, #000000 5%, #b2b2b2 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #000000), color-stop(1, #b2b2b2) );
		background:-moz-linear-gradient( center top, #000000 5%, #b2b2b2 100% );
		filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#000000", endColorstr="#b2b2b2");	background: -o-linear-gradient(top,#000000,b2b2b2);
	
		background-color:#000000;
	}
	.tbl tr:first-child td:first-child{
		border-width:0px 0px 1px 0px;
	}
	.tbl tr:first-child td:last-child{
		border-width:0px 0px 1px 1px;
	}
</style>
</head>
<body>
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
				<li><a href="http://win7-24.com/">Inicio</a></li>
				<li><a href="http://win7-24.com/ingresar">Comunidad</a></li>
			</ul>
			<div class="cl">&nbsp;</div>
		</div>
	</div>
	<!-- End Navigation -->
	<!-- Heading -->
	<div id="heading">
		<div id="res">
			<h1>Resultados</h1>
		</div>
		<div class="tbl">
			<table >
				<tr>
					<td>Hora</td>
					<td>Fecha</td>
					<td>Partido</td>
					<td>Local</td>
					<td>Visitante</td>
				</tr>
				
				<?php foreach($listPartidos as $par): ?>
						<?php
							echo "<tr><td>".$par['par_hora']."</td><td>".$par['par_fecha']."</td><td>".$par['par_equipo1'].'-Vs-'.$par['par_equipo2']."</td><td>".$par['marcadores']['mar_gol1']."</td><td>".$par['marcadores']['mar_gol2']."</td></tr>";
						?>
					<?php endforeach; ?>
			</table>
		</div>
	</div>
	<!-- End Heading -->

</body>

<!-- Scripts -->
	<script src="<?php echo base_url(); ?>/public/scroll/js/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>/public/scroll/js/plugins.js"></script>
	<script src="<?php echo base_url(); ?>/public/scroll/js/sly.min.js"></script>
	<script src="<?php echo base_url(); ?>/public/scroll/js/horizontal.js"></script>
</html>