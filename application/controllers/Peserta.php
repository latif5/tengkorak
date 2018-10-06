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

}