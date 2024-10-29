<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Timesheet Invoice</title>
<style>
@page { 
    margin: 0px 10px; /* Adjust margins to accommodate header and footer */
}
body { 
    font-family: Arial, sans-serif; 
    margin-top: 120px;
    padding: 0;
}
header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    height: 90px;
    text-align: center;
    line-height: 20px;
    font-size: 18px;
    background-color: #fff;
    border-bottom: 1px solid #ccc;
    z-index: 1000;
    padding-top: 20px;
    width: 100%;
    box-sizing: border-box;
}
footer { position: fixed; left: 0px; right: 0px; height: 80px;text-align: center; line-height: 20px; font-size: 12px;}
.pagebreak { page-break-after: always; }
.pagebreak:last-child { page-break-after: never; }
.header-table { 
    margin-top: 100px; /* Ensure content starts below the header */
    font-size: 11px !important; 
}
table { 
    font-size: 11px ; 
    border-collapse: collapse; 
    width: 95%; 
    margin-bottom: 15px;
    margin-left:20px
}
.mainTable th, .mainTable td { 
    border: 1px solid black; 
    padding: 10px; 
    text-align: left; 
    margin-top:50px;
}
.invoice-summary th, .invoice-summary td { 
    text-align: center; 
    border: 1px solid darkgray; 
    height:27px;
}
.brand-section { 
    margin-top: 20px; 
}
.brand-section img { 
    max-width: 100%; 
    height: auto; 
}
.company-info, .bill-to { 
    margin-bottom: 15px; 
}
.company-info b, .bill-to b { 
    display: block; 
    margin-bottom: 3px; 
}
.content {
    page-break-inside: avoid; /* Prevent page breaks inside the content */
    padding-bottom: 5px; /* Ensure content does not overlap footer */
}
.emp_tbl > tr > th {
    width: 20%;
    text-align: left;
    color: #fff;
    background-color: gray;
}
</style>
</head>

<body>
<?php 
    $logoPath =  $logo;

    if (file_exists($logoPath)) {
        $logo = base64_encode(file_get_contents($logoPath));
    } else {
        $logo = '';
    }
?>

<header>
    <div class="brand-section">
    <div class="row" >
        <div class="col-sm-3" style="color:black;font-weight:bold;margin-right:670px;margin-left:15px;">
            <img src="data:image/png;base64,<?= htmlspecialchars($logo, ENT_QUOTES, 'UTF-8'); ?>" alt="Logo">
        </div>
        <div class="col-sm-2" style="color:black;font-weight:bold;margin-top:-85px">
            <h3 style="text-align: center;font-weight:bold;" >Employee <?= ($type == "emp_data") ? 'Detail' : 'Timesheet'; ?></h3>
        </div>
        <div class="col-sm-6" style="text-align:left;margin-left:550px; margin-top:-85px; font-size:15px;" >
            <b> <?php if($type == 'timesheet') { echo "Date : </b> &nbsp;". $sheet_date; } ?>
        </div>
    </div>
    </div>
</header>  

<footer></footer> 

<div class="container-fluid">
    <div class="subpage" id="editor-container">
        <div class="brand-section content">
            <div class="row">
                <div class="col-sm-6" style="color:black; font-size:12px;">
                    <div class="col-sm-8" style="margin-left:25px;">
                    <!-- <b><span style="font-weight:bold;">Company Information</span><br>  -->
                    <span style="font-weight:1;"><b>Company Name :</b> <?= $company_name; ?></span><br>
                    <span style="font-weight:1;"><b>Address :</b> <?= $address; ?><br>
                    <span style="font-weight:1;"><b>Email :</b> <?= $com_email; ?><br>
                    <span style="font-weight:1;"><b>Phone :</b> <?= $com_phone; ?><br>
                    </div>
                </div>
                <?php if($type != 'emp_data') { ?>
                    <div class="col-sm-5" style="margin-left:550px;margin-top:-95px; font-size:12px;">
                        <b><span style="font-weight:bold;"> Name : <?= $first_name.' '.$last_name; ?></span><br> 
                        <span style="font-weight:1;"> Job Title :  <?= $designation; ?><br>
                        <span style="font-weight:1;"> Payroll Type : <?= $payroll_type; ?><br>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<br>    
<hr style="color:white; margin-top:10px">

<div class="pagebreak">
<?php if($type == 'emp_data') { ?>

    <table class="mainTable">
        <tbody class="emp_tbl">
            <tr>
                <th>Name</th>
                <td> <?= $emp_datas[0]['first_name']; ?> </td>
            </tr>
            <tr>
                <th>Phone</th>
                <td> <?= $emp_datas[0]['phone']; ?> </td>
            </tr>
            <tr>
                <th>Email</th>
                <td> <?= $emp_datas[0]['email']; ?> </td>
            </tr>
            <tr>
                <th>Country</th>
                <td> <?= $emp_datas[0]['country']; ?> </td>
            </tr>
            <tr>
                <th>City</th>
                <td> <?= $emp_datas[0]['city']; ?> </td>
            </tr>
            <tr>
                <th>Zipcode</th>
                <td> <?= $emp_datas[0]['zipcode']; ?> </td>
            </tr>
            <tr>
                <th>Designation</th>
                <td> <?= $emp_datas[0]['designation']; ?> </td>
            </tr>
            <tr>
                <th>Rate Type</th>
                <td> <?= $emp_datas[0]['rate_type']; ?> </td>
            </tr>
            <tr>
                <th>Houre Rate/Salary</th>
                <td> <?= $emp_datas[0]['hrate']; ?> </td>
            </tr>
        </tbody>
    </table>

<?php } else { ?>
   <table class="mainTable">
        <thead style="background-color: #424f5c;">
            <tr style="color:white;text-align:center;">
                <th style="text-align:center; color:white;">Date</th>
                <th style="text-align:center; color:white;" >Day</th>
                <th style="text-align:center; color:white;">Daily Break in mins</th>
                <th style="text-align:center; color:white;">Start Time (HH:MM)</th>
                <th style="text-align:center; color:white;">End Time (HH:MM)</th>
                <th style="text-align:center; color:white;">Hours</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(!empty($timesheet_data[0]['Date'])) {
            foreach ($timesheet_data as $row) { 
                $date = str_replace(['/'], '-', $row['Date']);
                echo '<tr style="color: black;">
                <td style="text-align:center;">' . date('m/d/Y', strtotime($date)) . '</td>
                <td style="text-align:center;">' . $row['Day'] . '</td>
                <td style="text-align:center;">' . $row['daily_break'] . '</td>
                <td style="text-align:center;">' . $row['time_start'] . '</td>
                <td style="text-align:center;">' . $row['time_end'] . '</td>
                <td style="text-align:center;">' . $row['hours_per_day'] . '</td>
                </tr>';    
            } }
            ?>
        </tbody>
        <tfoot>
            <tr style="color: black;">
                <td colspan="5" style="text-align: right;"><b><?= display('TOTAL'); ?> :</b></td>
                <td style="text-align: center;">
                    <input type="text" name="total[]" value="<?= $currency . "" .  $total_hours; ?>" style="border: none;" readonly />
                </td>
            </tr>
        </tfoot>
    </table>
    <br>
    <br>
    <table class="mainTable">
        <thead style="background-color: #424f5c;">
            <tr style="color:white;text-align:center;">
                <th style="text-align:center; color:white;">Administrator Name</th>
                <th style="text-align:center; color:white;">Payment Method</th>
                <th style="text-align:center; color:white;">Cheque No</th>
                <th style="text-align:center; color:white;">Payment Date</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="text-align:center;"><?= $admin_name; ?></td>
                <td style="text-align:center;"><?= $payment_method; ?></td>
                <td style="text-align:center;"><?= $cheque_no; ?></td>
                <td style="text-align:center;"><?= $cheque_date; ?></td>
            </tr>
        </tbody>
    </table>
<?php } ?>
</div>
</body>
</html>
