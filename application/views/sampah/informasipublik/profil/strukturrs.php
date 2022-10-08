<link href="<?php echo base_url('assets/css/orgchart.css'); ?>" rel="stylesheet">
<section id="portfolio">
    <!--<div class="container">-->
    <div class="center">
        <h1>Struktur Organisasi RSUD Prof. Dr. Margono Soekarjo</h1>            
    </div>
    <div class="portfolio-filter">
        <?php //print_r($get_struktur_pegawai); ?>
        <ul id="tree-data" style="display:none">
            <li id="root">                    
                <?php
                foreach ($get_struktur_pegawai as $row_str):
                    echo '<p class="jabatan">' . $row_str['nama_struktur'] . '</p>';
                    echo print_pegawai($row_str['pegawai'], $row_str['eselon']);
                    if (!empty($row_str['childstruktur'])) {
                        echo '<ul>';
                        echo print_child($row_str['childstruktur']);
                        echo '</ul>';
                    }
                endforeach;
                unset($row_str);
                ?>              
            </li>
        </ul>
        <div id="tree-view" style="width: 98%;"></div>
    </div>
    <!--</div>-->
</section>
<?php

function print_pegawai($data, $eselon) {
    $txt = "";
    foreach ($data as $row_peg):
        $txt .= '<a href="javascript:void(0)" onclick="showmodal(this.id)" id="' . str_replace(" ", "-", $row_peg['id_pegawai']) . '">';
        if ($row_peg['foto'] == NULL || $row_peg['foto'] == '') {
            $txt .= '<p><img src="' . base_url('assets/images/pegawai/default.png') . '" class="eselon img-rounded' . $eselon . '"></p>';
        } else {
            $txt .= '<p><img src="' . base_url('assets/images/pegawai/' . $row_peg['foto']) . '" class="eselon  img-rounded' . $eselon . '"></p>';
        }
        if ($row_peg['str_display'] == "" || $row_peg['str_display'] == NULL) {
            $nama = $row_peg['nama_pegawai'];
        } else {
            $nama = $row_peg['str_display'];
        }
        $txt .= '<p class="pejabat">' . $nama . '</p>';
        $txt .= '<p>NIP. ' . $row_peg['id_pegawai'] . '</p>';
        $txt .= '</a>';
    endforeach;
    return $txt;
}

function print_child($data) {
    $text = "";
    foreach ($data as $row_child):
        $text .= '<li>';
        $text .= '<p class="jabatan">' . $row_child['nama_struktur'] . '</p>';
        $text .= print_pegawai($row_child['pegawai'], $row_child['eselon']);
        if (!empty($row_child['childstruktur'])):
            $text .= '<ul>';
            foreach ($row_child['childstruktur'] as $row_child2):
                $text .= '<li>';
                $text .= '<p class="jabatan">' . $row_child2['nama_struktur'] . '</p>';
                $text .= print_pegawai($row_child2['pegawai'], $row_child2['eselon']);
                if (!empty($row_child['childstruktur'])):
                    $text .= '<ul type="vertical">';
                    $text .= print_child($row_child2['childstruktur']);
                    $text .= '</ul>';
                endif;
                $text .= '</li>';
            endforeach;
            //$text .= print_child($row_child['childstruktur']);
            $text .= '</ul>';
        endif;
        $text .= '</li>';
    endforeach;
    return $text;
}
?>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Pejabat Struktural RSUD Prof. Dr. Margono Soekarjo Purwokerto</h4>
            </div>
            <div id="modaldetailcontent"></div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('assets/js/orgchart.js'); ?>"></script>
<?php $root_url = "https://" . $_SERVER['HTTP_HOST']; ?>
<script>
    $(document).ready(function () {
        // create a tree
        $("#tree-data").jOrgChart({
            chartElement: $("#tree-view"),
            nodeClicked: nodeClicked
        });
        // lighting a node in the selection
        function nodeClicked(node, type) {
            node = node || $(this);
            $('.jOrgChart .selected').removeClass('selected');
            node.addClass('selected');
        }
        $("#myModal").on("hidden.bs.modal", function () {
            $('#myModal').find('#modaldetailcontent').html("");
        });
    });
    function showmodal(id) {
        //alert(id);
        //var href = "<?php echo site_url('detailpejabat'); ?>/" + id;
        var href = "<?php echo $root_url; ?>/detailpejabat/" + id;
        $('#myModal').find('#modaldetailcontent').load(href);
        $('#myModal').modal('show');
    }
</script>