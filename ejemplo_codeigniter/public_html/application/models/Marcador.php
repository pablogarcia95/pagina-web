<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Marcador extends CI_Model {

	public function __construct() {
        parent::__construct();
	}

	public function insertar($marcador) {
		return $this->db->insert('marcadores', $marcador);
	}

	public function actualizar($marcador, $mar_id) {
		return $this->db->update('marcadores', $marcador, compact('mar_id')); 
	}

	public function obtenerMarcador($mar_partido) {
		$this->db->from('marcadores');
		$this->db->where(compact('mar_partido'));
		$query = $this->db->get();
		return $query->row_array();
	}

	public function existeMarcador($mar_partido) {
		$this->db->from('marcadores');
		$this->db->where(compact('mar_partido'));
		return ($this->db->count_all_results() > 0) ? TRUE : FALSE;
	}

}