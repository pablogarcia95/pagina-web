<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Operador extends CI_Controller {

	var $user;

	function __construct() {
        parent::__construct();
		$this->user = $this->session->userdata('operador');
		if ( ! $this->user) {
			redirect('ingresar');
		}
		$this->load->library('menu', array(array('Boleto', 'par'), array('Pagos', 'pago'),  array('Cerrar Sesion', 'salir')));
		$this->session->set_userdata('mi_menu', $this->menu->contruirMenu());
    }

	public function index() {
		redirect('Operador/inicio');
	}
	
	public function par() {
		//if(!empty($this->session->userdata('msg'))){
		//		$this->session->set_flashdata('mensaje', $this->session->userdata('msg'));
		//		$this->session->set_userdata('msg', '');
		//	}
			$data['mi_menu'] = $this->session->userdata['mi_menu'];
			$data['nomb'] = $this->user['usu_nombre'];
	    	$data['listPartidos'] = $this->Partido->listar5();
		$data['listMonedas'] = $this->Moneda->listar();    	
	        $this->load->view('boletos', $data);
	    }
	
	public function inicio() {
		$data['mi_menu'] = $this->session->userdata['mi_menu'];
		$data['nomb'] = $this->user['usu_nombre'];
		$this->load->view('operador/inicio', $data);
	}

	public function valida() {
		if ( ! $this->input->post('dato'))
		{
			echo "Datos no suministrados";
		} else {
			if($res = $this->Apuesta->consultar($this->input->post('dato'))) { 
				if( ! $this->Pago->consultar($this->input->post('dato'))) {
					$linea="";$itemMarcador="";$gano=0;$c=0;
					$itemApuesta=$this->Apuesta_item->listar($res['apu_id']);
					foreach($itemApuesta as $item) {
						$itemPartidos=$this->Partido->obtenerPartidos($item['apu_partido']);
						if($this->Marcador->existeMarcador($item['apu_partido'])){
							$itemMarcador=$this->Marcador->obtenerMarcador($item['apu_partido']);
							$imagen="<img src='".base_url()."public/images/ok.png' width='12' height='12'  />";
							$dif=intval($itemMarcador['mar_gol1'])-intval($itemMarcador['mar_gol2']);
							if ($dif>0 && intval($item['apuesta'])>0){
								$gano++;
							}
							elseif ($dif==0&& intval($item['apuesta'])==0){
								$gano++;
							}
							elseif ($dif<0&& intval($item['apuesta'])<0){
								$gano++;
							}
							else{
								$imagen="<img src='".base_url()."public/images/no.png' width='12' height='12'  />";
							}
							$linea = $linea.$this->Apuesta->num2letra($item['apuesta'])." ".$itemPartidos." -> (".$itemMarcador['mar_gol1']."-".$itemMarcador['mar_gol2'].")".$imagen.$gano."<br>";
						}
						else{
							$itemMarcador="SM";
							$imagen="<img src='".base_url()."public/images/no.png' width='12' height='12'  />";
							$linea = $linea.$this->Apuesta->num2letra($item['apuesta'])." ".$itemPartidos."(Sin Marcador)".$imagen.$gano."<br>";
						}
						$c++;
						
					}
					echo $linea;
					if (intval($gano)==(intval($c))){
						$el_p="<div class='fitem' style='color:#00FF00;background:#000;'><label>G A N O ! ! ! </label>" . $res['apu_premio'] . "</div>";
						$el_p=$el_p . "<button id='pagar' onclick='calcula(".$res['apu_id'].",".$res['apu_moneda'].",".$res['apu_premio'].")'>Registrar pago de premio</button>";
					}
					else{
						$el_p="<div class='fitem' style='color:#FFF;background:#000;'>Solo logro ".$gano." aciertos de ".$c."</div>";
					}
					echo $el_p;
				}else{
					echo "Atencion: El boleto " . $this->input->post('dato') . " ya fue pagado ";
				}
				     
			} else {
				echo "No existe un boleto con el numero " . $this->input->post('dato');
			}
		}
//    	$this->load->view('h');
	}
	
	public function pagar() {
		if ( ! $this->input->post('apu_id') || ! $this->input->post('pago_valor'))
		{
			redirect('operador/pago');
		} else {
			$pago_apu_id = $this->input->post('apu_id');
			$pago_moneda = $this->input->post('pago_moneda');
			$pago_valor = $this->input->post('pago_valor');
			
			$pago_fecha = $this->Apuesta->obtenerFecha();
			$pago_hora = $this->Apuesta->obtenerHora();
			$estado="1";
			//$usu_id=$this->session->userdata('usu_id');
			$usu_id="1";
			$dat = array('pago_apu_id' => $pago_apu_id,
				 'pago_moneda' => $pago_moneda,
				 'pago_valor' => $pago_valor,
				 'pago_fecha' => $pago_fecha['fecha'],
				 'pago_hora' => $pago_hora['hora'],
				 'estado' => $estado,
				 'usu_id' => $usu_id);
			
			$this->Pago->insertar($dat);
			//redirect('operador/boleto');
		}
		echo $pago_fecha['fecha'] . " " . $pago_hora['hora']; 
	}
	
	public function boleto() {
		//if(!empty($this->session->userdata('msg'))){
		//	$this->session->set_flashdata('mensaje', $this->session->userdata('msg'));
		//	$this->session->set_userdata('msg', '');
		//}
		$data['mi_menu'] = $this->session->userdata['mi_menu'];
		$data['nomb'] = $this->user['usu_nombre'];
		$data['listPartidos'] = $this->Partido->listar2();
		$data['listApuestas'] = $this->Apuesta->listar();
		$data['listMonedas'] = $this->Moneda->listar();
		$this->load->view('operador/boleto', $data);
	}
	
	public function agregar_boleto() {
		if ( ! $this->input->post('valor') || ! $this->input->post('apu_partido'))
		{
			redirect('operador/boleto');
		} else {
			$apu_partido = $this->input->post('apu_partido');
			$apu_moneda = $this->input->post('apu_moneda');
			$apuesta = $this->input->post('apuesta');
			$apu_valor = $this->input->post('valor');
			$apu_fecha = $this->Apuesta->obtenerFecha()['fecha'];
			$apu_hora = $this->Apuesta->obtenerHora()['hora'];
			$estado="1";
			$usu_id=$this->session->userdata('usu_id');
			$dat = array('apu_partido' => $apu_partido,
				 'apu_moneda' => $apu_moneda,
				 'apuesta' => $apuesta,
				 'apu_valor' => $apu_valor,
				 'apu_fecha' => $apu_fecha,
				 'apu_hora' => $apu_hora,
				 'estado' => $estado,
				 'usu_id' => $usu_id);
			
			$this->Apuesta->insertar($dat);
			redirect('operador/boleto');
		}
	}
	
	public function pago() {
		//if(!empty($this->session->userdata('msg'))){
		//	$this->session->set_flashdata('mensaje', $this->session->userdata('msg'));
		//	$this->session->set_userdata('msg', '');
		//}
		$data['mi_menu'] = $this->session->userdata['mi_menu'];
		$data['nomb'] = $this->user['usu_nombre'];
		//$data['listPartidos'] = $this->Partido->listar();
		$data['listPagos'] = $this->Pago->listar();
		//$data['listMonedas'] = $this->Moneda->listar();
		$this->load->view('operador/pago', $data);
	}
	
	public function get_pago() {
		//if(!empty($this->session->userdata('msg'))){
		//	$this->session->set_flashdata('mensaje', $this->session->userdata('msg'));
		//	$this->session->set_userdata('msg', '');
		//}
		if ( ! $this->input->post('pago_id'))
		{
			redirect('operador/pago');
		} else {
		$res=$this->Pago->consultar_pago($this->input->post('pago_id'));
		echo $res['pago_id']."::".$res['pago_fecha']."::".$res['pago_hora']."::".$this->Moneda->obtenerNombre($res['pago_moneda'])."::".$res['pago_valor'];
		}
	}
	
	public function salir() {
		$this->session->sess_destroy();
		redirect('ingresar');
	}

	public function convertirLetras($apu_partido){
		for($i=0;$i<count($apu_partido);$i++){ 
			switch ($apu_partido[$i]){
				case "Local" :
					$apu_partido[$i]="1";
				break;
				case "Empate" :
					$apu_partido[$i]="0";
				break;
				case "Visitante" :
					$apu_partido[$i]="-1";
				break;
			}
		}
		return $apu_partido;
	}

	public function agregar_ticket_item() {
		if ( ! $this->input->post('a') || ! $this->input->post('b') || ! $this->input->post('c') || 
		! $this->input->post('mon_id') || ! $this->input->post('apu_valor') || ! $this->input->post('apu_premio'))
		{
			echo "-1";
		} else {
			$ban=false;
			$mon_id = $this->input->post('mon_id');
			$apu_valor = $this->input->post('apu_valor');
			$apu_premio = $this->input->post('apu_premio');
			$apu_fecha = $this->Apuesta->obtenerFecha()['fecha'];
			$apu_hora = $this->Apuesta->obtenerHora()['hora'];
			$estado="1";
			$usu_id=$this->session->userdata('usu_id');
			//$usu_id="1";
			$dat = array('apu_moneda' => $mon_id,
				 'apu_valor' => $apu_valor,
				 'apu_premio' => $apu_premio,
				 'apu_fecha' => $apu_fecha,
				 'apu_hora' => $apu_hora,
				 'usu_id' => $usu_id,
				 'estado' => $estado);
			
			$this->Apuesta->insertar($dat);
			$ban=true; // Por seguridad a fallos
			
			if ($ban == true){
				$a = $this->input->post('a');
				$b = $this->input->post('b');
				$c = $this->input->post('c');
				$mon_id = $this->input->post('mon_id');
				$apu_partido = explode("::", $a);
				$logro = explode("::", $b);
				$apuesta = explode("::", $c);
				$apuesta=$this->convertirLetras($apuesta);
				$apu_id=$this->Apuesta->getMax()['apu_id'];
				for($i=0;$i<count($apu_partido);$i++){ 
					$dat = array('apu_id' => $apu_id, 'apu_partido' => $apu_partido[$i], 'apuesta' => $apuesta[$i], 'logro' => $logro[$i]);
					$this->Apuesta_item->insertar($dat);
				}
				echo $apu_id . "::" . $apu_fecha . "::" . $apu_hora . "::" . $this->Moneda->obtenerNombre($mon_id);
			}
		}
	}
}