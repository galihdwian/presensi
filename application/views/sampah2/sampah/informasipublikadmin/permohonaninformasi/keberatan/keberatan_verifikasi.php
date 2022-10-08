<div class="row">
    <div class="col-md-12">        
        <div class="x_panel">
            <div class="x_content"> 
                <?php
                echo validation_errors();
                $attributes = array('class' => 'form-horizontal', 'id' => 'form_konfirmasi');
                echo form_open('adminpermohonan/keberatan_verifikasi/' . $id_keberatan, $attributes);
                ?>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Tanggal Konfirmasi:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="date_konfirmasi" name="date_konfirmasi" value="<?php echo date('d-m-Y H:i:s'); ?>" readonly="true">
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
                    <label class="control-label col-sm-2" for="email">Isi Tanggapan:</label>
                    <div class="col-sm-10">
                        <textarea name="pesan_konfirmasi" id="pesan_konfirmasi" class="form-control input-sm" spellcheck="false" autocomplete="off"><?php echo (set_value("pesan_konfirmasi") == "" ? "Terimakasih atas penyampaian keberatan atas permohonan informasi yang saudara sampaikan. Berdasarkan tindak lanjut dan investigasi dari tim PPID RSMS maka ....." : set_value('pesan_konfirmasi')); ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a href="<?php echo site_url('adminpermohonan/keberatan_detail/' . $id_keberatan); ?>" class="btn btn-warning">Batal</a>
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