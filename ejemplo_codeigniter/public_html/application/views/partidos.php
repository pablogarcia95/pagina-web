<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>WIN 7-24</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/stylesheets/partidos.css" type="text/css" media="all" />
<!--[if lte IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" /><![endif]-->

<style>
	#calcula {
		position: fixed;
  		right: 5px;
   		top: 140px;
   		width: 28%;
   		height: 470px;
   		border: #663366 5px double;
   		background-color: white;
   		color: black;
	}

	#res {
	    background-color:black;
	    color:white;
	    text-align:center;
	    padding:5px;
	}
	
	#base,#monto{
	    background-color:black;
	    color: #00FF00;
	    text-align:center;
	    padding:2px;
	    font-weight: lighter;
	    font-size:2em;
	    
	    font-family:'Helvetica','Verdana','Monaco',sans-serif;
	}
	
	#tabla_calcula{
		<!--margin: auto;-->
		position:relative;
		top:3px;
		width: 95%;
		<!--height: 20px;-->
		border:1px solid #000000;
		padding: 2px;
	}
	
	#ticket{
		width: 100%; 
	}
	
	#monto_premio{
		position:relative;
		<!--top: 550px;-->
		
		top:3%;
   		width: 90%;
   		border:1px solid #000000;
	}
	
	table { 
	  width: 70%; 
	  border-collapse: collapse;
	  font-weight: 900;
	  
	}
	/* Zebra striping */
	tr:nth-of-type(odd) { 
	  background: #eee; 
	  color: black;
	}
	th { 
	  background: #00FF00; 
	  color: white; 
	  font-weight: bold; 
	}
	td, th { 
	  padding: 6px; 
	  border: 1px solid #ccc; 
	  text-align: left; 
	}
	
	input{
	   width: 90%;
	   margin: 0 auto;
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
		<?php $tor = -1; $camb=1; ?>
		<?php foreach($listPartidos as $par): ?>
		<?php
			if($tor == -1 || $tor != $par['torneo_id']) {
				$tor = $par['torneo_id'];
				if($camb !=1) {	
					echo "</table></div><br>";
				} else {
					$camb = 0;
				}
				echo "
				<div class='tbl' onselectstart='return false'>
				<table>	<tr><td colspan='7'>" . $par["torneo_nombre"]." (<strong>Fecha: </strong>".$par['par_fecha'].")</td></tr>
					<tr>
						<td>Ref</td>
						<td>Hora</td>
						<td>Partido</td>
						<td>Local</td>
						<td>Empate</td>
						<td>Visitante</td>
					</tr>";
			}
echo "<tr id='info'><td>".$par['par_id']."</td><td>".$par['par_hora']."</td><td>".$par['par_equipo1'].'-Vs-'.$par['par_equipo2']."</td><td id='q2'>".$par['par_porcentaje1']."</td><td id='t1'>".$par['par_porcentaje3']."</td><td id ='y8'>".$par['par_porcentaje2']."</td></tr>";
			
			?>
		<?php endforeach; ?>
		<?php
			if($camb == 0) { 
				echo "</table></div>";
			}
		?>
		</div>
		<div id="calcula" name="calcula">
			<h2 style='text-align:center'>Cálculo de la Jugada</h2><br>
			<label style="font-weight:bold; font-size:14px;"> Monto de la apuesta en 
			<select id=Monto del premio￼ ￼
"mon_id" name="mon_id">
			<?php foreach($listMonedas as $mon): ?>
			<?php
				echo "<option value='".$mon['mon_id']."'> ".$mon['mon_descripcion']." </option>";
			?>
			<?php endforeach; ?>
			</select></label><input value="5000" type="number" id="base" name="base"/>
			<div id="tabla_calcula">
				<table id="ticket"><tr><td>Ref</td><td>Partido</td><td>Logro</td><td>Apuesta</td></tr></TABLE>
			</div>
			<div id="monto_premio">
				<label style="font-weight:bold; font-size:14px;"> Monto del premio </label> 
				<input style="width:70%;" value="0" type="text" id="monto" name="monto" readonly />
				<input style="weight:35px; width:35px;" type="image" src="<?php echo base_url(); ?>public/images/printer.png" alt="Submit" onclick="imprime('#ticket');" />
			</div>
		</div>
		
	</div>
	
	<!-- End Heading -->

</body>

<!-- Scripts -->
	<!-- <script src="<?php echo base_url(); ?>/public/scroll/js/jquery.min.js"></script> -->
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script>
	
		function getTabla(elem){
			var cab=false;
			var a="";var b="";var c="";
			$("#ticket tr").each(function () {
				if (cab == false){
					cab=true;
				}
				else{
					a=a+$(this).find("td").eq(0).html()+"::";
					b=b+$(this).find("td").eq(2).html()+"::";
					c=c+$(this).find("td").eq(3).html()+"::";
				}
			});
			a = a.substring(0, a.length-2);
			b = b.substring(0, b.length-2);
			c = c.substring(0, c.length-2);
			var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

			var f = new Date();
			fecha=f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
			hora=cad=f.getHours()+":"+f.getMinutes()+":"+f.getSeconds(); ;
			Popup($(elem).prop('outerHTML'), fecha, hora, $('#mon_id').val());

		}
	
		function imprime(elem){
			var r = confirm("Desea imprimir ésta apuesta?");
			if (r == true) {
				getTabla(elem);
			} else {
			    
			}
		    }
		
		function Popup(da, fecha, hora, moneda) 
		    {
		        var mywindow = window.open('', 'my div', 'height=400,width=600');
		        //mywindow.document.write('<style> body { font-family: Cambria, Georgia, serif; font-size: 24px; font-style: normal; font-variant: normal; font-weight: 500; line-height: 26.3999996185303px; }</style>');
		        //mywindow.document.write('<style> body { font-family: arial, helvetica, sans-serif; }</style>');
		        mywindow.document.write('<body>Nota: Expira a los tres (3) dias');
		        mywindow.document.write('<br>http://win7-24.com/');
		        mywindow.document.write('<br>');
		        mywindow.document.write('<br>C O T I Z A C I O N');
		        mywindow.document.write('<br>Fecha - Hora: '+fecha+' - '+hora);
		        mywindow.document.write('<br>Jugada: '+addCommas($('#base').val()));
		        mywindow.document.write('<br>----------------------------------------');
		        mywindow.document.write('<br>'+da);
		        mywindow.document.write('<br>----------------------------------------');
		        mywindow.document.write('<br>Premio Pesos: ' + $('#monto').val());
		        mywindow.document.write('<br>Documento no válido');
		        mywindow.document.write('<br>Acérquese a uno de nuestros puntos de pago</body>');
		        mywindow.print();
		        mywindow.close();
		        return true;
		    }
		    
		    $("#base").keydown(function (e) {
		        // Allow: backspace, delete, tab, escape, enter and .
		        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
		             // Allow: Ctrl+A, Command+A
		            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
		             // Allow: home, end, left, right, down, up
		            (e.keyCode >= 35 && e.keyCode <= 40)) {
		                 // let it happen, don't do anything
		                 return;
		        }
		        // Ensure that it is a number and stop the keypress
		        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
		            e.preventDefault();
		        }
		    });
	
		function addCommas(str) {
		    var parts = (str + "").split("."),
		        main = parts[0],
		        len = main.length,
		        output = "",
		        i = len - 1;
		    
		    while(i >= 0) {
		        output = main.charAt(i) + output;
		        if ((len - i) % 3 === 0 && i > 0) {
		            output = "," + output;
		        }
		        --i;
		    }
		    // put decimal part back
		    if (parts.length > 1) {
		        output += "." + parts[1];
		    }
		    return output;
		}
		b=0;
		
		
		function rgb2hex(rgb) {
		     if (  rgb.search("rgb") == -1 ) {
		          return rgb;
		     } else {
		          rgb = rgb.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+))?\)$/);
		          function hex(x) {
		               return ("0" + parseInt(x).toString(16)).slice(-2);
		          }
		          return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]); 
		     }
		}

		function val_rep(element, col){
			var c1 = rgb2hex(element.find("td").eq(3).css("background-color"));
			var c2 = rgb2hex(element.find("td").eq(4).css("background-color"));
			var c3 = rgb2hex(element.find("td").eq(5).css("background-color"));
			//alert(col);
			var c1_=false;
			var c2_=false;
			var c3_=false;
			if(c1=='#aeb404'){
				//alert ('Amarillo el primero');
				return true;
			}
			if(c2=='#aeb404'){
				//alert ('Amarillo el segundo');
				return true;
			}
			if(c3=='#aeb404' ){
				//alert ('Amarillo el tercero');
				return true;
			}
			return false;
		}
		var pagoVeces = '1-2015,2-2015,3-2950,4-3650,5-4150,6-4950,7-5590,8-6470'.split(',');
		
		function evalua_estadistica(premio, i, montoJugada){
			//if (i == 0)
			//	rango = pagoVeces[i].split('-');
			//else
				rango = pagoVeces[i-1].split('-');
			if(rango[0]==(i)) {
				limite = parseInt(rango[1])*montoJugada;
				if(premio>limite) {
					//alert("rango1="+rango[1]+" montoJugada => "+montoJugada+" premio => "+premio+" limite => "+limite);
					limite = Math.min(premio,limite);
					var sLim = ""+limite;
					var factor = 1;
					for(var k=(sLim.length-1); k>0; k--) {
						if(sLim.charAt(k)==0) {	factor = factor*10;} else {break;}
					}			
					if(factor>9) {
					    limite = limite + (premio%parseInt(factor));
					}
					
					premio = Math.min(premio,limite);
				}
			}
			return premio;
		}
		
		function calcula_premio(monto){
			//var c=$('#ticket td:nth-child(3)').text();
			var total=0;
 			var cab=false;
 			var apuesta=parseInt(monto);
 			var i=0;
 			$('#monto').val('0');
			$("#ticket tr").find('td:eq(2)').each(function () {
				if (cab==false){
					cab=true;
				}
				else{
					valor = $(this).html();
					signo=valor.substr(0,1);
					porc=parseInt(valor.substr(1));
					if (signo=='+')
						apuesta = apuesta+(apuesta*(porc/100));
					else if (signo=='-')
						apuesta = apuesta+(apuesta/(porc/100));
					//alert(apuesta);
					i++;
				}
				apuesta=Math.round(apuesta);
			});
			apuesta=evalua_estadistica(apuesta,i,monto);
			//alert(apuesta);
			return apuesta;
		}
		
		$('#base').keyup(function(e){
		
			if(e.keyCode == 13){
				$(this).trigger("enterKey");

				if (base!='' && c<=8){
					//alert('Enter');
					premio=calcula_premio($('#base').val());
					$('#monto').val(addCommas(premio));
				}
			}
		});
		
		var c=0;
		$("tr#info td").click(function() {     // function_td
			var row_index = $(this).parent().index();
			var col_index = $(this).index();

			if (col_index >= 3 && col_index <=5){
				if ( rgb2hex($(this).css("background-color"))=='#000000'){ 
					if (val_rep($(this).parent(), col_index)){
						var partido = rgb2hex($(this).parent().find("td").eq(2).text());
						alert('Solo podrá hacer una selección para el partido '+partido);
					}
					else{
						if (c<8){
							$(this).css("background-color","#aeb404");
							c++;
							$('#ticket > tbody:last-child').append('<tr><td>'+$(this).parent().find("td").eq(0).text()+'</td><td>'+$(this).parent().find("td").eq(3).text()+'</td><td>'+$(this).text()+'</td><td>'+$("#info").parent().find("td").eq(col_index+1).text()+'</td></tr>');
						}
						else{
							alert('Llegaste al límite de combinaciones');
						}
					}
				}
				else{
					$(this).css("background-color","transparent");
					c--;
					var ref = $(this).parent().find("td").eq(0).text();
					var $rowsNo = $('#ticket tbody tr').filter(function () {
					        return $.trim($(this).find('td').eq(0).text()) === ref
					    }).remove();
				
				}
				//alert(''+$("#base").text());
				//alert(''+document.getElementById('base').value);
				var base=document.getElementById('base').value;
				if (base!='' && c<=8){
					premio=calcula_premio(base);
					$('#monto').val(addCommas(premio));
					//alert(apuesta);
				}
				switch($(this).attr("id")) {
				case 'q2':
					//alert($(this).text());
				    	break;
				}
			}
		});
	</script>
</html>