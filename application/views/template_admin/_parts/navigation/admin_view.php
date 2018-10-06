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
        <li class="<?php if($current_page == 'Peserta'){ echo 'active'; }?>">
          <a href="<?php echo base_url('Peserta');?>" >
            <i class="fa fa-dashboard"></i> <span>Peserta</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar ASIDE -->
  </aside>