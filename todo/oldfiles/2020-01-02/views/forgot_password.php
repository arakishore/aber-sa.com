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
    <div class="login-form-main-section">
        <?php $this->load->view('inc_error');?>
        <form name="signup" id="signup" action="<?php echo site_url($controller . '/'.$fun_name) ?>" method="post">

            <input type="hidden" name="frm_mode" id="frm_mode" value="doForgotPassword">
            <div class="forgat-section">
            <div class="" id="message-contact">
                    <div id="success_div" class="hidedefault alert alert-success"> This is a success message.</div>
                    <div id="err_div" class="hidedefault alert alert-danger"> This is a error message.</div>
                </div>
                <div class="forgat-head">Forgot Passward</div>
                <div class="form-group">
                    <label for="email">Email address <span>*</span></label>
                    
                    <input class="formclass" type="text" id="email" name="email"  value="" required>
                    <div class="hideall email error-red ">This field is required</div>
                </div>
                <div class="forgat-button">
                   
                    <button type="submit" class="forgat-button-style">Send</button>
                    <!--<button type="button" class="forgat-button-style">Sign In</button>-->
                </div>
                <div class="dont-have-account-block">
                    Remember Password? <a class="logi-link-block" href="<?php echo site_url('login')?>">Login Now!</a>
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
            $(".formclass").removeClass("border-danger");


            var isError = false;
            var errMsg = "";
            var errMsg_alert = "";
           
            if (!$("#email").val()) {
                isError = true;
                error_msg = "Please enter an email address";
                $("#email").addClass("border-danger");
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