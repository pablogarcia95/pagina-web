<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Partidos extends CI_Controller {

	function __construct() {
        parent::__construct();
    }

    public function index($msg = NULL) {
    	$data['listPartidos'] = $this->Partido->listar5();
	$data['listMonedas'] = $this->Moneda->listar();    	
        $this->load->view('partidos', $data);
    }

    
}