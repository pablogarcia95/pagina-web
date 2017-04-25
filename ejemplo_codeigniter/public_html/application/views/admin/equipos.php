<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=big5">

<title>Administrador de equipos</title>

    <link href="<?php echo base_url(); ?>public/stylesheets/menu.css" rel="stylesheet" type="text/css" /> 
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css"> -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
   <script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script> 

</head>
<body oncontextmenu="return false">
	<?php echo $mi_menu?>
	<section>  
		<h1>Equipos</h1>
		<?php
			$mensaje = $this->session->flashdata('mensaje');
		    if ($mensaje) {
		  		echo '<h4>'.$mensaje.'</h4>';
			}
		?>
		<table id="dg" title="Equipos" class="easyui-datagrid" style="width:800px;height:250px"
            url="equipos"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="idd" width="50">ID</th>
                <th field="nombre" width="50">Nombre</th>
                <th field="region" width="50">Liga</th>
            </tr>
        </thead>
		<?php foreach($listEquipos as $equipo): ?>
		<?php
			echo '<tr><td>'.$equipo['equi_id'].'</td><td>'.$equipo['equi_nombre'].'</td><td>'.$equipo['equi_region'].'</td></tr>';
		?>
		<?php endforeach; ?>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="nuevoEquipo()">Nuevo equipo</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editarEquipo()">Editar equipo</a>
	<span>>></span>
	<input id="pe1" name="pe1" style="line-height:18px;border:1px solid #ccc"/>
	<a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch()">Buscar</a>
    </div>
    
    <div name="dlg" id="dlg" class="easyui-dialog" style="width:300px;height:250px;padding:10px 20px"
            closed="true" buttons="#dlg-buttons">
        <div class="ftitle">Informacion Equipo</div>
        <form id="fmEquipo" name="fmEquipo" method="post" action="agregar">
            <input id="idd" name="idd" type="hidden">
            <div class="fitem">
                <label>Nombre:</label>
                <input id="nombre" name="nombre" class="easyui-textbox" required="true">
            </div>
            <div class="fitem">
                <label>Liga:</label>
                <input id="region" name="region" class="easyui-textbox" required="true">
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="guardarEquipo()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    <script type="text/javascript">

        function nuevoEquipo(){
            $('#dlg').dialog('open').dialog('setTitle','Nuevo equipo');
            $('#fmEquipo').form('clear');
        }

        function editarEquipo(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('setTitle','Editar equipo');
	        $('#fmEquipo').form('clear');
                $('#fmEquipo').form('load', row);
            }
        }

        function guardarEquipo(){
         	document.getElementById("fmEquipo").submit();       
        }

	function doSearch(){
		Object.get = function(obj) {
		    var size= new Array(); 
		    res = new Object; var key, i=0;
		    for (key in obj) {
			size[i]={idd:obj[i].idd,nombre:obj[i].nombre,region:obj[i].region};
			i++;
		    }
		    return size;
		};
		$.post( "listarFiltroEquipo", { key: valor=$('#pe1').val() })
		  .done(function( data ) {
		  var res = data.split("----");
		  var info = new Object();
		  for(i=0; i<res.length-1; i++){
			var res2 = res[i].split("::::");
			info[i]={"idd":res2[0],"nombre":res2[1],"region":res2[2]};
		  }
		  var data2 = {"total":Object.keys(info).length,"rows":Object.get(info)};
		  $('#dg').datagrid('loadData', data2);
		  });
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