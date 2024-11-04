<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/calanderstyle.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<div class="content-wrapper">
   <section class="content-header" style="height: 60px;">
      <div class="header-icon">
         <figure class="one">
            <img src="<?php echo base_url() ?>asset/images/salesreport.png" class="headshotphoto" style="height:50px;" />
         </figure>
      </div>
      <div class="header-title">
         <div class="logo-holder logo-9">
         <h1><?php echo ('Logs'); ?></h1>
         </div>
            <ol class="breadcrumb" style=" border: 3px solid #d7d4d6;" >
               <li><a href="<?php echo base_url()?>"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
               <li class="active" style="color:orange"><?php echo 'Logs';?></li>
            <div class="load-wrapp">
               <div class="load-10">
                  <div class="bar"></div>
               </div>
            </div>
         </ol>
      </div>
   </section>
   <section class="content">
      <div class="panel panel-bd lobidrag">
         <div class="panel-heading" style="height: 60px;border: 3px solid #D7D4D6;">
            <div class="col-sm-12">
                <div class="col-md-6 col-sm-6" style="display: flex; justify-content: center; align-items: center;">
                    <label>Status</label>&nbsp;&nbsp;&nbsp;
                    <div class="custom-select status_name">
                         <div class="select-selected">Select Status</div>
                         <div class="select-items">
                             <div data-value="All">All</div>
                             <div data-value="Add"><i class="fa-solid fa-check text-success"></i>&nbsp; Add</div>
                             <div data-value="Update"><i class="fa-solid fa-pen text-warning"></i>&nbsp; Edit</div>
                             <div data-value="Delete"><i class="fa-solid fa-xmark text-danger"></i>&nbsp; Delete</div>
                         </div>
                     </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="search">
                      <span class="fa fa-search"></span>
                      <input class="daterangepicker_field dateSearch" name="daterangepicker-field" autocomplete="off" id="daterangepicker-field" placeholder="Search...">
                    </div>
                    <input type="button" id="searchtrans" name="btnSave" class="btn btnclr" value="Search" style="margin-bottom: 5px; margin-left: 10px;"/>
                </div>
            </div>   
         </div>
         <div class="row">
            <div class="col-sm-12">
               <div class="error_display mb-2"></div>
               <div class="panel panel-bd lobidrag">
                  <div class="panel-body" style="border: 3px solid #D7D4D6;">
                     <table class="table table-bordered" cellspacing="0" width="100%" id="log_list">
                        <thead>
                           <tr class="btnclr">
                            <th class="text-center">S.No</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">Time</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Module</th>
                            <th class="text-center">Actions</th>
                            <th class="text-center">Details</th>
                           </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script type="text/javascript">
var logDataTable;
$(document).ready(function() {
$(".sidebar-mini").addClass('sidebar-collapse') ;
    if ($.fn.DataTable.isDataTable('#log_list')) {
        $('#log_list').DataTable().clear().destroy();
    }
    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
    logDataTable = $('#log_list').DataTable({
        "processing": true,
        "serverSide": true,
        "lengthMenu": [
            [10, 25, 50, 100],
            [10, 25, 50, 100]
        ],
        "ajax": {
            "url": "<?php echo base_url('Chrm/logIndexData?id='); ?>" +
                encodeURIComponent('<?php echo $_GET['id']; ?>'),
            "type": "POST",
            "data": function(d) {
                d['<?php echo $this->security->get_csrf_token_name(); ?>'] =
                    '<?php echo $this->security->get_csrf_hash(); ?>';
                d.status_name = $('.custom-select').data('selected-value');
                d['date_search'] = $('#daterangepicker-field').val();
            },
            "dataSrc": function(json) {
               csrfHash = json[
                    '<?php echo $this->security->get_csrf_token_name(); ?>'];
                return json.data;
            }
        },
         "columns": [
         {
            "data": "id",
               "render": function(data, type, row) {
               return '<i class="fa fa-caret-right"></i> ' + data; 
            }
         },
         { "data": "c_date" },
         { "data": "c_time" },
         { "data": "username" },
         { "data": "module" },
         { "data": "user_actions" },
         { "data": "details" }
         ],
        "columnDefs": [{
            "orderable": false,
            "targets": [0, 6],
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
            localStorage.setItem('logs', JSON.stringify(data));
        },
        "stateLoadCallback": function(settings) {
            var savedState = localStorage.getItem('logs');
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
                "text": "Excel",
                "title": "Logs",
                "className": "btn-sm",
                "exportOptions": {
                    "columns": ':visible'
                }
            },
            {
               "extend": "colvis",
               "className": "btn-sm"
            }
        ]
    });

    $('#log_list tbody').on('click', 'tr', function() {
        var accordionRow = $(this).next('.accordion-row');
        if (accordionRow.length) {
            accordionRow.toggle(); // Toggle the accordion row
        } else {
            var data = logDataTable.row(this).data(); 
            var detailsHtml = `
                <tr class="accordion-row">
                  <td colspan="7">
                     <div class="row">
                        <div class="col-md-3" style="display: flex; justify-content: center">
                           <strong>Browser / IP Address:</strong>&nbsp;
                           <p>${data.user_platform} (${data.user_ipaddress})</p>
                        </div>
                        <div class="col-md-3" style="display: flex; justify-content: center">
                           <strong>Platform:</strong>&nbsp;
                           <p>${data.user_browser}</p>
                        </div>
                        <div class="col-md-6" style="display: flex; justify-content: start">
                           <strong>Information:</strong>&nbsp;
                           <p> ${data.details || ''} ${data.field_id && data.field_id !== '0' ? ' | <strong>' + data.field_id + '</strong>' : ''} ${data.hint ? ' | <strong>' + data.hint + '</strong>' : ''} </p>
                        </div>
                     </div>
                  </td>
               </tr>
            `;
            $(this).after(detailsHtml);
        }
    });
    
      $('.custom-select .select-items div').on('click', function() {
         const selectedValue = $(this).data('value');
         $('.custom-select .select-selected').text(selectedValue);
         $('.custom-select').data('selected-value', selectedValue);
         logDataTable.ajax.reload();
      });
    $('#searchtrans').on('click', function() {

        var dateValue = $('.dateSearch').val();

        if (dateValue === '') {
            toastr.error('Please select a date before searching.', 'Error');
            $('.dateSearch').addClass('error-border');
            return; 
        }
        toastr.clear();
        $('.dateSearch').removeClass('error-border');
        logDataTable.draw();
    });
});


 document.querySelector('.select-selected').addEventListener('click', function() {
        this.nextElementSibling.classList.toggle('show');
    });

    document.querySelectorAll('.select-items div').forEach(item => {
        item.addEventListener('click', function() {
            const selected = this.parentNode.previousElementSibling;
            selected.textContent = this.textContent;
            selected.dataset.value = this.dataset.value;
            this.parentNode.classList.remove('show');
        });
    });

    window.onclick = function(event) {
        if (!event.target.matches('.select-selected')) {
            document.querySelector('.select-items').classList.remove('show');
        }
    };

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

.text-success{
   color: green !important;
}
.changealign{
   position: relative;
   left: 64px;
}

 .custom-select {
      position: relative;
      cursor: pointer;
      width: 170px;
    height: 34px;
    background: #fff;
    border: 1px solid #fff;
    border-radius: 5px;
    color: #000;
    border-radius: 5px;
    bottom: 4px !important;
  }
  .select-selected {
      background-color: #fff;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
  }
  .select-items {
      position: absolute;
      background-color: white;
      border: 1px solid #ccc;
      display: none;
      width: 100%;
      z-index: 99;
  }
  .select-items div {
      padding: 10px;
      cursor: pointer;
  }
  .select-items div:hover {
      background-color: #ddd;
  }
</style>
