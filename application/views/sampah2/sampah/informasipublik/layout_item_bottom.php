<script type="text/javascript" src="<?php echo base_url('assets/js/Chart.bundle.min.js'); ?>"></script>
<section id="bottom">
    <div class="container wow zoomIn" data-wow-duration="1000ms" data-wow-delay="600ms">
        <div class="row">
            <div class="col-md-8 col-sm-6">
                <h3 class="column-title"><i class="fa fa-line-chart"></i> Statistik Permohonan Informasi</h3>
                <canvas id="myChart"></canvas>
                <?php include 'permohonan/statistik_chart.php'; ?> 
            </div>
            <div class="col-md-4 col-sm-6">
                <?php $this->load->view('informasipublik/v_jenis_informasi');?>
            </div>
        </div>
    </div>
</section>