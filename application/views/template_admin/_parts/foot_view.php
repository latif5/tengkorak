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

  <?php if($page_title == "Log User | NOKIA"){ ?>
     //get data log user
        $('.log-user').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [10,20, 40, 60],
          "iDisplayLength" :20,
          "scrollX":true,
          "scrollY":"60vh", //awalnya tidak ada
          fixedColumns: {
              leftColumns: 2
          },
          "columnDefs": [
            { "orderable": false, "targets": 0 }
          ],
          "sAjaxSource": "<?php echo base_url('LogUser/get_data'); ?>"
        }); 
  <?php } ?>

  <?php if($page_title == "Group User | NOKIA"){ ?>
     //get data Group User
        var table = $('.data-group').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [10,20, 40, 60],
          "iDisplayLength" :20,
          "scrollX":true,
          "scrollY":"60vh", //awalnya tidak ada
          fixedColumns: {
              leftColumns: 2
          },
          "columnDefs": [
            { "orderable": false, "targets": [0,3]}
          ],
          "sAjaxSource": "<?php echo base_url('GroupData/get_data'); ?>"
        });       

        // Inline editing
      var oldValue = null;
      $(document).on('dblclick', '.editable', function(){
        oldValue = $(this).html();

        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          $(this).html('<input type="text" style="width:90px; height:20px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          $(this).html('<input type="date" style="width:90px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "select"){
          $(this).html('<input type="text" style="width:90px;" class="update" value="'+ oldValue +'" />');
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
            url : '<?php echo base_url('GroupData/update_data') ?>',
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
        var that = $(this);
        var name= $(this).attr('data-name');
         var del = window.confirm('Confirm inactive '+name+'?');
          if (del === false) {
            event.preventDefault();
            return false;
          }
          
        $.ajax({
                  url: '<?php echo base_url("GroupData/delete_data"); ?>',
                  type: 'POST',
                  data: { id: id },
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
  <?php } ?>

  <?php if($page_title == "Cron Job | NOKIA"){ ?>
     //get data Cron Job
        var table = $('.data-cronjob').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [10,20, 40, 60],
          "iDisplayLength" :20,
          "scrollX":true,
          "scrollY":"63.6vh", //awalnya tidak ada
          fixedColumns: {
              leftColumns: 2
          },
          "columnDefs": [
            { "orderable": false, "targets": [0,3]},
            { "width": "20%", "targets": 2 }
          ],
          "sAjaxSource": "<?php echo base_url('Cronjob/get_data'); ?>"
        });       

        $('.data-cronjob tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
     // ajax modal edit cron job
         $(function(){
              $(document).on('click','.edit-cronjob',function(e){
                  e.preventDefault();
                  $("#editCronjob").modal('show');
                  $.post("<?php echo base_url('Cronjob/modalEditCronjob') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modalEditCronjob").html(html);
                      }   
                  );
              });
          });

      // ajax submit edit cron job
         $(function(){
            $(document).on('click','.submit-edit',function(e){
              if(document.getElementById('id').value == "" || document.getElementById('email').value == "" || document.getElementById('remarks').value == ""){
                alert("Please complete all information requested on this form");
              }else{
                $.ajax({
                  url : '<?php echo base_url('Cronjob/update_data') ?>',
                  method : 'post',
                  data : 
                  {
                    id    : document.getElementById('id').value,
                    email : document.getElementById('email').value,
                    remarks : document.getElementById('remarks').value
                  },
                  success : function(respone)
                  {
                    $("#editCronjob").modal('hide');
                    table.ajax.reload( null, false );
                    if(respone ==1){
                      alert("Success update");
                    }
                  }
                });
              }
            });
          });
  <?php } ?>

  <?php if($page_title == "Data User | NOKIA"){ ?>
     //get data data user
        var table = $('.data-user').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [10,20, 40, 60],
          "iDisplayLength" :20,
          "scrollX":true,
          "scrollY":"60vh", //awalnya tidak ada
          fixedColumns: {
              leftColumns: 2
          },
          "columnDefs": [
            { "orderable": false, "targets": [0,5,11,12,13] }
          ],
          "sAjaxSource": "<?php echo base_url('DataUser/get_data'); ?>"
        });       

        // Inline editing
      var oldValue = null;
      $(document).on('dblclick', '.editable', function(){
        oldValue = $(this).html();

        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          $(this).html('<input type="text" style="width:90px; height:20px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          $(this).html('<input type="date" style="width:90px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "select"){
          var elem    = $(this);
          $.ajax({
            type: "GET",
            url : "<?php echo base_url('DataUser/getDataGroup'); ?>",
            dataType: "html",
            success : function(respone){
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
            url : '<?php echo base_url('DataUser/update_data') ?>',
            method : 'post',
            data : 
            {
              id    : id,
              colName  : colName,
              newValue : newValue,
            },
            success : function(respone)
            {
              if(colName == 'id_group'){
                table.ajax.reload( null, false );
              }
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

        // check password - confirm password  
      $("#rePass").focusout(function(){
        if($("#pass").val() != $("#rePass").val()){
          $("#notMatch").show();
        }else{
          $("#notMatch").hide();
        }
      });
        // end check password

        // ajax delete data
     $(document).on('click','.delete-data',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var name= $(this).attr('data-name');
         var del = window.confirm('Confirm inactive '+name+'?');
          if (del === false) {
            event.preventDefault();
            return false;
          }
          
        $.ajax({
                  url: '<?php echo base_url("DataUser/delete_data"); ?>',
                  type: 'POST',
                  data: { id: id },
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

        // ajax change status
      $(document).on('click','.change-status',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var val= $(this).attr('data-name');
        $.ajax({
                  url: '<?php echo base_url("DataUser/change_status"); ?>',
                  type: 'POST',
                  data: { id: id, val: val },
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
        // end change status

        // ajax change publish
      $(document).on('click','.change-publish',function(event){
        var id= $(this).attr('rel');
        var that = $(this);
        var val= $(this).attr('data-name');
        $.ajax({
                  url: '<?php echo base_url("DataUser/change_publish"); ?>',
                  type: 'POST',
                  data: { id: id, val: val },
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
        // end change publish

        // ajax modal edit password
         $(function(){
              $(document).on('click','.edit-password',function(e){
                  e.preventDefault();
                  $("#editPassword").modal('show');
                  $.post("<?php echo base_url('DataUser/modelEditPassword') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditPassword").html(html);
                      }   
                  );
              });
          });


         // ajax modal edit group
         $(function(){
              $(document).on('click','.edit-group',function(e){
                  e.preventDefault();
                  $("#editGroup").modal('show');
                  $.post("<?php echo base_url('DataUser/modelEditGroup') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modelEditGroup").html(html);
                      }   
                  );
              });
          });
  <?php } ?>

  <?php if($page_title == "Master Received | NOKIA"){ ?>
      // get data
        <?php if(isset($_POST['year']) || isset($_POST['phase_code']) || isset($_POST['po_type']) || isset($_POST['po_no']) || isset($_POST['item_text']) || isset($_POST['cr_status'])){ ?>
        var table = $('.data-master-received').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"390px",
          "scrollY":"57.9vh", //awalnya tidak ada
          fixedColumns: {
              leftColumns: 2
          },
          "columnDefs": [
            { "orderable": false, "targets": [95]}
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[95].substr(0,48) == '<div><span type="text" name="status_po">0</span>' )
              {
                $(nRow).css('background-color', 'red');
              }
          },
          <?php
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");
            $key1 = str_replace($replacements,$entities,$_POST["year"]);
            $key2 = str_replace($replacements,$entities,$_POST["phase_code"]);
            $key3 = str_replace($replacements,$entities,$_POST["po_type"]);
            $key4 = str_replace($replacements,$entities,$_POST["po_no"]);
            $key5 = str_replace($replacements,$entities,$_POST["item_text"]);
            $key6 = str_replace($replacements,$entities,$_POST["cr_status"]);
            if($key1 == ""){
              $key1 = "xxx";
            }
            if($key2 == ""){
              $key2 = "xxx";
            }
            if($key3 == ""){
              $key3 = "xxx";
            }
            if($key4 == ""){
              $key4 = "xxx";
            }
            if($key5 == ""){
              $key5 = "xxx";
            }
            if($key6 == ""){
              $key6 = "xxx";
            }
          ?>
          "sAjaxSource": "<?php echo base_url('MasterReceived/get_data_filter/'.$key1.'/'.$key2.'/'.$key3.'/'.$key4.'/'.$key5.'/'.$key6); ?>"
        });
        <?php }else{ ?>
        var table = $('.data-master-received').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"390px",
          "scrollY":"57.9vh", //awalnya tidak ada
          fixedColumns: {
              leftColumns: 2
          },
          "columnDefs": [
            { "orderable": false, "targets": [95]}
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[95].substr(0,48) == '<div><span type="text" name="status_po">0</span>' )
              {
                $(nRow).css('background-color', 'red');
              }
          },
          "sAjaxSource": "<?php echo base_url('MasterReceived/get_data'); ?>"
          
        });
        <?php } ?>
        $('.data-master-received tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
        // Inline editing
      var oldValue = null;
      $(document).on('dblclick', '.editable', function(){
        oldValue = $(this).html();

        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          $(this).html('<input type="text" style="width:95px; height:20px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          $(this).html('<input type="date" style="width:90px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "select"){
          $(this).html('<input type="text" style="width:90px;" class="update" value="'+ oldValue +'" />');
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
            url : '<?php echo base_url('MasterReceived/update_data') ?>',
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
                  url: '<?php echo base_url("MasterReceived/delete_data"); ?>',
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
  <?php } ?>

  <?php if($page_title == "Master Phase | NOKIA"){ ?>
     //get data master phase
        var table = $('.master-phase').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [10,20, 40, 60],
          "iDisplayLength" :20,
          "scrollX":true,
          "scrollY":"390px",
          "scrollY":"60vh", //awalnya tidak ada
          fixedColumns: {
              leftColumns: 1
          },
          "columnDefs": [
            { "orderable": false, "targets": [10] }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[9].substr(0,45) == '<div><span type="text" name="status">0</span>' )
              {
                $(nRow).css('background-color', 'red');
              }
          },
          "sAjaxSource": "<?php echo base_url('MasterPhase/get_data'); ?>"
        });       
        
        $('.master-phase tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

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
                  url: '<?php echo base_url("MasterPhase/delete_data"); ?>',
                  type: 'POST',
                  data: { id: id, status:status },
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

      // ajax modal edit master phase
         $(function(){
              $(document).on('click','.edit-data',function(e){
                  e.preventDefault();
                  $("#editData").modal('show');
                  $.post("<?php echo base_url('MasterPhase/modalEditData') ?>",
                      {id:$(this).attr('data-id')},
                      function(html){
                          $("#modalEditData").html(html);
                      }   
                  );
              });
          });

      // ajax submit edit master phase
         $(function(){
            $(document).on('click','.submit-edit',function(e){
              if (document.getElementById('custcodeEdit').value == "" || document.getElementById('custnameEdit').value == "" || document.getElementById('phaseyearEdit').value == "" || document.getElementById('phasecodeEdit').value == "" || document.getElementById('phasenameEdit').value == "" || document.getElementById('remarksEdit').value == "") {
                alert("Please complete all information requested on this form");
              }else{
                $.ajax({
                  url : '<?php echo base_url('MasterPhase/edit_data') ?>',
                  method : 'post',
                  data : 
                  {
                    id    : document.getElementById('id').value,
                    phaseCodeAwal  : document.getElementById('phaseCodeAwal').value,
                    custcode  : document.getElementById('custcodeEdit').value,
                    custname  : document.getElementById('custnameEdit').value,
                    phaseyear  : document.getElementById('phaseyearEdit').value,
                    phasecode  : document.getElementById('phasecodeEdit').value,
                    phasename  : document.getElementById('phasenameEdit').value,
                    remarks  : document.getElementById('remarksEdit').value
                  },
                  success : function(respone)
                  {
                    if(respone ==1){
                      $("#editData").modal('hide');
                      table.ajax.reload( null, false );
                      alert("Success update");
                    }else{
                      alert("Phase code exist in database");
                    }
                  }
                });
              }
                    
            });
          });

      // ajax submit edit cron job
         $(function(){
            $(document).on('click','.submit-add',function(e){
              if (document.getElementById('custcode').value == "" || document.getElementById('custname').value == "" || document.getElementById('phaseyear').value == "" || document.getElementById('phasecode').value == "" || document.getElementById('phasename').value == "" || document.getElementById('remarks').value == "") {
                alert("Please complete all information requested on this form");
              }else{
                $.ajax({
                  url : '<?php echo base_url('MasterPhase/create') ?>',
                  method : 'post',
                  data : 
                  {
                    custcode  : document.getElementById('custcode').value,
                    custname  : document.getElementById('custname').value,
                    phaseyear  : document.getElementById('phaseyear').value,
                    phasecode  : document.getElementById('phasecode').value,
                    phasename  : document.getElementById('phasename').value,
                    remarks  : document.getElementById('remarks').value
                  },
                  success : function(respone)
                  {
                    if(respone ==1){
                      $("#addMasterPhase").modal('hide');
                      document.getElementById('custcode').value = "";
                      document.getElementById('custname').value = "";
                      document.getElementById('phaseyear').value = "";
                      document.getElementById('phasecode').value = "";
                      document.getElementById('phasename').value = "";
                      document.getElementById('remarks').value = "";
                      table.ajax.reload( null, false );
                      alert("Master phase has been entered to the database successfully");
                    }else{
                      alert("Phase code exist in database");
                    }
                  }
                });
              }
            });
          });
  <?php } ?>

  <?php if($page_title == "Upload Received | NOKIA"){ ?>
     //get data upload received
        var table = $('.upload-received').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [10,20, 40, 60],
          "iDisplayLength" :20,
          "scrollX":true,
          "scrollY":"390px",
          "scrollY":"60vh", //awalnya tidak ada
          fixedColumns: {
              leftColumns: 1
          },
          "columnDefs": [
            { "orderable": false, "targets": [4] }
          ],
          'fnRowCallback': function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
              if ( aData[4].substr(0,45) == '<div><span type="text" name="status">0</span>' )
              {
                $(nRow).css('background-color', 'red');
              }
          },
          "sAjaxSource": "<?php echo base_url('UploadReceived/get_data'); ?>"
        });       
        
        $('.upload-received tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

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
                  url: '<?php echo base_url("UploadReceived/delete_data"); ?>',
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
  <?php } ?>

  <?php if($page_title == "Upload QC | NOKIA"){ ?>
     //get data upload received
        var table = $('.upload-qc').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [10,20, 40, 60],
          "iDisplayLength" :20,
          "scrollX":true,
          "scrollY":"390px",
          "scrollY":"57.9vh", //awalnya tidak ada
          fixedColumns: {
              leftColumns: 1
          },
          "columnDefs": [
            { "orderable": false, "targets": [11] },
            {
              "targets": '_all',
              render : function(data, type, row, meta) {
                    var res = data.split("|");
                    if(res[0] == 't'){
                      res[0] = 'text';
                    }else if(res[0] == 's'){
                      res[0] = 'select';
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
              if ( aData[11].substr(0,11) == 't|status||0' )
              {
                $(nRow).css('background-color', 'red');
              }
          },
        <?php if(isset($_POST['qcno']) || isset($_POST['phasename']) || isset($_POST['status'])){ 
          $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
          $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");
          $key1 = str_replace($replacements,$entities,$_POST['qcno']);
          $key2 = str_replace($replacements,$entities,$_POST['phasename']);
          $key3 = str_replace($replacements,$entities,$_POST['status']);
          if($key1 == ''){$key1 = "xxx";}
          if($key2 == ''){$key2 = "xxx";}
          if($key3 == ''){$key3 = "xxx";}
        ?>
          "sAjaxSource": "<?php echo base_url('UploadQC/get_data_filter/'.$key1.'/'.$key2.'/'.$key3); ?>"
        });       
        <?php }else{ ?>
          "sAjaxSource": "<?php echo base_url('UploadQC/get_data'); ?>"
        });
        <?php } ?>
        $('.upload-qc tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );

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
                  url: '<?php echo base_url("UploadQC/delete_data"); ?>',
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
  <?php } ?>

  <?php if($page_title == "Data QC | NOKIA"){ ?>
      // get data
        var table = $('.data-QC').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [50, 100, 200, 500],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"57.9vh",
          fixedColumns: {
              leftColumns: 2
          },
          "columnDefs": [
            { "orderable": false, "targets": [41]},
            {
                "targets": [ 1,3,6,9 ],
                "visible": false
            },
            {
              "targets": [19,21],
              render : function(data, type, row, meta) {
                    var res = data.split("|");
                    if(res[0] == 't'){
                      res[0] = 'text';
                    }else if(res[0] == 's'){
                      res[0] = 'select';
                    }else if(res[0] == 'd'){
                      res[0] = 'date';
                    }
                    if(res[2] == 'e'){
                      res[2] = 'editable';
                    }
                    var id = row[0].split("|");
                    return "<div align='right'><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
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
              if(aData[13] == 't|qclevel||1'){
                $(nRow).css('background-color', '#ffcc00');
              }else if( aData[13] == 't|qclevel||0'){
                $(nRow).css('background-color', '#ff9900');
              }
              if ( aData[41].substr(0,11) == 't|status||0' )
              {
                $(nRow).css('background-color', 'red');
              }
          },
        <?php if(isset($_POST['qcno']) || isset($_POST['scccode']) || isset($_POST['qclevel']) || isset($_POST['matcode']) || isset($_POST['description'])){ ?>
        
          
          <?php
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D', '%2D');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");
            $key1 = str_replace($replacements,$entities,$_POST["qcno"]);
            $key2 = str_replace($replacements,$entities,$_POST["scccode"]);
            $key3 = str_replace($replacements,$entities,$_POST["qclevel"]);
            $key4 = str_replace($replacements,$entities,$_POST["matcode"]);
            $key5 = str_replace($replacements,$entities,$_POST["description"]);
            if($key1 == ""){$key1 = "xxx";}
            if($key2 == ""){$key2 = "xxx";}
            if($key3 == ""){$key3 = "xxx";}
            if($key4 == ""){$key4 = "xxx";}
            if($key5 == ""){$key5 = "xxx";}
          ?>
          "sAjaxSource": "<?php echo base_url('DataQC/get_data_filter/'.$key1.'/'.$key2.'/'.$key3.'/'.$key4.'/'.$key5); ?>"
        });
        <?php }else{ ?>
          "sAjaxSource": "<?php echo base_url('DataQC/get_data'); ?>"
          
        });
        <?php } ?>
        $('.data-QC tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        } );
        // Inline editing
      var oldValue = null;
      $(document).on('dblclick', '.editable', function(){
        oldValue = $(this).html();

        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          $(this).html('<input type="text" style="width:95px; height:20px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          $(this).html('<input type="date" style="width:90px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "select"){
          $(this).html('<input type="text" style="width:90px;" class="update" value="'+ oldValue +'" />');
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
            url : '<?php echo base_url('DataQC/update_data') ?>',
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
                  url: '<?php echo base_url("DataQC/delete_data"); ?>',
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
  <?php } ?>

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

  <?php if($page_title == "Sor Por Dashboard | NOKIA"){ ?>
      // get data
          var table = $('.data-sorpor').DataTable({
            "sServerMethod": "POST", 
            "bProcessing": true,
            "bServerSide": true,
            "lengthMenu": [20,50, 100, 150, 200],
            "iDisplayLength" :50,
            "scrollX":true,
            "scrollY":"390px",
            "scrollY":"61vh", //awalnya tidak ada
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
            "sAjaxSource": "<?php echo base_url('SorporDashboard/get_data'); ?>"
          
          });
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
      var oldValue = null;
      $(document).on('dblclick', '.editable', function(){
        oldValue = $(this).html();

        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          $(this).html('<input type="text" style="width:95px; height:20px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          $(this).html('<input type="date" style="width:90px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "select"){
          $(this).html('<select class="update"><option value="OPEN">OPEN</option><option value="CLOSE">CLOSE</option></select>');
        }else if($(this).attr('type') == "selectUser"){
          <?php
            $selectOption = "<select class='update'>"; 
            foreach ($this->db->query("SELECT nama_user FROM user")->result() as $key) {
              $selectOption .= "<option value='".$key->nama_user."'>".$key->nama_user."</option>";
            }
            $selectOption .= "</select>";
          ?>
          $(this).html("<?php echo $selectOption; ?>");
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
            url : '<?php echo base_url('SorporDashboard/update_data') ?>',
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
                  url: '<?php echo base_url("SorporDashboard/delete_data"); ?>',
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
  <?php } ?>

  <?php if($page_title == "Sor Por Database | NOKIA"){ ?>
      // get data
      var table = $('.data-sorpor').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [20,50, 100, 150, 200],
          "iDisplayLength" :50,
          "scrollX":true,
          "scrollY":"55.3vh",
          fixedColumns: {
              leftColumns: 2
          },
          "columnDefs": [
            { "orderable": false, "targets": [40]},
            {
              "targets": '_all',
              render : function(data, type, row, meta) {
                    var res = data.split("|");
                    if(res[0] == 't'){
                      res[0] = 'text';
                    }else if(res[0] == 's'){
                      res[0] = 'select';
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
              if(aData[5] == 't|level1||Site'){
                $(nRow).css('background-color', '#34c333');
              }else if(aData[5] == 't|level1||1'){
                $(nRow).css('background-color', '#ffcc00');
              }else if( aData[5] == 't|level1||0'){
                $(nRow).css('background-color', '#ff9900');
              }
              if ( aData[41].substr(0,11) == 't|status||0' )
              {
                $(nRow).css('background-color', 'red');
              }
          },
        <?php if(isset($_POST['phasecode']) || isset($_POST['porname']) || isset($_POST['level1']) || isset($_POST['siteid']) || isset($_POST['status']) || isset($_POST['qcline']) || isset($_POST['scccode']) || isset($_POST['voaline']) || isset($_POST['stl']) || isset($_POST['qcno'])  ){ ?>
          <?php
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");
            $key1 = str_replace($replacements,$entities,$_POST["level1"]);
            $key2 = str_replace($replacements,$entities,$_POST["siteid"]);
            $key3 = str_replace($replacements,$entities,$_POST["status"]);
            $key4 = str_replace($replacements,$entities,$_POST["qcline"]);
            $key5 = str_replace($replacements,$entities,$_POST["scccode"]);
            $key6 = str_replace($replacements,$entities,$_POST["voaline"]);
            $key7 = str_replace($replacements,$entities,$_POST["stl"]);
            $key8 = str_replace($replacements,$entities,$_POST["qcno"]);
            $key9 = str_replace($replacements,$entities,$_POST["porname"]);
            $key10 = str_replace($replacements,$entities,$_POST["porname_ori"]);
            $key11 = str_replace($replacements,$entities,$_POST["phasecode"]);
            if($key1 == ""){$key1 = "xxx";}
            if($key2 == ""){$key2 = "xxx";}
            if($key3 == ""){$key3 = "xxx";}
            if($key4 == ""){$key4 = "xxx";}
            if($key5 == ""){$key5 = "xxx";}
            if($key6 == ""){$key6 = "xxx";}
            if($key7 == ""){$key7 = "xxx";}
            if($key8 == ""){$key8 = "xxx";}
            if($key9 == ""){$key9 = "xxx";}
            if($key10 == ""){$key10 = "xxx";}
            if($key11 == ""){$key11 = "xxx";}
          ?>
          "sAjaxSource": "<?php echo base_url('Sorpordb/get_data_filter/'.$key1.'/'.$key2.'/'.$key3.'/'.$key4.'/'.$key5.'/'.$key6.'/'.$key7.'/'.$key8.'/'.$key9.'/'.$key10.'/'.$key11); ?>"
        });
        <?php }else{ ?>
            "sAjaxSource": "<?php echo base_url('Sorpordb/get_data'); ?>"
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
      var oldValue = null;
      $(document).on('dblclick', '.editable', function(){
        oldValue = $(this).html();

        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          $(this).html('<input type="text" style="width:95px; height:20px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          $(this).html('<input type="date" style="width:90px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "select"){
          $(this).html('<select class="update"><option value="OPEN">OPEN</option><option value="CLOSE">CLOSE</option></select>');
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
            url : '<?php echo base_url('Sorpordb/update_data') ?>',
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
                  url: '<?php echo base_url("Sorpordb/delete_data"); ?>',
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
  <?php } ?>

  <?php if($page_title == "Sor Por Update | NOKIA"){ ?>
      // get data
      var table = $('.data-sorpor').DataTable({
          "sServerMethod": "POST", 
          "bProcessing": true,
          "bServerSide": true,
          "lengthMenu": [100, 150, 200],
          "iDisplayLength" :100,
          "scrollX":true,
          "scrollY":"56.7vh",
          "ordering" : false,
          fixedColumns: {
              leftColumns: 19
          },
          "columnDefs": [
            {
                "targets": [ 1,2,3,4,5,9,10,11,12,13,14,15,16,33,41 ],
                "visible": false
            },
            {
              "targets": [23, 25, 30, 34],
              render : function(data, type, row, meta) {
                    var res = data.split("|");
                    if(res[0] == 't'){
                      res[0] = 'text';
                    }else if(res[0] == 's'){
                      res[0] = 'select';
                    }else if(res[0] == 'd'){
                      res[0] = 'date';
                    }
                    if(res[2] == 'e'){
                      res[2] = 'editable';
                    }
                    var id = row[0].split("|");
                    return "<div align='right'><span type='"+res[0]+"' id='"+id[3]+"' name='"+res[1]+"' class='"+res[2]+"'>"+res[3]+"</span></div>"
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
              if(aData[5] == 't|level1||Site'){
                $(nRow).css('background-color', '#34c333');
              }else if(aData[5] == 't|level1||1'){
                $(nRow).css('background-color', '#ffcc00');
              }else if( aData[5] == 't|level1||0'){
                $(nRow).css('background-color', '#ff9900');
              }
              if(aData[41].substr(0,11) == 't|status||0'){
                $(nRow).css('color', 'red');
              }
              if ( aData[41].substr(0,11) == 't|status||0' && aData[5] == 't|level1||2')
              {
                $(nRow).css('background-color', 'LightGray');
              }
          },
        <?php if(isset($_POST['porname']) || isset($_POST['level1']) || isset($_POST['sideid']) || isset($_POST['status']) || isset($_POST['qcline']) || isset($_POST['scccode']) || isset($_POST['voaline']) || isset($_POST['stl']) ){ ?>
          <?php
            $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
            $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");
            $key1 = str_replace($replacements,$entities,$_POST["porname"]);
            $key2 = str_replace($replacements,$entities,$_POST["level1"]);
            $key3 = str_replace($replacements,$entities,$_POST["siteid"]);
            $key4 = str_replace($replacements,$entities,$_POST["status"]);
            $key5 = str_replace($replacements,$entities,$_POST["qcline"]);
            $key6 = str_replace($replacements,$entities,$_POST["scccode"]);
            $key7 = str_replace($replacements,$entities,$_POST["voaline"]);
            $key8 = str_replace($replacements,$entities,$_POST["stl"]);
            if($key1 == ""){$key1 = "xxx";}
            if($key2 == ""){$key2 = "xxx";}
            if($key3 == ""){$key3 = "xxx";}
            if($key4 == ""){$key4 = "xxx";}
            if($key5 == ""){$key5 = "xxx";}
            if($key6 == ""){$key6 = "xxx";}
            if($key7 == ""){$key7 = "xxx";}
            if($key8 == ""){$key8 = "xxx";}
          ?>
          "sAjaxSource": "<?php echo base_url('SorporUpdate/get_data_filter/'.$key1.'/'.$key2.'/'.$key3.'/'.$key4.'/'.$key5.'/'.$key6.'/'.$key7.'/'.$key8); ?>"
        });
        <?php }else{ ?>
            <?php 
              $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D', '%22');
              $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "#", "[", "]"," ");
              $key = str_replace($replacements,$entities,$porname);
            ?>
            "sAjaxSource": "<?php echo base_url('SorporUpdate/get_data/'.$key); ?>"
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
      var oldValue = null;
      $(document).on('click', '.editable', function(){
        oldValue = $(this).html();

        $(this).removeClass('editable');  // to stop from making repeated request
        if($(this).attr('type') == "text"){
          if(oldValue == "- - -"){
            oldValue = "";
          }
          $(this).html('<input type="text" style="width:'+($(this).width()+8)+'px; height:20px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "date"){
          $(this).html('<input type="date" style="width:90px;" class="update" value="'+ oldValue +'" />');
        }else if($(this).attr('type') == "select"){
          $(this).html('<select class="update"><option value="OPEN">OPEN</option><option value="CLOSE">CLOSE</option></select>');
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
            url : '<?php echo base_url('SorporUpdate/update_data') ?>',
            method : 'post',
            data : 
            {
              id    : id,
              colName  : colName,
              newValue : newValue,
            },
            success : function(respone)
            {
              if(newValue == ''){
                newValue = "- - -";
              }
              $(elem).parent().addClass('editable');
              $(elem).parent().html(newValue);
            }
          });
        }
        else
        {
          if(newValue == ''){
            newValue = "- - -";
          }
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
                  url: '<?php echo base_url("SorporUpdate/delete_data"); ?>',
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

      // ajax modal assign to
       $(function(){
            $(document).on('click','.assignTo',function(e){
                e.preventDefault();
                $("#assignTo").modal('show');
                $.post("<?php echo base_url('SorporUpdate/modalAssignTo') ?>",
                    {sorporid:$(this).attr('sorporid'),porname:$(this).attr('porname')},
                    function(html){
                        $("#modalAssignTo").html(html);
                    }   
                );
            });
        });

       // ajax modal assign to
       $(function(){
            $(document).on('click','.sorSorPor',function(e){
                e.preventDefault();
                $("#assignTo").modal('show');
                $.post("<?php echo base_url('SorporUpdate/modalCorSorPor') ?>",
                    {sorporid:$(this).attr('sorporid'),porname:$(this).attr('porname')},
                    function(html){
                        $("#modalAssignTo").html(html);
                    }   
                );
            });
        });

       // ajax modal assign cor to
       $(function(){
            $(document).on('click','.assignCorTo',function(e){
                e.preventDefault();
                $("#assignTo").modal('show');
                $.post("<?php echo base_url('SorporUpdate/modalAssignCorTo') ?>",
                    {sorporid:$(this).attr('sorporid'),porname:$(this).attr('porname')},
                    function(html){
                        $("#modalAssignTo").html(html);
                    }   
                );
            });
        });

       // ajax modal input SPO
       $(function(){
            $(document).on('click','.inputSPO',function(e){
                e.preventDefault();
                $("#assignTo").modal('show');
                $.post("<?php echo base_url('SorporUpdate/modalInputSpo') ?>",
                    {sorporid:$(this).attr('sorporid'),porname:$(this).attr('porname')},
                    function(html){
                        $("#modalAssignTo").html(html);
                    }   
                );
            });
        });

       // ajax modal check SO
       $(function(){
            $(document).on('click','.checkSO',function(e){
                e.preventDefault();
                $("#assignTo").modal('show');
                $.post("<?php echo base_url('SorporUpdate/modalCheckSO') ?>",
                    {sorporid:$(this).attr('sorporid'),porname:$(this).attr('porname')},
                    function(html){
                        $("#modalAssignTo").html(html);
                    }   
                );
            });
        });

       // ajax refresh SCC
       $(function(){
            $(document).on('click','.refreshSCC',function(e){
                $.ajax({
                  url : '<?php echo base_url('SorporUpdate/refreshSCC') ?>',
                  method : 'post',
                  data : 
                  {
                    sorporid    : $(this).attr('sorporid')
                  },
                  success : function(respone)
                  {
                    if(respone ==1){
                      table.ajax.reload( null, false );
                      alert("Success refresh SCC");
                    }else{
                      alert(respone);
                    }
                  }
                });
            });
        });


        // ajax delete sor por
      $(document).on('click','.delete-sor-por',function(event){
        var id = $("#sorporid").val();
        var site = $("#siteSelected").val();
        var porname = $("#porname1").val();
        var remarks = $("#remarks").val();
        $.ajax({
                  url: '<?php echo base_url("SorporUpdate/deleteSorPor"); ?>',
                  type: 'POST',
                  data: { id: id, site: site, porname: porname, remarks: remarks },
                  success: function (resp) {    
                    if (resp == 1) {  
                     table.ajax.reload( null, false );
                     $("#assignTo").modal('hide');
                     alert("Success delete sor por");
                    } 
                    else { alert('error '+resp);}
                  },
                  error: function(e){ alert ("Error " + e); }
        });
        event.preventDefault();
      });
  <?php } ?>
</script>