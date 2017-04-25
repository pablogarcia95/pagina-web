<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Partido extends CI_Model {

	public function __construct() {
        parent::__construct();
	}

	public function obtenerPartido($par_id) {
		$this->db->from('partidos');
		$this->db->where(compact('par_id'));
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function obtenerPartidos($par_id) {
		$this->db->from('partidos');
		$this->db->where(compact('par_id'));
		$query = $this->db->get();
		$res=$query->row_array();
		$r=$this->Equipo->obtenerNombre($res['par_equipo1']);
		$retorno = $r;
		$r=$this->Equipo->obtenerNombre($res['par_equipo2']);
		$retorno = $retorno . " Vs " . $r;
		return $retorno;
	}
	
	public function obtenerPremio($par_id, $valor, $apuesta) {
		$this->db->from('partidos');
		$this->db->where(compact('par_id'));
		$query = $this->db->get();
		$res=$query->row_array();

		//$marcador=$this->Marcador->obtenerMarcador($par_id);
		$premio="No gano su apuesta";
		if($marcador = $this->Marcador->obtenerMarcador($par_id) ) {
			if ($apuesta == "1"){ // Le apost車 al local
				if ($marcador['mar_gol1'] > $marcador['mar_gol2'] ){
					$gano="gano";
					$premio=$valor * $res['par_porcentaje1'];
				}
				else{
					$gano="perdio";
				}
			}
			elseif($apuesta == "0"){ // Le apost車 al empate
				if ($marcador['mar_gol1'] == $marcador['mar_gol2'] ){
					$gano="gano";
					$premio=$valor * $res['par_porcentaje3'];
				}
				else{
					$gano="perdio";
				}
			}
			elseif($apuesta == "-1"){ // Le apost車 al empate
				if ($marcador['mar_gol1'] < $marcador['mar_gol2'] ){
					$gano="gano";
					$premio=$valor * $res['par_porcentaje2'];
				}
				else{
					$gano="perdio"; 
				}
			}
		}
		else{
			$premio="No hay un marcador registrado para el partido del boleto";
		}
		return $premio;
	}

	public function partidoMarcador() {
		$this->db->from('partidos');
		$this->db->where('par_id in (SELECT mar_partido FROM marcadores)');
		$query = $this->db->get();
		$parents = $query->result_array();
		$return = array();
		foreach($parents as $parent) {
			$equi_id = $parent['par_equipo1'];
			$this->db->from('equipos');
			$this->db->where(compact('equi_id'));
			$query = $this->db->get();
			$parent['par_equipo1'] = $query->row_array();
			$equi_id = $parent['par_equipo2'];
			$this->db->from('equipos');
			$this->db->where(compact('equi_id'));
			$query = $this->db->get();
			$parent['par_equipo2'] = $query->row_array();
			$parent['marcadores'] = $this->Marcador->obtenerMarcador($parent['par_id']);
			array_push($return, $parent);
		}
		return $return;
	}
	
	public function partidoMarcadorPaginaInicial() {
		$this->db->from('partidos');
//		$this->db->where('par_id in (SELECT mar_partido FROM marcadores)');
		$this->db->where('(par_fecha > DATE_SUB(CURRENT_DATE(), INTERVAL 16 DAY) AND par_fecha < CURRENT_DATE()) OR  (par_fecha = CURRENT_DATE() and par_hora < CURRENT_TIME())');
		$query = $this->db->get();
		$parents = $query->result_array();
		$return = array();
		foreach($parents as $parent) {
			$equi_id = $parent['par_equipo1'];
			$this->db->from('equipos');
			$this->db->where(compact('equi_id'));
			$query = $this->db->get();
			$des_equi = $query->row_array();
			$parent['par_equipo1'] = $des_equi['equi_nombre'];
			
			$equi_id = $parent['par_equipo2'];
			$this->db->from('equipos');
			$this->db->where(compact('equi_id'));
			$query = $this->db->get();
			$des_equi = $query->row_array();
			$parent['par_equipo2'] = $des_equi['equi_nombre'];
			
			$parent['marcadores'] = $this->Marcador->obtenerMarcador($parent['par_id']);
			array_push($return, $parent);
		}
		return $return;
	}	
	
	public function partidoMarcadorPaginaAgregar() {
		$this->db->from('partidos');
		$this->db->where('par_id not in (SELECT mar_partido FROM marcadores)');
		$query = $this->db->get();
		$parents = $query->result_array();
		$return = array();
		foreach($parents as $parent) {
			
			$equi_id = $parent['par_equipo1'];
			$this->db->from('equipos');
			$this->db->where(compact('equi_id'));
			$query = $this->db->get();
			$des_equi = $query->row_array();
			$parent['par_equipo1'] = $des_equi;
			
			$equi_id = $parent['par_equipo2'];
			$this->db->from('equipos');
			$this->db->where(compact('equi_id'));
			$query = $this->db->get();
			$des_equi = $query->row_array();
			$parent['par_equipo2'] = $des_equi;
			
			$parent['marcadores'] = $this->Marcador->obtenerMarcador($parent['par_id']);
			array_push($return, $parent);
		}
		return $return;
	}

	public function partidosDia() {
		$this->db->from('partidos');
		$this->db->where('par_id not in (SELECT mar_partido FROM marcadores) and ((par_fecha = CURRENT_DATE() and par_hora < CURRENT_TIME()) OR (par_fecha < CURRENT_DATE()))');
		$query = $this->db->get();
		$parents = $query->result_array();
		$return = array();
		foreach($parents as $parent) {
			$equi_id = $parent['par_equipo1'];
			$this->db->from('equipos');
			$this->db->where(compact('equi_id'));
			$query = $this->db->get();
			$parent['par_equipo1'] = $query->row_array();
			$equi_id = $parent['par_equipo2'];
			$this->db->from('equipos');
			$this->db->where(compact('equi_id'));
			$query = $this->db->get();
			$parent['par_equipo2'] = $query->row_array();
			array_push($return, $parent);
		}
		return $return;
	}
	
	public function listar() {
		$this->db->from('partidos');
		$this->db->where('par_fecha > CURRENT_DATE() OR  (par_fecha = CURRENT_DATE() and par_hora > CURRENT_TIME())');
		$query = $this->db->get();
		$parents = $query->result_array();
		$return = array();
		foreach($parents as $parent) {
			$par_id = $parent['par_id'];
			
			$equi_id = $parent['par_equipo1'];
			$this->db->from('equipos');
			$this->db->where(compact('equi_id'));
			$query = $this->db->get();
			$des_equi = $query->row_array();
			$parent['par_equipo1'] = $des_equi['equi_nombre'];
			
			$equi_id = $parent['par_equipo2'];
			$this->db->from('equipos');
			$this->db->where(compact('equi_id'));
			$query = $this->db->get();
			$des_equi = $query->row_array();
			$parent['par_equipo2'] = $des_equi['equi_nombre'];
			
			array_push($return, $parent);
		}
		return $return;
	}
	
	public function listar5() {
		$this->db->from('partidos');
		$this->db->where('par_fecha > CURRENT_DATE() OR  (par_fecha = CURRENT_DATE() and par_hora > CURRENT_TIME())');
                $this->db->order_by('par_fecha, torneo_id, par_hora', 'Asc');
		$query = $this->db->get();
		$parents = $query->result_array();
		$return = array();
		foreach($parents as $parent) {
			$par_id = $parent['par_id'];
			
			$equi_id = $parent['par_equipo1'];
			$this->db->from('equipos');
			$this->db->where(compact('equi_id'));
			$query = $this->db->get();
			$des_equi = $query->row_array();
			$parent['par_equipo1'] = $des_equi['equi_nombre'];
			
			$equi_id = $parent['par_equipo2'];
			$this->db->from('equipos');
			$this->db->where(compact('equi_id'));
			$query = $this->db->get();
			$des_equi = $query->row_array();
			$parent['par_equipo2'] = $des_equi['equi_nombre'];
			$parent['torneo_nombre'] = $this->Torneo->obtenerNombre($parent['torneo_id']);
			
			array_push($return, $parent);
		}
		return $return;
	}
	
	
	public function listar2() {
		$this->db->from('partidos');
		$this->db->where('par_id not in (SELECT mar_partido FROM marcadores) and ((par_fecha = CURRENT_DATE() and par_hora < CURRENT_TIME()) OR (par_fecha < CURRENT_DATE()))');
		$query = $this->db->get();
		$parents = $query->result_array();
		$return = array();
		foreach($parents as $parent) {
			$par_id = $parent['par_id'];
			
			$equi_id = $parent['par_equipo1'];
			$this->db->from('equipos');
			$this->db->where(compact('equi_id'));
			$query = $this->db->get();
			$des_equi = $query->row_array();
			$parent['par_equipo1'] = $des_equi['equi_nombre'];
			
			$equi_id = $parent['par_equipo2'];
			$this->db->from('equipos');
			$this->db->where(compact('equi_id'));
			$query = $this->db->get();
			$des_equi = $query->row_array();
			$parent['par_equipo2'] = $des_equi['equi_nombre'];
			
			array_push($return, $parent);
		}
		return $return;
	}
	
	public function listarPartidos() {
		$this->db->from('partidos');
		$this->db->where('par_fecha >= CURRENT_DATE()');
		$query = $this->db->get();
		$parents = $query->result_array();
		$return = array();
		foreach($parents as $parent) {
			$par_id = $parent['par_id'];			
			$equi_id = $parent['par_equipo1'];
			$this->db->from('equipos');
			$this->db->where(compact('equi_id'));
			$query = $this->db->get();
			$parent['par_equipo1'] = $query->row_array();
			$equi_id = $parent['par_equipo2'];
			$this->db->from('equipos');
			$this->db->where(compact('equi_id'));
			$query = $this->db->get();
			$parent['par_equipo2'] = $query->row_array();
			array_push($return, $parent);
		}
		return $return;
	}

	public function equipoPartido($par_equipo) {
		$this->db->from('partidos');
		$this->db->where('par_equipo1 = ' . $par_equipo . ' OR par_equipo2 = ' . $par_equipo);
		return ($this->db->count_all_results() > 0) ? TRUE : FALSE;
	}

	public function partidoUso($apu_partido) {
		$this->db->from('apuestas_item');
		$this->db->where(compact('apu_partido'));
		return ($this->db->count_all_results() > 0) ? TRUE : FALSE;
	}
	
	public function insertar($partido) {
		return $this->db->insert('partidos', $partido);
	}

	public function actualizar($partido, $par_id) {
		return $this->db->update('partidos', $partido, compact('par_id'));
	}
	
	public function eliminar($par_id) {
		$this->db->where(compact('par_id'));
		return $this->db->delete('partidos');		
	}

}