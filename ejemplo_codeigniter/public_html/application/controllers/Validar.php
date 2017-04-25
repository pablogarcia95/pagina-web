<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Validar extends CI_Controller {

	function __construct() {
        parent::__construct();
    }

    public function index($msg = NULL) {
    	$this->load->view('entrar');
    }

	public function verificar() {
		if ( ! $this->input->post('usuario') || ! $this->input->post('clave'))
		{
			redirect('ingresar');
		} else {
			$usuario = md5(strtoupper($this->input->post('usuario')));
			$clave = md5($this->input->post('clave'));
			if($usu = $this->Usuario->validarUsuario($usuario, $clave)) {
				$this->session->set_userdata('usu_id', $usu['usu_id']);
				unset($usu['usu_clave']);
				if($usu['usu_tipo'] == 1) {
					$this->session->set_userdata('admin', $usu);
					$this->load->library('menu', array(array('Equipos', 'equipos'), array('Torneos', 'torneos'), array('Partidos', 'partidos'), array('Monedas', 'monedas'), array('Marcadores', 'marcadores'), array('Usuarios', 'usuarios'), array('Apuestas', 'apuestas'), array('Pagos', 'pagos'), array('Frecuencia', 'partidos_apostados'),array('Copia', 'backup'),array('Cerrar Sesion', 'salir')));
					$this->session->set_userdata('mi_menu', $this->menu->contruirMenu());
					$this->session->set_userdata('fecha', $this->Apuesta->obtenerFecha()['fecha']);
					$this->session->set_userdata('msg', '');
					redirect('Abmin');
				} else {
					$this->session->set_userdata('operador', $usu);	
					redirect('Operador');
				}
			} else {
				redirect('ingresar');
			}
		}
	}

}