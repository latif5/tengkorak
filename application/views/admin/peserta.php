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

        <button type="button" class="btn btn-info btn-xs" data-toggle="modal" data-target="#addPeserta">Tambah</button>
      </div>
    </div>

  </section>

  <!--Import New-->
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addMenuTambahan" id="addPeserta">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Tambah Peeserta</h4>
        </div>
        <div class="modal-body">
        <form action="<?=base_url()?>Peserta/add" method="POST" enctype="multipart/form-data">
          <div class='form-group'>
            <label >Nama</label>
            <p>
              <input class="form-control input-sm" type="text" name="nama" placeholder="Nama">
            </p>
          </div>
          <div class='form-group'>
            <label >Deskripsi</label>
            <p>
              <input class="form-control input-sm" type="text" name="deskripsi" placeholder="Deskripsi">
            </p>
          </div>
          <div class='form-group'>
            <label >Jumlah Undangan</label>
            <p>
              <input class="form-control input-sm" type="number" name="jumalah_undangan" placeholder="Jumlah Undangan">
            </p>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success btn-sm">Tambah</button>
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