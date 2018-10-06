<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js'); ?>"></script>

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/plugins/jQueryUI/jquery-ui.min.js'); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/dist/js/dataTables.fixedColumns.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>">
  
</script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/plugins/fastclick/fastclick.js');?>"></script>
<script src="<?php echo base_url('assets/dist/js/app.min.js')?>"></script>

<!-- CK Editor -->
<!-- <script type="text/javascript" src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js'); ?>"></script> -->
<!-- <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script> -->
<!-- <script src="//cdn.ckeditor.com/4.6.1/full/ckeditor.js"></script> -->
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js'); ?>"></script>
<script src="<?=base_url()?>assets/dist/js/validator.js"></script>
<script type="text/javascript">

  <?php if($page_title == "Peserta | Tengkorak"){ ?>
      // get data
          var table = $('.data-peserta').DataTable({
            "sServerMethod": "POST", 
            "bProcessing": true,
            "bServerSide": true,
            "lengthMenu": [20,50, 100, 150, 200],
            "iDisplayLength" :50,
            "scrollX":true,
            "scrollY":"390px",
            "scrollY":"57.7vh", //awalnya tidak ada
            fixedColumns: {
                leftColumns: 2
            },
            "columnDefs": [
              { "orderable": false, "targets": [0]},
              {
                "targets": '_all',
                render : function(data, type, row, meta) {
                      var res = data.split("|");
                      if(res[0] == 't'){
                        res[0] = 'text';
                      }else if(res[0] == 's'){
                        res[0] = 'select';
                      }else if(res[0] == 'su'){
                        res[0] = 'selectUser';
                      }else if(res[0] == 'd'){
                        res[0] = 'date';
                      }
                      if(res[2] == 'e'){
                        res[2] = 'editable';
                      }
                      var id = row[0].split("|");
                      return "<div><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
                  }             
              }
            ],
            'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                if ( aData[3].substr(10) != '' )
                {
                  $(nRow).css('background-color', '#7FFF00');
                }
            },
            "sAjaxSource": "<?php echo base_url('Peserta/get_data'); ?>"
          });


      // ajax modal edit datetime
       $(function(){
            $(document).on('click','.edit-datetime',function(e){
                e.preventDefault();
                $("#editDatetime").modal('show');
                $.post("<?php echo base_url('Sorpor/modalEditDatetime') ?>",
                    {id:$(this).attr('data-id')},
                    function(html){
                        $("#modalEditDatetime").html(html);
                    }   
                );
            });
        });

  <?php } ?>
</script>