<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once(APPPATH.'core/Admin_Controller.php');

class Peserta extends Admin_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('excel');
        $this->load->model("MPeserta");
    }

    public function index() {
        $this->data['current_page'] = $this->uri->uri_string();
        $this->content = 'admin/peserta';     
        $this->navigation = 'template_admin/_parts/navigation/admin_view'; 
        // passing middle to function. change this for different views.
        $this->data['page_title'] = 'Peserta | Tengkorak';
        $this->layout();
    }

    public function get_data() {
    $start  = $_REQUEST['iDisplayStart'];
    $length = $_REQUEST['iDisplayLength'];
    $sSearch = $_REQUEST['sSearch'];

    $col = $_REQUEST['iSortCol_0'];
    $iter=0;
    $arr = array($iter =>'p.id', $iter+=1 =>'nama', $iter+=1 =>'deskripsi', $iter+=1 =>'waktu', $iter+=1 =>'status');

    $sort_by = $arr[$col];
    $sort_type = $_REQUEST['sSortDir_0'];
    
    $qry = "select p.id, p.nama, p.deskripsi, k.waktu, p.status, p.jumlah_undangan, p.jumlah_hadir from peserta p left join kehadiran k on p.id=k.id_peserta where (p.id LIKE ? or p.nama LIKE ? or p.deskripsi LIKE ? or k.waktu LIKE ? or p.status LIKE ?)  ORDER BY ".$sort_by." ".$sort_type." LIMIT ?, ?";
    $res = $this->db->query($qry, array("%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%",intval($start),intval($length)));

    $qry = "select count(*) as count from peserta p left join kehadiran k on p.id=k.id_peserta where (p.id LIKE ? or p.nama LIKE ? or p.deskripsi LIKE ? or k.waktu LIKE ? or p.status LIKE ?)";
    $result = $this->db->query($qry, array("%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%"));
    foreach($result->result() as $key)
    {
        $iTotal = $key->count;
    }

    $rec = array(
        'iTotalRecords' => $iTotal,
        'iTotalDisplayRecords' => $iTotal,
        'aaData' => array()
    );

    $k=0;$iter=0;
    if($res->num_rows() != null){
        foreach ($res->result() as $value) {
            if ($value->waktu == "") {
                $status = "Belum Hadir";
            } else {
                $status = "Hadir";
            }
            $iterasi = 0;
            $now = strtotime(date('Y-m-d'));
            $rec['aaData'][$k] = array(
                $iterasi => 't|id|e|'.($start+$k+1).'|'.$value->id,
                $iterasi+=1 => 't|nama|e|'.$value->nama,
                $iterasi+=1 => 't|deskripsi|e|'.$value->deskripsi,
                $iterasi+=1 => 't|waktu|e|'.$value->waktu,
                $iterasi+=1 => 't|status||'.$status,
            );
            $k++;
        }

    }

    echo json_encode($rec);
  }

  public function absensi() {
    $nama = $this->input->post('nama');
    $data = $this->MPeserta->getPesertaByNama($nama);
    $hadir = false;
    foreach ($data->result() as $key) {
        if ($key->jumlah_undangan == $key->jumlah_hadir) {
            $hadir = true;
        } else {
            $this->MPeserta->absensi($key->id, $key->jumlah_hadir + 1 );
            $hadir = false;
            break;
        }
    }

    if ($hadir) {
        // peserta sudah hadir , keluar page gagal
    } else {
        // sukses absen
    }
  }

  public function add() {
    $data = array(
        'nama' => $this->input->post("nama"),
        'deskripsi' => $this->input->post("deskripsi"),
        'jumlah_undangan' => $this->input->post("jumlah_undangan"),
        'jumlah_hadir' => $this->input->post("jumlah_hadir"),
        'status' => $this->input->post("status")
    );
    $this->MPeserta->add($data);

    $this->session->set_flashdata('sukses',true);
    $this->session->set_flashdata('pesanSukses','<h4><i class="fa fa-check"></i> Berhasil!</h4><p>Tambah data berhasil!</p>');
    redirect('Peserta','refresh');
  }

}