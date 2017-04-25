<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

<title>Gestion de Pagos</title>
	    <link href="<?php echo base_url(); ?>public/stylesheets/menu.css" rel="stylesheet" type="text/css" />
	    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
	    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
	    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/color.css">
	    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
	    <script src="<?php echo base_url(); ?>/public/scroll/js/jquery.min.js"></script>
	    <script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
</head>
<body oncontextmenu="return false">
	<?php echo $mi_menu?>
	<section>  
		<h1>Pagos</h1>
		<br/>
		<table id="dg" title="Boletos" class="easyui-datagrid" style="width:1100px;height:300px"
            url="apuestas"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr> 
                <th field="pago_id" width="50">ID</th>
                <th field="pago_apu_id" width="40">Apuesta</th>
                <th field="pago_moneda" width="40">Moneda Apuesta</th>
                <th field="pago_fecha" width="50">Fecha Pago</th>
                <th field="pago_hora" width="50">Hora Pago</th>
                <th field="pago_valor" width="60">Valor Pagado</th>

            </tr>
        </thead>
		<?php foreach($listPagos as $pagos): ?>
		<?php
			echo '<tr><td>'.$pagos['pago_id'].'</td><td>'.$pagos['pago_apu_id'].'</td><td>'.$pagos['pago_moneda'].'</td><td>'.$pagos['pago_fecha'].'</td><td>'.$pagos['pago_hora'].'</td><td>'.$pagos['pago_valor'];
		?>
		<?php endforeach; ?>
    </table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="nuevo()">Pagar Premio</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="imprime()">Imprimir </a>
    </div>
    
    <div name="dlg" id="dlg" class="easyui-dialog" style="width:500px;height:450px;padding:10px 20px"
            closed="true" buttons="#dlg-buttons">
        <div class="ftitle">Registrar Premio</div>
        <div class="fitem">
                <label>Número Boleto</label>
                <input id="boleto" name="boleto" class="easyui-textbox" required="true"/>
            </div>
            <div class="fitem">
                <button id="consultarApuesta">Consultar Boleto</button>
            </div>
            <div id="apuesta"></div>
        <form id="fm" name="fm" method="post" >
            <input id="idd" name="idd" type="hidden"> 

        </form>
        
    </div>
    <div id="dlg-buttons">
        <a id="elpago" href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="nuevo()">Pagar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cerrar</a>
    </div>
    
    <!-- 
    //////////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////////////////    
    -->
    <div name="dlg2" id="dlg2" class="easyui-dialog" style="width:400px;height:500px;padding:10px 20px"
            closed="true" buttons="#dlg-buttons2">
        <div class="ftitle">Constancia Pago de Premio</div>
        <form id="fm2" name="fm2" method="post" action="agregar_boleto">
            <input id="idd" name="idd" type="hidden">
            <input type="text" id="pago_fecha" name="pago_fecha"/>
            <input type="text" id="pago_hora" name="pago_hora"/>
            <div class="fitem">
                <label>Numero Recibo:</label>
                <input type="text" id="apu_id" name="apu_id"/>
            </div>
            <div class="fitem">
                <label>Numero Apuesta:</label>
                <input type="text" id="pago_apu_id" name="pago_apu_id"/>
            </div>
            <div class="fitem">
                <label>Marcador:</label>
                <input type="text" id="marcador" name="marcador"/>
            </div>
            <div class="fitem">
                <label>Valor Apostado:</label>
                <input type="text" id="apu_valor" name="apu_valor"/>
            </div>
            <div class="fitem">
                <label>Valor Pagado:</label>
                <input type="text" id="pago_valor" name="pago_valor"/>
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
            $('#dlg').dialog('open').dialog('setTitle','Pago de Premios');
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
         	//document.getElementById("fm").submit();       
        }

        function imprimir(){
		var row = $('#dg').datagrid('getSelected');
		if (row){
	            $('#dlg2').dialog('open').dialog('setTitle','Imprimir Recibo');
	            $('#fm2').form('clear');
	            $('#fm2').form('load', row);
	            //alert(row[0]);
	        } else {
			alert('Seleccione boleto para imprimir');
		}
        }
        
        function imprime(){
        	var row = $('#dg').datagrid('getSelected');
        	if (row){
			var r = confirm("Desea imprimir un recibo?");
			if (r == true) {
				$.post("get_pago",
			        {
					pago_id: row.pago_id
			        },
			        function(data,status){
			        	if (data == '-1'){
			        		alert('No pudo registrarse el ticket, intente más tarde');
			        	}
			        	else{
			        		var datos=data.split('::');
						Popup(datos[0], datos[1], datos[2], datos[3], datos[4]);
			        	}
					
			        }); 
				
			}
		} else {
			alert('Seleccione boleto para imprimir');
		}
		}
		
		function Popup(ticket, fecha, hora, moneda, valor) 
		    {
		        var mywindow = window.open('', 'my div', 'height=400,width=600');
		        mywindow.document.write('Nota: Recibo de soporte en pago de premio');
		        mywindow.document.write('<br>http://win7-24.com/');
		        mywindow.document.write('<br>');
		        mywindow.document.write('<br>Recibo Nro. '+ticket);
		        mywindow.document.write('<br>Fecha - Hora: '+fecha+' - '+hora);
		        mywindow.document.write('<br>Jugada en '+moneda);
		        mywindow.document.write('<br>----------------------------------------');
		        mywindow.document.write('<br>----------------------------------------');
		        mywindow.document.write('<br>Premio: ' + valor);
		        mywindow.document.write('<br>');
		        mywindow.print();
		        mywindow.close();
		        return true;
		    }
	    
	    function calcula(apu_id, mon, va) {
	        $.post("pagar",
	        {
	          apu_id: apu_id,
	          pago_moneda: mon,
	          pago_valor: va
	        },
	        function(data,status){
	            alert("El pago se realizó con éxito, imprima su tiquete ");
	            window.location="http://win7-24.com/Operador/pago";
	        });
	     }
	    
	    $(document).ready(function(){
	    	    $("#elpago").toggle();
		    $("#consultarApuesta").click(function(){
		        $.ajax({data:  'dato='+document.getElementById("boleto").value, url: 'valida', type: 'POST', success: function(result){
		            document.getElementById("apuesta").innerHTML=result;
		            //alert(result);
		        }});
		    });
	});
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