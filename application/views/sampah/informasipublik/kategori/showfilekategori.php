<section id="blog">
    <div class="blog">
        <?php
        if (!empty($get_tagfile)) {
            echo '<div class="center"><h2>' . $get_tagfile->display_name . '</h2></div>';
            $path = 'assets/file/' . $get_tagfile->file;
            if (file_exists($path) == TRUE) {
                $url_file = 'file/kategori/' . $get_tagfile->slug;
                ?>
                <div class="text-center mb-15">
                    <button class="btn btn-info btn-outline mr-15" type="button" value="Back" onclick="history.go(-1);"><i class="fa fa-arrow-left"></i> Kembali</button>
                    <a href="<?= site_url('informasipublik/downloadfile/' . $get_tagfile->slug); ?>" class="btn btn-warning btn-outline"><i class="fa fa-download"></i> Download</a>
                </div>
                <?php
                if ($get_tagfile->tipe == 'file') {
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
                            <p class="text-center">Tampaknya Anda tidak memiliki plugin PDF untuk browser ini atau tampilan telah diblock oleh aplikasi download manager. Tidak masalah, Anda dapat <a
                                    href="<?= site_url('informasipublik/downloadfile/' . $get_tagfile->slug); ?>">klik disini untuk download pdf file.</a></p>
                        </object>
                        <p class="text-center">* Untuk menampilkan file di browser pastikan browser yang digunakan support untuk melihat file pdf dan matikan aplikasi download manager.<br>**Jika dokumen tidak tampil mohon <i>reload</i> halaman.</p>
                        <?php
                    }
                } else {
                    echo '<div class="container text-center">';
                    echo '<img src="' . base_url($path) . '" class="img-responsive img-thumbnail">';
                    echo '</div>';
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
        }
        ?>
    </div>
</section>