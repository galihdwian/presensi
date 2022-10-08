<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_content"> 
                <?php
                echo validation_errors();
                $attributes = array('class' => 'form-horizontal', 'id' => 'form_konfirmasi');
                echo form_open('adminpermohonan/permohonan_keputusan/' . $id_permohonan, $attributes);
                ?>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Tanggal Keputusan:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="date_konfirmasi" name="date_konfirmasi" value="<?php echo date('d-m-Y H:i:s'); ?>" readonly="true">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Hasil Keputusan:</label>
                    <div class="col-sm-10">
                        <label class="radio-inline"><input type="radio" name="optradio" value="ditolak" <?php echo (set_value('optradio') == 'ditolak' ? 'checked="true"' : ""); ?>>Permohonan Ditolak</label>
                        <label class="radio-inline"><input type="radio" name="optradio" value="diterima" <?php echo (set_value('optradio') == 'diterima' ? 'checked="true"' : ""); ?>>Permohonan Diterima</label>
                    </div>
                </div>                 

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <div class="checkbox">
                            <label><input type="checkbox" id="sendmail" name="sendmail" value="T" <?php echo (set_value('sendmail') == 'T' ? 'checked="true"' : ""); ?>> Kirim Email</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Pesan Email:</label>
                    <div class="col-sm-10">
                        <textarea name="pesan_konfirmasi" id="pesan_konfirmasi" class="form-control input-sm" spellcheck="false" autocomplete="off"><?php echo (set_value('pesan_konfirmasi') == ""?"Terimakasih atas permohonan informasi dari saudara. Permohonan Informasi telah kami tindak lanjuti. Berdasarkan hasil tindaklanjut permohonan saudara kami TERIMA / TOLAK dengan alasan : ":set_value('pesan_konfirmasi'));?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Alasan Penolakan:</label>
                    <div class="col-sm-10">
                        <textarea name="alasan_penolakan" id="pesan_konfirmasi" class="form-control input-sm" spellcheck="false" autocomplete="off"><?php echo set_value('alasan_penolakan');?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">                        
                        <a href="<?php echo site_url('adminpermohonan/permohonan_detail/' . $id_permohonan); ?>" class="btn btn-warning">Batal</a>                        
                        <button type="submit" class="btn btn-default">Simpan</button>
                    </div>
                </div>
                <?php
                echo form_close();
                ?>
            </div>
        </div>
    </div>
</div>