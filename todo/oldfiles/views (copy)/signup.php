<!doctype html>
<html lang=en-US>

<head>
    <?php $this->load->view('inc_header_commoncss');?>
    <style>
        .hideall{
            display:none;
        }
    </style>

</head>

<body>
    <?php $this->load->view('inc_header_menu');?>
    <div class="blank-div-section"></div>
    <div class="trans-menu-join-bg">
        <img src="<?php echo base_url();?>assets/images/banner-right-section-img.png" alt="banner-right-section-img" />
    </div>
    <div class="login-form-main-section signup-form-main-section">

        <?php $this->load->view('inc_error');?>

        <form name="signup" id="signup" action="<?php echo site_url($controller . '/'.$fun_name) ?>" method="post"
            enctype="multipart/form-data">

            <input type="hidden" name="frm_mode" id="frm_mode" value="doRegister">
            <div class="forgat-section">
                <div class="forgat-head">Sign Up</div>
                <div class="" id="message-contact">
                    <div id="success_div" class="hidedefault alert alert-success"> This is a success message.</div>
                    <div id="err_div" class="hidedefault alert alert-danger"> This is a error message.</div>
                </div>

                <div class="radio-btns form-area">
                    <div class="radio-btn">
                        <input type="radio" id="user_type1" name="user_type" value="Customer">
                        <label for="user_type1">I am a Customer</label>
                        <div class="check"></div>
                    </div>
                    <div class="radio-btn">
                        <input type="radio" id="user_type2" name="user_type" value="Service Provider">
                        <label for="user_type2"> I am a Service Provider</label>
                        <div class="check"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row form-area">
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="user">First Name <span>*</span></label>
                            <input class="formclass " type="text" id="first_name" name="first_name"
                                value="<?php echo isset($records['first_name']) ? $records['first_name'] : ''?>"
                                required1>
                           <div class="hideall first_name error-red">This field is required</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="user">Last Name <span>*</span></label>
                            <input class="formclass" type="text" id="last_name" name="last_name"
                                value="<?php echo isset($records['last_name']) ? $records['last_name'] : ''?>">
                                <div class="hideall last_name error-red">This field is required</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="user">Address <span>*</span></label>
                            <input class="formclass" type="text" id="address_1" name="address_1"
                                value="<?php echo isset($records['address_1']) ? $records['address_1'] : ''?>">
                            <div class="hideall address_1 error-red">This field is required</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="user">City <span>*</span></label>
                            <input class="formclass" type="text" id="city_id" name="city_id"
                                value="<?php echo isset($records['city_id']) ? $records['city_id'] : ''?>">
                            <div class="hideall city_id error-red">This field is required</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="user">State <span>*</span></label>
                            <input class="formclass" type="text" id="state_id" name="state_id"
                                value="<?php echo isset($records['state_id']) ? $records['state_id'] : ''?>">
                            <div class="hideall state_id error-red">This field is required</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="user">Zip <span>*</span></label>
                            <input class="formclass" type="text" id="postcode" name="postcode"
                                value="<?php echo isset($records['postcode']) ? $records['postcode'] : ''?>">
                            <div class="hideall postcode error-red">This field is required</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="user">Email <span>*</span></label>
                            <input class="formclass" type="text" id="email" name="email"
                                value="<?php echo isset($records['email']) ? $records['email'] : ''?>" autocomplete="off" >
                            <div class="hideall email error-red">This field is required</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="user">Phone <span>*</span></label>
                            <input class="formclass" type="text" id="mobile" name="mobile"
                                value="<?php echo isset($records['mobile']) ? $records['mobile'] : ''?>" autocomplete="off" >
                            <div class="hideall mobile error-red">This field is required</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="password">Password <span>*</span></label>
                            <input class="formclass" type="password" id="passphrase" name="passphrase" value="" autocomplete="off" >
                            <div class="hideall passphrase error-red">This field is required</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="password">Confirm Password <span>*</span></label>
                            <input class="formclass" type="password" id="passphrase2" name="passphrase2" value="" autocomplete="off" >
                            <div class="hideall passphrase2 error-red">This field is required</div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="user">Company Name <span>*</span></label>
                            <input class="formclass" type="text" id="enterprise_name" name="enterprise_name"
                                value="<?php echo isset($records['enterprise_name']) ? $records['enterprise_name'] : ''?>"
                                required1>
                            <div class="hideall enterprise_name error-red">This field is required</div>
                        </div>
                    </div>
                </div>
                <div class="forgat-button form-area">
                    <button type="submit" class="forgat-button-style">Sign Up</button>
                    <!--<button type="button" class="forgat-button-style">Sign In</button>-->
                </div>
                <div class="dont-have-account-block form-area">
                    Already have an account? <a class="logi-link-block" href="<?php echo site_url('login')?>">Login
                        Now!</a>
                </div>
            </div>
        </form>
    </div>
    <?php $this->load->view('inc_footer');?>
    <?php $this->load->view('inc_common_footer_inner_js');?>
    <script type="text/javascript">
    $(document).ready(function($) {

        //btnActive
        $("#err_div").hide();
        $("#success_div").hide();

        $(".formclass").removeClass("border-danger");

        $("#signup").submit(function(e) {
            $(".hideall").hide();
            $(".formclass").removeClass("border-danger");
            $("#err_div").hide();
            $("#success_div").hide();


            var isError = false;
            var errMsg = "";
            var errMsg_alert = "";
            
            if ($('input[name="user_type"]:checked').length == 0) {
                isError = true;
                error_msg = "Please select user type";
                 $("#err_div").html(error_msg);
                $("#err_div").show();

            }
            if (!$("#first_name").val()) {
                isError = true;
                error_msg = "Please enter an first name";
                $("#first_name").addClass("border-danger");

                $(".first_name").show();
               
            }
            if (!$("#last_name").val()) {
                isError = true;
                error_msg = "Please enter an first name";
                $("#last_name").addClass("border-danger");
                $(".last_name").show();
               
            }

            if (!$("#address_1").val()) {
                isError = true;
                error_msg = "Please enter an first name";
                $("#address_1").addClass("border-danger");
                $(".address_1").show();
               
            }
            if (!$("#city_id").val()) {
                isError = true;
                error_msg = "Please enter an first name";
                $("#city_id").addClass("border-danger");
                $(".city_id").show();
               
            }


            if (!$("#state_id").val()) {
                isError = true;
                error_msg = "Please enter an first name";
                $("#state_id").addClass("border-danger");
                $(".state_id").show();
               
            }

            if (!$("#postcode").val()) {
                isError = true;
                error_msg = "Please enter an first name";
                $("#postcode").addClass("border-danger");
                $(".postcode").show();
               
            }
            if (!$("#email").val()) {
                isError = true;
                error_msg = "Please enter an first name";
                $("#email").addClass("border-danger");
                $(".email").show();
               
            }
            if (!$("#mobile").val()) {
                isError = true;
                error_msg = "Please enter an first name";
                $("#mobile").addClass("border-danger");
                $(".mobile").show();
               
            }

            if (!$("#passphrase").val()) {
                isError = true;
                error_msg = "Please enter an first name";
                $("#passphrase").addClass("border-danger");
                $(".passphrase").show();
               
            }
            if (!$("#passphrase2").val()) {
                isError = true;
                error_msg = "Please enter an first name";
                $("#passphrase2").addClass("border-danger");
                $(".passphrase2").show();
               
            }
            if ($("#passphrase").val() != $("#passphrase2").val()) {
                isError = true;
                error_msg = "Password does not match with Confirm Password ";
                $("#passphrase2").addClass("border-danger");
                //sreturn false;
            }



            if (!$("#enterprise_name").val()) {
                isError = true;
                error_msg = "Please enter an first name";
                $("#enterprise_name").addClass("border-danger");
                $(".enterprise_name").show();
               
            }

            if (!$("#email").val() || !validateEmail($("#email").val())) {
                isError = true;
                error_msg = "Please enter valid email id";
                // $("#error_email").show()
            }

            //  alert(error_msg);



            if (!isError) {
                //dataString = $("#regform").serialize();
                // alert(web_site_url);
                $("#err_div").html("");
                $("#err_div").hide();

                //  $("#contact-btn").attr("disabled", "disabled");
                //ajax send this to php page
                //$("#contactform").submit();			


                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    data: new FormData(
                        this
                    ), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false, // To send DOMDocument or non processed data file it is set to false
                    url: '<?php echo site_url($controller . '/'.$fun_name) ?>',

                    beforeSend: function() {
                        // this is where we append a loading image
                        //$("#contact-btn").attr("disabled", "disabled");
                        //btnRegister

                    },
                    success: function(redata) {
                        //  redata = jQuery.trim(redata);
                        // successful request; do something with the data
                        //  alert(redata);
                        // alert(redata);
                        console.log(redata);
                        if (redata.status==1) {
                         //   $("#success_div").html(redata.errorMessage);
                         $("#success_div").show();
                            $("#err_div").hide();
                           
                            $('.form-area').hide();
                            if (redata.redirecturl != null) {
                                window.location.href = redata.redirecturl;

                            }
                          
                          //  $('#message-contact').slideDown('slow');
                          //  $('#message-contact').html(redata.successMessage);
                        } else {
                            // alert(redata.errorMessage);
                            $("#err_div").html(redata.errorMessage);
                            $("#err_div").show();

                            $("#success_div").hide();

                        }

                        //  $('#signup').slideDown('slow');

                    },
                    error: function(redata) {
                        console.log("redata error ", redata);
                        $("#err_div").html(redata.errorMessage);
                        $("#err_div").show();

                    }
                });

                //end ajax send this to php page
            } else {
                console.log("error_msg ", error_msg);
                //alert("11");
             //   $("#err_div").html(error_msg);
              //  $("#err_div").show();
            }
            return false;
        });



        
        $( ".formclass" ).click(function() {
            $(this).removeClass("border-danger");   
            var id =  $(this).attr('id');
                $("."+id).hide();    
        });
        $( ".formclass" ).blur(function() {
            if (!$(this).val()) {
                var id =  $(this).attr('id');
                $(this).addClass("border-danger");   
                $("."+id).show();   
            }
            

        });
        
    });
    document.getElementById("signup").reset();
    </script>
</body>