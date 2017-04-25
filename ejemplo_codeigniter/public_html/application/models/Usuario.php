<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Model {

	public function __construct() {
        parent::__construct();
	}

	public function insertar($usuario) {
		return $this->db->insert('usuarios', $usuario);
	}

	public function actualizar($usuario, $usu_id) {
		return $this->db->update('usuarios', $usuario, compact('usu_id'));
	}

	public function eliminar($idUsuario) {
		$this->db->where(compact('idUsuario'));
		return $this->db->delete('usuarios');		
	}

	public function listar() {
		$this->db->from('usuarios');
		$query = $this->db->get();
		$parents = $query->result_array();
		$return = array();
		foreach($parents as $parent) {
			$tip_id = $parent['usu_tipo'];
			$this->db->from('tipoUsuario');
			$this->db->where(compact('tip_id'));
			$query = $this->db->get();
			array_push($return, array_merge($parent, $query->row_array()));
		}
		return $return;
	}

	public function validarUsuario($usu_u, $usu_clave) {
		$this->db->from('usuarios');
		$this->db->where(compact('usu_u', 'usu_clave'));
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function consultar($usu_id) {
		$this->db->from('usuarios');
		$this->db->where(compact('usu_id'));
		$query = $this->db->get();
		return $query->row_array();
	}

	public function existeUsuario($usu_u) {
		$this->db->from('usuarios');
		$this->db->where(compact('usu_u'));
		return ($this->db->count_all_results() > 0) ? TRUE : FALSE;
	}

}
