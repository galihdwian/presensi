<section id="portfolio">
    <!--<div class="container">-->
    <div class="center">
        <h1>Struktur Organisasi PPID Pelaksana RSUD Prof. Dr. Margono Soekarjo</h1>
    </div>
    <div class="portfolio-filter" style="width: 98%;margin: 0 auto;">
        <?php
        //        print_r($get_struktur_ppid);
        $no_control = 0;
        $eselon = 0;
        $alias = NULL;
        echo '<table class="table table-org" border="1">';
        foreach ($get_struktur_ppid as $r_str) :
            //penanggung jawab, ketua, wakil ketua (satu kotak satu orang)
            if ($r_str->eselon == '1' || $r_str->eselon == '3' || $r_str->eselon == '4') {
                if ($r_str->eselon != '1') {
                    echo '<tr>
                            <td align="center" valign="middle">&nbsp;</td>
                            <td align="center" valign="middle">&nbsp;</td>
                            <td align="center" valign="middle">&nbsp;</td>
                            <td align="center" valign="middle" class="linedown" height="50px">&nbsp;</td>
                            <td align="center" valign="middle">&nbsp;</td>
                            <td align="center" valign="middle">&nbsp;</td>
                            <td align="center" valign="middle">&nbsp;</td>
                            <td align="center" valign="middle">&nbsp;</td>
                            </tr>';
                }
                echo '<tr>
                <td align="center" valign="middle">&nbsp;</td>
                <td align="center" valign="middle">&nbsp;</td>
                <td align="center" valign="middle">&nbsp;</td>
                <td colspan="2" align="center" valign="middle" class="fullborder">';
                echo '<div class="contentstr">';
                echo '<p class="jabatan-ppid">' . $r_str->nama_struktur . '</p>';
                echo print_pegawai($r_str->id_pegawai, $r_str->nama_pegawai, $r_str->eselon, $r_str->foto_profil);
                echo '</div>';
                echo '</td>
                <td align="center" valign="middle">&nbsp;</td>
                <td align="center" valign="middle">&nbsp;</td>
                <td align="center" valign="middle">&nbsp;</td>
                </tr>';
            }
            //atasan ppid (satu kotak 3 orang)
            if ($r_str->eselon == '2') {
                // include 'strukturppid_atasan_tiga_orang.php';
                include 'strukturppid_atasan_dua_orang.php';
            } #end if eselon 2
            //SEKRETARIS (satu kotak 2 orang)
            if ($r_str->eselon == '5') {
                if ($eselon != 5) {
                    $eselon = 5;
                    $no_control = 0;
                }
                include 'strukturppid_sekretaris_dua_orang.php';
                // include 'strukturppid_sekretaris_satu_orang.php';
            } #end if eselon 5
            if ($r_str->eselon == '6') {
                if ($alias == NULL) {
                    echo '<tr>';
                    $no_control = 0;
                }
                if ($alias != $r_str->str_alias) {
                    $alias = $r_str->str_alias;
                    if ($no_control != 0) {
                        echo '</div>';
                        echo '</td>';
                        echo '<td align="center" valign="middle">&nbsp;</td>';
                    }
                    echo '<td colspan="2" align="center" class="fullborder topalign">';
                    echo '<div class="contentstr">';
                    echo '<p class="jabatan-ppid">' . $r_str->nama_struktur . '</p>';
                    $no_control++;
                }
                if ($alias == $r_str->str_alias) {
                    echo '<div class="row">';
                    echo '<div class="col-md-12">' . print_pegawai($r_str->id_pegawai, $r_str->nama_pegawai, $r_str->eselon, $r_str->foto_profil) . '</div>';
                    echo '</div>';
                }
            }
        endforeach;
        echo '</div>';
        echo '</td>';
        echo ' </tr>';
        unset($r_str);
        echo '</table>';

        function print_pegawai($id_pegawai, $nama_pegawai, $eselon, $foto_profil)
        {
            $txt = "";
            $txt .= '<a href = "javascript:void(0)" onclick = "showmodal(this.id)" id = "' . str_replace(" ", "-", $id_pegawai) . '">';
            if ($foto_profil == NULL || $foto_profil == '') {
                $txt .= '<p><img src = "' . base_url('assets/images/pegawai/profilpejabat/default.png') . '"></p>';
            } else {
                $txt .= '<p><img src = "' . base_url('assets/images/pegawai/profilpejabat/' . $foto_profil) . '"></p>';
            }
            $txt .= '<p class="pejabat">' . $nama_pegawai . '</p>';
            if ($id_pegawai == '19620916 198309 2 001') {
                $txt .= '<p>NIP. -</p>';
            } else {
                $txt .= '<p>NIP. ' . $id_pegawai . '</p>';
            }
            $txt .= '</a>';
            return $txt;
        }
        ?>
        <br>
        <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="myModal">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detail Pejabat PPID RSUD Prof. Dr. Margono Soekarjo Purwokerto</h4>
                    </div>
                    <div id="modaldetailcontent"></div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $("#myModal").on("hidden.bs.modal", function() {
                    $('#myModal').find('#modaldetailcontent').html("");
                });
            });

            function showmodal(id) {
                //alert(id);
                var href = "<?php echo site_url('detailpejabat'); ?>/" + id;
                $('#myModal').find('#modaldetailcontent').load(href);
                $('#myModal').modal('show');
            }
        </script>


    </div>
</section>