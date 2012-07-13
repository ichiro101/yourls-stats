<?php

class Yourls_Log extends CI_Model {

	public function all() {
		$query = $this->db->get("yourls_log");
		return $query->result();
	}

}
