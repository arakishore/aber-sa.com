<?php
$session_user_data = $this->session->userdata('user_data');
?>
<div class="navbar navbar-expand-lg navbar-light">
    <div class="text-center d-lg-none w-100">
        <button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
            <i class="icon-unfold mr-2"></i>
            Footer
        </button>
    </div>

    <div class="navbar-collapse collapse" id="navbar-footer">
        <span class="navbar-text">
            &copy; <?php echo date("Y")?>. ABER Transportation
        </span>

        
    </div>
</div>
<?php $this->load->view('inc_footer_firebase');?>
<script>
jQuery('.numbersOnly').keyup(function() {
    this.value = this.value.replace(/[^0-9\.]/g, '');
});
jQuery('.alphaonly').keyup(function() {
    this.value = this.value.replace(/[^a-zA-Z\s]+$/, '');
});
jQuery('.alhanumeric').keyup(function() {
    this.value = this.value.replace(/[^a-zA-Z0-9\-\s]+$/, '');
});
jQuery('.dob').keyup(function() {
    this.value = this.value.replace(/[^a-zA-Z0-9\-\s]+$/, '');
});

function validateEmail(email) {
    var eml = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
    if (eml.test($.trim(email)) == false) {
        return false;
    }
    return true;
}

function validateMobile(mobile) {
    var mob = /^[1-9]{1}[0-9]{9}$/;
    if (mob.test($.trim(mobile)) == false) {
        return false;
    }
    return true;
}

function validationzipcode(zipcode) {
    var zip = /^[1-9][0-9]{6}$/;
    if (zip.test($.trim(zipcode)) == false) {
        return false;
    }
    return true;
}
</script>