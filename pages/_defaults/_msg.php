<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    .alert p{
        vertical-align: middle;
        display: table-cell;
    }
</style>
<?php if($this->session->flashdata('errors')): ?>
    <div class="alert alert-danger">
        <span type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
        <strong>Error!</strong> <?= $this->session->flashdata('errors',true).PHP_EOL ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <div class="container">
        <div class="alert alert-danger alert-dismissable">
            <span type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
            <strong>Error!</strong> <?php echo $this->session->flashdata('error',true).PHP_EOL; ?>
        </div>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-block alert-success alert-dismissable" role="alert">
        <span type="button" class="close" data-bs-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
        <strong>Success!</strong> <?php echo $this->session->flashdata('success',true).PHP_EOL; ?>.
    </div>
<?php endif; ?>