<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=big5">

<title>Administrador de apuestas</title>

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
		<h1>Apuestas - <?php echo $fecha;?></h1>
		<br/>
	<table id="dg" title="Apuestas del día" class="easyui-datagrid" style="width:800px;height:250px"
            toolbar="#toolbar" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="Valor" width="50">Usuario</th>
                <th field="Usuario" width="50">Moneda</th>
                <th field="Base" width="25">Base</th>
                <th field="Premio" width="25">Premio</th>
            </tr>
        </thead>
		<?php foreach($listApuestas as $apuesta): 
		?>
		<?php
			echo '<tr><td>'.$apuesta['usu_nombre'].'</td><td>'.$apuesta['mon_nombre'].'</td><td>'.number_format($apuesta['apu_valor']).'</td><td>'.number_format($apuesta['apu_premio']).'</td></tr>';
		?>
		<?php endforeach; 
		?>
    </table>
     
	<table id="dg2" title="Apuestas del día (Detallado)" class="easyui-datagrid" style="width:800px;height:250px"
            toolbar="#toolbar2" pagination="true" rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="Usuario" width="40">Usuario</th>
                <th field="Moneda" width="15">Moneda</th>
                <th field="Valor" width="20">Valor</th>
                <th field="Premio" width="20">Premio</th>
		<th field="Fecha" width="25">Fecha</th>
		<th field="Hora" width="25">Hora</th>
		<th field="id" width="25">#</th>
            </tr>
        </thead>
		<?php foreach($listApuestas_detalle as $apuesta2): 
		?>
		<?php
			echo '<tr><td>'.$apuesta2['usu_nombre'].'</td><td>'.$apuesta2['mon_nombre'].'</td><td>'.number_format($apuesta2['apu_valor']).'</td><td>'.number_format($apuesta2['apu_premio']).'</td><td>'.$apuesta2['apu_fecha'].'</td><td>'.$apuesta2['apu_hora'].'</td><td>'.$apuesta2['apu_id'].'</td></tr>';
		?>
		<?php endforeach; 
		?>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onclick="consulta()">Consultar apuestas de día</a>
    </div>

    <div name="dlg" id="dlg" class="easyui-dialog" style="width:300px;height:200px;padding:10px 20px"
            closed="true" buttons="#dlg-buttons">
        <div class="ftitle">Información Día Apuesta</div>
        <form id="fmApuesta" name="fmApuesta" method="post" action="consultarApuesta">
            <div class="fitem">
  		<label>Fecha:</label>
                <input id="fecha" name="fecha" type="date" class="easyui-textbox" required="true">
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-search" onclick="consultarApuesta()" style="width:90px">Consultar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>

    <script type="text/javascript">

        function consulta(){
            $('#dlg').dialog('open').dialog('setTitle','Selección Fecha Consulta');
            $('#fmApuesta').form('clear');
        }        

        function consultarApuesta(){
         	document.getElementById("fmApuesta").submit();       
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