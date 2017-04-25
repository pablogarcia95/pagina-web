<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administrador de monedas</title>

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
		<h1>Monedas</h1>
		<?php
			$mensaje = $this->session->flashdata('mensaje');
		    if ($mensaje) {
		  		echo '<h4>'.$mensaje.'</h4>';
			}
		?>
		<table id="dg" title="Monedas" class="easyui-datagrid" style="width:800px;height:250px"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="idd" width="30">ID</th>
                <th field="siglas" width="270">SIGLA</th>
                <th field="nombre" width="480">NOMBRE</th>
            </tr>
        </thead>
		<?php foreach($listMonedas as $moneda): ?>
			<?php
				echo '<tr><td>'.$moneda['mon_id'].'</td><td>'.$moneda['mon_siglas'].'</td><td>'.$moneda['mon_descripcion'].'</td></tr>';
			?>
		<?php endforeach; ?>
		
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="nuevaMoneda()">Agregar moneda</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarMoneda()">Editar moneda</a>
    </div>
    
    <div name="dlg" id="dlg" class="easyui-dialog" style="width:300px;height:250px;padding:10px 20px"
            closed="true" buttons="#dlg-buttons">
        <div class="ftitle">Información Moneda</div>
        <form id="fmMoneda" name="fmMoneda" method="post" action="agregarMoneda">
            <input id="idd" name="idd" type="hidden">
            <div class="fitem">
                <label>Siglas:</label>
                <input id="siglas" name="siglas" class="easyui-textbox" required="true">
            </div>
            <div class="fitem">
                <label>Nombre:</label>
                <input id="nombre" name="nombre" class="easyui-textbox" required="true">
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="guardarEquipo()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    <script type="text/javascript">

        function nuevaMoneda(){
            $('#dlg').dialog('open').dialog('setTitle','Nueva Moneda');
            $('#fmMoneda').form('clear');

        }

        function editarMoneda(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('setTitle','Editar Moneda');
	            $('#fmMoneda').form('clear');
                $('#fmMoneda').form('load', row);
            }
        }

        function guardarEquipo(){
         	document.getElementById("fmMoneda").submit();       
        }

        function eliminarMoneda(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Eliminar Moneda','¿Desea eliminar (' + row['nombre'] + ")?",function(r){
                    if (r){
						$.post('eliminarMoneda', {key: row['idd']}).done(function() {
							location.reload();
						});
                    }
                });
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


		
	  
	</section>
</body>
</html>
