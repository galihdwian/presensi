<section id="blog">
    <div class="blog">
        <?php
        if (!empty($get_subfile)) {
            ?>
            <div class="center">
                <h2><?= $get_subfile->display_name; ?></h2>
                <?= ($get_subfile->keterangan != NULL ? '<p>' . $get_subfile->keterangan . '</p>' : ''); ?>
            </div>
            <?php
            $path = 'assets/file/' . $get_subfile->nama_file;
            if (file_exists($path) == TRUE) {
                $url_file = 'file/dip/' . $get_subfile->slug;
                ?>
                <div class="text-center mb-15">
                    <button class="btn btn-info btn-outline mr-15 mb-15" type="button" value="Back" onclick="history.go(-1);"><i class="fa fa-arrow-left"></i> Kembali</button>
                    <a href="<?= site_url('informasipublik/downloadfile/' . $get_subfile->slug); ?>" class="btn btn-warning btn-outline mr-15 mb-15"><i class="fa fa-download"></i> Download</a>
                    <?php
                    if ($get_subfile->tipe == 'File') {
                        echo '<a href="https://docs.google.com/viewerng/viewer?url=https://rsmargono.jatengprov.go.id/ppid/' . $url_file . '" class="btn btn-info btn-outline mb-15" target="_blank"><i class="fa fa-file-pdf-o"></i> Lihat di Google Docs</a>';
                    }
                    ?>
                </div>
                <?php
                if ($get_subfile->tipe == 'File') {
                    if ($is_mobile == true) {
                        ?>
                        <center id="loading2">
                            <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
                            <p>Loading File</p>
                        </center>
                        <iframe
                            src="https://docs.google.com/viewer?url=https://rsmargono.jatengprov.go.id/ppid/<?= $url_file; ?>&embedded=true"
                            class="object-pdf" id="iframe-file"></iframe>
                        <br>
                        <p class="text-center">* Jika dokumen tidak tampil mohon <i>reload</i> halaman.</p>
                        <script>
                            $(document).ready(function () {
                                $('#loading2').show();
                                $('#iframe-file').on('load', function () {
                                    $('#loading2').hide();
                                });
                            });
                        </script>
                        <?php
                    } else {
                        ?>
                        <object data="<?= site_url($url_file); ?>" type="application/pdf" class="object-pdf">
                            <p class="text-center">
                                Tampaknya Anda tidak memiliki plugin PDF untuk browser ini atau tampilan telah diblock oleh aplikasi download manager. Tidak masalah, Anda dapat 
                                <a href="<?= site_url('informasipublik/downloadfile/' . $get_subfile->slug); ?>">klik disini untuk download pdf file.</a>
                            </p>
                        </object>
                        <p class="text-center">* Untuk menampilkan file di browser pastikan browser yang digunakan support untuk melihat file pdf dan matikan aplikasi download manager.<br>**Jika dokumen tidak tampil mohon <i>reload</i> halaman.</p>
                        <?php
                    }
                } else {
                    ?>
                    <div class="container text-center">
                        <img src="<?= site_url($url_file); ?>" class="img-responsive img-thumbnail">
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="text-center">
                    <button class="btn btn-info btn-outline" type="button" value="Back" onclick="history.go(-1);"><i class="fa fa-arrow-left"></i> Kembali</button>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <img src="<?= site_url('file/not-found'); ?>" class="img-responsive">
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            ?>
            <div class="text-center">
                <button class="btn btn-info btn-outline" type="button" value="Back" onclick="history.go(-1);"><i class="fa fa-arrow-left"></i> Kembali</button>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <img src="<?= site_url('file/not-found'); ?>" class="img-responsive">
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</section>