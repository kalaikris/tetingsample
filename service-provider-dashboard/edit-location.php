<?php
    session_start();
    include_once '../config/core.php';
    include '../security/secure.php';
    if(isset($_COOKIE['service_token'])==""){
        header("Location:login.php");
    }else{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Onboarding</title>
        <link rel="shortcut icon" href="asset/images/fav-icon.png">
        <link rel="stylesheet" href="css/onbord-css/bootstrap.min.css?v=<?php echo $cur_date_time; ?>">
        <link rel="stylesheet" href='css/bootstrap-datetimepicker.css'>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css'>
        <link rel="stylesheet" href="css/fonts.css?v=<?php echo $cur_date_time; ?>">
        <link rel="stylesheet" href="css/onbord-css/common.css?v=<?php echo $cur_date_time; ?>">
        <link rel="stylesheet" href="css/onbord-css/index.css?v=<?php echo $cur_date_time; ?>">
        <link rel="stylesheet" href="css/select.css">
        <link href="sweetalert-master/dist/sweetalert.css" rel="stylesheet">
        <style>
            .uppercase {
                text-transform: uppercase;
            }
            .sidebar_status {
                display: none;
            }
        </style>
    </head>
    <body id="page">
         <div id="loading"></div>

        <div class="mani">
            <div class="side_menu" id="after_login"></div>
            <div class="mani_menu">
                <section class="service-location-sec" id="service_location_Details">
                    <div class="service-location-set">
                        <div class="header-title">
                            <h2>Service Locations</h2>
                        </div>
                        <div class="underline-div"></div>
                        <div class="service-input-group" id="ser_input_group">
                            <div class="ser-location-set">
                                <div class="step-form-header">
                                    <h3>Location 1</h3>
                                    <p>Choose the terminal where you provide the service and upload its necessary documents</p>
                                </div>
                                <div class="input-form-group">
                                    <div class="input-form-group-items">
                                        <div class="input-box-set">
                                            <p>Airport</p>
                                            <select class="select-input" id="AirportName"></select>
                                        </div>
                                        <p id="AirportNameErr" style="color: red; font-size: 13px;"></p>
                                    </div>
                                </div>
                                <div class="text-box-group">
                                    <div class="input-form-group-item">
                                        <div class="input-box-set">
                                            <p>Email Address</p>
                                            <input type="email" class="input-box" id="location_email_address" placeholder="Enter Email Address" autocomplete="off">
                                        </div>
                                    </div>
                                    <div>
                                        <p id="location_email_addressErr" style="color: red; font-size: 13px;"></p>
                                    </div>
                                </div>
                                <div class="upload-set">
                                    <div class="upload-items" id="divhiding5" >
                                        <label for="" class="upload-label" data-toggle="modal" onclick="multipleDocument()" data-target="#upload_document">
                                            <input type="file" class="input-file" id="document_upload">
                                            <p><img src="asset/images/upload-sm-icon.svg" alt="upload icon" class="btn-icon">Upload documents</p>
                                        </label>
                                    </div>
                                    <div class="">
                                        <p id="add_document_label_name" style="display: none;">Upload Documents</p>
                                        <div class="succes-icon-text" id="uploadedtext5" style="display: none;">
                                            <img src="asset/images/tick-icon.png" class="tick-icon">
                                            <p>Completed</p>
                                            <img src="asset/edit.png" onclick="Edit_document(`upload_document`)">
                                        </div>
                                    </div>
                                    <div class="upload-items" id="divhiding6">
                                        <label for="" class="upload-label" data-toggle="modal" onclick="multipleBankDetail()" data-target="#upload_bank_account_document">
                                            <input type="file" class="input-file" id="bank_account_document">
                                            <p><img src="asset/images/bank-sm-icon.svg" alt="upload icon" class="btn-icon">Add BankAccount</p>
                                        </label>
                                    </div>
                                    <div class="">
                                        <p id="add_bank_label_name" style="display: none;">Add Bank Account</p>
                                        <div class="succes-icon-text" id="uploadedtext6" style="display: none;">
                                            <img src="asset/images/tick-icon.png" class="tick-icon">
                                            <p>Completed</p>
                                            <img src="asset/edit.png" onclick="Edit_bankaccount(`upload_bank_account_document`)">
                                        </div>
                                    </div>
                                </div>
                                <div class="underline-div"></div>
                            </div>
                        </div>
                        <div class="form_btn text-center">
                                <button class="submit_btn" onclick="updateLocation()">Submit</button>
                        </div>
                        <!-- <div class="upload-set cust-mt">
                            <div class="upload-items">
                                <label class="upload-label" id="add_new_location">
                                    <p>Add new location</p>
                                </label>
                            </div>
                        </div>
                        <div class="upload-set cust-mt" id="remove_location_btn"></div> -->
                        <!-- <a class="nex-arrow-set" data-current="#service_location_Details" data-next="#review" onclick="nextButton()">
                            <img src="asset/images/next-arrow.svg" class="next-arrow" alt="nex arrow">
                        </a> -->
                    </div>
                </section>
            </div>
        </div>
    <!-- Modal -->
    <div class="append_document_upload"></div>
    <div class="append_bank_details"></div>
      
    <script src='js/jquery.min.js'></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="js/aws-sdk.min.js"></script>
    <script src='js/moment-with-locales.js'></script>
    <script src='js/bootstrap-datetimepicker.js'></script>
    <script src="js/intlTelInput.js"></script>
    <script src="js/intlTelInput.min.js"></script>
    <script src="js/s3upload.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="js/select.js"></script>
    <script src="sweetalert-master/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <!-- <script src="js/dropdowndata.js?v=<?php echo $cur_date_time; ?>"></script> -->
    <script src="js/heder-sidebar.js?v=<?php echo $cur_date_time; ?>"></script>
    <script src="js/sidemenu.js?v=<?php echo $cur_date_time; ?>"></script>
    <script>
    var airportdata='';
    // var state_val=false;
    // var city_val=false;
    var apiPath = "<?php echo $apiPath; ?>";
    //let firstCompanyToken = "<?php //echo $_REQUEST['firstCompanyToken']; ?>";
    var serviceProviderCompanyToken = localStorage.getItem("serviceProviderCompanyToken");
    var singleAirportToken = localStorage.getItem("airportToken");
    
    $(document).ready(function(){
        $(".chzn-select").chosen({ allow_single_deselect: true });
        var secured = "secured";
        var datas = { securedairportzo: secured };
        var jsondata1 = JSON.stringify(datas);
        $.ajax({
            type: "POST",
            dataType: "json",
            url: apiPath + "/service-provider/getBusinessInfoDropDown.php",
            data: jsondata1,
        }).done(function (data) {
            $("#AirportName").empty();
            var airportnamedata = data.airport_list;
            airportdata = '<option value="">Select Your Airport</option>';
            for (var key in airportnamedata) {
            airportdata +=
                '<option value="' +
                airportnamedata[key].airport_token +
                '">' +
                airportnamedata[key].airport_name +
                "</option>";
            }
            $("#AirportName").html(airportdata);
            $("#AirportName").change(function() {
            }).chosen({allow_single_deselect:true});({
                width: '100%',
                filter: true
            });
        });

        if(serviceProviderCompanyToken != null && serviceProviderCompanyToken != '' && serviceProviderCompanyToken != undefined){
            setTimeout(() => {
                appendfirstcompanyDetails(serviceProviderCompanyToken);
            }, 3000); 
        }
    })
    

    function Edit_document(data1){
        $('#'+data1).modal('show');
    }

    function Edit_bankaccount(data1){
        $('#'+data1).modal('show');
    }
    
    function bank_details() {
        var pass = 0;
        if (document.getElementById("account_number").value.trim() == "") {
            document.getElementById("account_numberErr").innerHTML = "*Enter Account Number !";
        }else{
            document.getElementById("account_numberErr").innerHTML = "";
            pass++;
        }if (document.getElementById("reenter_account_number").value == "") {
            document.getElementById("reenter_account_numberErr").innerHTML = "*Enter Re-Enter Account Number !";
        }else{
            document.getElementById("reenter_account_numberErr").innerHTML = "";
            pass++;
        }if (document.getElementById("ifsc_code").value == "") {
            document.getElementById("ifsc_codeErr").innerHTML = "*Enter IFSC Code !";
        }else{
            document.getElementById("ifsc_codeErr").innerHTML = "";
            pass++;
        }
        if (pass == 3) {
            var accountnumber = $('#account_number').val();
            var reenteraccountnumber = $('#reenter_account_number').val();
            if(accountnumber==reenteraccountnumber){
                swal({
                title: "Done",
                text: "Details Added Successfully!..",
                type: "success",
                showSuccessButton: false,
                confirmButtonColor: "#26C177",
                confirmButtonText: "OK",
                closeOnConfirm: false,
            },
            function(){
                swal.close();
                $('#upload_bank_account_document').modal('hide');
                $('#uploadedtext6').show();
                $('#uploadedtext6').attr('data-uploaded6', 'true');
                $('#divhiding6').hide();
                $('#add_bank_label_name').show();
            });
            }else{
                swal("","Account Number and Re-Entered Account Number Does Not Match");
            }
        }
    }
    
    function isNumber(evt)
    {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) 
        {
            return false;
        }
        return true;
    }
    
    function upload_documents(){
        var pass=5;
        if (pass == 5) {
            swal({
                title: "Done",
                text: "Details Added Successfully!..",
                type: "success",
                showSuccessButton: false,
                confirmButtonColor: "#26C177",
                confirmButtonText: "OK",
                closeOnConfirm: false,
            },
            function(){
                swal.close();
                $('#upload_document').modal('hide');
                $('#uploadedtext5').show();
                $('#uploadedtext5').attr('data-uploaded5', 'true');
                $('#divhiding5').hide();
                $('#add_document_label_name').show();
            });
        }
    }
        
    function multipleDocument(){
    let newDocument;

        newDocument = `<div id="upload_document" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                       
                        <div class="modal-body">
                            <div class="document-body">
                                <div class="modal-header">
                                    <h2>Upload documents</h2>
                                     <img src="asset/images/close.svg" alt="close icon" class="close-icon" data-dismiss="modal">
                                </div>
                                <div class="modal-division"></div>

                                <div class="input-form-group">
                                    <div class="text-box-group">
                                        <div class="input-form-group-item">
                                            <div class="input-box-set">
                                                <label for="gst_number">Gst Number</label>
                                                <input type="text" class="input-box" id="gst_number" placeholder="Enter Gst Number">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-box-group">
                                        <div class="input-form-group-item">
                                            <div class="input-box-set">
                                                <label for="pan_number">Pan Number</label>
                                                <input type="text" class="input-box" id="pan_number" placeholder="Enter Pan Number">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="Upload-data-box-main-box">
                                <div class="Upload_data_box">
                                        <div class="pan_car_box">
                                            <h4>Pan Card /Tax License Number</h4>
                                            <p>Upload your Pan Card /Tax License Number for verification</p>
                                        </div>
                                        <div class="texte-btton">
                                           <div class="pan_cont pan_cont0">
                                                <input id="panfile_url" type="hidden">
                                                <label for="panImage">Upload Pan Certificate</label>
                                                <input id="panValidId" type="hidden">
                                                <input id="panImage" type="file" onchange="imageUpload('panImage','panValidId','panfile_url','uploadedtext','pan_cont0','panImageErr');" accept="image/x-png, image/gif, image/jpeg,image/jpg,application/pdf" style="display:none;">
                                            </div>
                                            <p id="panImageErr" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                                            <div class="uploadedtext" style="display:none;">
                                                <div class="succes-icon-text">
                                                    <img src="asset/images/tick-icon.png" class="tick-icon">
                                                    <p>Uploaded</p>
                                                    <img src="asset/images/close.svg" alt="close icon" class="" style="margin-left: 10px;width:15px;" onclick="clear_modalValue('panImage','uploadedtext','pan_cont0','panImageErr','panfile_url')">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Upload_data_box">
                                        <div class="pan_car_box">
                                            <h4>GST/VAT</h4>
                                            <p>Upload Your GST Certificate For Verification</p>
                                        </div>
                                        <div class="texte-btton">
                                            <div class="pan_cont pan_cont1">
                                                <input id="gstfile_url" type="hidden">
                                                <label for="gstImage">Upload GST Certificate</label>
                                                <input id="gstValidId" type="hidden">
                                                <input id="gstImage" type="file" onchange="imageUpload('gstImage','gstValidId','gstfile_url','uploadedtext0','pan_cont1','gstImageErr');" accept="image/x-png, image/gif, image/jpeg,image/jpg,application/pdf" style="display:none;">
                                            </div>
                                            <p id="gstImageErr" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                                            <div class="uploadedtext0" style="display:none;">
                                            <div class="succes-icon-text">
                                                <img src="asset/images/tick-icon.png" class="tick-icon">
                                                <p>Uploaded</p>
                                                <img src="asset/images/close.svg" alt="close icon" class="" style="margin-left: 10px;width: 15px;" onclick="clear_modalValue('gstImage','uploadedtext0','pan_cont1','gstImageErr','gstfile_url')">
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Upload_data_box">
                                        <div class="pan_car_box">
                                            <h4>MSME Certificate</h4>
                                            <p>Upload your MSME Certificate For Verification</p>
                                        </div>
                                        <div class="texte-btton">
                                            <div class="pan_cont pan_cont2">
                                                <input id="msmefile_url" type="hidden">
                                                <label for="msmeImage">Upload MSME Certificate</label>
                                                <input id="msmeValidId" type="hidden">
                                                <input id="msmeImage" type="file" onchange="imageUpload('msmeImage','msmeValidId','msmefile_url','uploadedtext1','pan_cont2','msmeImageErr');" accept="image/x-png, image/gif, image/jpeg,image/jpg,application/pdf" style="display:none;">
                                            </div>
                                            <p id="msmeImageErr" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                                            <div class="uploadedtext1" style="display:none;">
                                            <div class="succes-icon-text">
                                                <img src="asset/images/tick-icon.png" class="tick-icon">
                                                <p>Uploaded</p>
                                                <img src="asset/images/close.svg" alt="close icon" class="" style="margin-left: 10px;width: 15px;" onclick="clear_modalValue('msmeImage','uploadedtext1','pan_cont2','msmeImageErr','msmefile_url')">
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Upload_data_box">
                                        <div class="pan_car_box">
                                            <h4>Certificate of incorporation</h4>
                                            <p>Upload your certificate of incorporation for verification</p>
                                        </div>
                                        <div class="texte-btton">
                                            <div class="pan_cont pan_cont3">
                                                <input id="incorporationfile_url" type="hidden">
                                                <label for="incorporationImage">Upload certificate of incorporation</label>
                                                <input id="incorporationValidId" type="hidden">
                                                <input id="incorporationImage" type="file" onchange="imageUpload('incorporationImage','incorporationValidId','incorporationfile_url','uploadedtext2','pan_cont3','incorporationImageErr');" accept="image/x-png, image/gif, image/jpeg,image/jpg,application/pdf" style="display:none;">
                                            </div>
                                            <p id="incorporationImageErr" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                                            <div class="uploadedtext2" style="display:none;">
                                            <div class="succes-icon-text">
                                                <img src="asset/images/tick-icon.png" class="tick-icon">
                                                <p>Uploaded</p>
                                                <img src="asset/images/close.svg" alt="close icon" class="" style="margin-left: 10px;width: 15px;" onclick="clear_modalValue('incorporationImage','uploadedtext2','pan_cont3','incorporationImageErr','incorporationfile_url')">
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Upload_data_box">
                                        <div class="pan_car_box">
                                            <h4>Void Cheque</h4>
                                            <p>Upload your bank account cancelled cheque for verification</p>
                                        </div>
                                        <div class="texte-btton">
                                            <div class="pan_cont pan_cont4">
                                                <input id="chequefile_url" type="hidden">
                                                <label for="chequeImage">Upload Void Cheque</label>
                                                <input id="chequeValidId" type="hidden">
                                                <input id="chequeImage" type="file" onchange="imageUpload('chequeImage','chequeValidId','chequefile_url','uploadedtext3','pan_cont4','chequeImageErr');" accept="image/x-png, image/gif, image/jpeg,image/jpg,application/pdf" style="display:none;">
                                            </div>
                                            <p id="chequeImageErr" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                                            <div class="uploadedtext3" style="display:none;">
                                            <div class="succes-icon-text">
                                                <img src="asset/images/tick-icon.png" class="tick-icon">
                                                <p>Uploaded</p>
                                                <img src="asset/images/close.svg" alt="close icon" class="" style="margin-left: 10px;width: 15px;" onclick="clear_modalValue('chequeImage','uploadedtext3','pan_cont4','chequeImageErr','chequefile_url')">
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Upload_data_box">
                                        <div class="pan_car_box">
                                            <h4>Contract Agreement</h4>
                                            <p>Upload your signed contract agreement for verification</p>
                                        </div>
                                        <div class="texte-btton">
                                            <div class="pan_cont pan_cont5">
                                                <input id="agreementfile_url" type="hidden">
                                                <label for="agreementImage">Upload Contract Agreement</label>
                                                <input id="agreementValidId" type="hidden">
                                                <input id="agreementImage" type="file" onchange="imageUpload('agreementImage','agreementValidId','agreementfile_url','uploadedtext4','pan_cont5','agreementImageErr');" accept="image/x-png, image/gif, image/jpeg,image/jpg,application/pdf" style="display:none;">
                                            </div>
                                            <p id="agreementImageErr" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                                            <div class="uploadedtext4" style="display:none;">
                                            <div class="succes-icon-text">
                                                <img src="asset/images/tick-icon.png" class="tick-icon">
                                                <p>Uploaded</p>
                                                <img src="asset/images/close.svg" alt="close icon" class="" style="margin-left: 10px;width: 15px;" onclick="clear_modalValue('agreementImage','uploadedtext4','pan_cont5','agreementImageErr','agreementfile_url')">
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Upload_data_box">
                                        <div class="pan_car_box">
                                            <h4>Other Document 1</h4>
                                            <p>Upload your other document for Verification</p>
                                        </div>
                                        <div class="texte-btton">
                                            <div class="pan_cont pan_cont7">
                                                <input id="otherDocument1file_url" type="hidden">
                                                <label for="otherDocument1Image">Upload</label>
                                                <input id="otherDocument1ValidId" type="hidden">
                                                <input id="otherDocument1Image" type="file" onchange="imageUpload('otherDocument1Image','otherDocument1ValidId','otherDocument1file_url','uploadedtext8','pan_cont7','otherDocument1ImageErr');" accept="image/x-png, image/gif, image/jpeg,image/jpg,application/pdf" style="display:none;">
                                            </div>
                                            <p id="otherDocument1ImageErr" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                                            <div class="uploadedtext8" style="display:none;">
                                                <div class="succes-icon-text">
                                                    <img src="asset/images/tick-icon.png" class="tick-icon">
                                                    <p>Uploaded</p>
                                                    <img src="asset/images/close.svg" alt="close icon"  style="margin-left: 10px;width:15px;" onclick="clear_modalValue('otherDocument1Image','uploadedtext8','pan_cont7','otherDocument1ImageErr')">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Upload_data_box">
                                        <div class="pan_car_box">
                                            <h4>Other Document 2</h4>
                                            <p>Upload your other document for Verification</p>
                                        </div>
                                        <div class="texte-btton">
                                            <div class="pan_cont pan_cont8">
                                                <input id="otherDocument2file_url" type="hidden">
                                                <label for="otherDocument2Image">Upload</label>
                                                <input id="otherDocument2ValidId" type="hidden">
                                                <input id="otherDocument2Image" type="file" onchange="imageUpload('otherDocument2Image','otherDocument2ValidId','otherDocument2file_url','uploadedtext9','pan_cont8','otherDocument2ImageErr');" accept="image/x-png, image/gif, image/jpeg,image/jpg,application/pdf" style="display:none;">
                                            </div>
                                            <p id="otherDocument1ImageErr" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p>
                                            <div class="uploadedtext9" style="display:none;">
                                                <div class="succes-icon-text">
                                                    <img src="asset/images/tick-icon.png" class="tick-icon">
                                                    <p>Uploaded</p>
                                                    <img src="asset/images/close.svg" alt="close icon" class="" style="margin-left: 10px;width:15px;" onclick="clear_modalValue('otherDocument2Image','uploadedtext9','pan_cont8','otherDocument2ImageErr')">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_btn text-center">
                                        <button class="submit_btn" onclick="upload_documents()">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`; 
        
        $(".append_document_upload").append(newDocument);
    }
    
    function clear_modalValue(data1,data2,data3,data4,data5){
        $('#'+data1).val('');
        $('.'+data2).hide();
        $('.'+data3).show();
        $('#'+data4).text('');
        $('#'+data5).val('');

    }

    function removedoc(){
        $(`#upload_document`).modal({backdrop: 'static', keyboard: false},'hide');
        // $(`#upload_document${doc}`).remove();
    }
            
    function multipleBankDetail(){
     let bankDetail;
     bankDetail = `<div id="upload_bank_account_document" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                            <img src="asset/images/close.svg" alt="close icon" class="close-icon" data-dismiss="modal">
                            <div class="modal-body">
                                <div class="document-body">
                                    <div class="modal-header">
                                        <h2>Add Bank Account</h2>
                                    </div>
                                    <div class="input-form-group full-width">
                                        <div class="texte-bttons">
                                            <div class="input-form-group-required-item">
                                                <div class="text-box-group"></div>
                                                    <div class="input-form-group-item">
                                                        <div class="input-box-set">
                                                            <p>Account number</p>
                                                            <input type="text" class="input-box" id="account_number" onkeypress="return isNumber(event)" placeholder="Enter Account Number">
                                                        </div>
                                                    </div>
                                                <p class="error-text"><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                                                </div>
                                            <div><p id="account_numberErr" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;""></p></div>
                                        </div>
                                        <div class="texte-bttons">
                                            <div class="input-form-group-required-item">
                                                <div class="input-form-group-item">
                                                    <div class="input-box-set">
                                                        <p>Re-Enter Account Number</p>
                                                        <input type="text" class="input-box" id="reenter_account_number" onkeypress="return isNumber(event)" placeholder="Enter Re-Enter Account Number">
                                                    </div>
                                                </div>
                                                <p class="error-text"><img src="asset/images/required-icon.png" class="required-icon">Enter valid input</p>
                                            </div>
                                            <div><p id="reenter_account_numberErr" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p></div>
                                        </div>
                                        <div class="texte-bttons">
                                            <div class="input-form-group-required-item">
                                                <input id="ifsc_code" type="hidden">
                                                <div class="input-form-group-item">
                                                    <div id="container" class="">
                                                        <p>Enter the IFSC code:</p>
                                                        <input class="uppercase" placeholder="Enter IFSC Code" maxlength="11">
                                                        <a id="btn" onclick="getDetailsClick()" class="">Get Details</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div><p id="ifsc_codeErr" style="color: red;font-size: 13px; padding-top: 8px; font-weight: 600;"></p></div>
                                        </div>
                                        <div class="input-form-group-required-item divhide" style="display:none;">
                                            <div class="input-form-group-item disabled">
                                                <div class="input-box-set">
                                                    <p>Branch</p>
                                                    <input type="text" class="input-box" id="branch_name" placeholder="Branch Name" disabled>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-form-group-required-item divhide" style="display:none;">
                                            <div class="input-form-group-item disabled">
                                                <div class="input-box-set">
                                                    <p>City</p>
                                                    <input type="text" class="input-box" id="cityname" placeholder="City Name" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form_btn text-center">
                                        <button class="submit_btn" onclick="bank_details()">Add Bank</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
        $(".append_bank_details").append(bankDetail);
    }
        
    function goBack(){
        var containerContent = `<p>Enter the IFSC code:</p>
                                <input class="uppercase" placeholder="Enter IFSC Code" maxlength="11">
                                <a id="btn" onclick="getDetailsClick()" class="">Get Details</a>`;
        $('#ifsc_code').val('');
        $('#container').html(containerContent);
        $(".divhide").hide();
    }
        
    function getDetailsClick(){
        var ifscCode = $('#container > input').val();
        if(ifscCode == ''){
            $("#ifsc_codeErr").text("Please Enter IFSC Code");
        }else{
            var ifsc = String($('#container > input').val());
            $.getJSON('https://ifsc.razorpay.com/'+ifsc, function(data){
                $("#ifsc_codeErr").text("");
                $("#cityname").val(data.CITY);
                $("#branch_name").val(data.BRANCH);
                $("#ifsc_code").val(data.IFSC);
                $(".divhide").show();
                $("#container").html('<a id="backBtn" class="waves-effect waves-light btn light-green darken-2" onclick="goBack()">Go Back</a>'); 
            }).fail(function(){
                var msg = '<div id="errMsg">Invalid IFSC code</div>';
                $('#container').html('');
                $("#container").html('<a id="backBtn" class="waves-effect waves-light btn light-green darken-2" onclick="goBack()">Go Back</a>');
                $('#container').append(msg);
                $("#ifsc_codeErr").text('');
                $("#cityname").val('');
                $("#branch_name").val('');
                $("#ifsc_code").val('');
            });
        }
    }
       
    function updateLocation(){
           // var email11234 = document.getElementById("location_email_address").value;
           //mailformat12345 = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if($('#uploadedtext5').attr('data-uploaded5') == "true" && $('#uploadedtext6').attr('data-uploaded6') == "true" && $("#AirportName").val() != '' && $("#location_email_address").val() != ''){
                    var airportName=$('#AirportName option:selected').val();
                    var selectedairport = document.getElementById('AirportName');
                    var airportvalue = selectedairport.options[selectedairport.selectedIndex].text;
                    
                    var datas = {
                        airportToken:$('#AirportName option:selected').val(),
                        locationemailaddress:$("#location_email_address").val(),
                        airportNametext:airportvalue,
                        pan_certificate:$('#panfile_url').val() === undefined?'':$('#panfile_url').val(),
                        gst_certificate:$('#gstfile_url').val() === undefined?'':$('#gstfile_url').val(),
                        msme_certificate:$('#msmefile_url').val() === undefined?'':$('#msmefile_url').val(),
                        certificate_incorporation:$('#incorporationfile_url').val() === undefined?'':$('#incorporationfile_url').val(),
                        void_cheque:$('#chequefile_url').val() === undefined?'':$('#chequefile_url').val(),
                        certificate_agreement:$('#agreementfile_url').val() === undefined?'':$('#agreementfile_url').val(),
                        account_number:$('#account_number').val(),
                        ifsc_code:$('#ifsc_code').val(),
                        branch_name:$('#branch_name').val(),
                        cityname:$('#cityname').val(),
                        gst_number:$('#gst_number').val() === undefined?'':$('#gst_number').val(),
                        pan_number:$('#pan_number').val() === undefined?'':$('#pan_number').val(),
                        other_document1:$('#otherDocument1file_url').val() === undefined?'':$('#otherDocument1file_url').val(),
                        other_document2:$('#otherDocument2file_url').val() === undefined?'':$('#otherDocument2file_url').val(),
                        serviceProviderCompanyToken:serviceProviderCompanyToken
                    }
                    $("#AirportNameErr").text("");
                    $("#location_email_addressErr").text("");
                    var json1 = JSON.stringify(datas);
                    $.ajax({
                        dataType: "JSON",
                        type: "POST",
                        url: apiPath+"/service-provider/updateCompanyLocation.php",
                        data: json1
                    }).done(function(data1){
                        if(data1.status_code == 200){
                            window.location = "dashboard.php";
                        }else{
                            swal(data1.message);
                        }
                    });
            }else{
                if($("#AirportName").val() == ''){
                    swal("Please Select Airport Name");
                }else if($('#uploadedtext5').attr('data-uploaded5') != "true"){
                    swal("Please upload all Documents");
                }else if($('#uploadedtext6').attr('data-uploaded6') != "true"){
                    swal("Please Fill Bank details");
                }else if($("#location_email_address").val() == ''){
                    swal("Please Enter Email Address");
                }
                // else if($("#location_email_address").val() != ''){
                //     var email1123 = document.getElementById("location_email_address").value;
                //     mailformat1234 = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                //     if (email1123.match(mailformat1234)) {
                //     }else{
                //         swal("Email- Enter Valid Mail-ID");
                //     }
                // }
            }
    }

        function appendfirstcompanyDetails(token){
            let datas = {
                            'company_token':token
                        };
            let json1 = JSON.stringify(datas);
            $.ajax({
                dataType: "JSON",
                type: "POST",
                url: apiPath+"/service-provider/getBussinessInfo.php",
                data: json1
            }).done(function(data){
                let firstCompanyDetailsObject = data.data;
                firstCompanyDetailsObject.serviceLocations.forEach((locationdetails,index) => {
                    if(locationdetails.airportToken == singleAirportToken){
                        $(`#AirportName`).val(locationdetails.airportToken);
                        console.log($(`#AirportName`).val());
                        $(`#AirportName`).prop('disabled', true).trigger("chosen:updated");
                        $(`#location_email_address`).val(locationdetails.emailId);
                        multipleDocument();
                        multipleBankDetail();
                        $(`#account_number`).val(locationdetails.accountNumber);
                        $(`#reenter_account_number`).val(locationdetails.accountNumber);
                        $('#container > input').val(locationdetails.ifscCode);
                        getDetailsClick();

                        $(`#gst_number`).val(locationdetails.gst_number);
                        $(`#pan_number`).val(locationdetails.pancard_number);
                        //Pan/Tax upload
                        if(locationdetails.pan_certificate != ''){
                            $(`#panfile_url`).val(locationdetails.pan_certificate);
                            $(`.uploadedtext`).css("display", "block");
                            $(`.pan_cont0`).hide();
                            $(`#gstImageErr`).text(""); 
                        }
                        
                        //gst upload
                        if(locationdetails.gstCertificate != ''){
                            $(`#gstfile_url`).val(locationdetails.gstCertificate);
                            $(`.uploadedtext0`).css("display", "block");
                            $(`.pan_cont1`).hide();
                            $(`#gstImageErr`).text("");
                        }
                        
                        //msme upload
                        if(locationdetails.msmeCertificate != ''){
                            $(`#msmefile_url`).val(locationdetails.msmeCertificate);
                            $(`.uploadedtext1`).css("display", "block");
                            $(`.pan_cont2`).hide();
                            $(`#msmeImageErr`).text("");
                        }
                        
                        //incorporationfile upload
                        if(locationdetails.incorporationCertificate != ''){
                            $(`#incorporationfile_url`).val(locationdetails.incorporationCertificate);
                            $(`.uploadedtext2`).css("display", "block");
                            $(`.pan_cont3`).hide();
                            $(`#incorporationImageErr`).text("");
                        }
                        
                        //chequefile upload
                        if(locationdetails.voideCheck != ''){
                            $(`#chequefile_url`).val(locationdetails.voideCheck);
                            $(`.uploadedtext3`).css("display", "block");
                            $(`.pan_cont4`).hide();
                            $(`#chequeImageErr`).text("");
                        }
                        
                        //agreementfile upload
                        if(locationdetails.agreement != ''){
                            $(`#agreementfile_url`).val(locationdetails.agreement);
                            $(`.uploadedtext4`).css("display", "block");
                            $(`.pan_cont5`).hide();
                            $(`#agreementImageErr`).text("");
                        }
                        
                        //Other doc1 upload
                        if(locationdetails.other_document_one != ''){
                            $(`#otherDocument1file_url`).val(locationdetails.other_document_one);
                            $(`.uploadedtext8`).css("display", "block");
                            $(`.pan_cont7`).hide();
                            $(`#otherDocument1ImageErr`).text("");
                        }
                        
                        //other doc2 upload
                        if(locationdetails.other_document_two != ''){
                            $(`#otherDocument2file_url`).val(locationdetails.other_document_two);
                            $(`.uploadedtext9`).css("display", "block");
                            $(`.pan_cont8`).hide();
                            $(`#otherDocument1ImageErr`).text("");
                        }
                        
                        //Add Completed status for image upload
                        $('#upload_document').modal('hide');
                        $('#uploadedtext5').show();
                        $('#uploadedtext5').attr('data-uploaded5', 'true');
                        $('#divhiding5').hide();
                        $('#add_document_label_name').show();

                        //Add Completed status for bank details upload
                        $('#uploadedtext6').show();
                        $('#uploadedtext6').attr('data-uploaded6', 'true');
                        $('#divhiding6').hide();
                        $('#add_bank_label_name').show();
                        
                        firstCompanyDetailsObject.serviceLocations.forEach((locationdetailss,index) => {
                            if(index != 0){
                               $(`#AirportName option[value='${locationdetailss.airportToken}']`).prop('disabled', true).trigger("chosen:updated");
                            }
                        });

                    }

                });

            });

        }
    
    </script>
    </body>
</html>
<?php
}
?>