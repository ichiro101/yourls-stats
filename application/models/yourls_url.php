<?php

class Yourls_Url extends CI_Model {

	public function all() {
		$query = $this->db->get("yourls_url");
		return $query->result();
	}

}
