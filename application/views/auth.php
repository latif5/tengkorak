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
        <div style="background:hsl(345, 100, 0) !important;  border:1px; display:table;">
          <div class="col-md-6">
            <div class="ibox-content" style="background-color: background:hsl(345, 100, 0); border:none !important;">
              <form class="m-t" id="Check_barcode" role="form" method="post">
                <div class="form-group">
                  <input type="text" id="nama" name="nama" style="background-color: hsl(345, 100, 0) !important;" class="form-control" placeholder="Barcode" size="60px" required="" autofocus="" value="">
                </div>
              </form> 
            </div>
          </div>
        </div>
      </div>
    </div>

      <!-- Modal -->
      <div class="modal fade" id="modal_status" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content panel-danger">
            <div class="modal-header panel-heading">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title" id="myModalLabel">Invitation Cobfirm</h3>
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


    <!-- Mainly scripts -->
    <script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/dist/js/jquery.bxslider.js'); ?>"></script>


<script type="text/javascript">
  $(document).ready(function() { 
    var form = $('#Check_barcode').val();
    $('#nama').change(function() { 
      $.ajax({ 
        url: '<?php echo base_url("Auth/get_data_name"); ?>',
        type: 'post',
        data: form.serialize(),
        dataType: 'json',
        success: function(data)
        {
          $('#modal_status').modal('show');
          // setTimeout(function(){$("#notif_save").hide();}, 2000);
        }
      });
   }); 
});

</script>
</html>