<?php
$session_user_data = $this->session->userdata('user_data');
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title><?php echo (isset($tittle))?$title:'ABER Transportation'?> </title>

<!-- Global stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>global_assets/css/icons/icomoon/styles.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>global_assets/css/icons/fontawesome/styles.min.css" rel="stylesheet" type="text/css">

<link href="<?php echo base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>assets/css/bootstrap_limitless.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>assets/css/layout.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>assets/css/components.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>assets/css/colors.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url() ?>assets/css/custom.css" rel="stylesheet" type="text/css">

<!-- /global stylesheets -->

<!-- Core JS files -->
<script src="<?php echo base_url() ?>global_assets/js/main/jquery.min.js"></script>
<script src="<?php echo base_url() ?>global_assets/js/main/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>global_assets/js/plugins/loaders/blockui.min.js"></script>
<!-- /core JS files -->

<!-- Theme JS files -->

<!-- Theme JS files -->
<script src="<?php echo base_url() ?>global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
 <script src="<?php echo base_url() ?>global_assets/js/plugins/tables/datatables/extensions/fixed_columns.min.js"></script>

 
 
<script src="<?php echo base_url() ?>global_assets/js/plugins/forms/selects/select2.min.js"></script>
<script src="<?php echo base_url() ?>global_assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js"></script>
	<script src="<?php echo base_url() ?>global_assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
	<script src="<?php echo base_url() ?>global_assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>
	<script src="<?php echo base_url() ?>global_assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
<script src="<?php echo base_url() ?>global_assets/js/plugins/forms/styling/switchery.min.js"></script>

<script src="<?php echo base_url() ?>global_assets/js/plugins/forms/styling/uniform.min.js"></script>


<script src="<?php echo base_url() ?>global_assets/js/plugins/visualization/d3/d3.min.js"></script>
<script src="<?php echo base_url() ?>global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
<script src="<?php echo base_url() ?>global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
<script src="<?php echo base_url() ?>global_assets/js/plugins/ui/moment/moment.min.js"></script>
<script src="<?php echo base_url() ?>global_assets/js/plugins/pickers/daterangepicker.js"></script>

<script src="<?php echo base_url() ?>global_assets/js/plugins/notifications/bootbox.min.js"></script>

<!-- <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script> -->

<script src="<?php echo base_url() ?>assets/js/app.js"></script>
<!-- /theme JS files -->
<script>
var st_url = "<?php echo site_url() ?>/";
</script>
<style>
.hidedefault {
    display: none;
}
</style>