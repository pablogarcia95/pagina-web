<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Apuesta_item extends CI_Model {

	public function __construct() {
        parent::__construct();
	}

	public function insertar($apuesta_item) {
		try {
			return $this->db->insert('apuestas_item', $apuesta_item);
		} catch(Exception $e) {
			return false;
		}
	}
	
        public function consultar($apu_id) {
		$this->db->from('apuestas_item');
		$this->db->where(compact('apu_id'));
		$query = $this->db->get();
		return $query->row_array();
	}

	public function listar($apu_id) {
		$this->db->from('apuestas_item');
		$this->db->where(compact('apu_id'));
		$query = $this->db->get();
		$parents = $query->result_array();
		$return = array();
		foreach($parents as $parent) {
			array_push($return, $parent);
		}
		return $return;
	}

}