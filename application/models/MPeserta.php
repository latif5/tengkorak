<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class MPeserta extends CI_Model {
		public function getPersertaByNama($nama) {
			$sql = "SELECT * FROM peserta WHERE nama = ?";
			return $this->db->query($sql, array($nama));
		}

		public function absensi($id) {
			
		}
	}