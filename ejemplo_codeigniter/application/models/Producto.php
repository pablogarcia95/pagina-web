<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Model {

	public function __construct() {
        parent::__construct();
	}

	public function insertar($moneda) {
		return $this->db->insert('productos', $moneda);
	}

	public function actualizar($moneda, $id) {
		return $this->db->update('productos', $moneda, compact('id'));
	}

	public function eliminar($id) {
		$this->db->where('id', $id);
		$this->db->delete('productos');
		//return $this->db->delete('usuarios', $id);
	}

	public function listar() {
		$this->db->from('productos');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function listar_filtro($codigoBarras) {
		$this->db->from('productos');
		$this->db->like('codigoBarras', $codigoBarras);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function consultar($id) {
		$this->db->from('productos');
		$this->db->where(compact('id'));
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function obtenerNombre($id) {
		$this->db->from('productos');
		$this->db->where(compact('id'));
		$query = $this->db->get();
		$res=$query->row_array();
		return $res['codigoBarras'];
		return $res['nombre'];
		return $res['categoria'];
		return $res['cantidad'];
		return $res['presentacion'];
		return $res['precioUnitario'];
	}

	public function existe($id) {
		$this->db->from('productos');
		$this->db->where(compact('id'));
		return ($this->db->count_all_results() > 0) ? TRUE : FALSE;
	}
}	
