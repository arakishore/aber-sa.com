<!doctype html>
<html lang=en-US>

<head>
    <?php $this->load->view('inc_header_commoncss');?>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-datepicker.min.css">
    <?php
$i=0;
?>
</head>

<body>
    <?php $this->load->view('inc_header_menu');?>

    <div class="trans-menu-join-bg">
        <img src="<?php echo base_url();?>assets/images/banner-right-section-img.png" alt="banner-right-section-img" />
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
        <form class="frm-vendor-search" name="request_step2" id="request_step2"
            action="<?php echo site_url("request/step2");?>" method="post" enctype="multipart/form-data">
            <div class="container">
                <div class="trans-listing-back-save-btn">
                    <?php
                $category_id = isset($postdata1['category_id']) ? $postdata1['category_id'] : '';
                $subcategory_id = isset($postdata1['subcategory_id']) ? $postdata1['subcategory_id'] : '';
                ?>
                    <a href="<?php echo site_url("request/step1/{$category_id}/{$subcategory_id}");?>"
                        class="btn-over-effect trans-listing-back-btn">
                        <img src="<?php echo base_url();?>assets/images/back-btn-arrow.png" alt="save-btn-icon" />
                        <span>Go
                            Back </span>
                    </a>
                    <div class="clearfix"></div>
                </div>
                <div class="trans-listing-parameters-main">
                    <div class="trans-listing-info-head">
                        Shipment Listing Information
                    </div>

                    <div class="form-group trans-shipment-city-postcode trans-shipinment-title">
                        <label>Shipinment Title</label>
                        <input type="text" name="request_title"
                            value="<?php echo (isset($postdata['request_title'])) ? $postdata['request_title'] : ''?>"
                            required class="form-control formclass" placeholder="e.g. USA">
                    </div>
                    <div class="text-block">
                        <div class="trans-item-section-main">
                            <div class="trans-item-section-head">
                                Item 1
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-2">
                                    <div class="trans-item-lable-section">
                                        Quantity*
                                    </div>
                                </div>
                                <div class="col-sm-8 col-md-8 col-lg-10">
                                    <div class="form-group trans-list-para-postcode trans-qty-drop">
                                        <select name="consignment_qty[]" id="consignment_qty1" required>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>



                                        </select>
                                        <span><i class="fal fa-angle-down"></i></span>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-2">
                                    <div class="trans-item-lable-section">
                                        Weight*
                                    </div>
                                </div>
                                <div class="col-sm-8 col-md-8 col-lg-10">
                                    <div class="form-group trans-list-para-postcode">
                                        <input type="text" name="consignment_weight[]" id="consignment_weight1"
                                            class="form-control formclass" placeholder="Kg"
                                            value="<?php echo (isset($postdata['consignment_weight'][$i])) ? $postdata['consignment_weight'][$i] : ''?>"
                                            required>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-2">
                                    <div class="trans-item-lable-section">
                                        Lenght*
                                    </div>
                                </div>
                                <div class="col-sm-8 col-md-8 col-lg-10">
                                    <div class="form-group trans-list-para-postcode">
                                        <input type="text" name="consignment_length[]" id="consignment_length1"
                                            class="form-control formclass" placeholder="cm"
                                            value="<?php echo (isset($postdata['consignment_length'][$i])) ? $postdata['consignment_length'][$i] : ''?>"
                                            required>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-2">
                                    <div class="trans-item-lable-section">
                                        Width*
                                    </div>
                                </div>
                                <div class="col-sm-8 col-md-8 col-lg-10">
                                    <div class="form-group trans-list-para-postcode">
                                        <input type="text" name="consignment_width[]" id="consignment_width1"
                                            class="form-control formclass" placeholder="cm"
                                            value="<?php echo (isset($postdata['consignment_width'][$i])) ? $postdata['consignment_width'][$i] : ''?>"
                                            required>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-md-4 col-lg-2">
                                    <div class="trans-item-lable-section">
                                        Height*
                                    </div>
                                </div>
                                <div class="col-sm-8 col-md-8 col-lg-10">
                                    <div class="form-group trans-list-para-postcode">
                                        <input type="text" name="consignment_height[]" id="consignment_height1"
                                            class="form-control formclass" placeholder="cm"
                                            value="<?php echo (isset($postdata['consignment_height'][$i])) ? $postdata['consignment_height'][$i] : ''?>"
                                            required>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="form-group trans-shipment-city-postcode">
                                <label>Description</label>
                                <textarea name="consignment_details[]" class="trans-textarea-descri"
                                    id="consignment_details1"></textarea>
                            </div>
                            <button class="btn trans-btns-hover-effect add-remove-btn" type="button"
                                onclick="education_fields();"><i class="fal fa-plus"></i> Add </button>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <div id="education_fields"></div>
                    </div>
                    <div class="form-group trans-list-para-postcode add-photos-main-section">
                        <label>Add Photos</label>
                        <div class="add-photos-main-section-images">
                            <span data-multiupload="1">
                                <span data-multiupload-holder></span>
                                <?php
                                
                                if(isset($consignmentimage_temp) && sizeof($consignmentimage_temp) > 0) { 
                                    foreach($consignmentimage_temp as $key => $val){
                                ?>
                                <div class="upload-photo" id="multiupload_img_1_<?php echo $val['img_id']?>"><span class="upload-close"><a
                                            href="javascript:void(0)" onclick="bindRemoveMultiUpload_new('<?php echo $val['img_id']?>')" id="multiupload_img_remove1_<?php echo $val['img_id']?>"><i
                                                class="fal fa-trash-alt"></i></a></span><img src="<?php echo base_url();?>uploads/consignmentimage_temp/<?php echo $val['image_name']?>"></div>
                                <?php    }
                                    }
                                ?>
                                <span class="upload-photo">
                                    <img src="<?php echo base_url();?>assets/images/multi-images-main-img.jpg"
                                        alt="plus img">
                                    <input data-multiupload-src class="upload_pic_btn" type="file" multiple="">
                                    <span data-multiupload-fileinputs></span>
                                </span>

                            </span>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    <div class="trans-listing-back-save-btn">
                        <button type="submit" id="btnstep2" name="btnstep2"
                            class="btn-over-effect trans-listing-back-btn trans-parameter-continue-btn">
                            <span> Continue </span><img src="<?php echo base_url();?>assets/images/back-btn-arrow.png"
                                alt="save-btn-icon">
                        </button>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <?php $this->load->view('inc_footer');?>

    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/common.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/create-listing-parameters.js"></script>

    <script>
    var room = 1;

    function education_fields() {
        room++;
        var objTo = document.getElementById('education_fields')
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "form-group removeclass" + room);
        var rdiv = 'removeclass' + room;
        divtest.innerHTML =
            '<div class="trans-item-section-main"><div class="trans-item-section-head"> Item ' + room +
            '</div><div class="row"><div class="col-sm-4 col-md-4 col-lg-2"><div class="trans-item-lable-section"> Quantity*</div></div><div class="col-sm-8 col-md-8 col-lg-10"><div class="form-group trans-list-para-postcode trans-qty-drop"> <select class="formclass"  name="consignment_qty[]" id="consignment_qty' +
            room +
            '"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select> <span><i class="fal fa-angle-down"></i></span></div><div class="clearfix"></div></div></div><div class="row"><div class="col-sm-4 col-md-4 col-lg-2"><div class="trans-item-lable-section"> Weight*</div></div><div class="col-sm-8 col-md-8 col-lg-10"><div class="form-group trans-list-para-postcode"> <input type="text"   name="consignment_weight[]" id="consignment_weight' +
            room +
            '" class="form-control formclass" placeholder="Kg"></div><div class="clearfix"></div></div></div><div class="row"><div class="col-sm-4 col-md-4 col-lg-2"><div class="trans-item-lable-section"> Lenght*</div></div><div class="col-sm-8 col-md-8 col-lg-10"><div class="form-group trans-list-para-postcode"> <input type="text" class="formclass"  name="consignment_length[]" id="consignment_length' +
            room +
            '" class="form-control formclass" placeholder="cm"></div><div class="clearfix"></div></div></div><div class="row"><div class="col-sm-4 col-md-4 col-lg-2"><div class="trans-item-lable-section"> Width*</div></div><div class="col-sm-8 col-md-8 col-lg-10"><div class="form-group trans-list-para-postcode"> <input type="text" class="formclass"  name="consignment_width[]" id="consignment_width' +
            room +
            '" class="form-control formclass" placeholder="cm"></div><div class="clearfix"></div></div></div><div class="row"><div class="col-sm-4 col-md-4 col-lg-2"><div class="trans-item-lable-section"> Height*</div></div><div class="col-sm-8 col-md-8 col-lg-10"><div class="form-group trans-list-para-postcode"> <input type="text" class="formclass"  name="consignment_height[]" id="consignment_height' +
            room +
            '" class="form-control formclass" placeholder="cm"></div><div class="clearfix"></div></div></div><div class="form-group trans-shipment-city-postcode"> <label>Description</label><textarea name="consignment_details[]" class="trans-textarea-descri formclass" id="consignment_details' +
            room +
            '"></textarea></div> <button class="btn trans-btns-hover-effect add-remove-btn" type="button" onclick="remove_education_fields(' +
            room + ');"><i class="fal fa-minus"></i> Less </button><div class="clearfix"></div></div> ';

        objTo.appendChild(divtest)
    }

    function remove_education_fields(rid) {
        $('.removeclass' + rid).remove();
    }

    //dropzone script with multiple files
    (function($) {
        function readMultiUploadURL(input, callback) {
            if (input.files) {
                $.each(input.files, function(index, file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        callback(false, e.target.result);
                    }
                    reader.readAsDataURL(file);
                });
            }
            callback(true, false);
        }
        var arr_multiupload = $("span[data-multiupload]");
        if (arr_multiupload.length > 0) {
            $.each(arr_multiupload, function(index, elem) {
                var container_id = $(elem).attr("data-multiupload");
                var id_multiupload_img = "multiupload_img_" + container_id + "_";
                var id_multiupload_img_remove = "multiupload_img_remove" + container_id + "_";
                var id_multiupload_file = id_multiupload_img + "_file";
                var block_multiupload_src = "data-multiupload-src-" + container_id;
                var block_multiupload_holder = "data-multiupload-holder-" + container_id;
                var block_multiupload_fileinputs = "data-multiupload-fileinputs-" + container_id;
                var input_src = $(elem).find("input[data-multiupload-src]");
                $(input_src).removeAttr('data-multiupload-src')
                    .attr(block_multiupload_src, "");
                var block_img_holder = $(elem).find("span[data-multiupload-holder]");
                $(block_img_holder).removeAttr('data-multiupload-holder')
                    .attr(block_multiupload_holder, "");
                var block_fileinputs = $(elem).find("span[data-multiupload-fileinputs]");
                $(block_fileinputs).removeAttr('data-multiupload-fileinputs')
                    .attr(block_multiupload_fileinputs, "");
                $(input_src).on('change', function(event) {
                    readMultiUploadURL(event.target, function(has_error, img_src) {
                        if (has_error == false) {
                            addImgToMultiUpload(img_src);
                        }
                    })
                });

                function addImgToMultiUpload(img_src) {

                    var id = Math.random().toString(36).substring(2, 10);

                    // console.log(img_src);
                    $.post('<?php echo site_url("request/doAddimage");?>', {
                            img_src: img_src,
                            img_id: id
                        },
                        function(data) {

                        });



                    var html = '<div class="upload-photo" id="' + id_multiupload_img + id + '">' +
                        '<span class="upload-close">' +
                        '<a href="javascript:void(0)" id="' + id_multiupload_img_remove + id +
                        '" ><i class="fal fa-trash-alt"></i></a>' +
                        '</span>' +
                        '<img src="' + img_src + '" >' +
                        '</div>';
                    var file_input = '<input type="file" name="file[]" id="' + id_multiupload_file + id +
                        '" style="display:none" />';
                    $(block_img_holder).append(html);
                    $(block_fileinputs).append(file_input);
                    bindRemoveMultiUpload(id);
                }

                function bindRemoveMultiUpload(id) {
                    $("#" + id_multiupload_img_remove + id).on('click', function() {
                        $("#" + id_multiupload_img + id).remove();
                        $("#" + id_multiupload_file + id).remove();

                        $.post('<?php echo site_url("request/doDeletImage");?>', {

                                img_id: id
                            },
                            function(data) {
                                console.log(data);
                            });
                    });
                }
            });
        }
    })(jQuery);

    function bindRemoveMultiUpload_new(id) {
        
                        $("#multiupload_img_1_" + id).remove();
                         

                        $.post('<?php echo site_url("request/doDeletImage");?>', {

                                img_id: id
                            },
                            function(data) {
                                console.log(data);
                            });
                }
    </script>

    <script type="text/javascript">
    $(document).ready(function($) {

        //btnActive
        $("#err_div").hide();
        $("#success_div").hide();

        $(".formclass").removeClass("border-danger");

        $("#request_step3").submit(function(e) {
            $(".hideall").hide();
            $(".formclass").removeClass("border-danger");
            $("#err_div").hide();
            $("#success_div").hide();


            var isError = false;
            var errMsg = "";
            var errMsg_alert = "";


            if (!$("#consignment_qty1").val()) {
                isError = true;
                error_msg = "Please enter an pickup location";
                $("#consignment_qty1").addClass("border-danger");

                $(".consignment_qty1").show();

            }

            if (!$("#consignment_weight1").val()) {
                isError = true;
                error_msg = "Please enter weight";
                $("#consignment_weight1").addClass("border-danger");

                $(".consignment_weight1").show();

            }

            if (!$("#consignment_length1").val()) {
                isError = true;
                error_msg = "Please enter length";
                $("#consignment_length1").addClass("border-danger");

                $(".consignment_length1").show();

            }
            if (!$("#consignment_height1").val()) {
                isError = true;
                error_msg = "Please enter   height";
                $("#consignment_height1").addClass("border-danger");

                $(".consignment_height1").show();

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




        $(".formclass").click(function() {
            $(this).removeClass("border-danger");
            var id = $(this).attr('id');
            $("." + id).hide();
        });
        $(".formclass").blur(function() {
            if (!$(this).val()) {
                var id = $(this).attr('id');
                $(this).addClass("border-danger");
                $("." + id).show();
            }


        });

    });
    </script>
</body>