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
            localStorage.setItem('manageemployee', JSON.stringify(data));
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
                    "columns": ':not(:eq(9))'
                }
            },
            {
                "extend": "csv",
                "text": "Excel",
                "title": "Manage Employee",
                "className": "btn-sm",
                "exportOptions": {
                    "columns": ':not(:eq(9))'
                }
            },
            {
                "extend": "print",
                "className": "btn-sm",
                "exportOptions": {
                    "columns": ':not(:eq(9))'
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

<div class="modal fade" id="designation_modal" role="dialog">
<div class="modal-dialog" role="document" style="margin-right: 900px;">
<div class="modal-content" style="width: 1200px;text-align:center;">
<div class="modal-header btnclr" >
<a href="#" class="close" data-dismiss="modal">&times;</a>
<h4 class="modal-title"><?php echo ('Form instructions') ?></h4>
</div>
<div class="modal-body">
<div id="customeMessage" class="alert hide"></div>
<form id="add_designation" method="post">
<div class="panel-body">
<input type ="hidden" name="csrf_test_name" id="" value="<?php echo $this->security->get_csrf_hash();?>">
<div class="form-group row">
<section class="content content_instuc" id="instuc_p1"> 
<!-- form instructions -->
<div class="row">
<div class="col-sm-12">
<div class="panel panel-bd lobidrag">
<div class="panel-body">
<div class="instuc_text row">
<div class="col-md-6">
<h3>General Instruction</h3>
<p>Section references are to the Internal Revenue Code.</p>
<div class="para-text">
<h4>Future Developments</h4>
<p>For the latest information about developments related to 
Form W-4, such as legislation enacted after it was published, 
go to www.irs.gov/FormW4</p>
<h4>Purpose of Form</h4>
<p>Complete Form W-4 so that your employer can withhold the 
correct federal income tax from your pay. If too little is 
withheld, you will generally owe tax when you file your tax 
return and may owe a penalty. If too much is withheld, you 
will generally be due a refund. Complete a new Form W-4 
when changes to your personal or financial situation would 
change the entries on the form. For more information on 
withholding and when you must furnish a new Form W-4, 
see Pub. 505, Tax Withholding and Estimated Tax. </p>
<p><strong>Exemption from withholding. </strong>You may claim exemption 
from withholding for 2022 if you meet both of the following 
conditions: you had no federal income tax liability in 2021 
and you expect to have no federal income tax liability in 
2022. You had no federal income tax liability in 2021 if (1) 
your total tax on line 24 on your 2021 Form 1040 or 1040-SR 
is zero (or less than the sum of lines 27a, 28, 29, and 30), or 
(2) you were not required to file a return because your 
income was below the filing threshold for your correct filing 
status. If you claim exemption, you will have no income tax 
withheld from your paycheck and may owe taxes and 
penalties when you file your 2022 tax return. To claim 
exemption from withholding, certify that you meet both of 
the conditions above by writing “Exempt” on Form W-4 in 
the space below Step 4(c). Then, complete Steps 1(a), 1(b), 
and 5. Do not complete any other steps. You will need to 
submit a new Form W-4 by February 15, 2023.</p>
<p></strong>Your privacy.</strong> If you prefer to limit information provided in 
Steps 2 through 4, use the online estimator, which will also 
increase accuracy.</p>
<p>As an alternative to the estimator: if you have concerns 
with Step 2(c), you may choose Step 2(b); if you have 
concerns with Step 4(a), you may enter an additional amount 
you want withheld per pay period in Step 4(c). If this is the 
only job in your household, you may instead check the box 
in Step 2(c), which will increase your withholding and 
significantly reduce your paycheck (often by thousands of 
dollars over the year).</p>
<p><strong>When to use the estimator.</strong> Consider using the estimator at
www.irs.gov/W4App if you:</p>
<ol>
<li> Expect to work only part of the year;</li>
<li>Have dividend or capital gain income, or are subject to 
additional taxes, such as Additional Medicare Tax;</li>
<li> Have self-employment income (see below); or</li>
<li>Prefer the most accurate withholding for multiple job 
situations</li>
</ol>
<p><strong>Self-employment. </strong>Generally, you will owe both income and 
self-employment taxes on any self-employment income you 
receive separate from the wages you receive as an 
employee. If you want to pay these taxes through 
withholding from your wages, use the estimator at 
www.irs.gov/W4App to figure the amount to have withheld.</p>
<p><strong>Nonresident alien.</strong> If you’re a nonresident alien, see Notice 
1392, Supplemental Form W-4 Instructions for Nonresident 
Aliens, before completing this form.</p>
</div>
</div>
<div class="col-md-6">
<h3>Specific Instructions</h3>
<div class="para-text">
<p><strong>Step 1(c). </strong>Check your anticipated filing status. This will 
determine the standard deduction and tax rates used to 
compute your withholding.</p>
<p></strong>Step 2.</strong> Use this step if you (1) have more than one job at the 
same time, or (2) are married filing jointly and you and your 
spouse both work.</p>
<p>Option <b>(a)</b> most accurately calculates the additional tax 
you need to have withheld, while option <b>(b)</b> does so with a 
little less accuracy. </p>
<p>If you (and your spouse) have a total of only two jobs, you 
may instead check the box in option (c). The box must also 
be checked on the Form W-4 for the other job. If the box is 
checked, the standard deduction and tax brackets will be 
cut in half for each job to calculate withholding. This option 
is roughly accurate for jobs with similar pay; otherwise, more 
tax than necessary may be withheld, and this extra amount 
will be larger the greater the difference in pay is between the 
two jobs</p>
<img src="" alt="">
<p><strong>Multiple jobs.</strong> Complete Steps 3 through 4(b) on only 
one Form W-4. Withholding will be most accurate if 
you do this on the Form W-4 for the highest paying job.</p>
<p><strong>Step 3.</strong> This step provides instructions for determining the 
amount of the child tax credit and the credit for other 
dependents that you may be able to claim when you file your 
tax return. To qualify for the child tax credit, the child must 
be under age 17 as of December 31, must be your 
dependent who generally lives with you for more than half 
the year, and must have the required social security number. 
You may be able to claim a credit for other dependents for 
whom a child tax credit can’t be claimed, such as an older 
child or a qualifying relative. For additional eligibility 
requirements for these credits, see Pub. 501, Dependents, 
Standard Deduction, and Filing Information. You can also 
include other tax credits for which you are eligible in this 
step, such as the foreign tax credit and the education tax 
credits. To do so, add an estimate of the amount for the year 
to your credits for dependents and enter the total amount in 
Step 3. Including these credits will increase your paycheck 
and reduce the amount of any refund you may receive when 
you file your tax return.</p>
<strong>Step 4 (optional).</strong>
<p><strong>Step 4(a).</strong> Enter in this step the total of your other 
estimated income for the year, if any. You shouldn’t include 
income from any jobs or self-employment. If you complete 
Step 4(a), you likely won’t have to make estimated tax 
payments for that income. If you prefer to pay estimated tax 
rather than having tax on other income withheld from your 
paycheck, see Form 1040-ES, Estimated Tax for Individuals.</p>
<p></strong>Step 4(b). </strong>Enter in this step the amount from the 
Deductions Worksheet, line 5, if you expect to claim 
deductions other than the basic standard deduction on your 
2022 tax return and want to reduce your withholding to 
account for these deductions. This includes both itemized 
deductions and other deductions such as for student loan 
interest and IRAs</p>
<p><strong>Step 4(c). </strong>Enter in this step any additional tax you want 
withheld from your pay each pay period, including any 
amounts from the Multiple Jobs Worksheet, line 4. Entering 
an amount here will reduce your paycheck and will either 
increase your refund or reduce any amount of tax that you 
owe</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<section class="content content_instuc" id="instuc_p2">
<!-- form instructions -->
<div class="row">
<div class="col-sm-12">
<div class="panel panel-bd lobidrag">
<!-- <div class="panel-heading">
   <div class="panel-title">
   
       <h4>Form instructions</h4>
   
   </div>
   
   </div> -->
<div class="panel-body">
<h4 class="instuc_title">Step 2(b)—Multiple Jobs Worksheet<span> (Keep for your records.)</span></h4>
<div class="instru-text">
<p>If you choose the option in Step 2(b) on Form W-4, complete this worksheet (which calculates the total extra tax for all jobs) on only ONE
Form W-4. Withholding will be most accurate if you complete the worksheet and enter the result on the Form W-4 for the highest paying job</p>
<p><strong>Note: </strong>If more than one job has annual wages of more than $120,000 or there are more than three jobs, see Pub. 505 for additional 
tables; or, you can use the online withholding estimator at www.irs.gov/W4App.</p>
<div class="wagesList">
<ol>
<div class="w_price2">
<li>Two jobs. If you have two jobs or you’re married filing jointly and you and your spouse each have one
job, find the amount from the appropriate table on page 4. Using the “Higher Paying Job” row and the
“Lower Paying Job” column, find the value at the intersection of the two household salaries and enter 
that value on line 1. Then, skip to line 3 . . . . . . . . . . . . . . . . . . . . .</li>
<form>
<label for="price">1</label>
<input type="text" id="wages_price" name="price" placeholder="$">
</form>
</div>
<br>
<li>Three jobs. If you and/or your spouse have three jobs at the same time, complete lines 2a, 2b, and 
2c below. Otherwise, skip to line 3.</li>
<br>
<ol type="a">
<div class="w_price2">
<li>Find the amount from the appropriate table on page 4 using the annual wages from the highest 
paying job in the “Higher Paying Job” row and the annual wages for your next highest paying job
in the “Lower Paying Job” column. Find the value at the intersection of the two household salaries 
and enter that value on line 2a . . . . . . . . . . . . . . . . . . . . . . . </li>
<form>
<label for="price">2a</label>
<input type="text" id="wages_price" name="price" placeholder="$">
</form>
</div>
<br>
<div class="w_price2">
<li>Find the amount from the appropriate table on page 4 using the annual wages from the highest 
paying job in the “Higher Paying Job” row and the annual wages for your next highest paying job
in the “Lower Paying Job” column. Find the value at the intersection of the two household salaries 
and enter that value on line 2a . . . . . . . . . . . . . . . . . . . . . . . </li>
<form>
<label for="price">2b</label>
<input type="text" id="wages_price" name="price" placeholder="$">
</form>
</div>
<br>
<div class="w_price2">
<li>Find the amount from the appropriate table on page 4 using the annual wages from the highest 
paying job in the “Higher Paying Job” row and the annual wages for your next highest paying job
in the “Lower Paying Job” column. Find the value at the intersection of the two household salaries 
and enter that value on line 2a . . . . . . . . . . . . . . . . . . . . . . . </li>
<form>
<label for="price">2c</label>
<input type="text" id="wages_price" name="price" placeholder="$">
</form>
</div>
<br>
</ol>
<div class="w_price2">
<li>Find the amount from the appropriate table on page 4 using the annual wages from the highest 
paying job in the “Higher Paying Job” row and the annual wages for your next highest paying job
in the “Lower Paying Job” column. Find the value at the intersection of the two household salaries 
and enter that value on line 2a . . . . . . . . . . . . . . . . . . . . . . . </li>
<form>
<label for="price">3</label>
<input type="text" id="wages_price" name="price" placeholder="$">
</form>
</div>
<br>
<div class="w_price2">
<li>Find the amount from the appropriate table on page 4 using the annual wages from the highest 
paying job in the “Higher Paying Job” row and the annual wages for your next highest paying job
in the “Lower Paying Job” column. Find the value at the intersection of the two household salaries 
and enter that value on line 2a . . . . . . . . . . . . . . . . . . . . . . . </li>
<form>
<label for="price">4</label>
<input type="text" id="wages_price" name="price" placeholder="$">
</form>
</div>
<br>
</ol>
</div>
</div>
</div>
<div class="panel-body">
<h4 class="instuc_title">Step 4(b)—Deductions Worksheet<span> (Keep for your records.)</span></h4>
<div class="instru-text">
<div class="wagesList">
<ol>
<div class="w_price2">
<li>Enter an estimate of your 2022 itemized deductions (from Schedule A (Form 1040)). Such deductions
may include qualifying home mortgage interest, charitable contributions, state and local taxes (up to 
$10,000), and medical expenses in excess of 7.5% of your income . . . . . . . . . . . . </li>
<form>
<label for="price">1</label>
<input type="text" id="wages_price" name="price" placeholder="$">
</form>
</div>
<br>
<div class="w_price2">
<li>If line 1 is greater than line 2, subtract line 2 from line 1 and enter the result here. If line 2 is greater 
than line 1, enter “-0-” . . . . . . . . . . . . . . . . . . . . . . . . . . </li>
<form>
<label for="price">2</label>
<input type="text" id="wages_price" name="price" placeholder="$">
</form>
</div>
<br>
<div class="w_price2">
<li>Enter an estimate of your student loan interest, deductible IRA contributions, and certain other 
adjustments (from Part II of Schedule 1 (Form 1040)). See Pub. 505 for more information . . . . </li>
<form>
<label for="price">3</label>
<input type="text" id="wages_price" name="price" placeholder="$">
</form>
</div>
<br>
<div class="w_price2">
<li>Add lines 3 and 4. Enter the result here and in Step 4(b) of Form W-4 . . . . . . . . . . .</li>
<form>
<label for="price">4</label>
<input type="text" id="wages_price" name="price" placeholder="$">
</form>
</div>
<br>
</ol>
</div>
</div>
<div class="instruc_bottom2">
<div class="col-md-6">
<p><strong>Privacy Act and Paperwork Reduction Act Notice.</strong> We ask for the information 
on this form to carry out the Internal Revenue laws of the United States. Internal 
Revenue Code sections 3402(f)(2) and 6109 and their regulations require you to 
provide this information; your employer uses it to determine your federal income 
tax withholding. Failure to provide a properly completed form will result in your 
being treated as a single person with no other entries on the form; providing 
fraudulent information may subject you to penalties. Routine uses of this 
information include giving it to the Department of Justice for civil and criminal 
litigation; to cities, states, the District of Columbia, and U.S. commonwealths and 
possessions for use in administering their tax laws; and to the Department of 
Health and Human Services for use in the National Directory of New Hires. We 
may also disclose this information to other countries under a tax treaty, to federal 
and state agencies to enforce federal nontax criminal laws, or to federal law 
enforcement and intelligence agencies to combat terrorism.</p>
</div>
<div class="col-md-6">
<p>You are not required to provide the information requested on a form that is 
subject to the Paperwork Reduction Act unless the form displays a valid OMB 
control number. Books or records relating to a form or its instructions must be 
retained as long as their contents may become material in the administration of 
any Internal Revenue law. Generally, tax returns and return information are 
confidential, as required by Code section 6103.</p> 
<p>The average time and expenses required to complete and file this form will vary 
depending on individual circumstances. For estimated averages, see the 
instructions for your income tax return.</p>
<p>If you have suggestions for making this form simpler, we would be happy to hear 
from you. See the instructions for your income tax return.</p>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
</div>
</div>
</div>
<div class="modal-footer">
<a href="#" class="btn btnclr" style="color:white;" data-dismiss="modal"><?php echo display('Close') ?> </a>
</div>
</form>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
