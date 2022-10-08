<?php
//print_r($get_file);
if (!empty($get_file)):
    foreach ($get_file as $r_file):
        ?>
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel"><?php echo $r_file['isi_informasi']; ?></h4>
        </div>
        <div class="modal-body">
            <object data="<?php echo base_url(); ?>assets/file/<?php echo $r_file['file_download'];?>" type="application/pdf" width="100%" height="500px"> 
                <p>Tampaknya Anda tidak memiliki plugin PDF untuk browser ini. Tidak masalah, Anda dapat <a href="<?php echo base_url(); ?>assets/informasipublik/file/CALK_2015.pdf" target="blank">klik disini untuk download pdf file.</a></p>  
            </object>
        </div>
        <?php
    endforeach;
    unset($r_file);
endif;
?>