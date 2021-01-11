var room = 1;
function education_fields() {
room++;
var objTo = document.getElementById('education_fields')
var divtest = document.createElement("div");
divtest.setAttribute("class", "form-group removeclass"+room);
var rdiv = 'removeclass'+room;
divtest.innerHTML = '<div class="trans-item-section-main"><div class="trans-item-section-head">Item 1</div><div class="row"><div class="col-sm-2 col-md-2 col-lg-2"><div class="trans-shipment-info-checkbox"><div class="check-box"><input id="blanket" class="filled-in" type="checkbox"><label for="blanket">Imperial</label></div></div></div><div class="col-sm-4 col-md-4 col-lg-4"><div class="trans-shipment-info-checkbox"><div class="check-box"><input id="blanket" class="filled-in" checked="checked" type="checkbox"><label for="blanket">ImperialMetric</label></div></div></div></div><div class="row"><div class="col-sm-2 col-md-2 col-lg-2"><div class="trans-item-lable-section">Quantity*</div></div><div class="col-sm-4 col-md-4 col-lg-4"><div class="form-group trans-list-para-postcode trans-qty-drop"><select><option>1</option><option>2</option></select><span><i class="fal fa-angle-down"></i></span></div><div class="clearfix"></div></div></div><div class="row"><div class="col-sm-2 col-md-2 col-lg-2"><div class="trans-item-lable-section">Weight*</div></div><div class="col-sm-4 col-md-4 col-lg-4"><div class="form-group trans-list-para-postcode trans-qty-drop"><select><option>Kg</option><option>Kg</option></select><span><i class="fal fa-angle-down"></i></span></div><div class="clearfix"></div></div></div><div class="row"><div class="col-sm-2 col-md-2 col-lg-2"><div class="trans-item-lable-section">Lenght*</div></div><div class="col-sm-5 col-md-5 col-lg-5"><div class="form-group trans-list-para-postcode rans-qty-drop"><select><option>m</option></select><span><i class="fal fa-angle-down"></i></span></div><div class="form-group trans-list-para-postcode"><input type="text" name="city post code" class="form-control" placeholder="cm"></div><div class="clearfix"></div></div></div><div class="row"><div class="col-sm-2 col-md-2 col-lg-2"><div class="trans-item-lable-section">Width*</div></div><div class="col-sm-5 col-md-5 col-lg-5"><div class="form-group trans-list-para-postcode trans-qty-drop"><select><option>m</option></select><span><i class="fal fa-angle-down"></i></span></div><div class="form-group trans-list-para-postcode"><input type="text" name="city post code" class="form-control" placeholder="cm"></div><div class="clearfix"></div></div></div><div class="row"><div class="col-sm-2 col-md-2 col-lg-2"><div class="trans-item-lable-section">Height*</div></div><div class="col-sm-5 col-md-5 col-lg-5"><div class="form-group trans-list-para-postcode trans-qty-drop"><select><option>m</option></select><span><i class="fal fa-angle-down"></i></span></div><div class="form-group trans-list-para-postcode"><input type="text" name="city post code" class="form-control" placeholder="cm"></div><div class="clearfix"></div></div></div><div class="form-group trans-shipment-city-postcode"><label>Description</label><textarea name="description-main" class="trans-textarea-descri"></textarea></div><div class="clearfix"></div></div><button class="btn btn-danger remove-btn-block" type="button" onclick="remove_education_fields('+ room +');"><i class="fal fa-minus"></i> Less</button><div class="clearfix"></div> ';

objTo.appendChild(divtest)
}
function remove_education_fields(rid) {
$('.removeclass'+rid).remove();
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
                var html = '<div class="upload-photo" id="' + id_multiupload_img + id + '">' +
                    '<span class="upload-close">' +
                    '<a href="javascript:void(0)" id="' + id_multiupload_img_remove + id + '" ><i class="fal fa-trash-alt"></i></a>' +
                    '</span>' +
                    '<img src="' + img_src + '" >' +
                    '</div>';
                var file_input = '<input type="file" name="file[]" id="' + id_multiupload_file + id + '" style="display:none" />';
                $(block_img_holder).append(html);
                $(block_fileinputs).append(file_input);
                bindRemoveMultiUpload(id);
            }
            function bindRemoveMultiUpload(id) {
                $("#" + id_multiupload_img_remove + id).on('click', function() {
                    $("#" + id_multiupload_img + id).remove();
                    $("#" + id_multiupload_file + id).remove();
                });
            }
        });
    }
})(jQuery);      