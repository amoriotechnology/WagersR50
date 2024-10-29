<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/calanderstyle.css">
<div class="content-wrapper">
   <section class="content-header" style="height: 60px;">
      <div class="header-icon">
         <figure class="one">
            <img src="<?php echo base_url() ?>asset/images/payslip.png" class="headshotphoto" style="height:50px;" />
         </figure>
      </div>
      <div class="header-title">
         <div class="logo-holder logo-9">
         <h1><?php echo ('Manage Employee') ?></h1>
         </div>
            <ol class="breadcrumb" style=" border: 3px solid #d7d4d6;" >
               <li><a href="#"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
               <li><a href="#"><?php echo display('hrm') ?></a></li>
               <li class="active" style="color:orange"><?php echo ('Manage Employee') ?></li>
            <div class="load-wrapp">
               <div class="load-10">
                  <div class="bar"></div>
               </div>
            </div>
         </ol>
      </div>
   </section>
   <section class="content">
      <?php
         $message = $this->session->userdata('message');
         if (isset($message)) { 
      ?>
      <div class="alert alert-info alert-dismissable" style="background-color:#38469f;color:white;font-weight:bold;">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <?php echo $message ?>                    
      </div>
      <?php $this->session->unset_userdata('message'); }
         $error_message = $this->session->userdata('error_message');
         if (isset($error_message)) {
      ?>
      <div class="alert alert-danger alert-dismissable">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <?php echo $error_message ?>                    
      </div>
      <?php $this->session->unset_userdata('error_message');}?>
      <div class="error_display mb-2"></div>
      <div class="panel panel-bd lobidrag">
         <div class="panel-heading" style="height: 60px;border: 3px solid #D7D4D6;">
            <div class="col-sm-12" style="height:69px;">
            <div class="col-sm-4" style="display: flex; justify-content: space-between; align-items: left;">
               <?php    foreach(  $this->session->userdata('perm_data') as $test){
                  $split=explode('-',$test);
                  if(trim($split[0])=='hrm' && $_SESSION['u_type'] ==3 && trim($split[1])=='1000'){
                    
                    
                     ?>
               <a href="<?php echo base_url('Chrm/add_employee') ?>" class="btn btnclr dropdown-toggle" style="color:white;border-color: #2e6da4;    height: fit-content;"> <i class="far fa-file-alt"> </i>&nbsp;<?php echo ('Add Employee') ?></a>
               <?php break;}} 
                  if($_SESSION['u_type'] ==2){ ?>
               <a href="<?php echo base_url('Chrm/add_employee') ?>" class="btn btnclr dropdown-toggle" style="border-color: #2e6da4;    height: fit-content;"> <i class="far fa-file-alt"> </i>&nbsp;<?php echo ('Add Employee') ?></a>
               <?php  } ?>
               &nbsp;&nbsp;
               <a  class="btnclr btn btn-default dropdown-toggle  boxes filip-horizontal "  style=" height:fit-content;"  id="s_icon"><b class="fa fa-search"></b>&nbsp;Advance search  </a>
               &nbsp;&nbsp;
               <a  class="btn btnclr dropdown-toggle"  aria-hidden="true"      style="height: fit-content;"  data-toggle="modal" data-target="#designation_modal" ><b class="fa fa-legal"> </b>&nbsp;<?php echo ('Form instructions') ?></a>
               &nbsp;&nbsp;
              <a  class="btn btnclr dropdown-toggle"  aria-hidden="true"      style="height: fit-content;"  href="<?php echo base_url() ?>Chrm/new_employee"  ><b class="fa fa-user"> </b>&nbsp;<?php echo ('New Employee Form') ?></a>&nbsp;&nbsp;
         
              <a href="<?php echo base_url('Chrm/hr_tools') ?>" class="btn btnclr dropdown-toggle" style="border-color: #2e6da4;    height: fit-content;"> <i class="far fa-file-alt"> </i>&nbsp;<?php echo ('Hand Book') ?></a>
              &nbsp;&nbsp;
              <a href="<?php echo base_url('chrm/w4form') ?>" class="btn btnclr dropdown-toggle" style="height: fit-content;">W4 Form</a>
               &nbsp;&nbsp;
               <a class="btnclr btn" href="<?php echo base_url('chrm/w9form') ?>" style="height: fit-content;" >W9 Form</a>
               &nbsp;&nbsp;
            </div>
         </div>
         </div>
         <div class="row">
            <div class="col-sm-12">
               <div class="panel panel-bd lobidrag">
                  <div class="panel-body" style="border: 3px solid #D7D4D6;">
                     <table class="table table-bordered" cellspacing="0" width="100%" id="employee_list">
                        <thead>
                           <tr class="btnclr">
                                <th class="text-center"><?php echo display('sl') ?></th>
                                <th class="text-center"><?php echo display('name') ?></th>
                                <th class="text-center"><?php echo display('designation') ?></th>
                                <th class="text-center"><?php echo display('phone') ?></th>
                                <th class="text-center"><?php echo display('email') ?></th>
                                <th class="text-center"><?php echo  ('Blood Group') ?></th>
                                <th class="text-center"><?php echo ('Social Security Number') ?></th>
                                <th class="text-center"><?php echo ('Routing Number') ?></th>
                                <th class="text-center"><?php echo ('Employee Tax') ?></th>
                                <th class="text-center"><?php echo display('action') ?></th>
                           </tr>
                        </thead>
                     </table>
                  </div>
               </div>     
            </div>
         </div>
      </div>
   </section>
</div>


<script src='<?php echo base_url();?>assets/js/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/knockout/3.4.0/knockout-debug.js'></script>
<script  src="<?php echo base_url() ?>assets/js/scripts.js"></script> 
<script type="text/javascript">
var csrfName = '<?php echo $this->security->get_csrf_token_name();?>';
var csrfHash = '<?php echo $this->security->get_csrf_hash();?>';

var employeeDataTable;
$(document).ready(function() {
$(".sidebar-mini").addClass('sidebar-collapse') ;
    if ($.fn.DataTable.isDataTable('#employee_list')) {
        $('#employee_list').DataTable().clear().destroy();
    }
    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
    employeeDataTable = $('#employee_list').DataTable({
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        "ajax": {
            "url": "<?php echo base_url('Chrm/employeeListdatatable'); ?>",
            "type": "POST",
            "data": function(d) {
                d['<?php echo $this->security->get_csrf_token_name(); ?>'] =
                    '<?php echo $this->security->get_csrf_hash(); ?>';
            },
            "dataSrc": function(json) {
               csrfHash = json[
                    '<?php echo $this->security->get_csrf_token_name(); ?>'];
                return json.data;
            }
        },
         "columns": [
         { "data": "id" },
         { "data": "first_name" },
         { "data": "designation" },
         { "data": "phone" },
         { "data": "email" },
         { "data": "blood_group" },
         { "data": "social_security_number" },
         { "data": "routing_number" },
         { "data": "employee_tax" },
         { "data": "action" },
         ],
        "columnDefs": [{
            "orderable": false,
            "targets": [0, 9],
            searchBuilder: {
                defaultCondition: '='
            },
            "initComplete": function() {
                this.api().columns().every(function() {
                    var column = this;
                    var select = $(
                            '<select><option value=""></option></select>'
                        )
                        .appendTo($(column.footer()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util
                                .escapeRegex(
                                    $(this).val()
                                );
                            column.search(val ? '^' + val + '$' :
                                '', true, false).draw();
                        });
                    column.data().unique().sort().each(function(d, j) {
                        select.append('<option value="' + d +
                            '">' + d + '</option>')
                    });
                });
            },
        }],
        "pageLength": 10,
        "colReorder": true,
        "stateSave": true,

        "stateSaveCallback": function(settings, data) {
            localStorage.setItem('Manage Employee', JSON.stringify(data));
        },
        "stateLoadCallback": function(settings) {
            var savedState = localStorage.getItem('manageemployee');
            return savedState ? JSON.parse(savedState) : null;
        },
        "dom": "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-6'i><'col-sm-6'p>>",
        "buttons": [{
                "extend": "copy",
                "className": "btn-sm",
                "exportOptions": {
                    "columns": ':visible'
                }
            },
            {
                "extend": "csv",
                "title": "Report",
                "className": "btn-sm",
                "exportOptions": {
                    "columns": ':visible'
                }
            },
            {
                "extend": "pdf",
                "title": "Report",
                "className": "btn-sm",
                "exportOptions": {
                    "columns": ':visible'
                }
            },
            {
                "extend": "print",
                "className": "btn-sm",
                "exportOptions": {
                    "columns": ':visible'
                },
            },
            {
               "extend": "colvis",
               "className": "btn-sm"
            }
        ]
    });

});

// Delete Employee List Data - Madhu
function deleteEmployeedata(id) 
{
    var succalert = '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
    
    var failalert = '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>';
    if (id !== "") {
        var confirmDelete = confirm("Are you sure you want to delete this employee?");
    
        if (confirmDelete) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "<?php echo base_url(); ?>chrm/employee_delete",
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': csrfHash, id: id},
                success: function(response) {
                    console.log(response, "response");
                    if (response.status === 'success') {
                        $('.error_display').html(succalert + response.msg + '</div>');
                        window.setTimeout(function() {
                            employeeDataTable.ajax.reload(null, false);
                            $('.error_display').html('');
                        }, 2500);
                    } else {
                        $('.error_display').html(failalert + response.msg + '</div>'); 
                    }
                },
                error: function() {
                    $('.error_display').html(failalert + 'An unexpected error occurred. Please try again.' + '</div>');
                }
            });
        }
    }
}

</script>

<style type="text/css">
.search {
position: relative;
color: #aaa;
font-size: 16px;
}

.search {display: inline-block;}

.search input {
  width: 260px;
  height: 34px;
  background: #fff;
  border: 1px solid #fff;
  border-radius: 5px;
  box-shadow: 0 0 3px #ccc, 0 10px 15px #fff inset;
  color: #000;
}

.search input { text-indent: 32px;}

.search .fa-search { 
  position: absolute;
  top: 8px;
  left: 10px;
}

.search .fa-search {left: auto; right: 10px;}

.btnclr{
    background-color: #424f5c;
    color: #fff;
}

.select2-container{
    display: none !important;
}
.form-control{
    width: 40% !important;
}

.table.dataTable thead th{
    border-bottom: 1px solid #e1e6ef  !important;
}

.table.dataTable tfoot th{
    border-top: 1px solid #e1e6ef  !important;
}

tbody{
    text-align: center !important;
}

.error-border {
    border: 2px solid red;
}
</style>
