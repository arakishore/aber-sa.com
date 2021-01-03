<?php
$error = $this->session->flashdata('error');
if ($error) { ?>
<div class="alert alert-danger" role="alert">
  <?php echo $error ?>
</div>
<?php } ?>          

<?php
$success = $this->session->flashdata('success');
if ($success) { ?>
<div class="alert alert-success" role="alert">
  <?php echo $success ?>
</div>
<?php } ?> 