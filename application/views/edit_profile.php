<!doctype html>
<html lang=en-US>

<head>
    <?php $this->load->view('inc_header_commoncss');?>
</head>

<body>
    <?php $this->load->view('inc_header_menu_account');?>


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
                    Edit Profile

                </div>
            </div>
        </div>
        <div class="trans-caet-banner-bottom-img"></div>
    </div>
    <div class="container">
        <div class="fb-your-restaurant-main-left">
            <div class="row">
                <div class="col-6 col-xs-6 col-lg-6">
                    <div class="fb-your-restaurant-back-btn">
                        <a href="<?php echo site_url($controller)?>"><i class="fal fa-angle-left"></i> Back</a>
                    </div>
                </div>

                <div class="col-6 col-xs-6 col-lg-6">
                    <div class="fb-your-restaurant-back-btn menu-responsive">
                        <a class="menu-responsive-menu" href="#">Menu <i class="fal fa-angle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php 
				   if($controller=='serviceprovider') {
				   	$this->load->view('inc_service_left');
				   } else {
					   $this->load->view('inc_customer_left');
				   }
				   ?>

                <div class="col-sm-12 col-md-12 col-lg-9">
                    <?php $this->load->view('inc_error');?>

                    <div class="fb-edit-profile-form">
                        <?php
$sel_photo = base_url().'assets/images/user-img.jpg';
if($results['profile_pic']) {
	$sel_photo = base_url().'uploads/profile_pics/'.$results['profile_pic'];
}
?>
 <form name="frm-edit-profile" id="frm-edit-profile"
                                action="<?php echo site_url($controller . '/edit_profile') ?>" method="post"
                                enctype="multipart/form-data"> 
                        <div class="profile-img">
                            <div class="fb-edit-profile-img-section">
                                <div style="position: relative;" class="profile-img-block">
                                    <div class="pro-img"><img src="<?php echo $sel_photo;?>"
                                            class="img-responsive img-preview" id="profile_preview_profile_pic"
                                            alt="" /></div>
                                    <div class="update-pic-btns">
                                        <button href="#" class="up-btn">Choose Photo</button>
                                        <input style="height: 100%; width: 100%; z-index: 99;" id="profile_pic"
                                            name="profile_pic" type="file" class="attachment_upload">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="mode" id="mode" value="submitform">

                            <div class="fb-edit-profile-form-section">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <div class="form-group fb-general-details-input">
                                        <input type="text" class="form-control" placeholder="First Name"
                                            name="first_name" id="first_name"
                                            value="<?php echo isset($results['first_name'])?$this->common->getDbValue($results['first_name']):''; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Last Name</label>
                                    <div class="form-group fb-general-details-input">
                                        <input type="text" class="form-control" placeholder="Last Name" name="last_name"
                                            id="last_name"
                                            value="<?php echo isset($results['last_name'])?$this->common->getDbValue($results['last_name']):''; ?>">
                                    </div>
                                </div>

                                <div class="form-group fb-general-details-input">
                                    <label>Phone</label>
                                    <div class="fb-phone-country-code">
                                        <input type="text" name="" placeholder="+41" class="fb-country-code-input">
                                        <input type="text" name="mobile" id="mobile" placeholder="Phone"
                                            value="<?php echo isset($results['mobile'])?$this->common->getDbValue($results['mobile']):''; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="form-group fb-general-details-input">
                                        <input type="text" class="form-control" placeholder="Email"
                                            value="<?php echo isset($results['email'])?$this->common->getDbValue($results['email']):''; ?>"
                                            readonly>
                                    </div>
                                </div>

                                <div class="fb-login-btn-section">
                                    <button class="btn-over-effect fb-btn-login-btn" type="submit">Save
                                        Changes</button>
                                </div>
                            </div>

                        </div>
 </form>
                    </div>
                </div>
            </div>
        </div>

        <?php $this->load->view('inc_footer');?>
        <?php $this->load->view('inc_common_footer_inner_js');?>

        <script type="text/javascript">
        $('#profile_pic').on('change', function() {
            var formData = new FormData($("#frm-edit-profile")[0]);
            var sel_img = get_extension($('#profile_pic').val());

            $("#error_profile_pic").hide();
            if (sel_img) {
                $.ajax({
                    url: "<?php echo site_url($controller."/profile_pic");?>",
                    type: 'POST',
                    enctype: 'multipart/form-data',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                      //  alert(data);
                        $("#profile_preview_profile_pic").attr("src", data);
                        $("#user-avtar-leftmenu").attr("src", data);
                        $ //("#topheader_profileimage").attr("src", data);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $("#error_profile_pic").show();
                        $("#error_profile_pic").html(xhr.responseText);
                        console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr
                            .responseText);
                    }
                });
            } else {
                $("#error_profile_pic").show();
            }
            // $("#profile_pic_main_form").submit();
        });

        //get extension
        function get_extension(img_name) {
            var dotIndex = img_name.lastIndexOf('.');
            var img_name = img_name.substring(dotIndex);
            if (img_name == '.jpg' || img_name == '.JPG' || img_name == '.png' || img_name == '.PNG' || img_name ==
                '.gif' || img_name == '.GIF' || img_name == '.jpeg' || img_name == '.JPEG') {
                return true;
            } else {
                return false;
            }
        }
        //get extension
        </script>
</body>