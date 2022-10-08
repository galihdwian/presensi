<section id="portfolio">
    <!--<div class="container">-->
    <div class="center">
        <h1>RSUD Prof. Dr. Margono Soekarjo Purwokerto Provinsi Jawa Tengah</h1>
        <p><b>Nomor : 800 / 01677a / II / 2022<br>Tentang<br>Perubahan Atas Keputusan Direktur Nomor 800/02263a/II/2021 Tentang Penyempurnaan Keanggotaan Pejabat Pengelola Informasi dan
                Dokumentasi (PPID) Pelaksana RSUD Prof. Dr. Margono Soekarjo Purwokerto</b></p>
    </div>
    <div class="portfolio-filter">
        <?php
        $path = 'assets/file/SK_PPID_Pembantu.pdf';
        if (file_exists($path) == true) {
            $url_file = 'file/dip/sk-direktur-rsud-prof-dr-margono-soekarjo-tentang-sk-tim-ppid';
            if ($is_mobile == true) {
        ?>
                <center id="loading2">
                    <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
                    <p>Loading File</p>
                </center>
                <iframe src="https://docs.google.com/viewer?url=https://rsmargono.jatengprov.go.id/ppid/<?= $url_file; ?>&embedded=true" class="object-pdf" id="iframe-file"></iframe>
                <br>
                <p class="text-center">* Jika dokumen tidak tampil mohon <i>reload</i> halaman.</p>
                <script>
                    $(document).ready(function() {
                        $('#loading2').show();
                        $('#iframe-file').on('load', function() {
                            $('#loading2').hide();
                        });
                    });
                </script>
            <?php
            } else {
            ?>
                <object data="<?= site_url($url_file); ?>" type="application/pdf" class="object-pdf">
                    <p class="text-center">Tampaknya Anda tidak memiliki plugin PDF untuk browser ini atau tampilan telah diblock oleh aplikasi download manager. Tidak masalah, Anda dapat <a href="<?= site_url('informasipublik/downloadfile/sk-direktur-rsud-prof-dr-margono-soekarjo-tentang-sk-tim-ppid'); ?>">klik disini untuk download pdf file.</a></p>
                </object>
                <p class="text-center">* Untuk menampilkan file di browser pastikan browser yang digunakan support untuk melihat
                    file
                    pdf dan matikan aplikasi download manager.<br>
                    **Jika dokumen tidak tampil mohon <i>reload</i> halaman.</p>
            <?php
            }
        } else {
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <img src="<?= base_url('assets/images/error/file_not_found.png'); ?>" class="img-responsive">
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>