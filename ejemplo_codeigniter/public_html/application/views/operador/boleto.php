<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

<title>Gestion de Boletos</title>

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
		<h1>Boletos</h1>
		<br/>
		<table id="dg" title="Boletos" class="easyui-datagrid" style="width:800px;height:300px"
            url="apuestas"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>
                <th field="apu_id" width="50">ID</th>
                <th field="apu_partido" width="100">Partido</th>
                <th field="apu_moneda" width="30">Moneda</th>
                <th field="apuesta" width="60">Apuesta</th>
                <th field="apu_fecha" width="50">Fecha</th>
                <th field="apu_valor" width="40">Valor</th>
                <th field="apu_hora" width="30">Hora</th>
                <th field="par_porcentaje1" width="18">Local</th>
                <th field="par_porcentaje2" width="18">Empate</th>
                <th field="par_porcentaje3" width="18">Visita</th>
            </tr>
        </thead>
		<?php foreach($listApuestas as $apuesta): ?>
		<?php
			echo '<tr><td>'.$apuesta['apu_id'].'</td><td>'.$apuesta['apu_partido'].'</td><td>'.$apuesta['apu_moneda'].'</td><td>'.$apuesta['apuesta'].'</td><td>'.$apuesta['apu_fecha'].'</td><td>'.$apuesta['apu_valor'].'</td><td>'.$apuesta['apu_hora'].'</td><td>'.$apuesta['par_porcentaje1'].'</td><td>'.$apuesta['par_porcentaje2'].'</td><td>'.$apuesta['par_porcentaje3'].'</td></tr>';
		?>
		<?php endforeach; ?>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="nuevo()">Generar Boleto</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="imprimir()">Imprimir </a>
    </div>
    
    <div name="dlg" id="dlg" class="easyui-dialog" style="width:300px;height:400px;padding:10px 20px"
            closed="true" buttons="#dlg-buttons">
        <div class="ftitle">Informacion Boleto</div>
        <form id="fm" name="fm" method="post" action="agregar_boleto">
            <input id="idd" name="idd" type="hidden">
            <div class="fitem">
                <label>Partido:</label>
                <select id="apu_partido" name="apu_partido">
	                <?php foreach($listPartidos as $apuesta): ?>
			<?php echo '<option value="'. $apuesta["par_id"] . '">'.$apuesta['par_equipo1'].' --  Vs -- '.$apuesta['par_equipo2'].'</option>';
			?>
			<?php endforeach; ?>
                </select>
            </div>
            <div class="fitem">
                <label>Moneda:</label>
                <select id="apu_moneda" name="apu_moneda">
	                <?php foreach($listMonedas as $moneda): ?>
			<?php echo '<option value="'. $moneda["mon_id"] . '" selected">'.$moneda['mon_descripcion'].' </option>';
			?>
			<?php endforeach; ?>
                </select>
            </div>
            <div class="fitem">
                <label>Apuesta:</label>
                <select id="apuesta" name="apuesta">
	        	<option value="1" selected>Gana Equipo Local</option>;
	        	<option value="0" selected>Empate</option>;
	        	<option value="-1" selected>Gana Equipo Visitante</option>;
		</select>
            </div>
            <div class="fitem">
                <label>Valor:</label>
                <input id="valor" name="valor" class="easyui-textbox" required/>
            </div>
            <div class="fitem">
                <label>Fecha:</label>
                <?php echo $this->Apuesta->obtenerFecha()['fecha']; ?>
            </div>
            <div class="fitem">
                <label>Hora:</label>
                <?php echo $this->Apuesta->obtenerHora()['hora']; ?>
            </div>
        </form>
        
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="guardar()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    
    <!-- 
    //////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////    
    -->
    <div name="dlg2" id="dlg2" class="easyui-dialog" style="width:300px;height:400px;padding:10px 20px"
            closed="true" buttons="#dlg-buttons2">
        <div class="ftitle">Boleto</div>
        <form id="fm2" name="fm2" method="post" action="agregar_boleto">
            <input id="idd" name="idd" type="hidden">
            <div class="fitem">
                <label>Partido:</label>
                <input type="text" id="apu_partido" name="apu_partido"/>
            </div>
            <div class="fitem">
                <label>Moneda:</label>
                <input type="text" id="apu_moneda" name="apu_moneda"/>

            </div>
            <div class="fitem">
                <label>Valor:</label>
                <input type="text" id="apu_valor" name="apu_valor" required/>
            </div>
            <div class="fitem">
                <label>Fecha:</label>
                <?php echo date('d/m/Y') ?>
            </div>
            <div class="fitem">
                <label>Hora:</label>
                <?php echo date('H:i') ?>
            </div>
            www.7-24.com
        </form>
        
    </div>
    <div id="dlg-buttons2">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="imprime('#dlg2')" style="width:90px">Imprimir</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg2').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    
    <script type="text/javascript">
	
        function nuevo(){
        	
            $('#dlg').dialog('open').dialog('setTitle','Registrar Boleto');
            $('#fm').form('clear');
            $('#apu_moneda').find('option:first').attr('selected', 'selected').parent('select');
            $('#apu_partido').find('option:first').attr('selected', 'selected').parent('select');
        }

        function editar(){
            var row = $('#dg').datagrid('getSelected');
	    if (row){
                $('#dlg').dialog('open').dialog('setTitle','Editar');
	        $('#fm').form('clear');
                $('#fm').form('load', row);
            }
        }

        function guardar(){
         	document.getElementById("fm").submit();       
        }

        function imprimir(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
	            $('#dlg2').dialog('open').dialog('setTitle','Imprimir Boleto');
	            $('#fm2').form('clear');
	            $('#fm2').form('load', row);
	        } else {
			alert('Seleccione boleto para imprimir');
		}
        }
        
        function imprime(elem){
		Popup($(elem).html());
	    }
	
	function Popup(data) 
	    {
	        var mywindow = window.open('', 'my div', 'height=400,width=600');
	        mywindow.document.write('<html><head><title>my div</title>');
	        mywindow.document.write('<link rel="stylesheet" href="http://www.jeasyui.com/easyui/themes/default/easyui.css" type="text/css" />');
	        mywindow.document.write('</head><body >');
	        mywindow.document.write(data);
	        mywindow.document.write('</body></html>');
	
	        mywindow.print();
	        mywindow.close();
	
	        return true;
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