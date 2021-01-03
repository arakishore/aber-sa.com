    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>                
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/common.js"></script>    

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