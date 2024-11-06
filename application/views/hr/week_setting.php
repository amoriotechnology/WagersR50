
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url()?>my-assets/css/css.css" />
<?php  error_reporting(1); ?>
<!-- Manage Invoice Start -->
<style>
table.table.table-hover.table-borderless td {
   border: 0;
}
.select2{
   display:none;
}

.btnclr{
   background-color:<?= $setting_detail[0]['button_color']; ?>;
   color: white;
}

.logo-9 i{
   font-size:80px;
   position:absolute;
   z-index:0;
   text-align:center;
   width:100%;
   left:0;
   top:-10px;
   color:#34495e;
   -webkit-animation:ring 2s ease infinite;
   animation:ring 2s ease infinite;
}

.logo-9 h1{
   font-family: 'Lora', serif;
   font-weight:600;
   text-transform:uppercase;
   font-size:40px;
   position:relative;
   z-index:1;
   color:#e74c3c;
   text-shadow: 3px 3px 0 #fff, -3px -3px 0 #fff, 3px -3px 0 #fff, -3px 3px 0 #fff;
}
   
.logo-9{
   position:relative;
} 
   
/*//side*/
.bar {
  float: left;
  width: 25px;
  height: 3px;
  border-radius: 4px;
  background-color: #4b9cdb;
}


.load-10 .bar {
  animation: loadingJ 2s cubic-bezier(0.17, 0.37, 0.43, 0.67) infinite;
}


@keyframes loadingJ {
  0%,
  100% {
   transform: translate(0, 0);
  }

  50% {
   transform: translate(80px, 0);
   background-color: #f5634a;
   width: 120px;
  }
}

tr.noBorder td {
   border: 0;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
   border-top:none;
}

.bg-success {
    background-color: green;
}
</style>
 

<div class="content-wrapper">
   <section class="content-header">
      <div class="header-icon">
        <figure class="one">
            <img src="<?= base_url()  ?>asset/images/taxes.png"  class="headshotphoto" style="height:50px;" />
        </figure>
      </div>
      
      <div class="header-title">
        <div class="logo-holder logo-9"><h1>Week Setting</h1></div>
 
       <small></small>
         <ol class="breadcrumb" style="border: 3px solid #d7d4d6;">
         <li><a href="#"><i class="pe-7s-home"></i> <?= display('home') ?></a></li>
            <li><a href="#">HRM</a></li>
            <li class="active" style="color:orange">Week Setting</li>
         </ol>
      </div>
   </section>

 
   <section class="content">
      <!-- Alert Message -->
      <?php
         $message = $this->session->userdata('message');
         if (isset($message)) { ?>
      <div class="alert alert-info alert-dismissable" style="color:white;background-color:#38469f;">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <?= $message ?>                    
      </div>

      <?php
         $this->session->unset_userdata('message'); }
         $error_message = $this->session->userdata('error_message');
         if (isset($error_message)) { ?>
      <div class="alert alert-danger alert-dismissable" style="color:white;background-color:#38469f;">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <?= $error_message ?>                    
      </div>
      <?php $this->session->unset_userdata('error_message'); } ?>
      <!-- date between search -->

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default" style="border:3px solid #d7d4d6;" >
                    <div class="panel-body">
                        <div class="row">
                            <form action="<?= base_url('Chrm/save_week_setting'); ?>" method="post">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>" />
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="start_week">Start Week</label>
                                            <select name="start_week" id="start_week" class="form-control" required>
                                            <?php
                                                $weeks = [0 => 'Sunday', 1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thusday', 5 => 'Friday', 6 => 'Saturday'];
                                                foreach($weeks as $week) {
                                            ?>
                                                <option value="<?= $week ?>" <?= (!empty($setting_detail[0]['start_week']) && ($setting_detail[0]['start_week'] == $week)) ? 'selected' : ''; ?>><?= $week; ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="end_week">End Week</label>
                                            <select name="end_week" id="end_week" class="form-control" required>
                                            <?php foreach($weeks as $week) { ?>
                                                <option value="<?= $week ?>" <?= (!empty($setting_detail[0]['end_week']) && ($setting_detail[0]['end_week'] == $week)) ? 'selected' : ''; ?>><?= $week; ?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group mt-4">
                                            <br>
                                            <button type="submit" name="submit" class="btn btn-primary mt-4">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-default" style="border:3px solid #d7d4d6;" >
               <div class="panel-body">
                  <div class="row">
                     <h3 class="col-sm-3" style="margin: 0;">Week Setting</h3>
                     <div class="col-sm-9 text-right"></div>
                     <br>

                     <div class="col-sm-12">
                        <div class="panel panel-bd lobidrag" >
                           <div class="panel-body">
                              <div class="table-responsive" >
                                <table class="table table-hover table-bordered" cellspacing="0" width="100%" id="">
                                    <thead>
                                        <tr style="height:25px;">
                                            <th class='btnclr'>SL</th>
                                            <th class='btnclr' class="text-center">Start Week</th>
                                            <th class='btnclr' class="text-center">End Week</th>
                                            <th class='btnclr' class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-center">
                                            <td>1</td>
                                            <td><?= (!empty($setting_detail[0]['start_week'])) ? $setting_detail[0]['start_week'] : ''; ?></td>
                                            <td><?= (!empty($setting_detail[0]['end_week'])) ?  $setting_detail[0]['end_week'] : ''; ?></td>
                                            <td><?= (!empty($setting_detail[0]['start_week']) && !empty($setting_detail[0]['end_week'])) ? '<span class="badge bg-success">Active</span>' : ''; ?> </td>
                                        </tr>
                                    </tbody>
                                </table>
                              </div>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
         </div>
      </div>

<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
   var csrfName = "<?= $this->security->get_csrf_token_name();?>";
   var csrfHash = "<?= $this->security->get_csrf_hash();?>";
   
   $(document).ready(function(){
     $(".federal_tax").click(function(){
       var tax = $(this).closest('tr').find('#federal_tax').val();
       $.ajax({
           type: "POST",
           url: '<?= base_url(); ?>Chrm/add_taxes_detail',
           data: {<?= $this->security->get_csrf_token_name();?>: csrfHash,tax:tax},
           success:function(data) {    
                location.reload(); 
           },
           error: function (){ }
       })
     });

      $(".delete_item").click(function(){
        var tax = $(this).closest('tr').find('td.tax_value').text();
        var state = $(this).closest('tr').find('td.state_name').text();
        var dataString = {
            tax : tax,
            state : state
        };
        dataString[csrfName] = csrfHash;
        $.ajax({
            type: "POST",
            url: "<?= base_url(); ?>Chrm/delete_tax",
            data: {<?= $this->security->get_csrf_token_name();?>: csrfHash,tax:tax,state:state},
            success:function(data) {     
            location.reload();
            },
            error: function (){ }
        });
     });
   });


function downloadPDF() {
    var pdfPath = '<?= base_url('assets/payrollform/fw3/fw3.pdf') ?>';
    var downloadLink = document.createElement('a');
    downloadLink.href = pdfPath;
    downloadLink.download = 'W3form.pdf';
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
}

</script>