<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include_once(APPPATH.'core/Admin_Controller.php');
class Sorpor extends Admin_Controller {
  function __construct()
  {
    parent::__construct();
    $can = false;
    for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
      if("Sor Por Tracker" == $this->session->userdata('nama_menu')[$i]){
        $can = true;
      }
    }
    if($this->session->userdata('id') == "" || $can == false){
      redirect('Auth');
    }
    $this->load->library('excel');
    $this->load->model("MSorpor");
  }
  public function index($nama_user = null) {
    $this->data['current_page'] = $this->uri->uri_string();
    $this->content = 'admin/sorpor';     
    $this->navigation = 'template_admin/_parts/navigation/admin_view'; 
    // passing middle to function. change this for different views.
    $this->data['page_title'] = 'Sor Por Tracker | NOKIA';
    $this->layout();
  }

  public function get_data(){
    $start  = $_REQUEST['iDisplayStart'];
    $length = $_REQUEST['iDisplayLength'];
    $sSearch = $_REQUEST['sSearch'];

    $col = $_REQUEST['iSortCol_0'];
    $iter=0;
    $arr = array($iter =>'id', $iter+=1 =>'custcode', $iter+=1 =>'phaseyear', $iter+=1 =>'phasecode', $iter+=1 =>'ultype', $iter+=1 =>'portype', $iter+=1 =>'porname', $iter+=1 =>'qtyso', $iter+=1 =>'qtyspo', $iter+=1 =>'baseid', $iter+=1 =>'id_user_assign', $iter+=2 =>'datetime', $iter+=1 =>'porcode', $iter+=1 =>'wbsl2', $iter+=1 =>'qcno', $iter+=1 =>'projecttype', $iter+=1 =>'projectname', $iter+=1 =>'reqname', $iter+=1 =>'reqemail', $iter+=1 =>'pordate', $iter+=1 =>'wpname', $iter+=1 =>'region', $iter+=1 =>'wbsl3', $iter+=1 =>'top', $iter+=1 =>'aginglog', $iter+=1 =>'statuslog', $iter+=1 =>'remarkslog', $iter+=1 =>'updatebylog', $iter+=1 =>'datetimelog', $iter+=1 =>'agingwipro', $iter+=1 =>'statuswipro', $iter+=1 =>'remarkswipro', $iter+=1 =>'updatebywipro', $iter+=1 =>'datetimewipro', $iter+=1 =>'porstatus', $iter+=1 =>'dateupload', $iter+=1 =>'filename', $iter+=1 =>'updateby', $iter+=1 =>'status', $iter+=1 =>'history_assign');

    $sort_by = $arr[$col];
    $sort_type = $_REQUEST['sSortDir_0'];

    // $qry = "select * from upload_qc u where u.status=1 and (u.id_upload_qc LIKE ? or u.wbsl2 LIKE ? or u.qcno LIKE ? or u.projecttype LIKE ? or u.projectname LIKE ? or u.typeul LIKE ? or u.filename LIKE ? or u.phasename LIKE ? or u.remarksUp LIKE ? or u.status LIKE ? or u.update_by LIKE ? or u.datetime LIKE ?)  ORDER BY ".$sort_by." ".$sort_type." LIMIT ?, ?";
    // $res = $this->db->query($qry, array("%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%",intval($start),intval($length)));
    
    $qry = "select * from sor_por_tracker s where s.status=1 and s.id_user_assign != 'finish' and (s.id LIKE ? or s.ultype LIKE ? or s.portype LIKE ? or s.custcode LIKE ? or s.phasecode LIKE ? or s.phaseyear LIKE ? or s.porname LIKE ? or s.porcode LIKE ? or s.wbsl2 LIKE ? or s.qcno LIKE ? or s.projecttype LIKE ? or s.projectname LIKE ? or s.reqname LIKE ? or s.reqemail LIKE ? or s.pordate LIKE ? or s.wpname LIKE ? or s.region LIKE ? or s.wbsl3 LIKE ? or s.top LIKE ? or s.qtyso LIKE ? or s.qtyspo LIKE ? or s.aginglog LIKE ? or s.statuslog LIKE ? or s.remarkslog LIKE ? or s.updatebylog LIKE ? or s.datetimelog LIKE ? or s.agingwipro LIKE ? or s.statuswipro LIKE ? or s.remarkswipro LIKE ? or s.updatebywipro LIKE ? or s.datetimewipro LIKE ? or s.porstatus LIKE ? or s.dateupload LIKE ? or s.filename LIKE ? or s.updateby LIKE ? or s.datetime LIKE ? or s.status LIKE ?)  ORDER BY ".$sort_by." ".$sort_type." LIMIT ?, ?";
    $res = $this->db->query($qry, array("%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%",intval($start),intval($length)));

    $qry = "select count(*) as count from sor_por_tracker s where s.status=1 and s.id_user_assign != 'finish' and (s.id LIKE ? or s.ultype LIKE ? or s.portype LIKE ? or s.custcode LIKE ? or s.phasecode LIKE ? or s.phaseyear LIKE ? or s.porname LIKE ? or s.porcode LIKE ? or s.wbsl2 LIKE ? or s.qcno LIKE ? or s.projecttype LIKE ? or s.projectname LIKE ? or s.reqname LIKE ? or s.reqemail LIKE ? or s.pordate LIKE ? or s.wpname LIKE ? or s.region LIKE ? or s.wbsl3 LIKE ? or s.top LIKE ? or s.qtyso LIKE ? or s.qtyspo LIKE ? or s.aginglog LIKE ? or s.statuslog LIKE ? or s.remarkslog LIKE ? or s.updatebylog LIKE ? or s.datetimelog LIKE ? or s.agingwipro LIKE ? or s.statuswipro LIKE ? or s.remarkswipro LIKE ? or s.updatebywipro LIKE ? or s.datetimewipro LIKE ? or s.porstatus LIKE ? or s.dateupload LIKE ? or s.filename LIKE ? or s.updateby LIKE ? or s.datetime LIKE ? or s.status LIKE ?)";
    $result = $this->db->query($qry, array("%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%"));
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
            if($value->id!=NULL){$id=$value->id;}else{$id='-';}
            if($value->ultype!=NULL){$ultype=$value->ultype;}else{$ultype='-';}
            if($value->portype!=NULL){$portype=$value->portype;}else{$portype='-';}
            if($value->custcode!=NULL){$custcode=$value->custcode;}else{$custcode='-';}
            if($value->phasecode!=NULL){$phasecode=$value->phasecode;}else{$phasecode='-';}
            if($value->phaseyear!=NULL){$phaseyear=$value->phaseyear;}else{$phaseyear='-';}
            if($value->porname!=NULL){$porname=$value->porname;}else{$porname='-';}
            if($value->baseid!=NULL){$baseid=$value->baseid;}else{$baseid='- - -';}
            if($value->porcode!=NULL){$porcode=$value->porcode;}else{$porcode='-';}
            if($value->wbsl2!=NULL){$wbsl2=$value->wbsl2;}else{$wbsl2='-';}
            if($value->qcno!=NULL){$qcno=$value->qcno;}else{$qcno='-';}
            if($value->projecttype!=NULL){$projecttype=$value->projecttype;}else{$projecttype='-';}
            if($value->projectname!=NULL){$projectname=$value->projectname;}else{$projectname='-';}
            if($value->reqname!=NULL){$reqname=$value->reqname;}else{$reqname='-';}
            if($value->reqemail!=NULL){$reqemail=$value->reqemail;}else{$reqemail='-';}
            if($value->pordate!=NULL){$pordate=$value->pordate;}else{$pordate='-';}
            if($value->wpname!=NULL){$wpname=$value->wpname;}else{$wpname='-';}
            if($value->region!=NULL){$region=$value->region;}else{$region='-';}
            if($value->wbsl3!=NULL){$wbsl3=$value->wbsl3;}else{$wbsl3='-';}
            if($value->top!=NULL){$top=$value->top;}else{$top='-';}
            if($value->qtyso!=NULL){$qtyso=$value->qtyso;}else{$qtyso='-';}
            if($value->qtyspo!=NULL){$qtyspo=$value->qtyspo;}else{$qtyspo='-';}
            if($value->aginglog!=NULL){$aginglog=$value->aginglog;}else{$aginglog='-';}
            if($value->statuslog!=NULL){$statuslog=$value->statuslog;}else{$statuslog='-';}
            if($value->remarkslog!=NULL){$remarkslog=$value->remarkslog;}else{$remarkslog='-';}
            if($value->updatebylog!=NULL){$updatebylog=$value->updatebylog;}else{$updatebylog='-';}
            if($value->datetimelog!=NULL){$datetimelog=$value->datetimelog;}else{$datetimelog='-';}
            if($value->agingwipro!=NULL){$agingwipro=$value->agingwipro;}else{$agingwipro='-';}
            if($value->statuswipro!=NULL){$statuswipro=$value->statuswipro;}else{$statuswipro='-';}
            if($value->remarkswipro!=NULL){$remarkswipro=$value->remarkswipro;}else{$remarkswipro='-';}
            if($value->updatebywipro!=NULL){$updatebywipro=$value->updatebywipro;}else{$updatebywipro='-';}
            if($value->datetimewipro!=NULL){$datetimewipro=$value->datetimewipro;}else{$datetimewipro='-';}
            if($value->porstatus!=NULL){$porstatus=$value->porstatus;}else{$porstatus='-';}
            if($value->dateupload!=NULL){$dateupload=$value->dateupload;}else{$dateupload='-';}
            if($value->filename!=NULL){$filename=$value->filename;}else{$filename='-';}
            if($value->updateby!=NULL){$updateby=$value->updateby;}else{$updateby='-';}
            if($value->datetime!=NULL){$datetime=$value->datetime;}else{$datetime='-';}
            if($value->status!=NULL){$status=$value->status;}else{$status='-';}
            if($value->id_user_assign!=NULL){$id_user_assign=$value->id_user_assign;}else{$id_user_assign='-';}
            if($value->history_assign!=NULL){$history_assign=$value->history_assign;}else{$history_assign='-';}

            $index = NULL;
            for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
              if("Sor Por Tracker" == $this->session->userdata('nama_menu')[$i]){
                $index = $i;
                break;
              }
            }
            if(strpos($this->session->userdata('hak_akses')[$index],"Delete") !== FALSE){
                if($value->status == 1){
                    $tombolHapus = '<button class="btn btn-danger btn-xs delete-data"style="height:20px;" status="'.$value->status.'" rel="'.$value->id.'" data-name="'.$value->projectname.'"><i class="fa fa-trash"></i></button>';
                }else{
                    $tombolHapus = '<button class="btn btn-success btn-xs delete-data"style="height:20px;" status="'.$value->status.'" rel="'.$value->id.'" data-name="'.$value->projectname.'"><i class="fa fa-trash"></i></button>';
                }
                $tombolChangeDatetime = '<button class="btn btn-warning btn-xs edit-datetime" data-id="'.$value->id.'"><i class="fa fa-pencil"></i></button>';
            }else{
              $tombolHapus = '';
              $tombolChangeDatetime = '';
            }
            if(strpos($this->session->userdata('hak_akses')[$index],"Update") !== FALSE){
              $editable = 'editable';
            }else{
              $editable = '';
            }
            $iterasi = 0;
            $now = strtotime(date('Y-m-d'));
            $date = strtotime(date('Y-m-d', strtotime($datetime)));
            $result = round(($now-$date) / 86400);
            $rec['aaData'][$k] = array(
                $iterasi => 't|id|e|'.$id.'|'.$this->encrypt_decrypt('encrypt','NOK1'.$id),
                $iterasi+=1 => 't|custcode|e|'.$custcode,
                $iterasi+=1 => 't|phaseyear|e|'.$phaseyear,
                $iterasi+=1 => 't|phasecode|e|'.$phasecode,
                $iterasi+=1 => 't|ultype|e|'.$ultype,
                $iterasi+=1 => 't|portype|e|'.$portype,
                $iterasi+=1 => 't|porname||'.$porname,
                $iterasi+=1 => 't|qtyso|e|'.$qtyso,
                $iterasi+=1 => 't|qtyspo|e|'.$qtyspo,
                $iterasi+=1 => 't|baseid|e|'.$baseid,
                $iterasi+=1 => 'su|id_user_assign|e|'.$id_user_assign,
                $iterasi+=1 => 't|||'.$result,
                $iterasi+=1 => 't|datetime||'.$datetime,
                $iterasi+=1 => 't|porcode|e|'.$porcode,
                $iterasi+=1 => 't|wbsl2|e|'.$wbsl2,
                $iterasi+=1 => 't|qcno|e|'.$qcno,
                $iterasi+=1 => 't|projecttype|e|'.$projecttype,
                $iterasi+=1 => 't|projectname|e|'.$projectname,
                $iterasi+=1 => 't|reqname|e|'.$reqname,
                $iterasi+=1 => 't|reqemail|e|'.$reqemail,
                $iterasi+=1 => 'd|pordate|e|'.$pordate,
                $iterasi+=1 => 't|wpname|e|'.$wpname,
                $iterasi+=1 => 't|region|e|'.$region,
                $iterasi+=1 => 't|wbsl3|e|'.$wbsl3,
                $iterasi+=1 => 't|top|e|'.$top,
                $iterasi+=1 => 't|aginglog|e|'.$aginglog,
                $iterasi+=1 => 's|statuslog|e|'.$statuslog,
                $iterasi+=1 => 't|remarkslog|e|'.$remarkslog,
                $iterasi+=1 => 't|updatebylog||'.$updatebylog,
                $iterasi+=1 => 't|datetimelog||'.$datetimelog,
                $iterasi+=1 => 't|agingwipro|e|'.$agingwipro,
                $iterasi+=1 => 's|statuswipro|e|'.$statuswipro,
                $iterasi+=1 => 't|remarkswipro|e|'.$remarkswipro,
                $iterasi+=1 => 't|updatebywipro||'.$updatebywipro,
                $iterasi+=1 => 't|datetimewipro||'.$datetimewipro,
                $iterasi+=1 => 's|porstatus|e|'.$porstatus,
                $iterasi+=1 => 't|dateupload||'.$dateupload,
                $iterasi+=1 => 't|filename||'.$filename,
                $iterasi+=1 => 't|updateby||'.$updateby,
                $iterasi+=1 => 't|status||'.$status.$tombolHapus." ".$tombolChangeDatetime,
                $iterasi+=1 => 't|history_assign||'.$history_assign
            );
            $k++;
            $start++;
        }

    }

    echo json_encode($rec);
  }
















  public function get_data_filter(){
    $start  = $_REQUEST['iDisplayStart'];
    $length = $_REQUEST['iDisplayLength'];
    $sSearch = $_REQUEST['sSearch'];

    $col = $_REQUEST['iSortCol_0'];
    $iter=0;
    $arr = array($iter =>'id', $iter+=1 =>'custcode', $iter+=1 =>'phaseyear', $iter+=1 =>'phasecode', $iter+=1 =>'ultype', $iter+=1 =>'portype', $iter+=1 =>'porname', $iter+=1 =>'qtyso', $iter+=1 =>'qtyspo', $iter+=1 =>'baseid', $iter+=1 =>'id_user_assign', $iter+=2 =>'datetime', $iter+=1 =>'porcode', $iter+=1 =>'wbsl2', $iter+=1 =>'qcno', $iter+=1 =>'projecttype', $iter+=1 =>'projectname', $iter+=1 =>'reqname', $iter+=1 =>'reqemail', $iter+=1 =>'pordate', $iter+=1 =>'wpname', $iter+=1 =>'region', $iter+=1 =>'wbsl3', $iter+=1 =>'top', $iter+=1 =>'aginglog', $iter+=1 =>'statuslog', $iter+=1 =>'remarkslog', $iter+=1 =>'updatebylog', $iter+=1 =>'datetimelog', $iter+=1 =>'agingwipro', $iter+=1 =>'statuswipro', $iter+=1 =>'remarkswipro', $iter+=1 =>'updatebywipro', $iter+=1 =>'datetimewipro', $iter+=1 =>'porstatus', $iter+=1 =>'dateupload', $iter+=1 =>'filename', $iter+=1 =>'updateby', $iter+=1 =>'status', $iter+=1 =>'history_assign');

    $sort_by = $arr[$col];
    $sort_type = $_REQUEST['sSortDir_0'];

    $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D', '%22');
    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]"," ");

    $key1 = str_replace($entities, $replacements, $this->uri->segment(3));
    $key2 = str_replace($entities, $replacements, $this->uri->segment(4));
    $key3 = str_replace($entities, $replacements, $this->uri->segment(5));
    $key4 = str_replace($entities, $replacements, $this->uri->segment(6));
    $key5 = str_replace($entities, $replacements, $this->uri->segment(7));

    if($key1=='xxx'){$key1='';}
    if($key2=='xxx'){$key2='';}
    if($key3=='xxx'){$key3='';}
    if($key4=='xxx'){$key4='';}
    if($key5=='xxx'){$key5='';}
    if($key5 == 'finish' || $key5 == ''){
        $finish = 's.id_user_assign LIKE ?';
    }else if($key5 == 'unfinish'){
        $key5 = 'finish';
        $finish = 's.id_user_assign NOT LIKE ?';
    }

    $qry = "select * from sor_por_tracker s where (".$finish." and s.reqname LIKE ? and s.id_user_assign LIKE ? and s.ultype LIKE ? and s.status LIKE ?) and (s.id LIKE ? or s.ultype LIKE ? or s.portype LIKE ? or s.custcode LIKE ? or s.phasecode LIKE ? or s.phaseyear LIKE ? or s.porname LIKE ? or s.porcode LIKE ? or s.wbsl2 LIKE ? or s.qcno LIKE ? or s.projecttype LIKE ? or s.projectname LIKE ? or s.reqname LIKE ? or s.reqemail LIKE ? or s.pordate LIKE ? or s.wpname LIKE ? or s.region LIKE ? or s.wbsl3 LIKE ? or s.top LIKE ? or s.qtyso LIKE ? or s.qtyspo LIKE ? or s.aginglog LIKE ? or s.statuslog LIKE ? or s.remarkslog LIKE ? or s.updatebylog LIKE ? or s.datetimelog LIKE ? or s.agingwipro LIKE ? or s.statuswipro LIKE ? or s.remarkswipro LIKE ? or s.updatebywipro LIKE ? or s.datetimewipro LIKE ? or s.porstatus LIKE ? or s.dateupload LIKE ? or s.filename LIKE ? or s.updateby LIKE ? or s.datetime LIKE ? or s.status LIKE ?)  ORDER BY ".$sort_by." ".$sort_type." LIMIT ?, ?";
    $res = $this->db->query($qry, array("%".$key5."%","%".$key1."%","%".$key2."%","%".$key3."%","%".$key4."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%",intval($start),intval($length)));

    $qry = "select count(*) as count from sor_por_tracker s where (".$finish." and s.reqname LIKE ? and s.id_user_assign LIKE ? and s.ultype LIKE ? and s.status LIKE ?) and (s.id LIKE ? or s.ultype LIKE ? or s.portype LIKE ? or s.custcode LIKE ? or s.phasecode LIKE ? or s.phaseyear LIKE ? or s.porname LIKE ? or s.porcode LIKE ? or s.wbsl2 LIKE ? or s.qcno LIKE ? or s.projecttype LIKE ? or s.projectname LIKE ? or s.reqname LIKE ? or s.reqemail LIKE ? or s.pordate LIKE ? or s.wpname LIKE ? or s.region LIKE ? or s.wbsl3 LIKE ? or s.top LIKE ? or s.qtyso LIKE ? or s.qtyspo LIKE ? or s.aginglog LIKE ? or s.statuslog LIKE ? or s.remarkslog LIKE ? or s.updatebylog LIKE ? or s.datetimelog LIKE ? or s.agingwipro LIKE ? or s.statuswipro LIKE ? or s.remarkswipro LIKE ? or s.updatebywipro LIKE ? or s.datetimewipro LIKE ? or s.porstatus LIKE ? or s.dateupload LIKE ? or s.filename LIKE ? or s.updateby LIKE ? or s.datetime LIKE ? or s.status LIKE ?)";
    $result = $this->db->query($qry, array("%".$key5."%","%".$key1."%","%".$key2."%","%".$key3."%","%".$key4."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%","%".$sSearch."%"));

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
            if($value->id!=NULL){$id=$value->id;}else{$id='-';}
            if($value->ultype!=NULL){$ultype=$value->ultype;}else{$ultype='-';}
            if($value->portype!=NULL){$portype=$value->portype;}else{$portype='-';}
            if($value->custcode!=NULL){$custcode=$value->custcode;}else{$custcode='-';}
            if($value->phasecode!=NULL){$phasecode=$value->phasecode;}else{$phasecode='-';}
            if($value->phaseyear!=NULL){$phaseyear=$value->phaseyear;}else{$phaseyear='-';}
            if($value->porname!=NULL){$porname=$value->porname;}else{$porname='-';}
            if($value->baseid!=NULL){$baseid=$value->baseid;}else{$baseid='- - -';}
            if($value->porcode!=NULL){$porcode=$value->porcode;}else{$porcode='-';}
            if($value->wbsl2!=NULL){$wbsl2=$value->wbsl2;}else{$wbsl2='-';}
            if($value->qcno!=NULL){$qcno=$value->qcno;}else{$qcno='-';}
            if($value->projecttype!=NULL){$projecttype=$value->projecttype;}else{$projecttype='-';}
            if($value->projectname!=NULL){$projectname=$value->projectname;}else{$projectname='-';}
            if($value->reqname!=NULL){$reqname=$value->reqname;}else{$reqname='-';}
            if($value->reqemail!=NULL){$reqemail=$value->reqemail;}else{$reqemail='-';}
            if($value->pordate!=NULL){$pordate=$value->pordate;}else{$pordate='-';}
            if($value->wpname!=NULL){$wpname=$value->wpname;}else{$wpname='-';}
            if($value->region!=NULL){$region=$value->region;}else{$region='-';}
            if($value->wbsl3!=NULL){$wbsl3=$value->wbsl3;}else{$wbsl3='-';}
            if($value->top!=NULL){$top=$value->top;}else{$top='-';}
            if($value->qtyso!=NULL){$qtyso=$value->qtyso;}else{$qtyso='-';}
            if($value->qtyspo!=NULL){$qtyspo=$value->qtyspo;}else{$qtyspo='-';}
            if($value->aginglog!=NULL){$aginglog=$value->aginglog;}else{$aginglog='-';}
            if($value->statuslog!=NULL){$statuslog=$value->statuslog;}else{$statuslog='-';}
            if($value->remarkslog!=NULL){$remarkslog=$value->remarkslog;}else{$remarkslog='-';}
            if($value->updatebylog!=NULL){$updatebylog=$value->updatebylog;}else{$updatebylog='-';}
            if($value->datetimelog!=NULL){$datetimelog=$value->datetimelog;}else{$datetimelog='-';}
            if($value->agingwipro!=NULL){$agingwipro=$value->agingwipro;}else{$agingwipro='-';}
            if($value->statuswipro!=NULL){$statuswipro=$value->statuswipro;}else{$statuswipro='-';}
            if($value->remarkswipro!=NULL){$remarkswipro=$value->remarkswipro;}else{$remarkswipro='-';}
            if($value->updatebywipro!=NULL){$updatebywipro=$value->updatebywipro;}else{$updatebywipro='-';}
            if($value->datetimewipro!=NULL){$datetimewipro=$value->datetimewipro;}else{$datetimewipro='-';}
            if($value->porstatus!=NULL){$porstatus=$value->porstatus;}else{$porstatus='-';}
            if($value->dateupload!=NULL){$dateupload=$value->dateupload;}else{$dateupload='-';}
            if($value->filename!=NULL){$filename=$value->filename;}else{$filename='-';}
            if($value->updateby!=NULL){$updateby=$value->updateby;}else{$updateby='-';}
            if($value->datetime!=NULL){$datetime=$value->datetime;}else{$datetime='-';}
            if($value->status!=NULL){$status=$value->status;}else{$status='-';}
            if($value->id_user_assign!='0'){$id_user_assign=$value->id_user_assign;}else{$id_user_assign='-';}
            if($value->history_assign!=NULL){$history_assign=$value->history_assign;}else{$history_assign='-';}

            $index = NULL;
            for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
              if("Sor Por Tracker" == $this->session->userdata('nama_menu')[$i]){
                $index = $i;
                break;
              }
            }
            if(strpos($this->session->userdata('hak_akses')[$index],"Delete") !== FALSE){
                if($value->status == 1){
                    $tombolHapus = '<button class="btn btn-danger btn-xs delete-data"style="height:20px;" status="'.$value->status.'" rel="'.$value->id.'" data-name="'.$value->projectname.'"><i class="fa fa-trash"></i></button>';
                }else{
                    $tombolHapus = '<button class="btn btn-success btn-xs delete-data"style="height:20px;" status="'.$value->status.'" rel="'.$value->id.'" data-name="'.$value->projectname.'"><i class="fa fa-trash"></i></button>';
                }
                $tombolChangeDatetime = '<button class="btn btn-warning btn-xs edit-datetime" data-id="'.$value->id.'"><i class="fa fa-pencil"></i></button>';
            }else{
              $tombolHapus = '';
              $tombolChangeDatetime = '';
            }
            if(strpos($this->session->userdata('hak_akses')[$index],"Update") !== FALSE){
              $editable = 'editable';
            }else{
              $editable = '';
            }
            $iterasi = 0;
            $now = strtotime(date('Y-m-d'));
            $date = strtotime(date('Y-m-d', strtotime($datetime)));
            $result = round(($now-$date) / 86400);
            $rec['aaData'][$k] = array(
                $iterasi => 't|id|e|'.$id.'|'.$this->encrypt_decrypt('encrypt','NOK1'.$id),
                $iterasi+=1 => 't|custcode|e|'.$custcode,
                $iterasi+=1 => 't|phaseyear|e|'.$phaseyear,
                $iterasi+=1 => 't|phasecode|e|'.$phasecode,
                $iterasi+=1 => 't|ultype|e|'.$ultype,
                $iterasi+=1 => 't|portype|e|'.$portype,
                $iterasi+=1 => 't|porname||'.$porname,
                $iterasi+=1 => 't|qtyso|e|'.$qtyso,
                $iterasi+=1 => 't|qtyspo|e|'.$qtyspo,
                $iterasi+=1 => 't|baseid|e|'.$baseid,
                $iterasi+=1 => 'su|id_user_assign|e|'.$id_user_assign,
                $iterasi+=1 => 't|||'.$result,
                $iterasi+=1 => 't|datetime||'.$datetime,
                $iterasi+=1 => 't|porcode|e|'.$porcode,
                $iterasi+=1 => 't|wbsl2|e|'.$wbsl2,
                $iterasi+=1 => 't|qcno|e|'.$qcno,
                $iterasi+=1 => 't|projecttype|e|'.$projecttype,
                $iterasi+=1 => 't|projectname|e|'.$projectname,
                $iterasi+=1 => 't|reqname|e|'.$reqname,
                $iterasi+=1 => 't|reqemail|e|'.$reqemail,
                $iterasi+=1 => 'd|pordate|e|'.$pordate,
                $iterasi+=1 => 't|wpname|e|'.$wpname,
                $iterasi+=1 => 't|region|e|'.$region,
                $iterasi+=1 => 't|wbsl3|e|'.$wbsl3,
                $iterasi+=1 => 't|top|e|'.$top,
                $iterasi+=1 => 't|aginglog|e|'.$aginglog,
                $iterasi+=1 => 's|statuslog|e|'.$statuslog,
                $iterasi+=1 => 't|remarkslog|e|'.$remarkslog,
                $iterasi+=1 => 't|updatebylog||'.$updatebylog,
                $iterasi+=1 => 't|datetimelog||'.$datetimelog,
                $iterasi+=1 => 't|agingwipro|e|'.$agingwipro,
                $iterasi+=1 => 's|statuswipro|e|'.$statuswipro,
                $iterasi+=1 => 't|remarkswipro|e|'.$remarkswipro,
                $iterasi+=1 => 't|updatebywipro||'.$updatebywipro,
                $iterasi+=1 => 't|datetimewipro||'.$datetimewipro,
                $iterasi+=1 => 's|porstatus|e|'.$porstatus,
                $iterasi+=1 => 't|dateupload||'.$dateupload,
                $iterasi+=1 => 't|filename||'.$filename,
                $iterasi+=1 => 't|updateby||'.$updateby,
                $iterasi+=1 => 't|status||'.$status.$tombolHapus." ".$tombolChangeDatetime,
                $iterasi+=1 => 't|history_assign||'.$history_assign
            );
            $k++;
            $start++;
        }

    }

    echo json_encode($rec);
  }

  function delete_data(){
    $id = $this->input->post('id');
    if($this->input->post('status') == 0){
        $status = 1;
    }else{
        $status = 0;
    }
    $res = $this
                ->MSorpor
                ->delete_data($id,$status);

    if ($res !== false){
        echo 1;
    }else{ 
        echo $res;
    }
  }

  function update_data(){
    $id      = $_REQUEST['id'];
    $newValue   = $_REQUEST['newValue'];
    $colName    = $_REQUEST['colName'];

    if($id != '' && $colName != '')
    {   
        if($newValue == ""){
            $data = array(
                $colName => NULL,
                'updateby' => $this->session->userdata('nama_user'),
                'datetime' => date("Y-m-d H:i:s")
            );
        }else{
            if ($colName == "id_user_assign") {
                $data = array(
                    $colName => $newValue
                );
            }else{
                $data = array(
                    $colName => $newValue,
                    'updateby' => $this->session->userdata('nama_user'),
                    'datetime' => date("Y-m-d H:i:s")
                );   
            }
            if($colName == 'statuslog' || $colName == 'remarkslog'){
                $waktu = date("Y-m-d H:i:s");
                $data = array(
                    $colName => $newValue,
                    'updateby' => $this->session->userdata('nama_user'),
                    'datetime' => $waktu,
                    'updatebylog' => $this->session->userdata('nama_user'),
                    'datetimelog' => $waktu
                );
            }else if($colName == 'statuswipro' || $colName == 'remarkswipro'){
                $waktu = date("Y-m-d H:i:s");
                $data = array(
                    $colName => $newValue,
                    'updateby' => $this->session->userdata('nama_user'),
                    'datetime' => $waktu,
                    'updatebywipro' => $this->session->userdata('nama_user'),
                    'datetimewipro' => $waktu
                );
            }
        }
        $this->db->where('id',$id);
        if($this->db->update('sor_por_tracker', $data))
        {   
            echo 'Updated successfully';
        }
        else
        {
            echo 'Erro in Updation';
        }
    }
  }

  public function import(){
    if($this->input->post('method') == "New data"){
        $this->importNew();
    }else{
        $this->importUpdate();
    }
  }

  public function importNew(){
    ini_set('max_execution_time', 0);
    $fileName = time().$_FILES['userfile']['name'];
    $config['upload_path'] = './assets/file/'; //buat folder dengan nama assets di root folder
    $config['file_name'] = $fileName;
    $config['allowed_types'] = 'xls|xlsx|csv';
    $config['max_size'] = 5000;
    
    $this->load->library('upload',$config);

    if(! $this->upload->do_upload('userfile') ){
        $this->session->set_flashdata('gagal',true);
        $this->session->set_flashdata('pesanGagal','<h4><i class="fa fa-times"></i> Failed!</h4><p>'.$this->upload->display_errors().'</p>');
        redirect('Sorpor','refresh');
    }
    $media = $this->upload->data();
    $inputFileName = './assets/file/'.$media['file_name'];
    try {
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
    } catch (Exception $e) {
        $this->session->set_flashdata('gagal',true);
        $this->session->set_flashdata('pesanGagal','<h4><i class="fa fa-times"></i> Failed!</h4><p>'.$e.'</p>');
        redirect('Sorpor','refresh');
    }
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    $dataQC = $this->MSorpor->getDataQCByNumber($objPHPExcel->getActiveSheet()->getCell('D6')->getValue());
    if($dataQC->num_rows() == NULL){
        $this->session->set_flashdata('gagal',true);
        $this->session->set_flashdata('pesanGagal','<h4><i class="fa fa-times"></i> Failed!</h4><p>QC not availabe.</p>');
        redirect('Sorpor','refresh');
    }

    foreach ($dataQC->result() as $value) {
        $custcode = $value->custcode;
        $phasecode = $value->phasecode;
        $phaseyear = $value->phaseyear;
    }

    $date = $this->dateSerialToDateTime($objPHPExcel->getActiveSheet()->getCell('D11')->getValue());
    $date = date('Y', $date)."-".date('m', $date)."-".date('d', $date);
    if ($this->input->post('uptype') == "COR") {
        $porname = "COR".date('ymd')."_".$objPHPExcel->getActiveSheet()->getCell('D3')->getValue();
    }else{
        $porname = $objPHPExcel->getActiveSheet()->getCell('D3')->getValue();
    }
    $data = array(
        'ultype' => $this->input->post('uptype'),
        'portype' => $this->input->post('portype'),
        'custcode' => $custcode,
        'phasecode' => $phasecode,
        'phaseyear' => $phaseyear,
        'porname' => $porname,
        'porcode' => $objPHPExcel->getActiveSheet()->getCell('D4')->getValue(),
        'wbsl2' => $objPHPExcel->getActiveSheet()->getCell('D5')->getValue(),
        'qcno' => $objPHPExcel->getActiveSheet()->getCell('D6')->getValue(),
        'projecttype' => $objPHPExcel->getActiveSheet()->getCell('D7')->getValue(),
        'projectname' => $objPHPExcel->getActiveSheet()->getCell('D8')->getValue(),
        'reqname' => $objPHPExcel->getActiveSheet()->getCell('D9')->getValue(),
        'reqemail' => $objPHPExcel->getActiveSheet()->getCell('D10')->getValue(),
        'pordate' => $date,
        'wpname' => $objPHPExcel->getActiveSheet()->getCell('D12')->getValue(),
        'region' => $objPHPExcel->getActiveSheet()->getCell('D13')->getValue(),
        'wbsl3' => $objPHPExcel->getActiveSheet()->getCell('D14')->getValue(),
        'top' => $objPHPExcel->getActiveSheet()->getCell('D15')->getValue(),
        'statuslog' => 'OPEN',
        'updatebylog' => $this->session->userdata('nama_user'),
        'datetimelog' => date("Y-m-d H:i:s"),
        'statuswipro' => 'OPEN',
        'updatebywipro' => $this->session->userdata('nama_user'),
        'datetimewipro' => date("Y-m-d H:i:s"),
        'porstatus' => 'OPEN',
        'dateupload' => date("Y-m-d H:i:s"),
        'filename' => $_FILES['userfile']['name'],
        'updateby' => $this->session->userdata('nama_user'),
        'datetime' => date("Y-m-d H:i:s"),
        'status' => 1,
        'id_user_assign' => $this->session->userdata('nama_user')
    );
    
    $insert = $this->db->insert("sor_por_tracker",$data);
    $new_fid = $this->db->insert_id();
    
    $row = 21;
    $data = array();
    $qtyso = 0;
    while ($objPHPExcel->getActiveSheet()->getCell('A'.$row)->getValue() != "" || $objPHPExcel->getActiveSheet()->getCell('B'.$row)->getValue() != ""){ //  Read a row of data into an array                 
        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                        '',
                                        TRUE,
                                        FALSE);

        if($rowData[0][0] != ""){
            $qtyso += 1;
            $no1 = $rowData[0][0];
            $siteid = $rowData[0][1];
            $sitename = $rowData[0][2];
            $region = $rowData[0][3];
            $worktype = $rowData[0][4];
            $city = $rowData[0][5];
            $pocust = $rowData[0][6];
            $projectid = $rowData[0][7];
            $farend = $rowData[0][8];
            $remarkspor = $rowData[0][9];
            $level1 = 'Site';
            $total = $rowData[0][17] / substr($objPHPExcel->getActiveSheet()->getCell('D6')->getValue(), 0, 4);
        }else{
            $level1 = $rowData[0][3];
            $total = ($rowData[0][6] * $rowData[0][13]) / substr($objPHPExcel->getActiveSheet()->getCell('D6')->getValue(), 0, 4);
        }
        $voaa = $rowData[0][13] / substr($objPHPExcel->getActiveSheet()->getCell('D6')->getValue(), 0, 4);
        $sovalue = $rowData[0][8] / substr($objPHPExcel->getActiveSheet()->getCell('D6')->getValue(), 0, 4);
        //Sesuaikan sama nama kolom tabel di database        
        if($rowData[0][12] == ''){$voaline = '';}else{$voaline = $rowData[0][12];}                        
        if($rowData[0][15] == ''){$stl = '';}else{$stl = $rowData[0][15];}                        
         $newData = array(
            'porname' => $porname,
            'porstatus' => 'OPEN',
            'reqname' => $objPHPExcel->getActiveSheet()->getCell('D9')->getValue(),
            'pordate' => $date,
            'level1' => $level1,
            'no1' => $no1,
            'siteid' => $siteid,
            'sitename' => $sitename,
            'region' => $region,
            'worktype' => $worktype,
            'city' => $city,
            'pocust' => $pocust,
            'projectid' => $projectid,
            'farend' => $farend,
            'remarkspor' => $remarkspor,
            'no2' => $rowData[0][0],
            'qcline' => $rowData[0][1],
            'scccode' => $rowData[0][2],
            'level2' => $rowData[0][3],
            'matcode' => $rowData[0][4],
            'sccdesc' => $rowData[0][5],
            'soqty' => $rowData[0][6],
            'uom' => $rowData[0][7],
            'sovalue' => $sovalue,
            'vendor' => $rowData[0][9],
            'loino' => $rowData[0][10],
            'voano' => $rowData[0][11],
            'voaline' => $voaline,
            'voaa' => $voaa,
            'curr' => $rowData[0][14],
            'stl' => $stl,
            'disc' => $rowData[0][16],
            'total' => $total,//$rowData[0][17],
            'podummy' => $rowData[0][18],
            'spo' => $rowData[0][19],
            'poremarks' => $rowData[0][20],
            'porname_ori' => $rowData[0][21],
            'sorporid' => $new_fid,
            'statussorpor' => 1,
            'updateby' => $this->session->userdata('nama_user'),
            'datetime' => date("Y-m-d H:i:s"),
            'status' => 1
        );
        array_push($data, $newData);
        $row++;
    }
    $insert = $this->db->insert_batch("sor_por_database",$data);

    //update qtyso dihitung dari counting
    $this->db->set('qtyso',$qtyso);
    $this->db->where('id',$new_fid);
    $this->db->update('sor_por_tracker');

    unlink("./assets/file/".$media['file_name']);
    $this->session->set_flashdata('sukses',true);
    $this->session->set_flashdata('pesanSukses','<h4><i class="fa fa-check"></i> Success!</h4><p>Import new data success!</p>');
    redirect('Sorpor','refresh');
  }


  function dateSerialToDateTime($date) {
      return ((($date > 25568) ? $date : 25569) * 86400) - ((70 * 365 + 19) * 86400);
  }


  public function importUpdate(){
    ini_set('max_execution_time', 0);
    $fileName = time().$_FILES['userfile']['name'];
    $config['upload_path'] = './assets/file/'; //buat folder dengan nama assets di root folder
    $config['file_name'] = $fileName;
    $config['allowed_types'] = 'xls|xlsx|csv';
    $config['max_size'] = 2500;
    
    $this->load->library('upload',$config);

    if(! $this->upload->do_upload('userfile') ){
        $this->session->set_flashdata('gagal',true);
        $this->session->set_flashdata('pesanGagal','<h4><i class="fa fa-times"></i> Failed!</h4><p>'.$this->upload->display_errors().'</p>');
        redirect('Sorpor','refresh');
    }
    $media = $this->upload->data();
    $inputFileName = './assets/file/'.$media['file_name'];
    try {
        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
    } catch (Exception $e) {
        unlink("./assets/file/".$media['file_name']);
        $this->session->set_flashdata('gagal',true);
        $this->session->set_flashdata('pesanGagal','<h4><i class="fa fa-times"></i> Failed!</h4><p>'.$e.'</p>');
        redirect('Sorpor','refresh');
    }
    $sheet = $objPHPExcel->getSheet(0);
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    // start check column id
    if($objPHPExcel->getActiveSheet()->getCell('A1')->getValue() != "ID"){
        unlink("./assets/file/".$media['file_name']);
        $this->session->set_flashdata('gagal',true);
        $this->session->set_flashdata('pesanGagal','<h4><i class="fa fa-times"></i> Failed!</h4><p>Import update data Failed!</p><p>Template import update data incorrect!</p>');
        redirect('Sorpor','refresh');
    }
    // end check column id

    $row = 3;
    $temp = array();
    $data = array();
    
    while($row <= $highestRow){
        // start add error id not found
        if($this->MSorpor->getSorporDbById($objPHPExcel->getActiveSheet()->getCell('A'.$row)->getValue())->num_rows() == 0){
            array_push($temp, $row);
        }
        // end add error id not found
        // start add data to array data
        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                            '',
                                            TRUE,
                                            FALSE);
        $newData = array(
            "id" => $rowData[0][0],
            "vendor" => $rowData[0][14],
            "loino" => $rowData[0][15],
            "voano" => $rowData[0][16],
            "voaline" => $rowData[0][17],
            "voaa" => $rowData[0][18] / substr($rowData[0][4], 0,4),
            "total" => ($rowData[0][11] * ($rowData[0][18] / substr($rowData[0][4], 0,4))),
            "curr" => $rowData[0][19],
            "stl" => $rowData[0][20],
            "spo" => $rowData[0][24],
            "podummy" => $rowData[0][23],
            "poremarks" => $rowData[0][25],
            "updateby" => $this->session->userdata('nama_user'),
            "datetime" => date("Y-m-d H:i:s")
        );
        array_push($data, $newData);
        $row++;
    }
    if(!empty($temp)){
        $baris = "Error : <br>ID not found in line ";
        for($i=0; $i<sizeof($temp);$i++){
            if($i!=0){
              $baris .= ", ".$temp[$i];
            }else{
              $baris .= $temp[$i];
            }
        }
        unlink("./assets/file/".$media['file_name']);
        $this->session->set_flashdata('gagal',true);
        $this->session->set_flashdata('pesanGagal','<h4><i class="fa fa-times"></i> Failed!</h4><p>Import update data Failed!</p><p>'.$baris.'</p>');
        redirect('Sorpor','refresh');
    
    }else{
        $insert = $this->db->update_batch("sor_por_database",$data,"id");
        unlink("./assets/file/".$media['file_name']);
        $this->session->set_flashdata('sukses',true);
        $this->session->set_flashdata('pesanSukses','<h4><i class="fa fa-check"></i> Success!</h4><p>Import update data success!</p>');
        redirect('Sorpor','refresh');
    }
  }

  function export(){
    ini_set('max_execution_time', 0);
    $inputFileType = PHPExcel_IOFactory::identify(FCPATH."/assets/dist/templateExport/ExportSorpor.xlsx");
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $this->excel = PHPExcel_IOFactory::load(FCPATH."/assets/dist/templateExport/ExportSorpor.xlsx");
    $this->excel->setActiveSheetIndex(0);
    $row = 2;
    $porname = "";
    foreach ($this->MSorpor->getDataByFilter($this->input->post('reqname'),$this->input->post('id_user_assign'),$this->input->post('assignStatus'),$this->input->post('ultype'),$this->input->post('status'))->result() as $frow){

        $this->excel->getActiveSheet()->getStyle("A".$row.":AC".$row)->applyFromArray(
            array(
              'borders' => array(
                  'allborders' => array(
                      'style' => PHPExcel_Style_Border::BORDER_THIN
                  )
              )
          )
        );
        $this->excel->getActiveSheet()->getStyle("A".$row.":AC".$row)->getFont()->setSize(9);

        $this->excel->getActiveSheet()->SetCellValue('A'.$row,$frow->id);
        $this->excel->getActiveSheet()->SetCellValue('B'.$row,$frow->custcode);
        $this->excel->getActiveSheet()->SetCellValue('C'.$row,$frow->phaseyear);
        $this->excel->getActiveSheet()->SetCellValue('D'.$row,$frow->phasecode);
        $this->excel->getActiveSheet()->SetCellValue('E'.$row,$frow->ultype);
        $this->excel->getActiveSheet()->SetCellValue('F'.$row,$frow->portype);
        $this->excel->getActiveSheet()->SetCellValue('G'.$row,$frow->porname);
        $this->excel->getActiveSheet()->SetCellValue('H'.$row,$frow->id_user_assign);
        $this->excel->getActiveSheet()->SetCellValue('I'.$row,$frow->qtyso);
        $this->excel->getActiveSheet()->SetCellValue('J'.$row,$frow->qtyspo);
        $this->excel->getActiveSheet()->SetCellValue('K'.$row,$frow->baseid);
        $this->excel->getActiveSheet()->SetCellValue('L'.$row,$frow->porcode);
        $this->excel->getActiveSheet()->SetCellValue('M'.$row,$frow->wbsl2);
        $this->excel->getActiveSheet()->SetCellValue('N'.$row,$frow->qcno);
        $this->excel->getActiveSheet()->SetCellValue('O'.$row,$frow->projecttype);
        $this->excel->getActiveSheet()->SetCellValue('P'.$row,$frow->projectname);
        $this->excel->getActiveSheet()->SetCellValue('Q'.$row,$frow->reqname);
        $this->excel->getActiveSheet()->SetCellValue('R'.$row,$frow->reqemail);
        $this->excel->getActiveSheet()->SetCellValue('S'.$row,$frow->pordate);
        $this->excel->getActiveSheet()->SetCellValue('T'.$row,$frow->wpname);
        $this->excel->getActiveSheet()->SetCellValue('U'.$row,$frow->region);
        $this->excel->getActiveSheet()->SetCellValue('V'.$row,$frow->wbsl3);
        $this->excel->getActiveSheet()->SetCellValue('W'.$row,$frow->top);
        $this->excel->getActiveSheet()->SetCellValue('X'.$row,$frow->dateupload);
        $this->excel->getActiveSheet()->SetCellValue('Y'.$row,$frow->filename);
        $this->excel->getActiveSheet()->SetCellValue('Z'.$row,$frow->updateby);
        $this->excel->getActiveSheet()->SetCellValue('AA'.$row,$frow->datetime);
        $this->excel->getActiveSheet()->SetCellValue('AB'.$row,$frow->status);
        $this->excel->getActiveSheet()->SetCellValue('AC'.$row,$frow->history_assign);

        $row++;  
    }

    $this->excel->getProperties()
                  ->setCreator("NOKIA") //creator
                    ->setTitle("Sor Por Tracker");
    $filename = "Export_Sor Por Tracker_".date("ymd").".xlsx";
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache

    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel2007');                
    //$objWriter->save(FCPATH."assets/dist/img/excel/$filename");
    $objWriter->save('php://output');
  }

  private function encrypt_decrypt($action, $string) {
      $output = false;
      $encrypt_method = "AES-256-CBC";
      $secret_key = 'This is my secret key';
      $secret_iv = 'This is my secret iv';
      // hash
      $key = hash('sha256', $secret_key);
      
      // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
      $iv = substr(hash('sha256', $secret_iv), 0, 16);
      if ( $action == 'encrypt' ) {
          $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
          $output = base64_encode($output);
      } else if( $action == 'decrypt' ) {
          $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
      }
      return $output;
  }



  public function getDataUserSelection(){
    $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");
    $oldvalue1 = str_replace($entities, $replacements, $this->uri->segment(3));
    foreach ($this->MSorpor->getDataUser()->result() as $key) {
        if($oldvalue1 == $key->nama_user){
            echo "<option value='".$key->nama_user."' selected>".$key->nama_user."</option>";
        }else{
            echo "<option value='".$key->nama_user."'>".$key->nama_user."</option>";
        }
    }
  }

  public function modalEditDatetime(){
    foreach ($this->MSorpor->getDateTimeById($_POST['id'])->result() as $key) {
      $datetime = $key->waktu;
      $porname = $key->porname;
    }
    echo "<div class='modal-header'>
            <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span></button>
            <h4 class='modal-title'>Edit Datetime<br>".$porname."</h4>
        </div>
        <div class='modal-body'>
          <form action='".base_url()."Sorpor/editDatetime' method='POST' enctype='multipart/form-data'>
          <input type='hidden' name='id' id='id' value='".$_POST['id']."'>
              <div class='form-group'>
                <label >Datetime</label>
                <p>
                  <input type='date' class='form-control input-sm' name='datetime' id='datetime' value='".$datetime."' required>
                </p>
              </div>
              
              <button type='' class='btn btn-sm' data-dismiss='modal'>Close</button>
              <button type='button' class='btn btn-success btn-sm change-datetime'>Save</button>
            </div>
          </form>
        </div>
        ";
  }

  public function submitEditDatetime(){
    $data = array(
        "datetime" => $this->input->post('datetime'),
        "dateupload" => $this->input->post('datetime')
    );
    $this->db->where('id', $this->input->post('id'));
    $this->db->update('sor_por_tracker', $data);
    echo 1;
  }

}