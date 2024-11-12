<?php error_reporting(1);  ?>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<link href="<?php echo base_url() ?>assets/css/style.css" rel="stylesheet">

<link rel="stylesheet" type="text/css" href="<?php echo base_url('my-assets/css/css.css')?>" />
<link rel="stylesheet" href="<?php echo base_url('my-assets/css/style.css') ?>">

<link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/bootstrap.min.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/font-awesome.min.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/themify-icons.css'); ?>" />

<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

<style>
.btnclr{
   background-color:<?php echo $setting_detail[0]['button_color']; ?>;
   color: white;
}

label {
   color: #000;
}

.m-3 {
   margin: 10px;
   font-size: 16px;
   font-weight: 700;
   padding: 5px;
   border-radius: 5px;
}

.pro_pic {
   border-radius: 2px solid #000;
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
    width: 110px;
  }
}
</style>

<div class="content-wrapper">
   <section class="content-header">
      <div class="header-icon"><i class="pe-7s-note2"></i></div>
      <div class="header-title">
         <h1>Employee Details</h1>
         <small></small>
         <ol class="breadcrumb">
            <li><a href=""><i class="pe-7s-home"></i> home </a></li>
            <li><a href="#">hrm</a></li>
            <li class="active">Employee Details</li>
         </ol>
      </div>
   </section>
   
   <section class="content">
      <!-- Sales report -->
      <div class="row">
         <div class="col-md-12">
            <a style="float:right;color:white;" href="<?= base_url('Chrm/manage_employee') ?>" class="btnclr btn">
               <i class="ti-align-justify"> </i>Manage Employee
            </a>
         </div>

         <div class="panel panel-bd lobidrag">
            <div class='col-sm-12'>
               <div class="row">
                  <div class="panel panel-bd lobidrag">
                     <div class="panel-body">
                     
                        <?php if(!empty($row[0]['profile_image'])) { ?>                     
                        <div class="col-md-12">
                           <img src="<?= base_url('assets/images/'.$row[0]['profile_image']); ?>" class="pro_pic" alt="Profile Picture" width="100px" height="100px">
                           <br><br>
                        </div>
                        <?php } ?>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">First Name</label>
                                 <span class="form-group"> : <?= $row[0]['first_name']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Middel Name</label>
                                 <span class="form-group"> : <?= $row[0]['middle_name']; ?></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Last Name</label>
                                 <span class="form-group"> : <?= $row[0]['last_name']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Designation</label>
                                 <span class="form-group"> : <?= $row[0]['designation']; ?></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Phone</label>
                                 <span class="form-group"> : <?= $row[0]['phone']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">email</label>
                                 <span class="form-group"> : <?= $row[0]['email']; ?></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">State</label>
                                 <span class="form-group"> : <?= $row[0]['state']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">City</label>
                                 <span class="form-group"> : <?= $row[0]['city']; ?></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Zip code</label>
                                 <span class="form-group"> : <?= $row[0]['zip']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Country</label>
                                 <span class="form-group"> : <?= $row[0]['country']; ?></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Address 1</label>
                                 <span class="form-group"> : <?= $row[0]['address_line_1']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Address 2</label>
                                 <span class="form-group"> : <?= $row[0]['address_line_2']; ?></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Employee Type</label>
                                 <span class="form-group"> : <?= $row[0]['employee_type']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Payroll Type</label>
                                 <span class="form-group"> : <?= $row[0]['payroll_type']; ?></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Bank</label>
                                 <span class="form-group"> : <?= $row[0]['bank_name']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Account Number</label>
                                 <span class="form-group"> : <?= $row[0]['account_number']; ?></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Employee Tax</label>
                                 <span class="form-group"> : <?= $row[0]['employee_tax']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Routing Number</label>
                                 <span class="form-group"> : <?= $row[0]['routing_number']; ?></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                              <p class="bg-warning text-center m-3">Working Location Taxes</p>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">State Tax</label>
                                 <span class="form-group"> : <?= $row[0]['state_tx']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">City Tax</label>
                                 <span class="form-group"> : <?= $row[0]['local_tax']; ?></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Country Tax</label>
                                 <span class="form-group"> : <?= $row[0]['cty_tax']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Other Working Tax</label>
                                 <span class="form-group"> : <?= $row[0]['state_tax_1']; ?></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-12">
                              <p class="bg-warning text-center m-3">Living Location Taxes</p>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">State Tax</label>
                                 <span class="form-group"> : <?= $row[0]['living_state_tax']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">City Tax</label>
                                 <span class="form-group"> : <?= $row[0]['living_local_tax']; ?></span>
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Country Tax</label>
                                 <span class="form-group"> : <?= $row[0]['living_county_tax']; ?></span>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="" class="col-md-4">Other Living Tax</label>
                                 <span class="form-group"> : <?= $row[0]['edit_living_other']; ?></span>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
            </div>

         </div>
      </div>
                   
   </section>
</div>

 

 