<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Equipo extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function insertar($equipo) {
		return $this->db->insert('equipos', $equipo);
	}

	public function actualizar($equipo, $equi_id) {
		return $this->db->update('equipos', $equipo, compact('equi_id'));
	}

	public function listar() {
		$this->db->from('equipos');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function listar_filtro($equi_nombre) {
		$this->db->from('equipos');
		$this->db->like('equi_nombre', $equi_nombre);
		$this->db->or_like('equi_region', $equi_nombre);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function eliminar($equi_id) {
		$this->db->where(compact('equi_id'));
		return $this->db->delete('equipos');		
	}
	
	public function obtenerNombre($equi_id) {
		$this->db->from('equipos');
		$this->db->where(compact('equi_id'));
		$query = $this->db->get();
		$res=$query->row_array();
		return $res['equi_nombre'];
	}

	public function existeEquipo($equi_id, $equi_nombre, $equi_region) {
		$this->db->from('equipos');
		$this->db->where('equi_id <> '.$equi_id);
		$this->db->where(compact('equi_nombre', 'equi_region'));		
		return ($this->db->count_all_results() > 0) ? TRUE : FALSE;
	}

}