<table class="table table-bordered table-centeredhead">
    <thead>
        <tr class="info">
            <th>NO</th>
            <td>Id Kategori</td>
            <th>Nama Kategori</th>
            <th>Status Display</th>
            <th>Aksi</th>
        </tr>                        
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($ip_tag as $r_kls):
            echo '<tr>';
            echo '<td class="fit">' . $no . '</td>';
            echo '<td>' . $r_kls->id_tag . '</td>';
            echo '<td>' . $r_kls->name_tag . '</td>';
            echo '<td class="text-center">' . ($r_kls->displaytag == 1 ? '<span class="label label-success">Tampil</span></a>' : '<span class="label label-danger">Tidak</span></a>') . '</td>';
            echo '<td class="fit">';
            echo '<button class="btn btn-sm btn-primary btn-block" onclick="showdetail(\'' . rawurlencode($r_kls->id_tag) . '\')">Edit</button>';
            echo '<a href="'. site_url('adminppid/list_file_categori/'.rawurlencode($r_kls->id_tag)).'" class="btn btn-sm btn-info btn-block">List File</a>';
            echo '</td>';
            echo '</tr>';
            $no++;
        endforeach;
        unset($r_kls);
        ?>
    </tbody>
</table>
