<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Plan extends CI_Model {

	public function __construct() {
        parent::__construct();
	}

	public function insertar($moneda) {
		return $this->db->insert('planes', $moneda);
	}

	public function actualizar($moneda, $id) {
		return $this->db->update('planes', $moneda, compact('id'));
	}

	public function eliminar($id) {
		$this->db->where(compact('id'));
		return $this->db->delete('planes');
	}

	public function listar() {
		$this->db->from('planes');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function listar_filtro($descripcion) {
		$this->db->from('planes');
		$this->db->like('descripcion', $descripcion);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function consultar($id) {
		$this->db->from('planes');
		$this->db->where(compact('id'));
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function obtenerNombre($id) {
		$this->db->from('planes');
		$this->db->where(compact('id'));
		$query = $this->db->get();
		$res=$query->row_array();
		return $res['descripcion'];
        return $res['valor'];
	}

	public function existe($id) {
		$this->db->from('planes');
		$this->db->where(compact('id'));
		return ($this->db->count_all_results() > 0) ? TRUE : FALSE;
	}
}	
