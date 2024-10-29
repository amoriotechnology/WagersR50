<?php error_reporting(1); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<div class="content-wrapper">
    <section class="content-header">
        <div class="header-icon"> <i class="pe-7s-note2"></i> </div>
        <div class="header-title">
            <h1>Add  User</h1> <small></small>
            <ol class="breadcrumb">
                <li><a href="index.html"><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>
                <li><a href="#"> <?php echo display('web_settings') ?> </a></li>
                <li class="active" style="color:orange;">Add Admin</li>
            </ol>
        </div>
    </section>

<style>
.select2 {
    display: none;
}
</style>


<section class="content">
<!-- Alert Message -->
<?php
$message = $this->session->userdata('message');
if (isset($message)) {
?>
<div class="alert alert-info alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <?php echo $message ?>
</div>
<?php 
$this->session->unset_userdata('message');
}
$error_message = $this->session->userdata('error_message');
if (isset($error_message)) {
?>
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $error_message ?>
    </div>
    <?php 
$this->session->unset_userdata('error_message');
}
?>
    <div class='row'> </div>
    <!-- New user -->
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="panel-title">
                        <div class="row">
                            <div class="col-sm-12">
                                <?php if($this->permission1->method('manage_user','read')->access()){?> <a href="<?php echo base_url('User/managecompany')?>" style="color:white;background-color:#38469f;" class="btn btn-success m-b-5 m-r-2"><i class="ti-align-justify"> </i>Manage Company</a>
                                    <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <?php echo form_open_multipart('User/company_insert');?>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Company Name<i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="company_name" id="company_name" value="<?= (!empty($cmpy_record) ? $cmpy_record[0]['company_name'] : '') ?>" placeholder="Enter your Company Name" required /> </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Company Email<i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input type="text" value="<?= (!empty($cmpy_record) ? $cmpy_record[0]['email'] : '') ?>" class="form-control" name="email" id="email" required placeholder="Enter your Company Email" /> </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Mobile<i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input type="number" value="<?= (!empty($cmpy_record) ? $cmpy_record[0]['mobile'] : '') ?>" class="form-control" name="mobile" id="mobile" maxlength="12" required placeholder="Enter your mobile" /> </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo 'City'; ?><i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input type="text" value="<?= (!empty($cmpy_record) ? $cmpy_record[0]['c_city'] : '') ?>" class="form-control" name="c_city" id="c_city" required placeholder="Enter your city" oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo 'State'; ?><i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input type="text" value="<?= (!empty($cmpy_record) ? $cmpy_record[0]['c_state'] : '') ?>" class="form-control" name="c_state" id="c_state" required placeholder="Enter your state" oninput="this.value = this.value.replace(/[^A-Za-z ]/g, '')"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo 'Zipcode'; ?><i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input type="text" value="<?= (!empty($cmpy_record) ? $cmpy_record[0]['c_zipcode'] : '') ?>" class="form-control" name="zipcode" id="zipcode" maxlength="6" required placeholder="Enter your Zipcode" oninput="this.value = this.value.replace(/[^0-9]/g, '')"/>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Address<i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input type="text" value="<?= (!empty($cmpy_record) ? $cmpy_record[0]['address'] : '') ?>" class="form-control" name="address" id="address" placeholder="Enter your address" /> </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Website<i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input type="text" value="<?= (!empty($cmpy_record) ? $cmpy_record[0]['website'] : '') ?>" class="form-control" name="website" id="website" placeholder="Enter your website" required /> </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Logo<i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control" name="image" id="logo" value="<?= (!empty($cmpy_record) ? $cmpy_record[0]['logo'] : 'required') ?>" /> 
                                <input type="hidden" class="form-control" name="logo_image" id="" value="<?= (!empty($cmpy_record) ? $cmpy_record[0]['logo'] : '') ?>" /> 
                            </div>
                            <?php if(!empty($cmpy_record)) { ?>
                            <div class="col-sm-4">
                                <img src="<?= base_url($cmpy_record[0]['logo']); ?>" width="20%" height="20%" /> 
                            </div>
                            <?php } ?>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Payment Reminder Period<i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <div class="datepicker" style="width: 100%;">
                                    <input type="text" name="payment_reminder_date" id="datepickerInput" value="<?= (!empty($cmpy_record) ? $cmpy_record[0]['payment_reminder_date'] : '') ?>" class="form-control" readonly>
                                    <div class="date-container" id="dateContainer"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Currency<i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <select class="form-control" id="currency" name="currency" class="form-control" style="width: 100%;" required="" style="max-width: -webkit-fill-available;">
                                <option value="">Select currency</option>
                                    <?php 
                                    $currencys = ['AFN' => 'AFN - Afghan Afghani', "ALL" => 'ALL - Albanian Lek', "DZD" => 'DZD - Algerian Dinar', "AOA" => 'AOA - Angolan Kwanza', "ARS" => 'ARS - Argentine Peso', "AMD" => 'AMD - Armenian Dram', "AWG" => 'AWG - Aruban Florin', 
                                    "AUD" => 'AUD - Australian Dollar', "AZN" => 'AZN - Azerbaijani Manat', "BSD" => 'BSD - Bahamian Dollar', "BHD" => 'BHD - Bahraini Dinar', "BDT" => 'BDT - Bangladeshi Taka', "BBD" => 'BBD - Barbadian Dollar', "BTN" => 'BTN - Bhutanese Ngultrum', 
                                    "BTC" => 'BTC - Bitcoin', "BOB" => 'BOB - Bolivian Boliviano', "BAM" => 'BAM - Bosnia-Herzegovina Convertible Mark', "BWP" => 'BWP - Botswanan Pula', "BRL" => 'BRL - Brazilian Real', "GBP" => 'GBP - British Pound Sterling',"BND" => 'BND - Brunei Dollar', 
                                    "BGN" => 'BGN - Bulgarian Lev', "BIF" => 'BIF - Burundian Franc', "KHR" => 'KHR - Cambodian Riel', "CAD" => 'CAD - Canadian Dollar', "CVE" => 'CVE - Cape Verdean Escudo', "KYD" => 'KYD - Cayman Islands Dollar', "XOF" => 'XOF - CFA Franc BCEAO', "XAF" => 'XAF - CFA Franc BEAC', 
                                    "XPF" => 'XPF - CFP Franc', "CLP" => 'CLP - Chilean Peso', "CNY" => 'CNY - Chinese Yuan', "COP" => 'COP - Colombian Peso', "KMF" => 'KMF - Comorian Franc', "CDF" => 'CDF - Congolese Franc', "CRC" => 'CRC - Costa Rican ColÃ³n', "HRK" => 'HRK - Croatian Kuna', "CUC" => 'CUC - Cuban Convertible Peso', 
                                    "CZK" => 'CZK - Czech Republic Koruna', "DKK" => 'DKK - Danish Krone', "DJF" => 'DJF - Djiboutian Franc', "DOP" => 'DOP - Dominican Peso', "XCD" => 'XCD - East Caribbean Dollar', "EGP" => 'EGP - Egyptian Pound', "ERN" => 'ERN - Eritrean Nakfa', "EEK" => 'EEK - Estonian Kroon', 
                                    "ETB" => 'ETB - Ethiopian Birr', "EUR" => 'EUR - Euro', "FKP" => 'FKP - Falkland Islands Pound', "FJD" => 'FJD - Fijian Dollar', "GMD" => 'GMD - Gambian Dalasi', "GEL" => 'GEL - Georgian Lari', "DEM" => 'DEM - German Mark', "GHS" => 'GHS - Ghanaian Cedi', "GIP" => 'GIP - Gibraltar Pound', 
                                    "GRD" => 'GRD - Greek Drachma', "GTQ" => 'GTQ - Guatemalan Quetzal', "GNF" => 'GNF - Guinean Franc', "GYD" => 'GYD - Guyanaese Dollar', "HTG" => 'HTG - Haitian Gourde', "HNL" => 'HNL - Honduran Lempira', "HKD" => 'HKD - Hong Kong Dollar', "HUF" => 'HUF - Hungarian Forint', 
                                    "ISK" => 'ISK - Icelandic KrÃ³na', "INR" => 'INR - Indian Rupee', "IDR" => 'IDR - Indonesian Rupiah', "IRR" => 'IRR - Iranian Rial', "IQD" => 'IQD - Iraqi Dinar', "ILS" => 'ILS - Israeli New Sheqel', "ITL" => 'ITL - Italian Lira', "JMD" => 'JMD - Jamaican Dollar', 
                                    "JPY" => 'JPY - Japanese Yen', "JOD" => 'JOD - Jordanian Dinar', "KZT" => 'KZT - Kazakhstani Tenge', "KES" => 'KES - Kenyan Shilling', "KWD" => 'KWD - Kuwaiti Dinar', "KGS" => 'KGS - Kyrgystani Som', "LAK" => 'LAK - Laotian Kip', "LVL" => 'LVL - Latvian Lats', "LBP" => 'LBP - Lebanese Pound', 
                                    "LSL" => 'LSL - Lesotho Loti', "LRD" => 'LRD - Liberian Dollar', "LYD" => 'LYD - Libyan Dinar', "LTL" => 'LTL - Lithuanian Litas', "MOP" => 'MOP - Macanese Pataca', "MKD" => 'MKD - Macedonian Denar', "MGA" => 'MGA - Malagasy Ariary', "MWK" => 'MWK - Malawian Kwacha', "MYR" => 'MYR - Malaysian Ringgit', 
                                    "MVR" => 'MVR - Maldivian Rufiyaa', "MRO" => 'MRO - Mauritanian Ouguiya', "MUR" => 'MUR - Mauritian Rupee', "MXN" => 'MXN - Mexican Peso', "MDL" => 'MDL - Moldovan Leu', "MNT" => 'MNT - Mongolian Tugrik', "MAD" => 'MAD - Moroccan Dirham', "MZM" => 'MZM - Mozambican Metical', "MMK" => 'MMK - Myanmar Kyat', 
                                    "NAD" => 'NAD - Namibian Dollar', "NPR" => 'NPR - Nepalese Rupee', "ANG" => 'ANG - Netherlands Antillean Guilder', "TWD" => 'TWD - New Taiwan Dollar', "NZD" => 'NZD - New Zealand Dollar', "NIO" => 'NIO - Nicaraguan CÃ³rdoba', "NGN" => 'NGN - Nigerian Naira', "KPW" => 'KPW - North Korean Won', 
                                    "NOK" => 'NOK - Norwegian Krone', "OMR" => 'OMR - Omani Rial', "PKR" => 'PKR - Pakistani Rupee', "PAB" => 'PAB - Panamanian Balboa', "PGK" => 'PGK - Papua New Guinean Kina', "PYG" => 'PYG - Paraguayan Guarani', "PEN" => 'PEN - Peruvian Nuevo Sol', "PHP" => 'PHP - Philippine Peso', "PLN" => 'PLN - Polish Zloty', 
                                    "QAR" => 'QAR - Qatari Rial', "RON" => 'RON - Romanian Leu', "RUB" => 'RUB - Russian Ruble', "RWF" => 'RWF - Rwandan Franc', "SVC" => 'SVC - Salvadoran ColÃ³n', "WST" => 'WST - Samoan Tala', "SAR" => 'SAR - Saudi Riyal', "RSD" => 'RSD - Serbian Dinar', "SCR" => 'SCR - Seychellois Rupee', 
                                    "SLL" => 'SLL - Sierra Leonean Leone', "SGD" => 'SGD - Singapore Dollar', "SKK" => 'SKK - Slovak Koruna', "SBD" => 'SBD - Solomon Islands Dollar', "SOS" => 'SOS - Somali Shilling', "ZAR" => 'ZAR - South African Rand', "KRW" => 'KRW - South Korean Won', "XDR" => 'XDR - Special Drawing Rights', 
                                    "LKR" => 'LKR - Sri Lankan Rupee', "SHP" => 'SHP - St. Helena Pound', "SDG" => 'SDG - Sudanese Pound', "SRD" => 'SRD - Surinamese Dollar', "SZL" => 'SZL - Swazi Lilangeni', "SEK" => 'SEK - Swedish Krona', "CHF" => 'CHF - Swiss Franc', "SYP" => 'SYP - Syrian Pound', "STD" => 'STD - São Tomé and Príncipe Dobra', 
                                    "TJS" => 'TJS - Tajikistani Somoni', "TZS" => 'TZS - Tanzanian Shilling', "THB" => 'THB - Thai Baht', "TOP" => 'TOP - Tongan paanga', "TTD" => 'TTD - Trinidad & Tobago Dollar', "TND" => 'TND - Tunisian Dinar', "TRY" => 'TRY - Turkish Lira', "TMT" => 'TMT - Turkmenistani Manat', "UGX" => 'UGX - Ugandan Shilling', 
                                    "UAH" => 'UAH - Ukrainian Hryvnia', "AED" => 'AED - United Arab Emirates Dirham', "UYU" => 'UYU - Uruguayan Peso', "USD" => 'USD - US Dollar', "UZS" => 'UZS - Uzbekistan Som', "VUV" => 'VUV - Vanuatu Vatu', "VEF" => 'VEF - Venezuelan BolÃ­var', "VND" => 'VND - Vietnamese Dong', "YER" => 'YER - Yemeni Rial', "ZMK" => 'ZMK - Zambian Kwacha']; 

                                    foreach($currencys as $key => $curr) { ?>
                                    <option value="<?= $key ?>" <?= (!empty($cmpy_record) && ($cmpy_record[0]['currency'] == $key) ? 'selected' : ''); ?>> <?= $curr; ?> </option>
                                    <?php } ?>                                    
                                    
                                </select>
                            </div>
                        </div>
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Payment Due date<i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <div class="datepicker1" style="width: 100%;">
                                    <input type="text" name="due_date" id="datepickerInput1" value="<?= (!empty($cmpy_record) ? $cmpy_record[0]['due_date'] : '') ?>" class="form-control" readonly>
                                    <div class="date-container1" id="dateContainer1"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Subscription Fees / Month<i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input type="text" value="<?= (!empty($cmpy_record) ? $cmpy_record[0]['subscription_fees'] : '') ?>" class="form-control" name="subscription_fees" id="subscription_fees" placeholder="Enter subscription fees" /> </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Payment Follow-Up Mail<i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input type="email" value="<?= (!empty($cmpy_record) ? $cmpy_record[0]['mail'] : '') ?>" class="form-control" name="mail" id="follow_up_mail" placeholder="Enter your Email address" /> </div>
                        </div>
                        <hr>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Username<i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input required type="text" value="<?= (!empty($user_record) ? $user_record[0]['username'] : '') ?>" class="form-control" name="username" id="username" placeholder="Enter your username" /> </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">
                                <?php echo display('password') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input type="password" value="<?= (!empty($cmpy_record) ? $cmpy_record[0]['password'] : '') ?>" ramji="" class="form-control" id="password" required name="password" placeholder="<?php echo display('password') ?>" /> </div>
                        </div>
                        <div class="form-group row">
                            <label for="address" class="col-sm-3 col-form-label">Email<i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <input type="email" value="<?= (!empty($user_record) ? $user_record[0]['email_id'] : '') ?>" class="form-control" name="user_email" required id="user_email" placeholder="Enter your useremail" /> </div>
                        </div>
                        <div class="form-group row">
                            <label for="user_type" class="col-sm-3 col-form-label">
                                <?php echo display('user_type') ?> <i class="text-danger">*</i></label>
                            <div class="col-sm-4">
                                <select required class="form-control" disabled name="user_type" id="user_type" tabindex="6">
                                    <option value="2">
                                        <?php echo display('select_one') ?>
                                    </option>
                                    <option selected value="2">
                                        <?php echo display('admin') ?>
                                    </option>
                                    <option value="2">
                                        <?php echo display('user') ?>
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-4">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                <input type="hidden" name="uid" value="<?php echo $_SESSION['user_id']; ?>">
                                <input type="hidden" name="cmpy_id" value="<?= (!empty($cmpy_record) ? $cmpy_record[0]['company_id'] : '') ?>">
                                <input type="submit" id="add-customer" style="color:white;background-color:#38469f;" class="btn btn-primary btn-large" name="add-user" value="<?php echo display('save') ?>" tabindex="6" /> </div>
                        </div>
                        <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
</div>

<!-- Edit user end -->
<style>
.datepicker {
    position: relative;
    display: inline-block;
}
.datepicker input {
    width: 100%;
    padding: 10px;
    border: 1px solid #CED4DA;
    border-radius: 0.25rem;
    cursor: pointer;
}
.datepicker .date-container {
    display: none;
    position: absolute;
    top: calc(100% + 5px);
    left: 0;
    z-index: 999;
    background: #fff;
    border: 1px solid #CED4DA;
    border-radius: 0.25rem;
    padding: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.datepicker .date-container .date {
    display: inline-block;
    width: 30px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    margin: 5px;
    cursor: pointer;
    border: 1px solid transparent;
    border-radius: 0.25rem;
    transition: background-color 0.3s, color 0.3s;
}
.datepicker .date-container .date:hover {
    background-color: #E9ECEF;
}

.datepicker1 {
    position: relative;
    display: inline-block;
}
.datepicker1 input {
    width: 100%;
    padding: 10px;
    border: 1px solid #CED4DA;
    border-radius: 0.25rem;
    cursor: pointer;
}
.datepicker1 .date-container1 {
    display: none;
    position: absolute;
    top: calc(100% + 5px);
    left: 0;
    z-index: 999;
    background: #fff;
    border: 1px solid #CED4DA;
    border-radius: 0.25rem;
    padding: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
.datepicker1 .date-container1 .date {
    display: inline-block;
    width: 30px;
    height: 30px;
    line-height: 30px;
    text-align: center;
    margin: 5px;
    cursor: pointer;
    border: 1px solid transparent;
    border-radius: 0.25rem;
    transition: background-color 0.3s, color 0.3s;
}
.datepicker1 .date-container1 .date:hover {
    background-color: #E9ECEF;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="text/javascript">
    var dateContainer = document.getElementById("dateContainer");
    var datePickerInput = document.getElementById("datepickerInput");
    datePickerInput.addEventListener("click", function() {
        dateContainer.style.display = "block";
    });

    for (var i = 1; i <= 10; i++) {
        var dateElement = document.createElement("div");
        dateElement.classList.add("date");
        dateElement.textContent = i;
        dateContainer.appendChild(dateElement);
        dateElement.addEventListener("click", function() {
            var selectedDate = this.textContent;
            datePickerInput.value = selectedDate;
            dateContainer.style.display = "none";
        });
    }

    document.addEventListener("click", function(event) {
        if (!dateContainer.contains(event.target) && event.target !== datePickerInput) {
            dateContainer.style.display = "none";
        }
    });
</script>    

<script type="text/javascript">
    var dateContainer1 = document.getElementById("dateContainer1");
    var datePickerInput1 = document.getElementById("datepickerInput1");
    datePickerInput1.addEventListener("click", function() {
        dateContainer1.style.display = "block";
    });

    for (var i = 1; i <= 31; i++) {
        var dateElement = document.createElement("div");
        dateElement.classList.add("date");
        dateElement.textContent = i;
        dateContainer1.appendChild(dateElement);
        dateElement.addEventListener("click", function() {
            var selectedDate = this.textContent;
            datePickerInput1.value = selectedDate;
            dateContainer1.style.display = "none";
        });
    }

    document.addEventListener("click", function(event) {
        if (!dateContainer1.contains(event.target) && event.target !== datePickerInput1) {
            dateContainer1.style.display = "none";
        }
    });
</script>    