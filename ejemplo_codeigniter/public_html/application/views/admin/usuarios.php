<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Administrador de usuarios</title>

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
		<h1>Usuarios</h1>
		<?php
			$mensaje = $this->session->flashdata('mensaje');
		    if ($mensaje) {
		  		echo '<h4>'.$mensaje.'</h4>';
			}
		?>
		<table id="dg" title="Usuarios" class="easyui-datagrid" style="width:800px;height:250px"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="idd" width="50">ID</th>
                <th field="nombre" width="50">Nombre</th>
                <th field="tipo" width="50">Tipo</th>
            </tr>
        </thead>
		<?php foreach($listUsuarios as $usuario): ?>
			<?php
				echo '<tr><td>'.$usuario['usu_id'].'</td><td>'.$usuario['usu_nombre'].'</td><td>'.$usuario['tip_descripcion'].'</td></tr>';
			?>
		<?php endforeach; ?>
		
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="nuevoUsuario()">Nuevo usuario</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="claveUsuario()">Clave usuario</a>
    </div>
    
    <div name="dlg" id="dlg" class="easyui-dialog" style="width:300px;height:280px;padding:10px 20px"
            closed="true" buttons="#dlg-buttons">
        <div class="ftitle">Información Usuario</div>
        <form id="fmUsuario" name="fmUsuario" method="post" action="agregarUsuario">
            <input id="idd" name="idd" type="hidden">
            <div class="fitem">
                <label>Nombre:</label>
                <input id="nombre" name="nombre" class="easyui-textbox" required="true"/>
            </div>
            <div class="fitem">
                <label>Clave:</label>
                <input id="clave" name="clave" type="password" class="easyui-textbox" required="true"/>
            </div>
            <div class="fitem">
                <label>Tipo usuario:</label>
                <select name="tipo" id="tipo" required="true">
					<option value="1">Administrador</option>
					<option value="2">Operador</option>
				</select>
            </div>
        </form>
    </div>
<div name="dlg1" id="dlg1" class="easyui-dialog" style="width:300px;height:180px;padding:10px 20px"
            closed="true" buttons="#dlg-buttons1">
        <div class="ftitle">Editar Usuario</div>
        <form id="fmUsuario1" name="fmUsuario1" method="post" action="editarUsuario">
            <input id="idd" name="idd" type="hidden">
            <div class="fitem">
                <label>Clave:</label>
                <input id="clave" name="clave" type="password" class="easyui-textbox" required="true">
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="guardarUsuario()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
	<div id="dlg-buttons1">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-edit" onclick="Usuario()" style="width:90px">Cambiar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg1').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    <script type="text/javascript">
        var url;
        function nuevoUsuario(){
            $('#dlg').dialog('open').dialog('setTitle','Nuevo usuario');
            $('#fmEquipo').form('clear');
        }

		function claveUsuario(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg1').dialog('open').dialog('setTitle','Clave Usuario');
	     	    $('#fmUsuario1').form('clear');
                $('#fmUsuario1').form('load', row);
            }
        }

        function guardarUsuario(){
         	document.getElementById("fmUsuario").submit();       
        }

		function Usuario(){
         	document.getElementById("fmUsuario1").submit();       
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
		.fitem select{
            width:170px;
        }
    </style>


		
	  
	</section>
</body>
</html>
