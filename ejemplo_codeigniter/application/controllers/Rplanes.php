<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rplanes extends CI_Controller {

	var $user;

	function __construct() {
        parent::__construct();
    }

	public function index() {
		redirect('Rplanes/home');
	}

	public function home() {		
		$this->load->view('admin/home', $data );
	}

	public function planes() {
		$data['listAreas'] = $this->Plan->listar();
		$this->load->view('admin/planes', $data );
	}

	// INICIO FUNCIONES DE PLANES

	public function agregar() {
		if ( ! $this->input->post('descripcion') && ! $this->input->post('valor'))
		{
			redirect('index.php/Rplanes/planes');
		} else {
			$descripcion = $this->input->post('descripcion');
			$valor = $this->input->post('valor');

			if (! $this->input->post('idd')) {
				if(!$this->Plan->existe(0, $descripcion)) {
					$dat = array('descripcion' => $descripcion, 'valor' => $valor);
					$this->Plan->insertar($dat);
                    
				} else {
					//$this->session->set_userdata('msg', 'Equipo ya existe. Verifique datos');
				}
			} else {
				$idd = $this->input->post('idd');
				$dat = array('descripcion' => $descripcion,'valor' => $valor);
				
				$this->Plan->actualizar($dat, $idd);
				
				//$this->session->set_userdata('msg', 'Equipo '. $nombre . '(' . $region . ') editado correctamente');
			}
			redirect('index.php/Rplanes/planes');
		}
	}


	public function listarFiltroArea() {
		if ($this->input->post('key')) {
			$data = $this->Plan->listar_filtro($this->input->post('key'));
			foreach ($data as $valor) {
			    echo $valor['id'] . "::::" . $valor['descripcion'] . "::::". $valor['valor'] . "----";
			}
			
		}
	}

	public function eliminar() {
		if ($this->input->post('key')) {
			$idd = $this->input->post('key');
			$this->Equipo->eliminar($idd);
		}
	}
}
