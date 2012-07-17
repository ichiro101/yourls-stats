<?php

class Yourls_Log extends CI_Model {

	public function all() {
		$query = $this->db->get("yourls_log");
		return $query->result();
	}

	public function url($url) {
		$query = $this->db->get_where("yourls_log", array("shorturl" => $url));
		return $query->result();
	}

}
