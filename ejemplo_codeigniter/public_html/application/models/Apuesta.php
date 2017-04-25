<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Apuesta extends CI_Model {

	public function __construct() {
        parent::__construct();
	}

	public function insertar($apuesta) {
		try {
			return $this->db->insert('apuestas', $apuesta);
		} catch(Exception $e) {
			return false;
		}
	}

        public function obtenerFecha() {
		$this->db->select('DATE(NOW()) as fecha');
		$query = $this->db->get();
		return $query->row_array();
        }
        
        public function obtenerHora() {
		$this->db->select('TIME(NOW()) as hora');
		$query = $this->db->get();
		return $query->row_array();
        }
        
        public function getMax() {
		$this->db->select_max('apu_id');
		$this->db->from('apuestas');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function listaApuestaFecha($apu_fecha) {
		$this->db->select('SUM(apu_valor) as apu_valor, SUM(apu_premio) as apu_premio, usu_id as usu_id, apu_moneda as apu_moneda');
		$this->db->from('apuestas');
		$this->db->where(compact('apu_fecha'));
		$this->db->group_by('usu_id', 'apu_moneda');
		$query = $this->db->get();
		$parents = $query->result_array();
		$return = array();
		foreach($parents as $parent) {
                       $parent['usu_nombre'] = $this->Usuario->consultar($parent['usu_id'])['usu_nombre'];
                       $parent['mon_nombre'] = $this->Moneda->consultar($parent['apu_moneda'])['mon_siglas'];
                       array_push($return, $parent);
                }
		return $return;
	}

	public function listaApuestaFecha_detalle($apu_fecha) {
		$query = $this->db->query('SELECT a.apu_valor, a.apu_premio, a.usu_id, a.apu_moneda, a.apu_fecha, a.apu_hora, a.apu_hora FROM apuestas_item as i, apuestas as a WHERE a.apu_id=i.apu_id and a.apu_fecha="$apu_fecha"');
		$parents = $query->result_array();
		$return = array();
		foreach($parents as $parent) {
                       $parent['usu_nombre'] = $this->Usuario->consultar($parent['a.usu_id'])['usu_nombre'];
                       $parent['mon_nombre'] = $this->Moneda->consultar($parent['a.apu_moneda'])['mon_siglas'];
                       array_push($return, $parent);
                }
		return $return;
	}

	public function listaApuestaFechaTotal($apu_fecha) {
		$this->db->from('apuestas');
		$this->db->where(compact('apu_fecha'));
		$this->db->order_by('usu_id, apu_hora', 'Asc');
		$query = $this->db->get();
		$parents = $query->result_array();
		$return = array();
		foreach($parents as $parent) {
                       $parent['usu_nombre'] = $this->Usuario->consultar($parent['usu_id'])['usu_nombre'];
                       $parent['mon_nombre'] = $this->Moneda->consultar($parent['apu_moneda'])['mon_siglas'];
                       array_push($return, $parent);
                }
		return $return;
	}

        public function consultarApuestaDia() {
		$this->db->from('apuestas');
		$this->db->where(compact('apu_partido', 'apu_moneda'));
		$query = $this->db->get();
		return $query->row_array();            
        }
        
        public function consultar($apu_id) {
		$this->db->from('apuestas');
		$this->db->where(compact('apu_id'));
		$query = $this->db->get();
		return $query->row_array();
	}

	public function listar() {
		$this->db->from('apuestas');
		$query = $this->db->get();
		$parents = $query->result_array();
		$return = array();
		foreach($parents as $parent) {
			$apu_id = $parent['apu_id'];
			
			$par_id = $parent['apu_partido'];
			$this->db->from('partidos');
			$this->db->where(compact('par_id'));
			$query = $this->db->get();
			$des_equi = $query->row_array();
			$parent['par_porcentaje1'] = $des_equi['par_porcentaje1'];
			$parent['par_porcentaje2'] = $des_equi['par_porcentaje2'];
			$parent['par_porcentaje3'] = $des_equi['par_porcentaje3'];
			$partidoA = $des_equi['par_equipo1'];
			$partidoB = $des_equi['par_equipo2'];
			
			$equi_id = $partidoA;
			$this->db->from('equipos');
			$this->db->where(compact('equi_id'));
			$query = $this->db->get();
			$des_equi = $query->row_array();
			$partido_disputado = $des_equi['equi_nombre'];
			
			$equi_id = $partidoB;
			$this->db->from('equipos');
			$this->db->where(compact('equi_id'));
			$query = $this->db->get();
			$des_equi = $query->row_array();
			$partido_disputado = $partido_disputado . " -- Vs -- " . $des_equi['equi_nombre'];
			$parent['apu_partido'] = $partido_disputado;
			
			$mon_id = $parent['apu_moneda'];
			$this->db->from('monedas');
			$this->db->where(compact('mon_id'));
			$query = $this->db->get();
			$des_equi = $query->row_array();
			$parent['apu_moneda'] = $des_equi['mon_descripcion'];
			
			if ($parent['apuesta'] == '1'){
					$parent['apuesta']="Gana el Local";
				}
				elseif($parent['apuesta'] == '0'){
					$parent['apuesta']="Empate";
				}
			elseif($parent['apuesta'] == '-1'){
				$parent['apuesta']="Gana el Visitante";
			}
			$parent['apu_valor'] = number_format($parent['apu_valor']);
			array_push($return, $parent);
			
		}
		return $return;
	}

	public function partidosApostados() {
		$this->db->from('partidos');
		$this->db->where('(par_fecha = CURRENT_DATE() and par_hora > CURRENT_TIME()) OR (par_fecha > CURRENT_DATE())');
		$query = $this->db->get();
		$parents = $query->result_array();
		$return = array();
		foreach($parents as $parent) {
			$apu_partido = $parent['par_id'];
			$this->db->from('apuestas_item');
			$this->db->where(compact('apu_partido'));			
			$parent['cantidad'] = $this->db->count_all_results();
			$parent['par_equipo1_n']=$this->Equipo->obtenerNombre($parent['par_equipo1']);
			$parent['par_equipo2_n']=$this->Equipo->obtenerNombre($parent['par_equipo2']);
			array_push($return, $parent);
		}
		return $return;
	}
	
	public function equiposApostados() {
		$this->db->from('partidos');
		$this->db->where('(par_fecha = CURRENT_DATE() and par_hora > CURRENT_TIME()) OR (par_fecha > CURRENT_DATE())');
		$query = $this->db->get();
		$parents = $query->result_array();
		$return = array();
		foreach($parents as $parent) {
			$this->db->from('apuestas_item');
			$this->db->where('logro > 0');
			$parent['cantidad1'] = $this->db->count_all_results();
			$this->db->from('apuestas_item');
			$this->db->where('logro < 0');
			$parent['cantidad2'] = $this->db->count_all_results();
			$parent['par_equipo1_n']=$this->Equipo->obtenerNombre($parent['par_equipo1']);
			$parent['par_equipo2_n']=$this->Equipo->obtenerNombre($parent['par_equipo2']);
			array_push($return, $parent);
		}
		return $return;
		// Recuerda que el no esta dispuesto a perderlo todo, no esta preparado para ganar nada
	}
	
	public function equiposFrecuencia() {
		$query = $this->db->query('SELECT equipos.equi_id, equi_nombre, COUNT( * ) AS can FROM equipos INNER JOIN partidos ON ( equipos.equi_id = partidos.par_equipo1 OR equipos.equi_id = partidos.par_equipo2 ) GROUP BY equipos.equi_id ORDER BY COUNT( * ) DESC LIMIT 0 , 30');
		$parents = $query->result_array();
		$return = array();
		foreach($parents as $parent) {
			array_push($return, $parent);
		}
		return $return;
	}
	
	public function num2letra($apuesta) {
		$res="";
		switch ($apuesta) {
		    case "1":
		        $res="(Fue al Local) ";
		        break;
		    case "0":
		        $res="(Fue al Empate) ";
		        break;
		    case "-1":
		        $res="(Fue al Visitante) ";
		        break;
		}
		return $res;
	}
}