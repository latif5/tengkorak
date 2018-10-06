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

  <?php if($page_title == "Sor Por Tracker | NOKIA"){ ?>
      // get data
          var table = $('.data-sorpor').DataTable({
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
              { "orderable": false, "targets": [39,11]},
              {
                  "targets": [ 25,26,27,28,29,30,31,32,33,34,35 ],
                  "visible": false
              },
              {
                "targets": [6],
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
                      return "<div><a href='<?=base_url();?>SorporUpdate/index/"+id[4]+"' target='_blank'><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></a></div>"
                  }             
              },
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
                if ( aData[39].substr(0,11) == 't|status||0' )
                {
                  $(nRow).css('background-color', 'red');
                }
            },
          <?php if(isset($_POST['reqname']) || isset($_POST['id_user_assign']) || isset($_POST['ultype'])){ ?>
          <?php
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");
            $key1 = str_replace($replacements,$entities,$_POST["reqname"]);
            $key2 = str_replace($replacements,$entities,$_POST["id_user_assign"]);
            $key3 = str_replace($replacements,$entities,$_POST["ultype"]);
            $key4 = str_replace($replacements,$entities,$_POST["status"]);
            $key5 = str_replace($replacements,$entities,$_POST["assignStatus"]);
            if($key1 == ""){$key1 = "xxx";}
            if($key2 == ""){$key2 = "xxx";}
            if($key3 == ""){$key3 = "xxx";}
            if($key4 == ""){$key4 = "xxx";}
            if($key5 == ""){$key5 = "xxx";}
          ?>
            "sAjaxSource": "<?php echo base_url('Sorpor/get_data_filter/'.$key1.'/'.$key2.'/'.$key3.'/'.$key4.'/'.$key5); ?>"
          });
          <?php }else{ ?>
            "sAjaxSource": "<?php echo base_url('Sorpor/get_data'); ?>"
          });
          <?php } ?>
        $('.data-sorpor tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
        // Inline editing
      String.prototype.replaceArray = function(find, replace){
        var replaceString = this;
        for(var i=0; i<find.length; i++){
          replaceString = replaceString.replace(find[i],replace[i]);
        }
        return replaceString;
      }
      var oldValue = null;
      var entities = ['%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22'];
      var replacements = ['!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," "];
      $(document).on('dblclick', '.editable', function(){
        oldValue = $(this).html();

        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          $(this).html('<input type="text" style="width:'+($(this).width()+8)+'px; height:14.4px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          $(this).html('<input type="date" style="width:90px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "select"){
          $(this).html('<select class="update"><option value="OPEN">OPEN</option><option value="CLOSE">CLOSE</option></select>');
        }else if($(this).attr('type') == "selectUser"){
          var elem = $(this);
          var oldValue1 = oldValue.replaceArray(replacements,entities);
          $.ajax({
            type: "GET",
            url: "<?php echo base_url();?>Sorpor/getDataUserSelection/"+oldValue1,
            dataType: "html",
            success: function(respone){
              $(elem).html('<select class="update">'+respone+'</select>');
            }
          });
        }
        $(this).find('.update').focus();
      });

      var newValue = null;
      $(document).on('blur', '.update', function(){
        var elem    = $(this);
        newValue  = $(this).val();
        var id  = $(this).parent().attr('id');
        var colName = $(this).parent().attr('name');

        if(newValue != oldValue)
        {
          $.ajax({
            url : '<?php echo base_url('Sorpor/update_data') ?>',
            method : 'post',
            data : 
            {
              id    : id,
              colName  : colName,
              newValue : newValue,
            },
            success : function(respone)
            {
              $(elem).parent().addClass('editable');
              $(elem).parent().html(newValue);
            }
          });
        }
        else
        {
          $(elem).parent().addClass('editable');
          $(this).parent().html(newValue);
        }
      });
        // end inline editing

        // ajax delete data
     $(document).on('click','.delete-data',function(event){
        var id= $(this).attr('rel');
        var status = $(this).attr('status');
        var that = $(this);
        var name= $(this).attr('data-name');
        if(status == 1){
          var del = window.confirm('Confirm inactive '+name+'?');
        }else{
          var del = window.confirm('Confirm active '+name+'?');
        }
        
          if (del === false) {
            event.preventDefault();
            return false;
          }
          
        $.ajax({
                  url: '<?php echo base_url("Sorpor/delete_data"); ?>',
                  type: 'POST',
                  data: { id: id, status: status },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                    } 
                    else { alert('error '+resp);}
                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      
      });
        // end delete data

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

       // ajax sumbit edit datetime
      $(document).on('click','.change-datetime',function(event){
        var id= $("#id").val();
        var that = $(this);
        var datetime= $("#datetime").val();
        $.ajax({
                  url: '<?php echo base_url("Sorpor/submitEditDatetime"); ?>',
                  type: 'POST',
                  data: { id: id, datetime: datetime },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                     $("#editDatetime").modal('hide');
                     alert("Success update datetime assgin to");
                    } 
                    else { alert('error '+resp);}
                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      });

  <?php } ?>
</script>