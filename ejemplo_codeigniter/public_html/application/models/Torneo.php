<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Torneo extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function insertar($Torneo) {
		return $this->db->insert('torneos', $Torneo);
	}

	public function actualizar($Torneo, $torneo_id) {
		return $this->db->update('torneos', $Torneo, compact('torneo_id'));
	}

	public function listar() {
		$this->db->from('torneos');
		$this->db->order_by('torneo_nombre', 'Asc');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function listar_filtro($torneo_nombre) {
		$this->db->from('torneos');
		$this->db->like('torneo_nombre', $torneo_nombre);
		$this->db->or_like('pais', $torneo_nombre);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function eliminar($torneo_id) {
		$this->db->where(compact('torneo_id'));
		return $this->db->delete('torneos');		
	}
	
	public function obtenerNombre($torneo_id) {
		$this->db->from('torneos');
		$this->db->where(compact('torneo_id'));
		$query = $this->db->get();
		$res=$query->row_array();
		return $res['pais'] . " - " . $res['torneo_nombre'];
	}

	public function existeTorneo($torneo_id, $torneo_nombre, $pais) {
		$this->db->from('torneos');
		$this->db->where('torneo_id <> '.$torneo_id);
		$this->db->where(compact('torneo_nombre', 'pais'));		
		return ($this->db->count_all_results() > 0) ? TRUE : FALSE;
	}

}