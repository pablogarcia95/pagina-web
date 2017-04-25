<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Resultados extends CI_Controller {

	function __construct() {
        parent::__construct();
    }

    public function index($msg = NULL) {
    	$data['listPartidos'] = $this->Partido->partidoMarcadorPaginaInicial();
        $this->load->view('resultados', $data);
    }
}