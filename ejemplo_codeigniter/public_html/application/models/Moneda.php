<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Moneda extends CI_Model {

	public function __construct() {
        parent::__construct();
	}

	public function insertar($moneda) {
		return $this->db->insert('monedas', $moneda);
	}

	public function actualizar($moneda, $mon_id) {
		return $this->db->update('monedas', $moneda, compact('mon_id'));
	}

	public function eliminar($mon_id) {
		$this->db->where(compact('mon_id'));
		return $this->db->delete('monedas');
	}

	public function listar() {
		$this->db->from('monedas');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function consultar($mon_id) {
		$this->db->from('monedas');
		$this->db->where(compact('mon_id'));
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function obtenerNombre($mon_id) {
		$this->db->from('monedas');
		$this->db->where(compact('mon_id'));
		$query = $this->db->get();
		$res=$query->row_array();
		return $res['mon_descripcion'];
	}

	public function existeMoneda($mon_id, $mon_siglas) {
		$this->db->from('monedas');
		$this->db->where(compact('mon_siglas'));
		$this->db->where('mon_id <> ' . $mon_id);
		return ($this->db->count_all_results() > 0) ? TRUE : FALSE;
	}

	public function usoMoneda($apu_moneda) {
		$this->db->from('apuestas');
		$this->db->where(compact('apu_moneda'));
		return ($this->db->count_all_results() > 0) ? TRUE : FALSE;
	}

}
