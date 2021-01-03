<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view('inc_metacss');?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Admin Management</title>
  <!-- Global stylesheets -->

  <link href="https://fonts.googleapis.com/css2?family=Muli:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
        <!--font-family: 'Muli', sans-serif;-->

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        <!--font-family: 'Poppins', sans-serif;-->
<link rel="shortcut icon"
	href="<?php echo base_url()?>global_assets/images/companylogo.png"
	type="image/x-icon" />
<!-- Global stylesheets -->
 
<link
	href="<?php echo base_url() ?>assets/css/loginstyle.css"
	rel="stylesheet" type="text/css">

<!-- /global stylesheets -->

<!-- Core JS files -->

</head>
<style>
.login_bg {
	background-color: #ffffff!important;
	 
	background-repeat: no-repeat;
	background-size: cover;
	position: relative;
	height: 100vh;
}

body {background-color: #92a8d1!important;}


.no-background1 {
	background-image:
		url("<?php echo base_url() ?>global_assets/images/bg2.jpg");
}
</style>
<body>
	<div class="login_bg">

		<div class="page_loader"></div>

		 

		<!-- login-form -->
		 
			<div class="loginInner" id="pass_form1">

				<div class="login_l">
					<a href=""><img
						src="<?php echo base_url() ?>/global_assets/images/logo_login.png"
						alt=""></a>

					<p class="login_txt">
                   <h1> Welcome Admin</h1>   </span>
					</p>

				</div>

				<div class="login_r">



				<!-- 	<img
						src="<?php echo base_url() ?>/global_assets/images/logoicon.png"
						alt=""> -->
					<!-- <h2 class="login_head_one">Sign into your account</h2> -->
					<div class="clr"></div>
					
					

					  <!-- Login form -->
                      <form class="login-form" action="<?php echo site_url('home') ?>" method="post">

<div class="card mb-0">
    <div class="card-body">
        <div class="text-center mb-3">
            
           
        </div>
        <?php //$error_msg = $this->session->flashdata('error_msg');
if ($error_msg) {
?>
        <div class="alert alert-danger" id="errormsg">
            <?php echo $error_msg; ?>
        </div>
        <?php } else {?>
        <div class="alert alert-danger" id="errormsg" style="display:none">

        </div>
        <?php }?>
        <div class="form-group form-group-feedback form-group-feedback-left">
            <input type="text" name="username" id="username" class="form-control" placeholder="Username">
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
        </div>

        <div class="form-group form-group-feedback form-group-feedback-left">
            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
        </div>

        <!-- <div class="text-center">
        <a href="login_password_recover.html">Forgot password?</a>
    </div> -->
    </div>
</div>
</form>
<!-- /login form -->
					 

				</div>

				<div class="clr"></div>
			</div>




		 
		 

			</div>
	 


	</div>

 
</body>

</html>