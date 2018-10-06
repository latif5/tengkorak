<div class="content-wrapper" style="background-color: white;">
  
  <!-- Main content -->
  <section class="content">
    <?php if($this->session->flashdata('sukses')){ ?>
      <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $this->session->flashdata('pesanSukses'); ?>
      </div>
    <?php }elseif ($this->session->flashdata('gagal')) {?>
      <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo $this->session->flashdata('pesanGagal'); ?>
      </div>
    <?php } ?>
    <!-- Default box -->
    <div class="row">
      <p style="font-size: 24px; font-weight: 100; color:#134292; margin-left: 1%; margin-top: -0.3%;">Sor Por Tracker</p>
      <div class="col-md-12">
        <form action="" method="POST">
        Requester Name <input type="" style="height: 19px; width: 80px;" name="reqname" id="reqname" value="<?php if(isset($_POST['reqname'])){ echo $_POST['reqname'];} ?>">
        Assign to <input type="" style="height: 19px; width: 80px;" name="id_user_assign" id="id_user_assign" value="<?php if(isset($_POST['id_user_assign'])){ echo $_POST['id_user_assign'];} ?>">
        Assign Status <select style="height: 19px; width: 80px;" name="assignStatus" id="assignStatus">
            <option value="">All</option>
            <option value="unfinish" <?php if(isset($_POST['assignStatus'])){if($_POST['assignStatus'] == 'unfinish'){echo "selected";}}else{ echo "selected";} ?>>Unfinish</option>
            <option value="finish" <?php if(isset($_POST['assignStatus'])){if($_POST['assignStatus'] == 'finish'){echo "selected";}} ?>>Finish</option>
          </select>
        UL Type <select style="height: 19px; width: 80px;" name="ultype">
            <option value="">All</option>
            <option value="POR" <?php if(isset($_POST['ultype'])){if($_POST['ultype'] == "POR"){echo "selected";}} ?>>POR</option>
            <option value="COR" <?php if(isset($_POST['ultype'])){if($_POST['ultype'] == "COR"){echo "selected";}} ?>>COR</option>
            <option value="SOR" <?php if(isset($_POST['ultype'])){if($_POST['ultype'] == "SOR"){echo "selected";}} ?>>SOR</option>
          </select>
        Status <select style="height: 19px; width: 80px;" name="status" id="status">
            <option value="">All</option>
            <option value="1" <?php if(isset($_POST['status'])){if($_POST['status'] == '1'){echo "selected";}}else{ echo "selected";} ?>>Active</option>
            <option value="0" <?php if(isset($_POST['status'])){if($_POST['status'] == '0'){echo "selected";}} ?>>Inactive</option>
          </select>
        <button class="btn btn-primary btn-xs" style="height: 19px; margin-top: -3px;"><i class="fa fa-search"></i> Search</button></form><p style="margin-top: -5px;"></p>
        <table class="table table-bordered table-hover data-sorpor" id="data-sorpor" style="white-space: nowrap;">
          <thead>
          <tr>
            <th><div><b>id</b></div></th>
            <th><div><b>Cust Code</b></div></th>
            <th><div><b>Phase Year</b></div></th>
            <th><div><b>Phase Code</b></div></th>
            <th><div><b>UL Type</b></div></th>
            <th><div><b>POR Type</b></div></th>
            <th><div><b>POR Name</b></div></th>
            <th><div><b>Qty SO</b></div></th>
            <th><div><b>Qty SPO</b></div></th>
            <th><div><b>Base ID</b></div></th>
            <th><div><b>Assign to</b></div></th>
            <th><div><b>Assign Days</b></div></th>
            <th><div><b>Date Time</b></div></th>
            <th><div><b>POR Code</b></div></th>
            <th><div><b>WBS Level 2</b></div></th>
            <th><div><b>QC Number</b></div></th>
            <th><div><b>Project Type</b></div></th>
            <th><div><b>Project Name</b></div></th>
            <th><div><b>Requester Name</b></div></th>
            <th><div><b>Requester Email</b></div></th>
            <th><div><b>POR Date Req</b></div></th>
            <th><div><b>WP Name</b></div></th>
            <th><div><b>Region</b></div></th>
            <th><div><b>WBS Grouping (L3)</b></div></th>
            <th><div><b>Term Of Payment</b></div></th>
            <th><div><b>Aging LOG</b></div></th>
            <th><div><b>Status LOG</b></div></th>
            <th><div><b>Remarks LOG</b></div></th>
            <th><div><b>Update by LOG</b></div></th>
            <th><div><b>Date Time LOG</b></div></th>
            <th><div><b>Aging WIPRO</b></div></th>
            <th><div><b>Status WIPRO</b></div></th>
            <th><div><b>Remarks WIPRO</b></div></th>
            <th><div><b>Update by WIPRO</b></div></th>
            <th><div><b>Date Time WIPRO</b></div></th>
            <th><div><b>POR Status</b></div></th>
            <th><div><b>Date Upload</b></div></th>
            <th><div><b>File name</b></div></th>
            <th><div><b>Update by</b></div></th>
            <th><div><b>Status Request</b></div></th>
            <th><div><b>History Assign</b></div></th>
          </tr>
          </thead>
        </table>
        <?php
          $index = NULL;
          for($i=0; $i< count($this->session->userdata('nama_menu')); $i ++){
            if("Sor Por Tracker" == $this->session->userdata('nama_menu')[$i]){
              $index = $i;
              break;
            }
          }
          if(strpos($this->session->userdata('hak_akses')[$index],"Create") !== FALSE){
        ?>  
        <form action="<?=base_url();?>Sorpor/export" method="POST">
        <button type="button" class="btn btn-info btn-xs add-data" data-toggle="modal" data-target="#import">
          <i class="fa fa-upload"></i>&nbsp; Import
        </button>
        <?php } if(strpos($this->session->userdata('hak_akses')[$index],"Update") !== FALSE){ ?>
          
              <input type="hidden" style="height: 19px; width: 80px;" name="reqname" id="reqname" value="<?php if(isset($_POST['reqname'])){ echo $_POST['reqname'];}?>">
              <input type="hidden" style="height: 19px; width: 80px;" name="id_user_assign" id="id_user_assign" value="<?php if(isset($_POST['id_user_assign'])){ echo $_POST['id_user_assign'];} ?>">
              <input type="hidden" style="height: 19px; width: 80px;" name="assignStatus" id="assignStatus" value="<?php if(isset($_POST['assignStatus'])){ echo $_POST['assignStatus'];}else{ echo "unfinish";} ?>">
              <input type="hidden" style="height: 19px; width: 80px;" name="ultype" id="ultype" value="<?php if(isset($_POST['ultype'])){ echo $_POST['ultype'];} ?>">
              <input type="hidden" style="height: 19px; width: 80px;" name="status" id="status" value="<?php if(isset($_POST['status'])){ echo $_POST['status'];}else{ echo 1;} ?>">
              <button type="submit" class="btn btn-success btn-xs" ><i class="fa fa-download"></i>&nbsp; Export</button>
          </form>
        <?php } ?>
      </div>
    </div>

  </section>

  <!--Import New-->
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addMenuTambahan" id="import">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Import new data</h4>
        </div>
        <div class="modal-body">
        <form action="<?=base_url()?>Sorpor/import" method="POST" enctype="multipart/form-data">
          <div class='form-group'>
            <label >Method</label>
            <p>
              <select class="form-control input-sm" name="method" required>
                <option value="">- Choose method -</option>
                <option value="New data">New data</option>
                <option value="Update data">Update data</option>
              </select>
            </p>
          </div>
          <div class='form-group'>
            <label >UL Type</label>
            <p>
              <select class="form-control input-sm" name="uptype" required>
                <option value="">- Choose -</option>
                <option value="POR">POR</option>
                <option value="COR">COR</option>
                <option value="SOR">SOR</option>
              </select>
            </p>
          </div>
          <div class='form-group'>
            <label >POR Type</label>
            <p>
              <select class="form-control input-sm" name="portype" required>
                <option value="">- Choose -</option>
                <option value="SO and SPO">SO and SPO</option>
                <option value="SO Only">SO Only</option>
                <option value="SPO Only">SPO Only</option>
              </select>
            </p>
          </div>
          <div class='form-group'>
            <label >File excel</label>
            <p>
              <input type="file" class="form-control input-sm" name="userfile" accept=".xlsx, .xls, .csv" required placeholder="Remarks">
            </p>
          </div>
          <a href="<?=base_url();?>assets/dist/templateImport/TemplateImportSorporNew.xlsx">Download template import new</a><br>
          <a href="<?=base_url();?>assets/dist/templateImport/TemplateImportSorporUpdate.xlsx">Download template import Update</a>
        </div>
        <div class="modal-footer">
          <button class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-sm">Import</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit datetime -->
  <div class="modal fade" tabindex="-1" role="dialog" id="editDatetime">
    <div class="modal-dialog">
      <div class="modal-content" id="modalEditDatetime">
        
      </div>
    </div>
  </div>
</div>