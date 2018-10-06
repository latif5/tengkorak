  <header class="main-header">
    <!-- Logo -->
    <a href="<?=base_url();?>Dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>N</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><img src="<?=base_url();?>assets/dist/img/nokia_logo_white.png" style="width:50%; height: 100%;"></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li >
              <a href="<?=base_url()?>Auth/logout"><span class="hidden-xs"><?php echo $this->session->userdata("nama_lengkap"); ?></span><i style="margin-left: 40px;" class="fa fa-sign-out"></i> Logout</a>
          </li>
          <?php if($this->session->userdata('nama_group') == "Admin"){ ?>
          <li class="dropdown user user-menu">
            <?php if($this->session->userdata('maintenance')){ ?>
            <a href="<?=base_url();?>Auth/setMaintenance/0"><button class="btn btn-success btn-xs" style="margin-top: -5px;">On</button></a>
            <?php }else{ ?>
            <a href="<?=base_url();?>Auth/setMaintenance/1"><button class="btn btn-danger btn-xs" style="margin-top: -5px;">Off</button></a>
            <?php } ?>
            <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">Maintenance</span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header" style=" height: 50px;">
                <p style="margin-top: 0px;">
                  <?php if($this->session->userdata('maintenance')){ ?>
                  <a href="<?=base_url();?>Auth/setMaintenance/0"><button class="btn btn-success btn-xs">On</button></a>
                  <?php }else{ ?>
                  <a href="<?=base_url();?>Auth/setMaintenance/1"><button class="btn btn-danger btn-xs">Off</button></a>
                  <?php } ?>
                </p>
              </li>
            </ul> -->
          </li>
          <?php } ?>
        </ul>
      </div>
    </nav>
  </header>

  <!--Sidebar ASIDE-->
  <aside class="main-sidebar">
    <section class="sidebar inner-container" style="height: 610px; overflow-y: scroll;"> <!-- overflow-y: scroll ; .inner-container::-webkit-scrollbar {
     display: none;
    } di head_view -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" style="overflow-y: hidden;">

          <li style="background-color: #124191;" align="center">
            <img src="<?=base_url();?>assets/dist/img/portracking.png" style="width:65%; height: 100%; margin-top: 6%; margin-bottom: 6%;">
          </li>
        <?php
          for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
            if("Dashboard" == $this->session->userdata('nama_menu')[$i]){
        ?>
            <li class="<?php if($current_page == 'Dashboard'){ echo 'active'; }?>">
              <a href="<?php echo base_url('Dashboard');?>" >
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
        <?php
            break;
            }
          }
        ?>
        
        <?php
          for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
            if("Log User" == $this->session->userdata('nama_menu')[$i] || "Data User" == $this->session->userdata('nama_menu')[$i] || "Group User" == $this->session->userdata('nama_menu')[$i] || "Cron Job" == $this->session->userdata('nama_menu')[$i]){
        ?>
          <li class="<?php if($page_title == 'Log User | NOKIA' || $page_title == 'Data User | NOKIA' || $page_title == 'Group User | NOKIA' || $page_title == 'Cron Job | NOKIA'){ echo 'active'; }?>">
            <a href="#"><i class="fa fa-users"></i> <span>User</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Log User" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Log User | NOKIA'){ echo 'active'; }?>">
                  <a href="<?php echo base_url('LogUser');?>" >
                    <i class="fa fa-circle-o"></i><span>Log User</span>
                  </a>
                </li>
              <?php
                    break;
                  }
                }
              ?>
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Data User" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Data User | NOKIA') { echo 'active'; } ?>"><a href="<?php echo base_url('DataUser');?>"><i class="fa fa-circle-o"></i>Data user</a></li>
              <?php 
                  break;
                  }
                }
              ?>
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Group User" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'Group User | NOKIA') { echo 'active'; } ?>"><a href="<?php echo base_url('GroupData');?>"><i class="fa fa-circle-o"></i>Group User</a></li>
              <?php 
                  break;
                  }
                }
              ?>
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Cron Job" == $this->session->userdata('nama_menu')[$i]){
              ?>
              <li class="<?php if($page_title == 'Cron Job | NOKIA') { echo 'active'; } ?>"><a href="<?php echo base_url('Cronjob');?>"><i class="fa fa-circle-o"></i>Cron Job</a></li>
              <?php 
                  break;
                  }
                }
              ?>
            </ul>
          </li>
        <?php
              break;
            }
          }
        ?>
        <?php
          for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
            if("Master Received" == $this->session->userdata('nama_menu')[$i] || "Master Phase" == $this->session->userdata('nama_menu')[$i] || "Upload received" == $this->session->userdata('nama_menu')[$i]){
        ?>
          <li class="<?php if($page_title == 'Master Received | NOKIA' || $page_title == 'Master Phase | NOKIA' || $page_title == 'Upload Received | NOKIA'){ echo 'active'; }?>">
            <a href="#"><i class="fa fa-database"></i> <span>Master</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Master Phase" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Master Phase | NOKIA') { echo 'active'; } ?>"><a href="<?php echo base_url('MasterPhase');?>"><i class="fa fa-circle-o"></i>Phase</a></li>
              <?php 
                  break;
                  }
                }
              ?>
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Upload received" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Upload Received | NOKIA') { echo 'active'; } ?>"><a href="<?php echo base_url('UploadReceived');?>"><i class="fa fa-circle-o"></i>Upload received</a></li>
              <?php 
                  break;
                  }
                }
              ?>
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Master Received" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Master Received | NOKIA') { echo 'active'; } ?>"><a href="<?php echo base_url('MasterReceived');?>"><i class="fa fa-circle-o"></i>Received</a></li>
              <?php 
                  break;
                  }
                }
              ?>
            </ul>
          </li>
        <?php
              break;
            }
          }
        ?>
        <?php
          for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
            if("Data QC" == $this->session->userdata('nama_menu')[$i] || "Upload QC" == $this->session->userdata('nama_menu')[$i]|| "Sor Por Tracker" == $this->session->userdata('nama_menu')[$i]|| "Sor Por Dashboard" == $this->session->userdata('nama_menu')[$i]|| "Sor Por Database" == $this->session->userdata('nama_menu')[$i]|| "Sor Por Update" == $this->session->userdata('nama_menu')[$i]){
        ?>
          <li class="<?php if($page_title == 'Data QC | NOKIA' || $page_title == 'Upload QC | NOKIA' || $page_title == 'Sor Por Tracker | NOKIA' || $page_title == 'Sor Por Dashboard | NOKIA' || $page_title == 'Sor Por Database | NOKIA' || $page_title == 'Sor Por Update | NOKIA'){ echo 'active'; }?>">
            <a href="#"><i class="fa fa-database"></i> <span>Data</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
              <?php
                for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
                  if("Upload QC" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Upload QC | NOKIA') { echo 'active'; } ?>"><a href="<?php echo base_url('UploadQC');?>"><i class="fa fa-circle-o"></i>QC Tracker</a></li>
              <?php 
                  }else if("Data QC" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Data QC | NOKIA') { echo 'active'; } ?>"><a href="<?php echo base_url('DataQC');?>"><i class="fa fa-circle-o"></i>QC Database</a></li>
              <?php 
                  }else if("Sor Por Tracker" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Sor Por Tracker | NOKIA') { echo 'active'; } ?>"><a href="<?php echo base_url('Sorpor');?>"><i class="fa fa-circle-o"></i>Sor Por Tracker</a></li>
              <?php
                  }else if("Sor Por Dashboard" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Sor Por Dashboard | NOKIA') { echo 'active'; } ?>"><a href="<?php echo base_url('SorporDashboard');?>"><i class="fa fa-circle-o"></i>Sor Por Dashboard</a></li>
              <?php
                  }else if("Sor Por Database" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Sor Por Database | NOKIA') { echo 'active'; } ?>"><a href="<?php echo base_url('Sorpordb');?>"><i class="fa fa-circle-o"></i>Sor Por Database</a></li>
              <?php
                  }else if("Sor Por Update" == $this->session->userdata('nama_menu')[$i]){
              ?>
                <li class="<?php if($page_title == 'Sor Por Update | NOKIA') { echo 'active'; } ?>"><a href="<?php echo base_url('SorporUpdate');?>"><i class="fa fa-circle-o"></i>Sor Por Update</a></li>
              <?php
                  }
                }
              ?>
            </ul>
          </li>
        <?php
              break;
            }
          }
        ?>
        
      </ul>
    </section>
    <!-- /.sidebar ASIDE -->
  </aside>
