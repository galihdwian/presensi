<!-- <?php
        if (!empty($getperiodedetail)) {
            $timenow = empty($timenow) ? strtotime(date('Y-m-d H:i:s')) : $timenow;
            $datenow = empty($datenow) ? strtotime(date('Y-m-d')) : $datenow;
            include_once 'js_initcounter.php';
            if ($datenow >= strtotime($getperiodedetail->tanggalawal) && $datenow <= strtotime($getperiodedetail->tanggalakhir)) {
                #jika tanggal sekarang diantara tanggal awal dan tanggal akhir
        ?> -->
<div id="mu-book-overview">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mu-book-overview-area pb-0">
                    <div class="mu-heading-area">
                        <!-- <h2 class="mu-heading-title"><?= $getperiodedetail->header_title; ?></h2> -->
                        <span class="mu-header-dot"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- <?php
                echo $this->session->flashdata('message');
                if ($statusperiode == TRUE) {
                ?> -->
        <div class="row">
            <div class="col-md-12">
                <div class="well bordered orange">
                    <?php include_once 'wizard.php'; ?>
                </div>
            </div>
        </div>
        <!-- <?php
                    if (!empty($kodeperiode)) {
                        if ($kodeperiode == '202012') {
                            include 'pengumuman/relawan_covid_tahap_satu.php';
                        } elseif ($kodeperiode == '202013') {
                            include 'pengumuman/relawan_covid_tahap_dua.php';
                        } elseif ($kodeperiode == '202101') {
                            include 'pengumuman/relawan_covid_tahap_tiga.php';
                        } else {
                            // load view pengumuman / timeline
                            define('BASE_VIEW_PATH', dirname(__FILE__) . "/../");
                            include(BASE_VIEW_PATH . "pengumuman.php");
                        }
                    }
                ?>
                <?php } ?> -->
    </div>
</div>
<!-- <?php
            } elseif ($datenow < strtotime($getperiodedetail->tanggalawal)) {
                #jika tanggal sekarang sebelum tanggal awal
                include_once 'beforeperiode.php';
            } elseif ($datenow > strtotime($getperiodedetail->tanggalakhir)) {
                #jika tanggal sekarang sesudah tanggal akhir
                include_once 'afterperiode.php';
            }
        } else {
        ?> -->
<div id="mu-book-overview">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="mu-book-overview-area pb-0">
                    <div class="mu-heading-area">
                        <h2 class="mu-heading-title">Sistem Monitoring dan Evaluasi<br>RSUD Prof. Dr. Margono Soekarjo</h2>
                        <span class="mu-header-dot"></span>
                        <h3 class="alert alert-info">Segera Hadir</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<?php
        }
?>