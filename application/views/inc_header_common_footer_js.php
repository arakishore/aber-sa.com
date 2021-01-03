  <!--sticky header -->
  <script type="text/javascript">
        window.onscroll = function() {
            myFunction()
        };
        var header = document.getElementById("myHeader");
        var sticky = header.offsetTop;

        function myFunction() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky");
            } else {
                header.classList.remove("sticky");
            }
        }
        </script>

        <!--menuzord -->
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/menuzord.js"></script>
        <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery("#menuzord").menuzord({
                align: "left"
            });
        });
        </script>
        <!--menuzord-->

        <!--slick slider-->
        <script src="<?php echo base_url();?>assets/js/slick.js" type="text/javascript"></script>
        <script type="text/javascript">
        $(document).on('ready', function() {
            $(".lazy").slick({
                lazyLoad: 'ondemand', // ondemand progressive anticipated
                infinite: true
            });

            $(".regular").slick({
                dots: true,
                infinite: true,
                slidesToShow: 2,
                slidesToScroll: 1,
                autoplay: true,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 700,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });

            $(".lazy-testimonial").slick({
                lazyLoad: 'ondemand', // ondemand progressive anticipated
                infinite: true,
                autoplay: true,
                dots: true
            });



//footer form 
   //btnActive
    

   $('.btnfooter').click(function(){
       
            var formtype =  $(this).data('formtype');
         // alert(formtype);
     //console.log(this.id);
    

                var isError = false;
                var errMsg = "";
                var errMsg_alert = "";
                var footer_contact_fname = $("#"+formtype+" input[name='footer_contact_fname']").val();
               // alert(footer_contact_fname);
               
                var footer_contact_email = $("#"+formtype+" input[name='footer_contact_email']").val();
              
                if (footer_contact_email == "") {
                    isError = true;
                    error_msg = "Please enter your email id";
                    //return false;
                }

                if (!$("#"+formtype+" input[name='footer_contact_email']").val() || !validateEmail($("#"+formtype+" input[name='footer_contact_email']").val())) {
                    isError = true;
                    error_msg = "Please enter valid email id";
                    // $("#error_email").show()
                }


               

                if (footer_contact_fname == "") {
                    isError = true;
                    error_msg = "Please enter   first name";
                    //return false;
                }






                if (!isError) {
                    
                    $("#"+formtype+"-success_divfooter").html("");
                    $("#"+formtype+"-success_divfooter").hide();

                    dataString = $("#"+formtype).serialize();
 
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        data: dataString, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                  //      contentType: false, // The content type used when sending data to the server.
                   //     cache: false, // To unable request pages to be cached
                    //    processData: false, // To send DOMDocument or non processed data file it is set to false
                        url: '<?php echo site_url("common_ajax/footerform")?>',

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
                           // console.log(redata);
                            if (redata.status) {


                                $("#"+formtype+"-success_divfooter").html(redata.retcomment);
                                $("#"+formtype+"-success_divfooter").show();
 
                                $('#footer_contact_fname').val("");
                                
                                $('#footer_contact_email').val("");
                                
                                $("#"+formtype).hide();
                                
                            } else {
                                // alert(redata.retcomment);
                                $("#"+formtype+"-success_divfooter").html(redata.retcomment);
                                $("#"+formtype+"-success_divfooter").show();

                                 

                            }
                        },
                        error: function(redata) {

                            $("#"+formtype+"-success_divfooter").html(redata.retcomment);
                            $("#"+formtype+"-success_divfooter").show();
                        }
                    });

                    //end ajax send this to php page
                } else {
                  
                    $("#"+formtype+"-success_divfooter").html(error_msg);
                    $("#"+formtype+"-success_divfooter").show();
                }
                return false;
            
    });

            

//end of footer

        });
        </script>

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