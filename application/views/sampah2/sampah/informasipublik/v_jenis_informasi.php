<h3 class="column-title"><i class="fa fa-list"></i> Jenis Informasi</h3>
<ul class="list-unstyled list-fa">
    <?php
    foreach ($get_kategori as $row_kategori):
        echo '<li><a href="' . site_url('kategoriinformasipublik/' . $row_kategori['slug']) . '"><i class="fa fa-angle-double-right"></i> <span>' . $row_kategori['name_tag'] . ' <span class="label label-danger">' . $row_kategori['tag_child'] . ' Informasi</span></span></a></li>';
    endforeach;
    unset($row_kategori);
    ?>
</ul>