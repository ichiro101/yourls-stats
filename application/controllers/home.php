<?php

class Home extends CI_Controller {

	public function index() {
		$this->load->model('Yourls_url');

		$data = array();
		$data['urls'] = $this->Yourls_url->all();

		$this->load->view("main", $data);
	}

}
