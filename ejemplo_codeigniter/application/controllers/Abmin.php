<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Abmin extends CI_Controller {

	var $user;

	function __construct() {
        parent::__construct();
    }

	public function index() {
		redirect('Abmin/home');
	}

	public function home() {		
		$this->load->view('admin/home', $data );
	}

	public function areas() {
		$data['listAreas'] = $this->Area->listar();
		$this->load->view('admin/areas', $data );
	}

	// INICIO FUNCIONES DE AREAS

	public function agregar() {
		if ( ! $this->input->post('descripcion'))
		{
			redirect('index.php/Abmin/areas');
		} else {
			$descripcion = $this->input->post('descripcion');
			if (! $this->input->post('idd')) {
				if(!$this->Area->existe(0, $descripcion)) {
					$dat = array('descripcion' => $descripcion);
					$this->Area->insertar($dat);
				} else {
					//$this->session->set_userdata('msg', 'Equipo ya existe. Verifique datos');
				}
			} else {
				$idd = $this->input->post('idd');
				$dat = array('descripcion' => $descripcion);
				$this->Area->actualizar($dat, $idd);
				//$this->session->set_userdata('msg', 'Equipo '. $nombre . '(' . $region . ') editado correctamente');
			}
			redirect('index.php/Abmin/areas');
		}
	}

	public function listarFiltroArea() {
		if ($this->input->post('key')) {
			$data = $this->Area->listar_filtro($this->input->post('key'));
			foreach ($data as $valor) {
			    echo $valor['area_id'] . "::::" . $valor['descripcion'] . "----";
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
