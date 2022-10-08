<?php
$total_permohonan_diterima = 0;
$total_permohonan_disetujui = 0;
$total_permohonan_ditolak = 0;
?>

<section id="portfolio">
    <div class="container">
        <div class="center wow zoomIn">
            <h1>Statistik Permohonan Informasi Tahun <?= $tahun_aktif; ?></h1>
        </div>
        <div class="portfolio-filter">
            <div class="row">
                <script type="text/javascript" src="<?php echo base_url('assets/js/Chart.bundle.min.js'); ?>"></script>
                <div class="col-md-8">
                    <canvas id="myChart" height="180"></canvas>
                    <?php include 'statistik_chart.php'; ?>
                </div>
                <div class="col-md-4">
                    <canvas id="myChart2" height="400px" width="400px"></canvas>
                    <script>
                        var ctx = document.getElementById("myChart2");
                        var myChart2 = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: ["Jumlah Permohonan", "Jumlah Disetujui", "Jumlah Ditolak"],
                                datasets: [{
                                    data: [<?= $total_permohonan_diterima; ?>, <?= $total_permohonan_disetujui; ?>, <?= $total_permohonan_ditolak; ?>],
                                    backgroundColor: [
                                        'rgba(39, 139, 185, 0.8)',
                                        'rgba(39, 194, 80, 0.8)',
                                        'rgba(172, 37, 41, 0.8)'
                                    ]
                                }]
                            },
                            options: {
                                responsive: false,
                                legend: {
                                    display: true,
                                    labels: {
                                        fontColor: 'rgb(255, 99, 132)'
                                    },
                                    position: 'bottom',
                                },
                                responsive: true,
                                hover: {
                                    mode: 'label'
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="center wow zoomIn">
            <h5>Informasi permohonan informasi yang dterima dapat dilihat di <a href="https://rsmargono.jatengprov.go.id/ppid/dip/1_2021_42/jumlah_permohonan_informasi_publik_yang_diterima">di sini</a></h5>
        </div>
    </div>
</section>