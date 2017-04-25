<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends CI_Model {

	public function __construct() {
        parent::__construct();
	}

	public function insertar($moneda) {
		return $this->db->insert('areas', $moneda);
	}

	public function actualizar($moneda, $area_id) {
		return $this->db->update('areas', $moneda, compact('area_id'));
	}

	public function eliminar($area_id) {
		$this->db->where(compact('area_id'));
		return $this->db->delete('areas');
	}

	public function listar() {
		$this->db->from('areas');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function listar_filtro($descripcion) {
		$this->db->from('areas');
		$this->db->like('descripcion', $descripcion);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function consultar($area_id) {
		$this->db->from('areas');
		$this->db->where(compact('area_id'));
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function obtenerNombre($area_id) {
		$this->db->from('areas');
		$this->db->where(compact('area_id'));
		$query = $this->db->get();
		$res=$query->row_array();
		return $res['descripcion'];
	}

	public function existe($area_id) {
		$this->db->from('areas');
		$this->db->where(compact('area_id'));
		return ($this->db->count_all_results() > 0) ? TRUE : FALSE;
	}
}	
