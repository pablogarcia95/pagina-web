<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Administrador de marcadores</title>
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
		<h1>Marcadores</h1>
		<?php
			$mensaje = $this->session->flashdata('mensaje');
		    if ($mensaje) {
		  		echo '<h4>'.$mensaje.'</h4>';
			}
		?>
		<table id="dg" title="Marcadores Dia" class="easyui-datagrid" style="width:1000px;height:250px"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        	<thead>
			    <tr>
			        <th field="idd" width="20">ID</th>
			        <th field="par_equipo1" width="50">Equipo Local</th>
			        <th field="par_equipo2" width="50">Equipo Visitante</th>
					<th field="golesA" width="20">Goles Local</th>
					<th field="golesB" width="20">Goles Visitante</th>
			        <th field="par_fecha" width="50">Fecha</th>
			        <th field="par_hora" width="50">Hora</th>
			    </tr>
	        </thead>
			<?php foreach($listMarcadores as $marcador): ?>
				<?php
					echo '<tr><td>'.$marcador['marcadores']['mar_id'].'</td><td>'.$marcador['par_equipo1']['equi_nombre'].' ('.$marcador['par_equipo1']['equi_region'].')</td><td>'.$marcador['par_equipo2']['equi_nombre'].' ('.$marcador['par_equipo2']['equi_region'].')</td><td>'.$marcador['marcadores']['mar_gol1'].'</td><td>'.$marcador['marcadores']['mar_gol2'].'</td><td>'.$marcador['par_fecha'].'</td><td>'.$marcador['par_hora'].'</td></tr>'
				?>
			<?php endforeach; ?>
   		</table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="nuevoMarcador()">Nuevo marcador</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarMarcador()">Editar marcador</a>
    </div>
    <div id="dlg" class="easyui-dialog" style="width:280px;height:400px;padding:10px 20px"
            closed="true" buttons="#dlg-buttons">
        <div class="ftitle">Informacion Marcador</div>
        <form id="fm" name="fm" method="post" action="agregarMarcador">
            <input name="idd" id="idd" type="hidden">
            <input name="iddd" id="iddd" type="hidden">
            <div class="fitem">
                <label>Equipo Local:</label>
                <input id="par_equipo1" name="par_equipo1" class="easyui-textbox" readonly="readonly"/>
            </div>
            <div class="fitem">
                <label>Equipo Visitante:</label>
                <input id="par_equipo2" name="par_equipo2" class="easyui-textbox" readonly="readonly"/>
            </div>
            <div class="fitem">
                <label>Goles Local:</label>
                <input name="golesA" id="golesA" type="text" class="easyui-textbox"/>
            </div>
            <div class="fitem">
                <label>Goles Visitante:</label>
                <input name="golesB" id="golesB" type="text" class="easyui-textbox"/>
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="guardarMarcador()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    <script type="text/javascript">
    
    	function guardarMarcador(){
         	document.getElementById("fm").submit();       
        }

        function nuevoMarcador(){
            var row1 = $('#dg11').datagrid('getSelected');
			if(row1) { 
			        $('#dlg').dialog('open').dialog('setTitle','Nuevo Marcador');
			        $('#fm').form('clear');
                	$('#fm').form('load',row1);
			} else {
				alert('Seleccione partido para asignar marcador');
			}
        }

        function editarMarcador(){
        
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('setTitle','Editar Marcador');
		$('#fm').form('clear');
                $('#fm').form('load',row);
                
            } else {
		alert('Seleccione marcador para modificar');
	    }
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
		<table id="dg11" title="Partidos Dia" class="easyui-datagrid" style="width:695px;height:250px"
			 pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        	<thead>
			    <tr>
			        <th field="iddd" width="20">ID</th>
			        <th field="par_equipo1" width="100">Equipo A</th>
			        <th field="par_equipo2" width="100">Equipo B</th>
			        <th field="fecha" width="30">Fecha</th>
			        <th field="hora" width="30">Hora</th>
			    </tr>
	        </thead>
			<?php foreach($listPartidos as $partido): ?>
				<?php
					echo '<tr><td>'.$partido['par_id'].'</td><td>'.$partido['par_equipo1']['equi_nombre'].' ('.$partido['par_equipo1']['equi_region'].')</td><td>'.$partido['par_equipo2']['equi_nombre'].' ('.$partido['par_equipo2']['equi_region'].')</td><td>'.$partido['par_fecha'].'</td><td>'.$partido['par_hora'].'</td></tr>';
				?>
			<?php endforeach; ?>
   		</table>

	</section>
</body>
</html>