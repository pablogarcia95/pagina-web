<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=big5">

<title>Administrador de productos</title>
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
   <script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script> 

</head>
<body oncontextmenu="return false">
	<section>  
		<table id="dg" title="Productos" class="easyui-datagrid" style="width:800px;height:250px"
            url="productos"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="idd" width="50">id</th>
                <th field="codigoBarras" width="60">codigoBarras</th>
                <th field="nombre" width="50">nombre</th>
                <th field="categoria" width="50">categoria</th>
                <th field="cantidad" width="50">cantidad</th>
                <th field="presentacion" width="50">presentacion</th>
                <th field="precioUnitario" width="50">precioUnitario</th>

            </tr>
        </thead>
		<?php foreach($listAreas as $area): ?>
		<?php
            echo'<tr><td>'.$area['id'].'</td><td>'.$area['codigoBarras'].'</td><td>'.$area['nombre'].'</td><td>'.$area['categoria'].'</td><td>'.$area['cantidad'].'</td><td>'.$area['presentacion'].'</td><td>'.$area['precioUnitario'].'</td></tr>';
		?>
		<?php endforeach; ?>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="nuevo()">Nuevo</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editar()">Editar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" plain="true" onclick="eli()">Eliminar</a>
	<span>>></span>
	<input id="pe1" name="pe1" style="line-height:18px;border:1px solid #ccc"/>
	<a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch()">Buscar</a>
    </div>
    
    <div name="dlg" id="dlg" class="easyui-dialog" style="width:300px;height:250px;padding:10px 20px"
            closed="true" buttons="#dlg-buttons">
        <div class="ftitle">Informacion Producto</div>
        <form id="formulario" name="formulario" method="post" action="agregar">
            <input id="idd" name="idd" type="hidden">
            <div class="fitem">
                 <label>codigoBarras:</label>
                <input id="codigoBarras" name="codigoBarras" class="easyui-textbox" required="true">
                <label>nombre:</label>
                <input id="nombre" name="nombre" class="easyui-textbox" required="true">
                <label>categoria:</label>
                <input id="categoria" name="categoria" class="easyui-textbox" required="true">
                <label>cantidad:</label>
                <input id="cantidad" name="cantidad" class="easyui-textbox" required="true">
                <label>presentacion:</label>
                <input id="presentacion" name="presentacion" class="easyui-textbox" required="true">
                <label>precioUnitario:</label>
                <input id="precioUnitario" name="precioUnitario" class="easyui-textbox" required="true">
               
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="guardar()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    <script type="text/javascript">

        function nuevo(){
            $('#dlg').dialog('open').dialog('setTitle','Nuevo');
            $('#formulario').form('clear');
        }

        function editar(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg').dialog('open').dialog('setTitle','Editar');
	        $('#formulario').form('clear');
                $('#formulario').form('load', row);
            }
        }

 function eli(){
           var row = $('#dg').datagrid('getSelected');
           $.post( "eliminar", { key: row.idd})
              .done(function( data ) {
                alert( "Fue eliminado: " + row.idd );
            window.location.reload('index.php/Rmedicamento/productos')
              });

        }


        function guardar(){
         	document.getElementById("formulario").submit();       
        }

	function doSearch(){
		Object.get = function(obj) {
		    var size= new Array(); 
	res = new Object; var key, i=0;
    for (key in obj){size[i]={idd:obj[i].idd,codigoBarras:obj[i].codigoBarras,nombre:obj[i].nombre,categoria:obj[i].categoria,cantidad:obj[i].cantidad,presentacion:obj[i].presentacion,precioUnitario:obj[i].precioUnitario};
			i++;
		    }
		    return size;
		};
		$.post( "listarFiltroArea", { key: valor=$('#pe1').val() })
		  .done(function( data ) {
		  var res = data.split("----");
		  var info = new Object();
		  for(i=0; i<res.length-1; i++){
			var res2 = res[i].split("::::");
	info[i]={"idd":res2[0],"codigoBarras":res2[1],"nombre":res2[2],"categoria":res2[3],"cantidad":res2[4],"presentacion":res2[5],"precioUnitario":res2[6]};
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
