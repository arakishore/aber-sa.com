<!doctype html>
<html lang=en-US>

<head>
    <?php $this->load->view('inc_header_commoncss');?>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker.min.css">
    <style>
        .hideall{
            display:none;
        }
    </style>
</head>

<body>
    <?php $this->load->view('inc_header_menu');?>
    <div class="trans-menu-join-bg">
        <img src="<?php echo base_url();?>assets/images/banner-right-section-img.png" alt="banner-right-section-img">
    </div>
    <div class="trans-banner-section trans-select-category-banner">
        <div class="trans-blank-section"></div>
        <div class="container">
            <div class="trans-banner-section-content">
                <div class="trans-banner-content-line"></div>
                <div class="trans-select-category-head">
                    NEW DELIVERY
                </div>
            </div>
        </div>
        <div class="trans-caet-banner-bottom-img"></div>
    </div>
    <div class="trans-select-cate-section-main">
        <div class="container">
            <div class="trans-listing-back-save-btn">
            <?php
                $category_id = isset($postdata['category_id']) ? $postdata['category_id'] : '';
                $sub_categoryid = isset($postdata['sub_categoryid']) ? $postdata['sub_categoryid'] : '';
                ?>
                <a href="<?php echo site_url("request/subcategory/".$category_id."/".$sub_categoryid);?>"
                    class="btn-over-effect trans-listing-back-btn">
                    <img src="<?php echo base_url();?>assets/images/back-btn-arrow.png" alt="save-btn-icon" /> <span>Go
                        Back </span>
                </a>
                <div class="clearfix"></div>
            </div>
            <div class="trans-listing-parameters-main">
                <form class="frm-vendor-search" name="request_step1" id="request_step1" action="<?php echo site_url("request/step1");?>" method="post">
                    <input type="hidden" name="category_id" id="category_id" value="<?php echo (isset($postdata['category_id'])) ? $postdata['category_id'] : ''?>">
                    <input type="hidden" name="sub_categoryid" id="sub_categoryid" value="<?php echo (isset($postdata['sub_categoryid'])) ? $postdata['sub_categoryid'] : ''?>">
                    <div class="trans-shipment-info-head">
                        Shipment Information
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="trans-shipment-info-pickup">
                                        Pickup Location
                                    </div>
                                    <div class="form-group trans-shipment-city-postcode">
                                        <input type="hidden" name="pickup_longitude" id="pickup_longitude" value="<?php echo (isset($postdata['pickup_longitude'])) ? $postdata['pickup_longitude'] : ''?>">
                                        <input type="hidden" name="pickup_latitude" id="pickup_latitude" value="<?php echo (isset($postdata['pickup_latitude'])) ? $postdata['pickup_latitude'] : ''?>">
                                        <label>City or Postcode</label>
                                        <input type="text"  name="pickup_location" id="pickup_location"
                                            class="form-control formclass" placeholder="e.g. As Sahafah, Olaya St" required
                                            onFocus="geolocate()" value="<?php echo (isset($postdata['pickup_location'])) ? $postdata['pickup_location'] : ''?>">
                                        <img src="<?php echo base_url();?>assets/images/input-up-arrow-icon.png"
                                            alt="input-up-arrow-icon" />
                                    </div>
                                    <div class="tarns-pickup-date-input">
                                        <div class="tarns-pickup-date-head">
                                            Pickup Date
                                        </div>
                                        <div class="form-group trans-shipment-city-postcode">
                                            <input type="text" name="pickup_date" id="pickup_date"
                                                class="form-control formclass datepicker1" placeholder="Earliest" value="<?php echo (isset($postdata['pickup_date'])) ? $postdata['pickup_date'] : ''?>" required>
                                            <img src="<?php echo base_url();?>assets/images/input-calender-icon.png"
                                                alt="input-up-arrow-icon" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="trans-shipment-info-pickup">
                                        Delivery Location
                                    </div>
                                    <div class="form-group trans-shipment-city-postcode">
                                        <input type="hidden" name="destination_longitude" id="destination_longitude"
                                            value="<?php echo (isset($postdata['destination_longitude'])) ? $postdata['destination_longitude'] : ''?>">
                                        <input type="hidden" name="destination_latitude" id="destination_latitude"
                                            value="<?php echo (isset($postdata['destination_latitude'])) ? $postdata['destination_latitude'] : ''?>">
                                        <label>City or Postcode</label>
                                        <input type="text" name="destination_location" id="destination_location"
                                            class="form-control formclass" placeholder="e.g. As Sahafah, Olaya St"
                                            onFocus="geolocate()"  value="<?php echo (isset($postdata['destination_location'])) ? $postdata['destination_location'] : ''?>" required>
                                        <img src="<?php echo base_url();?>assets/images/input-down-arrow-icon.png"
                                            alt="input-up-arrow-icon" />
                                    </div>
                                    <div class="tarns-pickup-date-input">
                                        <div class="tarns-pickup-date-head">
                                            Delivery Date
                                        </div>
                                        <div class="form-group trans-shipment-city-postcode">
                                            <input type="text" name="drop_destination_date" id="drop_destination_date"
                                                class="form-control formclass datepicker1" placeholder="Earliest" value="<?php echo (isset($postdata['drop_destination_date'])) ? $postdata['drop_destination_date'] : ''?>" required>
                                            <img src="<?php echo base_url();?>assets/images/input-calender-icon.png"
                                                alt="input-up-arrow-icon" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="trans-listing-back-save-btn">
                        <button type="submit" id="btnstep1" name="btnstep1"
                            class="btn-over-effect trans-listing-back-btn trans-parameter-continue-btn">
                            <span> Continue </span><img src="<?php echo base_url();?>assets/images/back-btn-arrow.png"
                                alt="save-btn-icon">
                        </button>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php $this->load->view('inc_footer');?>
    <?php $this->load->view('inc_common_footer_js');?>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/create-listing.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datepicker.min.js"></script>
    <script>
    
    $(document).ready(function(){
   $("#pickup_date").datepicker({
       format: 'dd-mm-yyyy',
       todayHighlight: true,
       startDate: '+0d',
       autoclose: true,
   }).on('changeDate', function (selected) {
       var minDate = new Date(selected.date.valueOf());
       $('#drop_destination_date').datepicker('setStartDate', minDate);
   });

   $("#drop_destination_date").datepicker({
       format: 'dd-mm-yyyy',
       autoclose: true,
   }).on('changeDate', function (selected) {
           var minDate = new Date(selected.date.valueOf());
           $('#pickup_date').datepicker('setEndDate', minDate);
   });
});

    //btnstep1
    // Controll data
       /*  $('#btnstep1').click(function(){
                //pickup_location

            $('#request_step1').submit();
        }); */

    </script>
     <script type="text/javascript">
    $(document).ready(function($) {

        //btnActive
        $("#err_div").hide();
        $("#success_div").hide();

        $(".formclass").removeClass("border-danger");

        $("#request_step1").submit(function(e) {
            $(".hideall").hide();
            $(".formclass").removeClass("border-danger");
            $("#err_div").hide();
            $("#success_div").hide();


            var isError = false;
            var errMsg = "";
            var errMsg_alert = "";
            
            
            if (!$("#pickup_location").val()) {
                isError = true;
                error_msg = "Please enter an pickup location";
                $("#pickup_location").addClass("border-danger");

                $(".pickup_location").show();
               
            }
           if (!$("#destination_location").val()) {
                isError = true;
                error_msg = "Please enter an destination location";
                $("#destination_location").addClass("border-danger");

                $(".destination_location").show();
               
            }
            //  alert(error_msg);



            if (!isError) {
                //dataString = $("#regform").serialize();
                // alert(web_site_url);
                $("#err_div").html("");
                $("#err_div").hide();
                //$('#request_step1').submit();
                return true;
                
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
     
    </script>
    <script>
    //search location
    var pickup_location, destination_location;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name',
        postal_lat: 'lat',
        postal_lng: 'lng'
    };

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */
            (document.getElementById('pickup_location')), {
                types: ['geocode']
            });
        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);

        autocomplete2 = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */
            (document.getElementById('destination_location')), {
                types: ['geocode']
            });
        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete2.addListener('place_changed', fillInAddress2);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
        var latitude = place.geometry.location.lat();
        var longitude = place.geometry.location.lng();
        //alert(latitude)
        //alert(longitude)
        document.getElementById('pickup_longitude').value = latitude;
        document.getElementById('pickup_latitude').value = longitude;
    }

    function fillInAddress2() {
        // Get the place details from the autocomplete object.
        var place = autocomplete2.getPlace();
        var latitude = place.geometry.location.lat();
        var longitude = place.geometry.location.lng();
        //alert(latitude)
        //alert(longitude)
        document.getElementById('destination_longitude').value = latitude;
        document.getElementById('destination_latitude').value = longitude;
    }

    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBs3Ci13XYyV1cPcs88UVbkOjn05c1r4gY&libraries=places&callback=initAutocomplete"
        async defer></script>
</body>