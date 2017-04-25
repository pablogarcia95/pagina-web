<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pago extends CI_Model {

	public function __construct() {
        parent::__construct();
	}

	public function insertar($pago) {
		try {
			return $this->db->insert('pagos', $pago);
		} catch(Exception $e) {
			return false;
		}
	}

	public function listaPagoFecha($pago_fecha) {
		$this->db->select('SUM(pago_valor) as pago_valor, usu_id as usu_id, pago_moneda as pago_moneda');
		$this->db->from('pagos');
		$this->db->where(compact('pago_fecha'));
		$this->db->group_by('usu_id', 'pago_moneda');
		$query = $this->db->get();
		$parents = $query->result_array();
		$return = array();
		foreach($parents as $parent) {
                       $parent['usu_nombre'] = $this->Usuario->consultar($parent['usu_id'])['usu_nombre'];
                       $parent['mon_nombre'] = $this->Moneda->consultar($parent['pago_moneda'])['mon_siglas'];
                       array_push($return, $parent);
                }
		return $return;
	}
	
	public function listaPagoFechaDetallado($pago_fecha) {
		$this->db->from('pagos');
		$this->db->where(compact('pago_fecha'));
		$this->db->order_by('usu_id, pago_hora', 'Asc');
		$query = $this->db->get();
		$parents = $query->result_array();
		$return = array();
		foreach($parents as $parent) {
                       $parent['usu_nombre'] = $this->Usuario->consultar($parent['usu_id'])['usu_nombre'];
                       $parent['mon_nombre'] = $this->Moneda->consultar($parent['pago_moneda'])['mon_siglas'];
                       array_push($return, $parent);
                }
		return $return;
	}

	public function listaPagoFechaTotal($pago_fecha) {
		$this->db->select('SUM(pago_valor) as pago_valor, pago_moneda as pago_moneda');
		$this->db->from('pagos');
		$this->db->where(compact('pago_fecha'));
		$this->db->group_by('pago_moneda');
		$query = $this->db->get();
		$parents = $query->result_array();
		$return = array();
		foreach($parents as $parent) {
                       $parent['mon_nombre'] = $this->Moneda->consultar($parent['pago_moneda'])['mon_siglas'];
                       array_push($return, $parent);
                }
		return $return;
	}
	
	public function consultar($pago_apu_id) {
		$this->db->from('pagos');
		$this->db->where(compact('pago_apu_id'));
		$query = $this->db->get();
		return $query->row_array();
        }
        
        public function consultar_pago($pago_id) {
		$this->db->from('pagos');
		$this->db->where(compact('pago_id'));
		$query = $this->db->get();
		return $query->row_array();
        }

        public function consultarApuestaDia() {
		$this->db->from('apuestas');
		$this->db->where(compact('apu_partido', 'apu_moneda'));
		$query = $this->db->get();
		return $query->row_array();
        }

	public function listar() {
		$this->db->from('pagos');
		$query = $this->db->get();
		$parents = $query->result_array();
		$return = array();
		foreach($parents as $parent) {
			$pago_apu_id = $parent['pago_apu_id'];
			array_push($return, $parent);
		}
		return $return;
	}
}