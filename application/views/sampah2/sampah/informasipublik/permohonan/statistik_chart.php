<?php
$label = '"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"';
$langsung = '';
$medsos = '';
$diterima = '';
$ditolak = '';
$disetujui = '';
$total_permohonan_diterima = 0;
$total_permohonan_disetujui = 0;
$total_permohonan_ditolak = 0;
$jumlah_bulan = 1;
foreach ($get_rekap_permohonan as $row_rekap) {
    //jumlah permohonan yang diterima per kategori
    $jumlah_langsung = $row_rekap->permohonan_langsung_diterima;
    $jumlah_medsos = $row_rekap->permohonan_medsos_diterima;
    //jumlah permohonan yang disetujui per kategori
    $jumlah_langsung_disetujui = $row_rekap->permohonan_langsung_disetujui;
    $jumlah_medsos_disetujui = $row_rekap->permohonan_medsos_disetujui;
    //total permohonan yang masuk per kategori
    $total_diterima = $jumlah_langsung + $jumlah_medsos;
    $total_disetujui = $jumlah_langsung_disetujui + $jumlah_medsos_disetujui;
    //jumlah ditolak
    $jumlah_ditolak = $total_diterima - $total_disetujui;
    //set data string
    $langsung .= '"' . $jumlah_langsung . '",';
    $medsos .= '"' . $jumlah_medsos . '",';
    $diterima .= '"' . $total_diterima . '",';
    $ditolak .= '"' . $jumlah_ditolak . '",';
    $disetujui .= '"' . $total_disetujui . '",';
    //set pie data
    $total_permohonan_diterima = $total_permohonan_diterima + $total_diterima;
    $total_permohonan_disetujui = $total_permohonan_disetujui + $total_disetujui;
    $total_permohonan_ditolak = $total_permohonan_ditolak + $jumlah_ditolak;
    //auto increment jumlah bulan
    $jumlah_bulan++;
}
for ($i = $jumlah_bulan; $i <= 12; $i++) {
    $langsung .= '"0",';
    $medsos .= '"0",';
    $diterima .= '"0",';
    $ditolak .= '"0",';
    $disetujui .= '"0",';
}
$langsung = rtrim($langsung, ',');
$medsos = rtrim($medsos, ',');
$diterima = rtrim($diterima, ',');
$ditolak = rtrim($ditolak, ',');
$disetujui = rtrim($disetujui, ',');
?>
<script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?= $label; ?>],
            datasets: [{
                label: "Jumlah Permohonan Langsung",
                data: [<?= $langsung; ?>],
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(39, 139, 185, 0.8)",
                borderColor: "rgba(39, 139, 185, 0.8)"
            }, {
                label: "Jumlah Permohonan Melalui Media Sosial",
                data: [<?= $medsos; ?>],
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(7, 201, 199, 0.8)",
                borderColor: "rgba(7, 201, 199, 0.9)"
            }, {
                label: "Total Permohonan Diterima",
                data: [<?= $diterima; ?>],
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(0, 0, 0, 0.8)",
                borderColor: "rgba(0, 0, 0, 0.9)"
            }, {
                label: "Jumlah Permohonan Disetujui",
                data: [<?= $disetujui; ?>],
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(39, 194, 80, 0.8)",
                borderColor: "rgba(39, 194, 80, 0.9)"
            }, {
                label: "Jumlah Permohonan Ditolak",
                data: [<?= $ditolak; ?>],
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(172, 37, 41, 0.8)",
                borderColor: "rgba(172, 37, 41, 0.9)"
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: 'bottom',
            },
            hover: {
                mode: 'label'
            },
            scales: {
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Bulan'
                    }
                }],
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Jumlah'
                    },
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            title: {
                display: false
            }
        }
    });
</script>