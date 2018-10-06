<?php header('Access-Control-Allow-Origin: *'); ?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tengkorak</title>
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/dist/img/favicon/icon.png');?>"/>
    <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/dist/css/slide_show/animate.css');?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/dist/css/slide_show/newStyle.css');?>" rel="stylesheet">
  <link href="<?php echo base_url('assets/dist/css/slide_show/jquery.bxslider.css');?>" rel="stylesheet">
</head>

<body class="gray-bg" style="background-image: url(<?=base_url()?>assets/dist/img/img.jpeg);">

    <div class="loginColumns animated fadeInDown" style=";">
        <div class="row">
      <div style="background:hsl(345, 100, 0) !important;  border:1px; display:table; padding:20px;">
       
        <div class="col-md-6">
          <div class="ibox-content" style="background-color: background:hsl(345, 100, 0); border:none !important; !important; padding:0px !important;">
            
            <form class="m-t" role="form" method="post" action="<?=base_url();?>Auth/login">
              <div class="form-group">
                <input type="text" id="nama_user" name="nama_user" style="background-color: hsl(345, 100, 0) !important;" class="form-control" placeholder="Barcode" required="" autofocus="" value="">
              </div>
              <button type="submit" class="btn btn-warning" id="submit">Check</button>
            </form>
              
          </div>
        </div>
        <!-- <div class="col-md-12">
          <p class="m-t">
            <small>POIN v.2 © 2016</small>
          </p>
        </div> -->
            </div>
      
        </div>
        
    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/dist/js/jquery.bxslider.js'); ?>"></script>
  
  <script>
    $(document).ready(function(){
      $('.bxslider').bxSlider({
        auto: true,
        pager: false
      });
    });
  </script>

<?php if($this->session->flashdata('verifikasi')){ ?>

      <script type="text/javascript">
          $(window).on('load',function(){
              $('#modal_verifikasi').modal('show');
          });
      </script>
<?php } ?>

      <!-- Modal -->
      <div class="modal fade" id="modal_verifikasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title" id="myModalLabel">Sign in</h3>
            </div>
            <div class="modal-body">
              <h4>
                We sent you a code to verify your identity. This helps keep your account safe.
            </h4><br>
            <h4>
              <b>
                We texted a code to:<br>
                <p id="sendMail"></p>
              </b>
            </h4><br>
            <h4>
              <b>
                Enter the 4-digit code
              </b>
            </h4>
            <form action="<?=base_url();?>Auth/checkCode" method="POST">
              <input type="hidden" name="id" value="">
              <input type="text" id="kode_verifikasi" name="kode_verifikasi" style="color:black !important;" class="form-control" placeholder="Input captcha code. 4 characters" required maxlength="4">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
          </div>
        </div>
      </div>

<?php if($this->session->flashdata('gagal')){ ?>
      <script type="text/javascript">
          $(window).on('load',function(){
              $('#modal_gagal').modal('show');
          });
      </script>
      <!-- Modal -->
      <div class="modal fade" id="modal_gagal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content panel-danger">
            <div class="modal-header panel-heading">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title" id="myModalLabel">Login failed</h3>
            </div>
            <div class="modal-body panel-heading">
              <h4 id="mssg">
                
                <?php echo $this->session->flashdata('message'); ?>
            </h4>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

<?php } ?>
<?php if($this->session->flashdata('verifikasi_gagal')){ ?>
      <script type="text/javascript">
          $(window).on('load',function(){
              $('#modal_gagal_verifikasi').modal('show');
          });
      </script>
      <!-- Modal -->
      <div class="modal fade" id="modal_gagal_verifikasi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content panel-danger">
            <div class="modal-header panel-heading">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title" id="myModalLabel">Login failed</h3>
            </div>
            <div class="modal-body panel-heading">
              <h4>
                The answer you entered for verification code was not correct.
            </h4>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" id="close_modal_gagal">Close</button>
            </div>
          </div>
        </div>
      </div>
      </body>
<?php } ?>
<script type="text/javascript">
  $("#close_modal_gagal").click(function(){
    $("#modal_verifikasi").modal("show");
  });

</script>
</html>