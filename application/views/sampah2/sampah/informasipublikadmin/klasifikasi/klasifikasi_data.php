<table class="table table-bordered table-centeredhead">
    <thead>
        <tr class="info">
            <th>No</th>
            <th>Nama Klasifikasi</th>
            <th>Aksi</th>
        </tr>                        
    </thead>
    <tbody>
        <?php
        $no = 1;
        foreach ($get_klasifikasi as $r_kls):
            echo '<tr>';
            echo '<td class="fit">' . $no . '</td>';
            echo '<td>' . $r_kls['nama_ppid'] . '</td>';
            echo '<td class="fit">';
            ?>
        <button class="btn btn-sm btn-primary" onclick="showdetail('<?php echo $r_kls['id_ppid']; ?>')">Detail dan Edit</button>
        <?php
        echo '</td>';
        echo '</tr>';
        $no++;
    endforeach;
    unset($r_kls);
    ?>
</tbody>
</table>
