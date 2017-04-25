<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=big5">

<title>Administrador de usuarios</title>
    
 <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/color.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.min.js"></script>
   

   
</head>



<div name="dlg" id="dlg" class="easyui-dialog" style="width:300px;height:250px;padding:10px 20px"
            closed="true" buttons="#dlg-buttons">
        <div class="ftitle">ingreso al sistema</div>
        <form id="formulario" name="formulario" method="post" action="agregar">
            <input id="idd" name="idd" type="hidden">
            <div class="fitem">
            <label>Usuario:</label>
               <input id="pe1" name="pe1" style="line-height:18px;border:1px solid #ccc"/>
<label>Contraseña:</label>
               <input id="pe1" name="pe1" style="line-height:18px;border:1px solid #ccc"/>
    <a href="#" class="easyui-linkbutton" plain="true" onclick="ingreso1()">INGRESAR</a>
        </div>
        </form>
    </div>
   <div id="dlg-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
        
    </div>

    <script type="text/javascript">

function regresar(){
    window.location="regresar";
}

    function ingreso1(){
        Object.get = function(obj) {
            var size= new Array(); 
            res = new Object; var key, i=0;
            for (key in obj) {
            size[i]={idd:obj[i].idd,usuario:obj[i].usuario,contraseña:obj[i].contraseña};
            i++;
            }
            return size;
        };
        $.post( "IngresoPersonal", { key: valor=$('#pe1').val() })
          .done(function( data ) {
          var res = data.split("----");
          var info = new Object();
          var si=0;
          for(i=0; i<res.length-1; i++){
            var res2 = res[i].split("::::");
            info[i]={"idd":res2[0],"usuario":res2[1],"contraseña":res2[2]};
            window.location="Admin";
            var sii=si+1
          }

          if (sii == undefined) {
             alert("<h1>no existe</h1>");
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
    


</html>    