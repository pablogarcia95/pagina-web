<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rmedicamento extends CI_Controller {

	var $user;

	function __construct() {
        parent::__construct();
    }

	public function index() {
		redirect('Rmedicamento/home');
	}

	public function home() {		
		$this->load->view('admin/home', $data );
	}

	public function productos() {
		$data['listAreas'] = $this->Producto->listar();
		$this->load->view('admin/productos', $data );
	}

	// INICIO FUNCIONES DE PLANES

public function agregar(){
if (!$this->input->post('codigoBarras') && !$this->input->post('nombre') && !$this->input->post('categoria') && !$this->input->post('cantidad') && !$this->input->post('presentacion') && ! $this->input->post('precioUunitario'))
		{
			redirect('index.php/Rmedicamento/productos');
		} else {
			$codigoBarras= $this->input->post('codigoBarras');
			$nombre = $this->input->post('nombre');
			$categoria = $this->input->post('categoria');
			$cantidad = $this->input->post('cantidad');
			$presentacion = $this->input->post('presentacion');
			$precioUnitario = $this->input->post('precioUnitario');;

			if (! $this->input->post('idd')) {
				if(!$this->Producto->existe(0, $codigoBarras)) { 
					$dat=array('codigoBarras'=>$codigoBarras,'nombre'=>$nombre,'categoria'=>$categoria,'cantidad'=>$cantidad,'presentacion'=>$presentacion,'precioUnitario'=>$precioUnitario);
					$this->Producto->insertar($dat);
                    
				} else {
					//$this->session->set_userdata('msg', 'Equipo ya existe. Verifique datos');
				}
			} else {
				$idd = $this->input->post('idd');
				$dat=array('codigoBarras'=>$codigoBarras,'nombre'=>$nombre,'categoria'=>$categoria,'cantidad'=>$cantidad,'presentacion'=>$presentacion,             'precioUnitario'=>$precioUnitario);
				
				$this->Producto->actualizar($dat, $idd);
				
				//$this->session->set_userdata('msg', 'Equipo '. $nombre . '(' . $region . ') editado correctamente');
			}
			redirect('index.php/Rmedicamento/productos');
		}
	}


	public function listarFiltroArea() {
		if ($this->input->post('key')) {
			$data = $this->Producto->listar_filtro($this->input->post('key'));foreach ($data as $valor) { 
echo $valor['id']."::::".$valor['codigoBarras']."::::".$valor['nombre']."::::".$valor['categoria']."::::".$valor['cantidad']."::::".$valor['presentacion']."::::".$valor['precioUnitario']."----";
			}
			
		}
	}

	public function eliminar() {
		if ($this->input->post('key')) {
			$idd = $this->input->post('key');
			$this->Producto->eliminar($idd);
		}
	}
}
