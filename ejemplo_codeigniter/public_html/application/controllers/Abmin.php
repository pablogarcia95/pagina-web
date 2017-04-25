<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Abmin extends CI_Controller {

	var $user;

	function __construct() {
        parent::__construct();
		$this->user = $this->session->userdata('admin');
		if ( ! $this->user) {
			redirect('ingresar');
		}
    }

	public function index() {
		redirect('Abmin/home');
	}

	public function home() {		
		$data['mi_menu'] = $this->session->userdata['mi_menu'];
		$data['nomb'] = $this->user['usu_nombre'];
		$this->load->view('admin/home', $data );
	}

	public function equipos() {
		//if(!empty($this->session->userdata('msg'))){
	//		$this->session->set_flashdata('mensaje', $this->session->userdata('msg'));
//			$this->session->set_userdata('msg', '');
//		}
		$data['mi_menu'] = $this->session->userdata['mi_menu'];
		$data['nomb'] = $this->user['usu_nombre'];
		$data['listEquipos'] = $this->Equipo->listar();
		$this->load->view('admin/equipos', $data );
	}

	public function torneos() {
		//if(!empty($this->session->userdata('msg'))){
		//	$this->session->set_flashdata('mensaje', $this->session->userdata('msg'));
		//	$this->session->set_userdata('msg', '');
		//}
		$data['mi_menu'] = $this->session->userdata['mi_menu'];
		$data['nomb'] = $this->user['usu_nombre'];
		$data['listTorneos'] = $this->Torneo->listar();
		$this->load->view('admin/torneos', $data );
	}

	public function partidos() {
		//if(!empty($this->session->userdata('msg'))){
	//		$this->session->set_flashdata('mensaje', $this->session->userdata('msg'));
//			$this->session->set_userdata('msg', '');
//		}
		$data['mi_menu'] = $this->session->userdata['mi_menu'];
		$data['nomb'] = $this->user['usu_nombre'];
		$data['listTorneos'] = $this->Torneo->listar();
		$data['listPartidos'] = $this->Partido->listar();
		$data['listEquipos'] = $this->Equipo->listar();
		$this->load->view('admin/partidos', $data );
	}

	public function apuestas() {
//		if(!empty($this->session->userdata('msg'))){
//			$this->session->set_flashdata('mensaje', $this->session->userdata('msg'));
//			$this->session->set_userdata('msg', '');
//		}
		$data['mi_menu'] = $this->session->userdata['mi_menu'];
		$data['nomb'] = $this->user['usu_nombre'];
		$data['fecha'] = $this->session->userdata['fecha'];
                $data['listApuestas'] = $this->Apuesta->listaApuestaFecha($this->session->userdata['fecha']);
                $data['listApuestas_detalle'] = $this->Apuesta->listaApuestaFechaTotal($this->session->userdata['fecha']);
                $data['listApuestasMoneda'] = $this->Apuesta->listaApuestaFechaTotal($this->session->userdata['fecha']);
		$this->load->view('admin/apuestas', $data);
	}

	public function pagos() {
//		if(!empty($this->session->userdata('msg'))){
//			$this->session->set_flashdata('mensaje', $this->session->userdata('msg'));
//			$this->session->set_userdata('msg', '');
//		}
		$data['mi_menu'] = $this->session->userdata['mi_menu'];
		$data['nomb'] = $this->user['usu_nombre'];
		$data['fecha'] = $this->session->userdata['fecha'];
                $data['listPagos'] = $this->Pago->listaPagoFecha($this->session->userdata['fecha']);
                $data['listPagosDetalle'] = $this->Pago->listaPagoFechaDetallado($this->session->userdata['fecha']);
		$this->load->view('admin/pagos', $data);
	}
	
	public function partidos_apostados() {
//		if(!empty($this->session->userdata('msg'))){
//			$this->session->set_flashdata('mensaje', $this->session->userdata('msg'));
//			$this->session->set_userdata('msg', '');
//		}
		$data['mi_menu'] = $this->session->userdata['mi_menu'];
		$data['nomb'] = $this->user['usu_nombre'];
		$data['fecha'] = $this->session->userdata['fecha'];
                $data['listPartidosApostados'] = $this->Apuesta->partidosApostados();
                $data['listEquiposApostados'] = $this->Apuesta->equiposApostados();
                $data['listEquiposFrecuencia'] = $this->Apuesta->equiposFrecuencia();
		$this->load->view('admin/partidos_apostados', $data);
	}

	public function monedas() {
		//if(!empty($this->session->userdata('msg'))){
		//	$this->session->set_flashdata('mensaje', $this->session->userdata('msg'));
		//	$this->session->set_userdata('msg', '');
		//}
		$data['mi_menu'] = $this->session->userdata['mi_menu'];
		$data['nomb'] = $this->user['usu_nombre'];
		$data['listMonedas'] = $this->Moneda->listar();
		$this->load->view('admin/monedas', $data );
	}

	public function marcadores() {
		//if(!empty($this->session->userdata('msg'))){
		//	$this->session->set_flashdata('mensaje', $this->session->userdata('msg'));
		//	$this->session->set_userdata('msg', '');
		//}
		$data['mi_menu'] = $this->session->userdata['mi_menu'];
		$data['nomb'] = $this->user['usu_nombre'];
		$data['listMarcadores'] = $this->Partido->partidoMarcador();
		$data['listPartidos'] = $this->Partido->partidosDia();
		$this->load->view('admin/marcadores', $data);
	}

	public function usuarios() {
		//if(!empty($this->session->userdata('msg'))){
		//	$this->session->set_flashdata('mensaje', $this->session->userdata('msg'));
		//	$this->session->set_userdata('msg', '');
		//}
		$data['mi_menu'] = $this->session->userdata['mi_menu'];
		$data['nomb'] = $this->user['usu_nombre'];
		$data['listUsuarios'] = $this->Usuario->listar();
		$this->load->view('admin/usuarios', $data);
	}

	// INICIO FUNCIONES DE EQUIPOS

	public function agregar() {
		if ( ! $this->input->post('nombre') || ! $this->input->post('region'))
		{
			redirect('Abmin/equipos');
		} else {
			$nombre = $this->input->post('nombre');
			$region = $this->input->post('region');
			if (! $this->input->post('idd')) {
				if(!$this->Equipo->existeEquipo(0, $nombre, $region)) {
					$dat = array('equi_nombre' => $nombre,
							 'equi_region' => $region);
					$this->Equipo->insertar($dat);
					$this->session->set_userdata('msg', 'Equipo agregado correctamente');
				} else {
					$this->session->set_userdata('msg', 'Equipo ya existe. Verifique datos');
				}
			} else {
				$idd = $this->input->post('idd');
				if(!$this->Partido->equipoPartido($idd)) {
					if(!$this->Equipo->existeEquipo($idd, $nombre, $region)) {
						$dat = array('equi_nombre' => $nombre,
								 'equi_region' => $region);
						$this->Equipo->actualizar($dat, $idd);
						$this->session->set_userdata('msg', 'Equipo '. $nombre . '(' . $region . ') editado correctamente');
					} else {
						$this->session->set_userdata('msg', 'Equipo '. $nombre . '(' . $region . ') ya existe. Verifique datos.');
					}
				} else {
					$this->session->set_userdata('msg', 'No se puede editar ID equipo: ' . $idd . ', Ya ha sido usado.');
				}
			}
			redirect('Abmin/equipos');
		}
	}

	public function eliminar() {
		if ($this->input->post('key')) {
			$idd = $this->input->post('key');
			$this->Equipo->eliminar($idd);
		}
	}

	// FIN FUNCIONES DE EQUIPOS

	// INICIO FUNCIONES DE TORNEOS

	public function agregar_torneo() {
		if ( ! $this->input->post('nombre') || ! $this->input->post('pais'))
		{
			redirect('Abmin/torneos');
		} else {
			$nombre = $this->input->post('nombre');
			$pais = $this->input->post('pais');
			if (! $this->input->post('idd')) {
				if(!$this->Torneo->existeTorneo(0, $nombre, $pais)) {
					$dat = array('torneo_nombre' => $nombre,
							 'pais' => $pais);
					$this->Torneo->insertar($dat);
					$this->session->set_userdata('msg', 'Torneo agregado correctamente');
				} else {
					$this->session->set_userdata('msg', 'Torneo ya existe. Verifique datos');
				}
			} else {
				$idd = $this->input->post('idd');
				//if(!$this->Partido->equipoTorneo($idd)) {
					if(!$this->Torneo->existeTorneo($idd, $nombre, $pais)) {
						$dat = array('torneo_nombre' => $nombre,
								 'pais' => $pais);
						$this->Torneo->actualizar($dat, $idd);
						$this->session->set_userdata('msg', 'Torneo '. $nombre . '(' . $pais . ') editado correctamente');
					} else {
						$this->session->set_userdata('msg', 'Torneo '. $nombre . '(' . $pais . ') ya existe. Verifique datos.');
					}
				//} else {
				//	$this->session->set_userdata('msg', 'No se puede editar ID equipo: ' . $idd . ', Ya ha sido usado.');
				//}
			}
			redirect('Abmin/torneos');
		}
	}

	public function eliminar_torneo() {
		if ($this->input->post('key')) {
			$idd = $this->input->post('key');
			$this->Torneo->eliminar($idd);
		}
	}

	// FIN FUNCIONES DE TORNEOS

	// INICIO FUNCIONES DE PARTIDOS
	
	public function agregar_partido() {
		if ( ! $this->input->post('par_equipo1') || ! $this->input->post('par_equipo2') && ! $this->input->post('par_id'))
		{
			redirect('Abmin/partidos');
		} else {
			$par_equipo1 = $this->input->post('iddd');
			$par_equipo2 = $this->input->post('idddd');
			$par_porcentaje1 = $this->input->post('par_porcentaje1');
			$par_porcentaje2 = $this->input->post('par_porcentaje2');
			$par_porcentaje3 = $this->input->post('par_porcentaje3');
			$par_fecha = $this->input->post('par_fecha');
			$par_hora = $this->input->post('par_hora');
			$torneo_id = $this->input->post('torneo_id');			
			$dat = array('par_equipo1' => $par_equipo1,
			 'par_equipo2' => $par_equipo2,
			 'par_porcentaje1' => $par_porcentaje1,
			 'par_porcentaje2' => $par_porcentaje2,
			 'par_porcentaje3' => $par_porcentaje3,
			 'par_fecha' => $par_fecha,
			 'par_hora' => $par_hora,
			 'torneo_id' => $torneo_id);
			$this->Partido->insertar($dat);
			$this->session->set_userdata('msg', 'Partido agregado correctamente.');
			redirect('Abmin/partidos');
		}
	}
	
	public function modificar_partido() {
		if ( ! $this->input->post('par_equipo1') || ! $this->input->post('par_equipo2') && ! $this->input->post('par_id'))
		{
			redirect('Abmin/partidos');
		} else {
			$par_equipo1 = $this->input->post('iddd');
			$par_equipo2 = $this->input->post('idddd');
			$par_porcentaje1 = $this->input->post('par_porcentaje1');
			$par_porcentaje2 = $this->input->post('par_porcentaje2');
			$par_porcentaje3 = $this->input->post('par_porcentaje3');
			$par_fecha = $this->input->post('par_fecha');
			$par_hora = $this->input->post('par_hora');			
			$dat = array(
			 'par_porcentaje1' => $par_porcentaje1,
			 'par_porcentaje2' => $par_porcentaje2,
			 'par_porcentaje3' => $par_porcentaje3,
			 'par_fecha' => $par_fecha,
			 'par_hora' => $par_hora);
			$this->Partido->actualizar($dat, $this->input->post('par_id'));
			$this->session->set_userdata('msg', 'Partido modificado correctamente.');
			redirect('Abmin/partidos');
		}
	}
	
	public function eliminarPartido() {
		if ($this->input->post('key')) {
			$idd = $this->input->post('key');
			if(!$this->Partido->partidoUso($idd)) {
				$this->Partido->eliminar($idd);
				return TRUE;
			}
		}
		return FALSE;
	}
	
	public function listarFiltro() {
		if ($this->input->post('key')) {
			$data = $this->Equipo->listar_filtro($this->input->post('key'));
			foreach ($data as $valor) {
			    echo $valor['equi_id'] . "::::" . $valor['equi_nombre'] . " (" . $valor['equi_region'] . ")----";
			}
			
		}
	}

	public function listarFiltroEquipo() {
		if ($this->input->post('key')) {
			$data = $this->Equipo->listar_filtro($this->input->post('key'));
			foreach ($data as $valor) {
			    echo $valor['equi_id'] . "::::" . $valor['equi_nombre'] . "::::" . $valor['equi_region'] . "----";
			}
			
		}
	}
	
	public function listarFiltroTorneo() {
		if ($this->input->post('key')) {
			$data = $this->Torneo->listar_filtro($this->input->post('key'));
			foreach ($data as $valor) {
			    echo $valor['torneo_id'] . "::::" . $valor['torneo_nombre'] . "::::" . $valor['pais'] . "----";
			}
			
		}
	}

	// FIN FUNCIONES DE PARTIDOS

	// INICIO FUNCIONES DE APUESTAS

	public function agregarApuesta() {
		if ( ! $this->input->post('iddd') || ! $this->input->post('equ1') || ! $this->input->post('equ2')
				|| ! $this->input->post('idMoneda') || ! $this->input->post('moneda'))
		{
			redirect('Admin/monedas');
		} else {
			$id_partido = $this->input->post('iddd');
			$id_moneda = $this->input->post('idMoneda');
			if (! $this->input->post('idd')) {
				$apu = $this->Apuesta->verificarApuesta($id_partido, $id_moneda);
				if(!$apu) {
					$part = $this->Partido->obtenerPartido($id_partido);
					$dat = array('apu_partido' => $id_partido, 'apu_moneda' => $id_moneda,
								'apu_fecha' =>$part['par_fecha'], 'apu_hora' => $part['par_hora']);
					$this->Apuesta->insertar($dat);
					$this->session->set_userdata('msg', 'Apuesta agregada correctamente');
				} else {
					$this->session->set_userdata('msg', 'Verifique informaci贸n. Apuesta no fue agregada.');
				}
			} else {
				$idd = $this->input->post('idd');
				$this->Moneda->actualizar($dat, $idd);
			}
			redirect('Abmin/apuestas');
		}
	}

        public function consultarApuesta() {
                if ( ! $this->input->post('fecha')) {
                      redirect('Abmin/apuestas');
                } else {
                      $this->session->set_userdata('fecha', $this->input->post('fecha'));
		      redirect('Abmin/apuestas');
                }
        }
	
	

	// FIN FUNCIONES DE APUESTAS

	// INICIO FUNCIONES DE PAGOS

	public function consultarPago() {
                if ( ! $this->input->post('fecha')) {
                      redirect('Abmin/pagos');
                } else {
                      $this->session->set_userdata('fecha', $this->input->post('fecha'));
		      redirect('Abmin/pagos');
                }
        }	

	// FIN FUNCIONES DE PAGOS

	// INICIO FUNCIONES DE MONEDAS

	public function agregarMoneda() {
		if ( ! $this->input->post('siglas') || ! $this->input->post('nombre'))
		{
			redirect('Abmin/monedas');
		} else {
			$nombre = $this->input->post('nombre');
			$siglas = $this->input->post('siglas');
			$dat = array('mon_siglas' => $siglas,
						 'mon_descripcion' => $nombre);
			if (! $this->input->post('idd')) {
				if(!$this->Moneda->existeMoneda(0, $siglas)) {
					$this->Moneda->insertar($dat);
					$this->session->set_userdata('msg', 'Moneda '.$siglas.' agregado correctamente.');
				} else {
					$this->session->set_userdata('msg', 'Moneda '.$siglas.' ya existe. Verifique datos.');
				}
			} else {
				$idd = $this->input->post('idd');
				if(!$this->Moneda->usoMoneda($idd)) {
					if(!$this->Moneda->existeMoneda($idd, $siglas)) {
						$this->Moneda->actualizar($dat, $idd);
						$this->session->set_userdata('msg', 'Moneda '.$siglas.' actualizada correctamente.');
					} else {
						$this->session->set_userdata('msg', 'No se puede actualizar. Moneda '.$siglas.' ya existe. Verifique datos.');
					}
				} else {
					$this->session->set_userdata('msg', 'No se puede editar moneda ID: '.$idd.'. Ya existen apuestas con ella.');
				}
			}
			redirect('Abmin/monedas');
		}
	}

	// FIN FUNCIONES DE MONEDAS

	// INICIO FUNCIONES DE MARCADORES

	public function agregarMarcador() {
		if ( ! is_numeric( $this->input->post('golesB')) || ! is_numeric( $this->input->post('golesA')))
		{	$this->session->set_userdata('msg', 'Falto ingresar informacion o no ingreso un marcador numerico');
			redirect('Abmin/marcadores');
		} else {
			$golesA = $this->input->post('golesA');
			$golesB = $this->input->post('golesB');			
			if (! $this->input->post('idd')) {
				$id_part = $this->input->post('iddd');
				$dat = array('mar_partido' => $id_part,
							 'mar_gol1' => $golesA,
							 'mar_gol2' => $golesB);
				if($this->Marcador->existeMarcador($id_part) == false) {
					if($this->Marcador->insertar($dat)) {
						$this->session->set_userdata('msg', 'Marcador agregado correctamente');
					} else {
						$this->session->set_userdata('msg', 'Verifique datos. Marcador no agregado');
					}
				} else {
					$this->session->set_userdata('msg', 'Marcador ya existe.');
				}
			} else {
				$datt = array('mar_gol1' => $golesA, 'mar_gol2' => $golesB);
				$idd = $this->input->post('idd');
				$this->Marcador->actualizar($datt, $idd);
				$this->session->set_userdata('msg', 'Marcador actualizado correctamente');
			}
			redirect('Abmin/marcadores');
		}
	}

	// FIN FUNCIONES DE MARCADORES

	// INICIO FUNCIONES DE USUARIOS

	public function agregarUsuario() {
		if ( ! $this->input->post('nombre') || ! $this->input->post('clave') || ! $this->input->post('tipo'))
		{
			redirect('Abmin/usuarios');
		} else {
			$u = md5(strtoupper($this->input->post('nombre')));
			if(!$this->Usuario->existeUsuario($u)) {
				$nombre = strtoupper($this->input->post('nombre'));
				$clave = md5($this->input->post('clave'));
				$tipo = $this->input->post('tipo');
				$dat = array('usu_nombre' => $nombre,
						'usu_clave' => $clave,
						'usu_tipo' => $tipo,
						'usu_u' => $u);
				$this->Usuario->insertar($dat);
				$this->session->set_userdata('msg', 'Usuario insertado correctamente');
			} else {
				$this->session->set_userdata('msg', 'Usuario existente. Por favor Verifique datos.');
			}
			redirect('Abmin/usuarios');
		}
	}

	public function editarUsuario() {
		if ( ! $this->input->post('idd') || ! $this->input->post('clave') ) {
			redirect('Abmin/usuarios');
		} else {
			$idd = $this->input->post('idd');
			$clave = md5($this->input->post('clave'));
			$dat = array('usu_clave' => $clave);
			$this->Usuario->actualizar($dat, $idd);
			$this->session->set_userdata('msg', 'Clave modificada correctamente - Usuario ID: ' . $idd);
			redirect('Abmin/usuarios');
		}
	}

	// FIN FUNCIONES DE USUARIOS

	public function salir() {
		$this->session->sess_destroy();
		redirect('ingresar');
	}

	public function backup() {
		$this->load->dbutil();
		$this->load->dbutil();
		$prefs = array(     
		        'format'      => 'zip',             
		        'filename'    => 'my_db_backup.sql'
		      );
		$backup = $this->dbutil->backup($prefs); 
		$db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
		$save = 'pathtobkfolder/'.$db_name;
		$this->load->helper('file');
		write_file($save, $backup); 
		$this->load->helper('download');
		force_download($db_name, $backup);
	}

}