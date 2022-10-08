<ul class="elements">
    <?php
//    print_r($results);
    foreach ($results as $r_res):
        if ($r_res['tipe_view'] == 'DL') {
            echo '<li><a href="' . $r_res['url_page'] . '" target="blank"><i class="fa fa-angle-right"></i> ' . $r_res['judul_informasi'] . '</a></li>';
        } elseif ($r_res['tipe_view'] == 'FD') {
            ?><li><a href="#" onclick="showdata('<?php echo $r_res['id_sub']; ?>')"><i class="fa fa-angle-right"></i> <?php echo $r_res['judul_informasi']; ?></a></li><?php
        } elseif ($r_res['tipe_view'] == 'PG') {
            echo '<li><a href="' . site_url($r_res['url_page']) . '" target="blank"><i class="fa fa-angle-right"></i> ' . $r_res['judul_informasi'] . '</a></li>';
        }
    endforeach;
    unset($r_res);
    ?>
</ul>
<div class="portfolio-pagination" id="ajax_paging">
    <?php echo $links; ?>
</div>