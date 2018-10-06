<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends CI_Controller {
  function __construct()
  {
    parent::__construct();
  	$this->load->model("MAuth");
  }
  function dateSerialToDateTime($date) {
      return ((($date > 25568) ? $date : 25569) * 86400) - ((70 * 365 + 19) * 86400);
  }
  public function index($nama_user = null) {
    /*$date = $this->dateSerialToDateTime(43046);
    echo $date."<br>";
    echo date('Y', $date)."-".date('m', $date)."-".date('d', $date);*/
    if($this->session->userdata('captcha') == ""){
      $data['captcha'] = $this->createCaptcha();
    }else{
      $data['captcha'] = $this->session->userdata('captcha');
    }
    
    if($nama_user!=null){
      $data['nama_user'] = $nama_user;
    }
    $this->load->view('auth',$data);
  }

  public function createCaptcha(){
    $options = array(
      'img_path' => './capimg/',
      'img_url' => base_url('capimg'),
      'img_width' => '180',
      'img_height' => '40',
      'font_path'     => './system/fonts/texb.ttf',
      'font_size'     => 25,
      'word_length'   => 4,
      'expiration' => 7200
    );

    $cap = create_captcha($options);
    $this->session->set_userdata('keycode',md5($cap['word']));
    $this->session->set_userdata('captcha',$cap['image']);
    return $cap['image'];
  }

  public function successLogin($id,$nama_lengkap,$nama_user,$password,$email){
    $this->session->unset_userdata('captcha');  
    $this->session->unset_userdata("nama_userTemp");
    $this->session->unset_userdata("passwordTemp");
    $this->session->unset_userdata("captchaTemp"); 
    $data['id'] = $id;
    $data['nama_lengkap'] = $nama_lengkap;
    $data['nama_user'] = $nama_user;
    $data['password'] = $password;
    $data['email'] = $email;
    $hakAkses = $this->MAuth->getHakAkses($id);
    $access = array();
    $menu = array();
    $admin = false;
    if($hakAkses->num_rows() != null){
      foreach ($hakAkses->result() as $value) {
        if($value->nama_group == "Admin"){
          $admin = true;
        }
        $data['nama_group'] = $value->nama_group;
        array_push($menu, $value->nama_menu);
        array_push($access, $value->hak_akses);
      }  
    }else{
      array_push($menu, "Auth");
      array_push($access, "Auth");
    }
    
    $data['nama_menu'] = $menu;
    $data['hak_akses'] = $access;
    $maintenance = $this->MAuth->cekMaintenance();
    $data['maintenance'] = $maintenance;
    if($maintenance){
      if($admin){
        $this->session->set_userdata($data);
        $this->MAuth->addLogLogin($id);
        redirect('Dashboard','refresh');
      }else{
        $this->session->set_flashdata('gagal',true);
        $this->session->set_flashdata('message',"System is currently undergoing maintenance. Please try again later.");
        redirect('Auth','refresh');
      }
    }else{
      $this->session->set_userdata($data);
      $this->MAuth->addLogLogin($id);
      if($menu[0] == "Dashboard"){
        redirect('Dashboard','refresh');
      }else if($menu[0] == "Log User"){
        redirect('LogUser','refresh');
      }else if($menu[0] == "Data User"){
        redirect('DataUser','refresh');
      }else if($menu[0] == "Group User"){
        redirect('GroupData','refresh');
      }else if($menu[0] == "Cron Job"){
        redirect('Cronjob','refresh');
      }else if($menu[0] == "Master Phase"){
        redirect('MasterPhase','refresh');
      }else if($menu[0] == "Upload Received"){
        redirect('UploadReceived','refresh');
      }else if($menu[0] == "Master Received"){
        redirect('MasterReceived','refresh');
      }else if($menu[0] == "Upload QC"){
        redirect('UploadQC','refresh');
      }else if($menu[0] == "Data QC"){
        redirect('DataQC','refresh');
      }else if($menu[0] == "Sor Por Tracker"){
        redirect('Sorpor','refresh');
      }else if($menu[0] == "Sor Por Dashboard"){
        redirect('SorporDashboard','refresh');
      }else if($menu[0] == "Sor Por Database"){
        redirect('Sorpordb','refresh');
      }else if($menu[0] == "Sor Por Update"){
        redirect('SorporUpdate','refresh');
      }else{
        redirect('Auth/logout','refresh');
      }
    }
  }


  public function login(){
      $nama_user = $this->input->post("nama_user");
      $password = $this->input->post("password");
      $captcha = $this->input->post("captcha");
      $this->session->set_userdata("nama_userTemp",$nama_user);
      $this->session->set_userdata("passwordTemp",$password);
      $this->session->set_userdata("captchaTemp",$captcha);
      if($this->checkCaptcha($captcha)){
        if($this->MAuth->cekData($nama_user,'NOK1'.$password)->num_rows() != null){
          $data = $this->MAuth->cekStatus($nama_user,'NOK1'.$password);
          if($data->num_rows() != null){
            foreach ($data->result() as $value) {
              $date_update_verifikasi = $value->date_update_verifikasi;
              $email = $value->email;
              $id = $value->id;
              $nama_lengkap = $value->nama_lengkap;
            }
            $time = strtotime($date_update_verifikasi);
            //$final = date("Y-m-d", strtotime("+1 month", $time)); expired 1 bulan
            $final = date("Y-m-d", strtotime("+1 week", $time));
            if($final > date("Y-m-d")){
              $this->successLogin($id,$nama_lengkap,$nama_user,$password,$email);
            }else{
              $this->generateCodeUser($id,$email);
              $this->session->set_userdata('idTemp',$id);
              $this->session->set_userdata('emailTemp',$email);
              $this->session->set_flashdata('verifikasi',true);
              redirect('Auth','refresh');
            }
          }else{
            $this->session->set_flashdata('gagal',true);
            $this->session->set_flashdata('message',"Sorry, your account is inactive.");
            redirect('Auth','refresh');
          }
        }else{
          $this->session->set_flashdata('gagal',true);
          $this->session->set_flashdata('message',"The nama_user you entered couldn't be found or your password was incorrect. <br> Please try again.");
          redirect('Auth','refresh');
        }
      }else{
        $this->session->set_flashdata('gagal',true);
        $this->session->set_flashdata('message','The answer you entered for the CAPTCHA was not correct.');
        redirect('Auth','refresh');
      }
  }

 

  public function generateCodeUser($id,$email){
    $code = rand(0000,9999);
    while($this->MAuth->checkCode($code)->num_rows() > 0){
      $code = rand(0000,9999);
    }
    if(strlen($code) == 3){
      $code = "0".$code;
    }
    $this->sendMail($email,$code);
    $this->MAuth->updateKodeVerifikasiUser($id, $code);
  }

  public function sendMail($email,$code){
    $to = $email;
    $subject = "Verification code";

    $message = "
    <html>
    <head>
    <title>Verification Code</title>
    </head>
    <body>
    <div style='color:black;'>
      <b><span style='font-size:16px;'>Your verification code is : </span><span style='font-size: 20px;'>".$code."</span></b>
    <br><br>
      If you are having any issues with your account, please don't hesitate to contact admin.
    <br><br>
      Thanks!<br>Admin
    </div>
    </body>
    </html>
    ";

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: nokia_noreply@portracking.poinsystem.com' . "\r\n";

    mail($to,$subject,$message,$headers);
  }

  public function checkCode(){
    $id = $this->input->post('id');
    $kode_verifikasi = $this->input->post('kode_verifikasi');
    $data = $this->MAuth->checkCodeUser($id,$kode_verifikasi);
    if($data->num_rows() != null){
      $this->MAuth->updateDateVerifikasi($id);
      $this->session->unset_userdata('idTemp');
      $this->session->unset_userdata('emailTemp');
      foreach ($data->result() as $value) {
        $nama_lengkap = $value->nama_lengkap;
        $nama_user = $value->nama_user;
        $password = $value->password;
        $email = $value->email;
      }
      $this->successLogin($id,$nama_lengkap,$nama_user,$password,$email);
    }else{
      $this->session->set_flashdata('verifikasi_gagal',true);
      redirect('Auth','refresh');
    }
  }

  public function checkCaptcha(){
    if(md5($this->input->post("captcha")) == $this->session->userdata("keycode")){
      return true;
    }else{
      return false;
    }
  }

  public function reCaptcha(){
    $this->session->unset_userdata('captcha');  
    redirect('Auth','refresh');
  }

  public function logout(){
    if(!empty($this->session->userdata('id'))){
      $this->MAuth->addLogLogout($this->session->userdata('id'));  
      $dataSession = $this->session->all_userdata();
      $this->session->unset_userdata($dataSession['id']);
      $this->session->unset_userdata($dataSession['nama_lengkap']);
      $this->session->unset_userdata($dataSession['nama_user']);
      $this->session->unset_userdata($dataSession['password']);
      $this->session->unset_userdata($dataSession['email']);
      $this->session->sess_destroy();
    }
    redirect('Auth','refresh');
  }

  public function setMaintenance(){
    $this->MAuth->setMaintenance($this->uri->segment(3));
    $data['maintenance'] = $this->uri->segment(3);
    $this->session->set_userdata($data);
    redirect('Dashboard','refresh');
  }
  
}