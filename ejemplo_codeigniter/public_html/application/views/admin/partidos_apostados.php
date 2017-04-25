<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

<title>Administrador de pagos</title>

    <link href="<?php echo base_url(); ?>public/stylesheets/menu.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
    <script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>

</head>
<body oncontextmenu="return false">
	<?php echo $mi_menu?>
	<section>  
	<table id="dg" title="Frecuencia de Apuestas por Partido" class="easyui-datagrid" style="width:800px;height:250px"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="par_id" width="50">ID PAtido</th>
                <th field="par_equipo1" width="50">Local</th>
                <th field="par_equipo2" width="50">Visitante</th>
                <th field="par_porcentaje1" width="50">L</th>
                <th field="par_porcentaje2" width="50">E</th>
                <th field="par_porcentaje3" width="50">V</th>
                <th field="par_fecha" width="50">Fecha</th>
                <th field="par_hora" width="50">Hora</th>
                <th field="cantidad" width="50">Cantidad Votos</th>
            </tr>
        </thead>
		<?php foreach($listPartidosApostados as $item): 
		?>
		<?php
			echo '<tr><td>'.$item['par_id'].'</td><td>'.$item['par_equipo1_n'].'</td><td>'.$item['par_equipo2_n'].'</td></td><td>'.$item['par_porcentaje1'].'</td><td>'.$item['par_porcentaje2'].'</td><td>'.$item['par_porcentaje3'].'</td><td>'.$item['par_fecha'].'</td><td>'.$item['par_hora'].'</td><td>'.$item['cantidad'].'</td></tr>';
		?>
		<?php endforeach; 
		?>
    </table>
    
    
    
    <table id="dg" title="Frecuencia de Apuestas" class="easyui-datagrid" style="width:800px;height:250px"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="par_id" width="50">ID PAtido</th>
                <th field="par_equipo1" width="50">Local</th>
                <th field="par_equipo2" width="50">Visitante</th>
                <th field="cantidad1" width="50">Cantidad Local</th>
                <th field="cantidad2" width="50">Cantidad Visitante</th>
            </tr>
        </thead>
		<?php foreach($listEquiposApostados as $item2): 
		?>
		<?php
			echo '<tr><td>'.$item2['par_id'].'</td><td>'.$item2['par_equipo1_n'].'</td><td>'.$item2['par_equipo2_n'].'</td></td><td>'.$item2['cantidad1'].'</td><td>'.$item2['cantidad2'].'</td></tr>';
		?>
		<?php endforeach; 
		?>
    </table>
    
    
    <table id="dg" title="Frecuencia de Apuestas por Equipo" class="easyui-datagrid" style="width:800px;height:250px"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="equipo_id" width="50">ID Equipo</th>
                <th field="nombre" width="50">NOMBRE</th>
                <th field="Frecuencia" width="50">Frecuencia</th>

            </tr>
        </thead>
		<?php foreach($listEquiposFrecuencia as $item3): 
		?>
		<?php
			echo '<tr><td>'.$item3['equi_id'].'</td><td>'.$item3['equi_nombre'].'</td><td>'.$item3['can'];
		?>
		<?php endforeach; 
		?>
    </table>
    
    
 <script type="text/javascript">

        function consulta(){
            $('#dlg').dialog('open').dialog('setTitle','Selección Fecha Consulta');
            $('#fmPago').form('clear');
        }
        

        function consultarPago(){
         	document.getElementById("fmPago").submit();       
        }

    </script>
    <style type="text/css">
        #fm{
            margin:0;
            padding:10px 30px;
        }
        .ftitle{
            font-size:14px;
            font-weight:bold;
            padding:5px 0;
            margin-bottom:10px;
            border-bottom:1px solid #ccc;
        }
        .fitem{
            margin-bottom:5px;
        }
        .fitem label{
            display:inline-block;
            width:80px;
        }
        .fitem input{
            width:160px;
        }
    </style>
	</section>
</body>
</html>