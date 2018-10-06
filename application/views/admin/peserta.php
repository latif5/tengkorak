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
      <p style="font-size: 24px; font-weight: 100; color:#134292; margin-left: 1%; margin-top: -0.3%;">Daftar Peserta</p>
      <div class="col-md-12">
        <table class="table table-bordered table-hover data-peserta" id="data-peserta" style="white-space: nowrap;">
          <thead>
          <tr>
            <th><div><b>No</b></div></th>
            <th><div><b>Nama</b></div></th>
            <th><div><b>Deskripsi</b></div></th>
            <th><div><b>Waktu Hadir</b></div></th>
            <th><div><b>Status</b></div></th>
          </tr>
          </thead>
        </table>
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