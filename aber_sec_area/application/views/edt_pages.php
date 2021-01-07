<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view('inc_metacss');?>

	<!-- Core JS files -->
	 
	<!-- Theme JS files -->

	 
    

	<!-- /theme JS files -->    

    
</head>

<body>

	<!-- Main navbar -->
		<?php $this->load->view('inc_topmenu');?>	
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">
		<!-- Main sidebar -->
		<?php $this->load->view('inc_leftmenu');?>
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-light">
                    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                        <div class="d-flex">
                            <div class="breadcrumb">
                                <a href="<?php echo site_url("dashboard");?>" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                                <span class="breadcrumb-item ">CMS</span>
                                <span class="breadcrumb-item active">Pages Data</span>
                            </div>

                            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                        </div>

                        <div class="header-elements d-none">
                            <div class="breadcrumb justify-content-center">
                                <a href="<?php echo site_url($this->ctrl_name.'/list_all')?>" class="breadcrumb-elements-item">
                                    <button type="button" class="btn btn-success btn-sm"><i class="icon-plus2 mr-2"></i> Back</button>
                                </a>

                            </div>
                        </div>
                    </div>

                </div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">

				<!-- Page length options -->
			  <div class="card">
				<div class="card-header header-elements-inline">
						<h5 class="card-title">Edit Paragraph / Page</h5>
				  </div>


				  <div class="card-body">
<form action="<?php echo site_url($this->ctrl_name.'/edit_att/'.$id)?>" name="ed_pg_frm" id="ed_pg_frm" method="post" class="form-horizontal" enctype="multipart/form-data">
<input type="hidden" name="mode_edt" id="mode_edt" value="edit_att">

                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="name">Heading :<span class="text-danger">*</span></label>
                                    <div class="col-lg-9"><input type="text" class="form-control" id="cms_title" name="cms_title" required placeholder="Heading" value="<?php echo $this->common->getDbValue($sel_rs['cms_title'])?>">

                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="company">Content (Arabic):</label>
                                    <div class="col-lg-9">
										<textarea class="form-control col-md-12 ckeditor" rows="8" name="cms_desc" id="cms_desc" placeholder="Content (Arabic)" required><?php echo $this->common->getDbValue($sel_rs['cms_desc'])?></textarea>                                    
                                    </div>
                                    
                                </div>
                                
<div class="form-group row">
                                    <label class="col-form-label col-lg-2" for="company">Content (ENG):</label>
                                    <div class="col-lg-9">
										<textarea class="form-control col-md-12 ckeditor" rows="8" name="cms_desc_more" id="cms_desc_more" placeholder="Content (ENG)" required><?php echo $this->common->getDbValue($sel_rs['cms_desc_more'])?></textarea>                                    
                                    </div>
                                    
                                </div>                                
<?php

if($sel_rs['cms_image']!=''){
			$photo = back_path.'uploads/para_images/'.stripslashes($sel_rs['cms_image']);
} else {
			$photo = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';	
}
?>
<div class="form-group row">
                                    <label class="col-md-2 control-label"> Image </label>
                                    <div class="col-md-10">
                                        <div class="row col-md-5">
                                            <img src="<?php echo $photo?>" id="temppreviewimageki1" class="temppreviewimageki1" style="width:200px; height:auto;display:none1"> </div>
                                        <div class="row col-md-10">

                                            <div class="input-group image-preview1">

                                                <input type="text" class="form-control image-preview-filename1" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                                                <span class="input-group-btn">
                                                    <!-- image-preview-clear button -->
                                                    <button type="button" class="btn btn-default image-preview-clear image-preview-clear1" style="display:none;" id=1>
                                                        <span class="glyphicon glyphicon-remove"></span> Clear
                                                    </button>
                                                    <!-- image-preview-input -->
                                                    <div class="btn btn-default image-preview-input">
                                                        <span class="glyphicon glyphicon-folder-open"></span>
                                                        <span class="image-preview-input-title image-preview-input-title1">Browse</span>
                                                        <input type="file" accept="image/png, image/jpeg, image/gif" class="browseimage" id="1" name="cms_image" /> <!-- rename it -->

                                                    </div>
                                                </span>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="form-group row">
                                    <label class="col-form-label col-lg-2"></label>
                                    <div class="col-lg-9">
                                        <button type="submit" class="btn bg-blue">Save <i class="icon-paperplane ml-2"></i></button>
                                        <a href="<?php echo site_url($this->ctrl_name.'/list_all')?>"><button type="button" class="btn btn-light  ml-2">Cancel</button></a>
                                    </div>
                                </div>
                            </form>
                        </div>
				</div>
				<!-- /page length options -->


			</div>
			<!-- /content area -->


			<!-- Footer -->
			<?php $this->load->view('inc_footer');?>
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->
 <script type="text/javascript">
        jQuery(document).ready(function($) {






            $(function() {


                //image 1
                // Create the close button
                var closebtn1 = $('<button/>', {
                    type: "button",
                    text: 'x',
                    id: 'close-preview1',
                    style: 'font-size: initial;',
                });
                closebtn1.attr("class", "close pull-right");
                // Set the popover default content
                $('.image-preview1').popover({
                    trigger: 'manual',
                    html: true,
                    title: "<strong>Preview</strong>" + $(closebtn1)[0].outerHTML,
                    content: "There's no image",
                    placement: 'bottom'
                });
                // Clear event
                $('.image-preview-clear').click(function() {
                    var imgid = $(this).attr('id');
                    $('.image-preview' + imgid).attr("data-content", "").popover('hide');
                    $('.image-preview-filename' + imgid).val("");
                    $('.image-preview-clear' + imgid).hide();
                    //$('.image-preview-input input:file').val("");
                    $(".image-preview-input-title" + imgid).text("Browse");
                    $(".temppreviewimageki" + imgid).attr("src", '');
                    $(".temppreviewimageki" + imgid).hide();
                });
                // Create the preview image
                $(".browseimage").change(function() {
                    var img = $('<img/>', {
                        id: 'dynamic',
                        width: 250,
                        height: 200,
                    });
                    var imgid = $(this).attr('id');
                    var file = this.files[0];
                    var reader = new FileReader();
                    // Set preview image into the popover data-content
                    reader.onload = function(e) {

                        $(".image-preview-input-title" + imgid).text("Change");
                        $(".image-preview-clear" + imgid).show();
                        $(".image-preview-filename" + imgid).val(file.name);
                        img.attr('src', e.target.result);

                        $(".temppreviewimageki" + imgid).attr("src", $(img)[0].src);
                        $(".temppreviewimageki" + imgid).show();
                        //img.attr('src', e.target.result);
                        //alert(e.target.result);
                        ///alert($(img)[0].outerHTML);
                        //$(".image-preview1").attr("data-content",$(img)[0].outerHTML).popover("show");
                    }
                    reader.readAsDataURL(file);
                });
                //end  
            });
        });

        // TableManageButtons.init();
        </script>    
</body>
</html>
