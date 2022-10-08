<?php
if (!empty($error)) {
    echo $error;
}
echo $this->session->flashdata('message_status');
?>
<div class="row">
    <div class="col-md-12 text-center mb-20">
        <img src="<?= base_url('assets/admin/images/dashboard-baner.jpg'); ?>" class="img-responsive"/>
    </div>
</div>