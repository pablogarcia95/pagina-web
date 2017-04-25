<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
	
	<title>Administrador de partidos</title>
	<link href="<?php echo base_url(); ?>public/stylesheets/menu.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
    <script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
</head>
<-- <body oncontextmenu="return false"> -->
<body>
	<?php echo $mi_menu?>
	<section>  
		<h1>Partidos</h1>
		<?php
			$mensaje = $this->session->flashdata('mensaje');
		    if ($mensaje) {
		  		echo '<h4>'.$mensaje.'</h4>';
			}
		?>
		<table id="dg" title="Paridos" class="easyui-datagrid" style="width:1000px;height:250px"
            toolbar="#toolbar" pagination="true"
            rownumbers="true" fitColumns="true" singleSelect="true">
        	<thead>
			    <tr>
			        <th field="par_id" width="50">ID</th>
			        <th field="par_equipo1" width="50">Equipo Local</th>
			        <th field="par_equipo2" width="50">Equipo Visitante</th>
			        <th field="par_porcentaje1" width="50">Gana Local</th>
			        <th field="par_porcentaje2" width="50">Gana Visitante</th>
			        <th field="par_porcentaje3" width="50">Empate</th>
			        <th field="par_fecha" width="50">Fecha</th>
			        <th field="par_hora" width="50">Hora</th>
			        <th field="torneo_id" width="50">Torneo</th>
			    </tr>
	        </thead>
	        <?php foreach($listPartidos as $partido): ?>
				<?php echo '<tr><td>'.$partido['par_id'].'</td><td>'.$partido['par_equipo1'].'</td><td>'.$partido['par_equipo2'].'</td><td>'.$partido['par_porcentaje1'].'</td><td>'.$partido['par_porcentaje2'].'</td><td>'.$partido['par_porcentaje3'].'</td><td>'.$partido['par_fecha'].'</td><td>'.$partido['par_hora'].'</td><td>'.$partido['torneo_id'].'</td></tr>';
				?>
			<?php endforeach; ?>
   		</table>
    <div id="toolbar">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newUser()">Nuevo partido</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editar()">Editar %</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Eliminar partido</a>
    </div>
    <div id="dlg" class="easyui-dialog" style="width:400px;height:500px;padding:10px 20px" closed="true" buttons="#dlg-buttons">
        <div class="ftitle">Informacion Partido</div>
        <form id="fm" name="fm" method="post" action="agregar_partido">
            <input name="par_id" id="par_id" type="hidden">
            <div class="fitem">
                <label>Torneo:</label>
                <select id="torneo_id" name="torneo_id">
			<?php foreach($listTorneos as $torneno): ?>
				<?php echo "<option value='".$torneno['torneo_id']."'>".$torneno['torneo_nombre']."</option>"; ?>
			<?php endforeach; ?>
		</select>
            </div>
	    <div class="fitem">
                <label>Equipo Local:</label>
                <input name="iddd" id="iddd" type="hidden">
                <input id="par_equipo1" name="par_equipo1" class="easyui-textbox" readonly="readonly"/>
            </div>
            <div class="fitem">
                <label>Gana Local:</label>
                <input name="par_porcentaje1" id="par_porcentaje1" type="text" class="easyui-textbox" required="true"/>
            </div>
            <input name="idddd" id="idddd" type="hidden">
            <div class="fitem">
                <label>Equipo Visita:</label>
                <input name="idddd" id="idddd" type="hidden">
                <input id="par_equipo2" name="par_equipo2" class="easyui-textbox" readonly="readonly"/>
            </div>
            <div class="fitem">
                <label>Gana Visita:</label>
                <input type="text" name="par_porcentaje2" id="par_porcentaje2" class="easyui-textbox" required="true"/>
            </div>
            <div class="fitem">
                <label>Empate:</label>
                <input name="par_porcentaje3" id="par_porcentaje3" type="text" class="easyui-textbox" required="true"/>
            </div>
            <div class="fitem">
                <label>Fecha:</label>
                <input name="par_fecha" id="par_fecha" type="date" class="easyui-textbox" required="true"/>
            </div>
            <div class="fitem">
                <label>Hora:</label>
                <input name="par_hora" id="par_hora" type="time" class="easyui-textbox" required="true"/>
            </div>
        </form>
    </div>
    <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="guardarPartido()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    
    <!-- ////////////////////////////////////////////////////////////////////////////////////////// -->
    
    
    <div id="dlg222" class="easyui-dialog" style="width:350px;height:500px;padding:10px 20px" closed="true" buttons="#dlg222-buttons">
        <div class="ftitle">Informacion Partido</div>
        <form id="fm222" name="fm222" method="post" action="modificar_partido">
          	<input name="par_id" id="par_id" type="hidden">
            <div class="fitem">
                <label>Equipo A (Local):</label>
                <input name="iddd" id="iddd" type="hidden">
                <input id="par_equipo1" name="par_equipo1" class="easyui-textbox" readonly="readonly"/>
            </div>
            <div class="fitem">
                <label>Gana A:</label>
                <input name="par_porcentaje1" id="par_porcentaje1" type="text" min="0" class="easyui-textbox" required="true"/>
            </div>
            <input name="idddd" id="idddd" type="hidden">
            <div class="fitem">
                <label>Equipo B:</label>
                <input name="idddd" id="idddd" type="hidden">
                <input id="par_equipo2" name="par_equipo2" class="easyui-textbox" readonly="readonly"/>
            </div>
            <div class="fitem">
                <label>Gana B:</label>
                <input type="text" min="0" name="par_porcentaje2" id="par_porcentaje2" class="easyui-textbox" required="true"/>
            </div>
            <div class="fitem">
                <label>Empate:</label>
                <input name="par_porcentaje3" id="par_porcentaje3" type="text" min="0" class="easyui-textbox" required="true"/>
            </div>
            <div class="fitem">
                <label>Fecha:</label>
                <input name="par_fecha" id="par_fecha" type="date" class="easyui-textbox" required="true"/>
            </div>
            <div class="fitem">
                <label>Hora:</label>
                <input name="par_hora" id="par_hora" type="time" class="easyui-textbox" required="true"/>
            </div>
        </form>
    </div>
    <div id="dlg222-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="modificarPartido()" style="width:90px">Guardar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg222').dialog('close')" style="width:90px">Cancelar</a>
    </div>
    
    <script type="text/javascript">
    
    	function guardarPartido(){
         	document.getElementById("fm").submit();       
        }
        
        function modificarPartido(){
         	document.getElementById("fm222").submit();       
        }
        
        function editar(){
        
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $('#dlg222').dialog('open').dialog('setTitle','Editar %');
	        $('#fm222').form('clear');
                $('#fm222').form('load', row);
            }
            else{
            	alert('Seleccione un partido para editar');
            }
        }

        function newUser(){
            var row1 = $('#dg11').datagrid('getSelected');
            var row2 = $('#dg12').datagrid('getSelected');
		if(row1 && row2) { 
			if(row1['iddd'] != row2['idddd']) { 
			        $('#dlg').dialog('open').dialog('setTitle','Nuevo Partido');
			        $('#fm').form('clear');
                	$('#fm').form('load',row1);
                	$('#fm').form('load',row2);
			} else {
				alert('Seleccione equipos diferentes');				
			}
		} else {
			alert('Seleccione equipo para el partido');
		}
        }
        
        function destroyUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                $.messager.confirm('Eliminar Partido','������Desea eliminar partido '+row['par_equipo1']+' vs. '+row['par_equipo2']+'?',function(r){
                    if (r){
			$.post('eliminarPartido', {key: row['par_id']}).done(function() {
				location.reload();
			});
                    }
                });
            }
            else{
            	alert('Seleccione el partido');
            }
        }

    </script>
    	<script type="text/javascript">
		function loaddata() {
			$("#dg").datagrid("loading");

			$.getJSON("http://localhost:9000/json/"+ $("#category" ).text() + "/" + field, {}, function(result) {
			rows = result.rows;
			$("#dg").datagrid('loadData', rows);
			});
		}


		function doSearch(op){
			Object.get = function(obj) {
			    var size= new Array(); 
			    res = new Object; var key, i=0;
			    for (key in obj) {
				if (op == 1)
			  		size[i]={iddd:obj[i].iddd,par_equipo1:obj[i].par_equipo1};
				else
					size[i]={idddd:obj[i].idddd,par_equipo2:obj[i].par_equipo2};
				
				i++;
			    }
			    return size;
			};
			if (op == 1){
				valor=$('#pe1').val();}
			else{
				valor=$('#pe2').val();}
			$.post( "listarFiltro", { key: valor })
			  .done(function( data ) {
			  var res = data.split("----");
			  var info = new Object();
			  for(i=0; i<res.length-1; i++){
				var res2 = res[i].split("::::");
				if (op == 1)
			  		info[i]={"iddd":res2[0],"par_equipo1":res2[1]};
				else
					info[i]={"idddd":res2[0],"par_equipo2":res2[1]};
				
			  }
			  var data2 = {"total":Object.keys(info).length,"rows":Object.get(info)};
			  if (op == 1)
			  	$('#dg11').datagrid('loadData', data2);
			  else
				$('#dg12').datagrid('loadData', data2);
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
	<table>	
		<tr>
		<td>
		<table id="dg11" name="dg11" title="Equipo Local" class="easyui-datagrid" style="width:495px;height:250px"
			 pagination="true" toolbar="#tb1" rownumbers="true" fitColumns="true" singleSelect="true">
	        	<thead>
				    <tr>
				        <th field="iddd" width="50">ID</th>
				        <th field="par_equipo1" width="400">Equipo</th>
				    </tr>
		        </thead>
				<?php foreach($listEquipos as $equipo): ?>
					<?php
						echo '<tr><td>'.$equipo['equi_id'].'</td><td>'.$equipo['equi_nombre'].' ('.$equipo['equi_region'].')</td></tr>';
					?>
				<?php endforeach; ?>
   		</table>
   		<div id="tb1" style="padding:3px">
		    <span>Equipo</span>
		    <input id="pe1" name="pe1" style="line-height:18px;border:1px solid #ccc"/>
		    <a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch(1)">Buscar</a>
		</div>
	</td>
	<td>
		<table id="dg12" name="dg12" title="Equipo Visitante" class="easyui-datagrid" style="width:495px;height:250px"
			 pagination="true" toolbar="#tb2" rownumbers="true" fitColumns="true" singleSelect="true">
	        	<thead>
				    <tr>
				        <th field="idddd" width="50">ID</th>
				        <th field="par_equipo2" width="400">Equipo</th>
				    </tr>
		        </thead>
				<?php foreach($listEquipos as $equipo): ?>
					<?php
						echo '<tr><td>'.$equipo['equi_id'].'</td><td>'.$equipo['equi_nombre'].' ('.$equipo['equi_region'].')</td></tr>';
					?>
				<?php endforeach; ?>
   		</table>
		<div id="tb2" style="padding:3px">
		    <span>Equipo</span>
		    <input id="pe2" name="pe2" style="line-height:18px;border:1px solid #ccc"/>
		    <a href="#" class="easyui-linkbutton" plain="true" onclick="doSearch(2)">Buscar</a>
		</div>
</td>
</tr>
	</table>
	</section>
</body>
</html>