<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Model {

	public function __construct() {
        parent::__construct();
	}

	public function insertar($moneda) {
		return $this->db->insert('usuarios', $moneda);
	}

	public function actualizar($moneda, $id) {
		return $this->db->update('usuarios', $moneda, compact('id'));
	}

	public function eliminar($id) {
		$this->db->where('id', $id);
		$this->db->delete('usuarios');
		//return $this->db->delete('usuarios', $id);
	}

	public function listar() {
		$this->db->from('usuarios');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function listar_filtro($usuario) {
		$this->db->from('usuarios');
		$this->db->like('usuario', $usuario);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function consultar($id) {
		$this->db->from('usuario');
		$this->db->where(compact('id'));
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function obtenerNombre($id) {
		$this->db->from('usuarios');
		$this->db->where(compact('id'));
		$query = $this->db->get();
		$res=$query->row_array();
		return $res['usuario'];
        return $res['contraseña'];
	}

	public function existe($id) {
		$this->db->from('usuarios');
		$this->db->where(compact('id'));
		return ($this->db->count_all_results() > 0) ? TRUE : FALSE;
	}
}	
