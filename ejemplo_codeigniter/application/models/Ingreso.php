<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Ingreso extends CI_Model { 

public function __construct() {
        parent::__construct();
	}

public function listar(){
	$this->db->from('usuarios');
	$query = $this->db->get();
	return $query->result_array();

}


public function IngresoPersonal($usuario){
	$this->db->from('usuarios');
	$this->db->like('usuario',$usuario);
	$query = $this->db->get();
	return $query->result_array();
}


}