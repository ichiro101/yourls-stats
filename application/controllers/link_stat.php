<?php

class Link_Stat extends CI_Controller {

	// Show the aggregate statistics
	public function all() {
		$this->load->model('Yourls_url');
		$this->load->model('Yourls_log');

		$data = array();
		$Yourls_log = $this->Yourls_log->all();

		$data["data"] = $Yourls_log;

		$this->load->view("link_stats/all", $data);
	}

	// Show only the statistics for a given link (or
	// shorturl)
	public function link_stats($url) {
		$this->load->model('Yourls_url');
		$this->load->model('Yourls_log');

		$data = array();
		$Yourls_log = $this->Yourls_log->url($url);

		$data["data"] = $Yourls_log;

		$this->load->view("link_stats/link_stats", $data);
	}
}
