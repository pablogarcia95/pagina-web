<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rusuarios extends CI_Controller {

	var $user;

	function __construct() {
        parent::__construct();
    }

	public function index() {
		redirect('Rusuarios/home');
	}

	public function home() {		
		$this->load->view('admin/home', $data );
	}

	public function usuarios() {
		$data['listAreas'] = $this->Usuario->listar();
		$this->load->view('admin/usuarios', $data );
	}

	// INICIO FUNCIONES DE PLANES

	public function agregar() {
		if ( ! $this->input->post('usuario') && ! $this->input->post('contraseña'))
		{
			redirect('index.php/Rusuarios/usuarios');
		} else {
			$usuario = $this->input->post('usuario');
			$contraseña = $this->input->post('contraseña');

			if (! $this->input->post('idd')) {
				if(!$this->Usuario->existe(0, $usuario)) {
					$dat = array('usuario' => $usuario, 'contraseña' => $contraseña);
					$this->Usuario->insertar($dat);
                    
				} else {
					//$this->session->set_userdata('msg', 'Equipo ya existe. Verifique datos');
				}
			} else {
				$idd = $this->input->post('idd');
				$dat = array('usuario' => $usuario,'contraseña' => $contraseña);
				
				$this->Usuario->actualizar($dat, $idd);
				
				//$this->session->set_userdata('msg', 'Equipo '. $nombre . '(' . $region . ') editado correctamente');
			}
			redirect('index.php/Rusuarios/usuarios');
		}
	
    

		      //  $idd = $this->input->post('idd'); {
			//	$dat = array('usuario' => $usuario,'contraseña' => $contraseña);
				
			//	$this->Usuario->eliminar($dat, $idd);
				
				//$this->session->set_userdata('msg', 'Equipo '. $nombre . '(' . $region . ') editado correctamente');
			//}
			redirect('index.php/Rusuarios/usuarios');
		


	}


	public function listarFiltroArea() {
		if ($this->input->post('key')) {
			$data = $this->Usuario->listar_filtro($this->input->post('key'));
			foreach ($data as $valor) {
			    echo $valor['id'] . "::::" . $valor['usuario'] . "::::". $valor['contraseña'] . "----";
			}
			
		}
	}

	public function eliminar() {
		if ($this->input->post('key')) {
			$idd = $this->input->post('key');
			$this->Usuario->eliminar($idd);
		}
	}
}