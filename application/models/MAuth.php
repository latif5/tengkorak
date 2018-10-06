<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class MAuth extends CI_Model {

		public function cekData($username,$password){
			$sql = "SELECT * FROM user WHERE nama_user = ? and password = ?";
			return $this->db->query($sql, array($username,md5($password)));
		}

		public function cekStatus($username,$password){
			$sql = "SELECT * FROM user WHERE nama_user = ? and password = ? and status = 1 and now() < expired_date";
			return $this->db->query($sql, array($username,md5($password)));
		}

		public function checkCodeUser($id,$kode_verifikasi){
			$sql = "SELECT * FROM user where id = ? and kode_verifikasi = ?";
			return $this->db->query($sql, array($id, $kode_verifikasi));
		}

		public function checkCode($kode){
			$sql = "SELECT * FROM user where kode_verifikasi = ?";
			return $this->db->query($sql, $kode);
		}
	    
	    public function updateKodeVerifikasiUser($id, $code){
	    	$sql = "UPDATE user set kode_verifikasi = ? where id = ?";
	    	$this->db->query($sql, array($code,$id));
	    }

	    public function updateDateVerifikasi($id){
	    	$sql = "UPDATE user set date_update_verifikasi=now() where id = ?";
	    	$this->db->query($sql, $id);
	    }

	    public function addLogLogin($id){
	    	$this->db->query("INSERT into log_user(id_user, waktu_login) values('$id',now())");
	    }

	    public function addLogLogout($id){
	    	$id_log = $this->db->query("SELECT id_log FROM log_user where id_user='$id' and date(waktu_login) = date(now()) order by id_log desc limit 1");
	    	foreach ($id_log->result() as $value) {
	    		$id_log = $value->id_log;
	    	}
	    	$this->db->query("UPDATE log_user set waktu_logout = now() where id_log = '$id_log' ");
	    }

	    public function getHakAkses($id){
	    	return $this->db->query("select nama_group, nama_menu, group_concat(nama_hak_akses) as hak_akses from user_group u, group_data g, hak_akses_user hku, hak_akses ha, menu m where u.id_group=g.id_group and g.id_group=hku.id_group and hku.id_hak_akses=ha.id_hak_akses and hku.id_menu=m.id_menu and id_user='$id' group by nama_menu order by m.id_menu asc");
	    }

	    public function cekMaintenance(){
	    	$data = $this->db->query("SELECT * FROM maintenance");
	    	foreach ($data->result() as $value) {
	    		if($value->do == 1){
	    			return true;
	    		}else{
	    			return false;
	    		}
	    	}
	    }

	    public function setMaintenance($value){
	    	$this->db->query("UPDATE maintenance set do = '$value'");
	    }
	}