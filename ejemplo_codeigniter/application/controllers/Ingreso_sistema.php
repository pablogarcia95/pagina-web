<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class Ingreso_sistema extends CI_Controller {  

   var $user;

    function __construct() {
        parent::__construct();
    }

    public function index() {
        redirect('Ingreso_sistema/home');
    }

    public function home() {        
        $this->load->view('admin/home', $data );
    }

    public function ingresar() {
        $data['listAreas'] = $this->Ingreso->listar();
        $this->load->view('admin/ingresar', $data );
    }

     public function Admin(){
       $this->load->view('usuarios');

    }

    public function regresar() {
       $this->load->view('Navegacion');
    }

    public function IngresoPersonal() {
        if ($this->input->post('key')) {
            $data = $this->Ingreso->IngresoPersonal($this->input->post('key'));
            foreach ($data as $valor) {
                echo $valor['id'] . "::::" . $valor['usuario'] . "::::". $valor['contraseña'] . "----";
            }
            
        }
    }
}