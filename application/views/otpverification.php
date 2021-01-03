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
    <div class="trans-banner-section trans-select-category-banner">
        <div class="trans-blank-section"></div>
        <div class="container">
            <div class="trans-banner-section-content">
                <div class="trans-banner-content-line"></div>
                <div class="trans-select-category-head">
                Enter your OTP
                </div>
            </div>
        </div>
        <div class="trans-caet-banner-bottom-img"></div>
    </div>
    <div class="container">
        <div class="login-form-main-section">
            <?php $this->load->view('inc_error');?>
            <form name="signup" id="signup" action="<?php echo site_url($controller . '/'.$fun_name) ?>" method="post"
                enctype="multipart/form-data">
                <input type="hidden" name="email" id="email" value="<?php echo (isset($email)) ? $email : ''?>">
                <input type="hidden" name="frm_mode" id="frm_mode" value="doOTPverification">
                <div class="forgat-section">
                <div class="" id="message-contact">
                    <div id="success_div" class="hidedefault alert alert-success"> This is a success message.</div>
                    <div id="err_div" class="hidedefault alert alert-danger"> This is a error message.</div>
                </div>
                    <!-- <div class="forgat-head">Sign In</div> -->
                    <div class="form-group">
                        <label for="temp_otp">Enter verification code sent to your Mail <span>*</span></label>
                        <input class="formclass" type="text" id="temp_otp" name="temp_otp"  value="" required>
                        <div class="hideall temp_otp error-red ">This field is required</div>
                    </div>
                    
                    

                    <div class="forgat-button">
                    <button type="submit" class="forgat-button-style">Verify</button>
                        <!--<button type="button" class="forgat-button-style">Sign In</button>-->
                    </div>
                    <div class="dont-have-account-block">
                        Don't received a code? <a class="logi-link-block" href="<?php echo site_url('signup/resendOTP?u='.$u)?>" class="resendlink">Resend
                            Now!</a>
                    </div>
                </div>
            </form>
        </div>


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
           
            if (!$("#temp_otp").val()) {
                isError = true;
                error_msg = "Please enter OTP";
                $("#temp_otp").addClass("border-danger");
                return false;
            }
             

             

            //  alert(error_msg);



            if (!isError) {
                //dataString = $("#regform").serialize();
                // alert(web_site_url);
                $("#err_div").html("");
                $("#err_div").hide();
                return true;
                 
            } else {
                console.log("error_msg ", error_msg);
                //alert("11");
                $("#err_div").html(error_msg);
                $("#err_div").show();
                return false;
            }
            

            return false;
        });


        //resendlink
       


         
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
    </script>
</body>