<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class MPeserta extends CI_Model {
		public function getPersertaByNama($nama) {
			$sql = "SELECT * FROM peserta WHERE nama = ?";
			return $this->db->query($sql, array($nama));
		}

		public function absensi($id, $jumlah_hadir) {
			$this->db->query("UPDATE peserta set jumlah_hadir = $jumlah_hadir where id = $id");
			$this->db->query("INSERT into kehadiran(id_peserta, waktu) values($id,now())");
		}

		public function add($data) {
			$this->db->insert('peserta', $data);
		}
	}