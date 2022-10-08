<section id="blog" class="container">
    <div class="blog">      
        <div class="row">
            <div class="col-md-2">
                <?php include 'sidebar.php'; ?>
            </div>  
            <div class="col-md-10" style="border-left: solid 1px #ccc;min-height: 514px;">
                <div class="blog-item"> 
                    <div class="col-xs-12 col-sm-12 col-md-12 blog-content">
                        <?php
                        switch ($subpage) {
                            case 'index':
                                include 'subpage_index.php';
                                break;
                            case 'pengajuanpermohonan':
                                include 'pengajuan/pengajuanpermohonan.php';
                                break;
                            case 'daftar_pengajuan':
                                include 'daftarpermohonan/daftar_pengajuan.php';
                                break;
                            case 'pengajuan_keberatan':
                                include 'keberatan/pengajuan_keberatan.php';
                                break;
                            case 'daftar_keberatan':
                                include 'keberatan/daftar_keberatan.php';
                                break;
                            default:
                                break;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>