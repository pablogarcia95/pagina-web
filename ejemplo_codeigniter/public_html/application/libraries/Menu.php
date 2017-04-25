<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu {

	private $arr_menu;

	public function __construct($arr) {
		$this->arr_menu = $arr;
	}

	public function contruirMenu() {
		$ret_menu = "<nav id='m'>Menu<ul>"; 
		foreach($this->arr_menu as $elemento) {
			$ret_menu .= '<li><a href="'.$elemento[1].'">'.$elemento[0].'</a></li>';
		}
		$ret_menu .= "</ul></nav>"; 
		return $ret_menu;
	}

}
