<?php

class MenuModel extends MainModel{

	public function __construct( $db = false, $controller = null ){
		$this->db = $db;
		$this->controller = $controller;
		$this->userdata = $this->controller->userdata;
	}

}