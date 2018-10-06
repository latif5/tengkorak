<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	class MSorpor extends CI_Model {

		public function delete_data($id, $status) {
			$data = array(
				'status' => $status,
                'updateby' => $this->session->userdata('nama_user'),
                'datetime' => date("Y-m-d H:i:s")
			);
			$this->db->where('id',$id);
			$this->db->update('sor_por_tracker',$data);
			$data = array(
				'statussorpor' => $status
			);
			$this->db->where('sorporid',$id);
			$this->db->update('sor_por_database',$data);
		}

		public function getDataQCByNumber($qcnumber) {
			return $this->db->query("SELECT custcode, phasecode, phaseyear from data_qc where qcno='$qcnumber' and status = 1 limit 1");
		}

		public function getDataByFilter($reqname,$id_user_assign,$assignStatus,$ultype,$status) {
			if($assignStatus == 'finish' || $assignStatus == '') {
				$finish = 's.id_user_assign LIKE ?';
			}else if($assignStatus == 'unfinish') {
				$assignStatus = 'finish';
       			$finish = 's.id_user_assign NOT LIKE ?';
			}
			$sql = "SELECT * from sor_por_tracker s where ".$finish." and s.reqname LIKE ? and s.id_user_assign LIKE ? and s.ultype LIKE ? and s.status LIKE ?";
			return $this->db->query($sql , array("%".$assignStatus."%","%".$reqname."%","%".$id_user_assign."%","%".$ultype."%","%".$status."%"));
		}

		public function getStatusLogOpen() {
			$this->db->select('id, date(dateupload) as tanggal',FALSE);
			$this->db->where('statuslog','OPEN');
			return $this->db->get('sor_por_tracker');
		}

		public function getStatusWiproOpen() {
			$this->db->select('id, date(datetimelog) as tanggal', FALSE);
			$array = array('statuswipro'=>'OPEN','statuslog'=>'CLOSE');
			$this->db->where($array);
			return $this->db->get('sor_por_tracker');
		}

		public function getSorPorFinish() {
			return $this->db->query("SELECT * FROM sor_por_tracker WHERE id_user_assign='finish' and date(datetime)=date(subdate(now(),1)) and status=1");
		}

		public function getSorPorUnfinish() {
			return $this->db->query("SELECT * FROM sor_por_tracker WHERE id_user_assign!='finish' and status =1");
		}

		public function getSorporDbBySorporid($id) {
			return $this->db->query("SELECT * FROM sor_por_database WHERE sorporid ='$id'");
		}

		public function getSorporDbById($id) {
			return $this->db->query("SELECT * FROM sor_por_database WHERE id ='$id'");
		}

		public function getDataUser() {
			return $this->db->query("SELECT * FROM user order by nama_user asc");
		}

		public function getDateTimeById($id) {
			return $this->db->query("SELECT porname, date(datetime) as waktu FROM sor_por_tracker WHERE id ='$id'");
		}
	}