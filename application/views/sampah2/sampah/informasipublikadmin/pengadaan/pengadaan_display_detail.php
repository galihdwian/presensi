<table class="table">
    <tr>
        <td class="fit">ID Paket Pengadaan</td>
        <td class="fit text-center">:</td>
        <td><?= $detail_pengadaan->id_paket; ?></td>
    </tr>
    <tr>
        <td class="fit">Nama Paket Pengadaan</td>
        <td class="fit text-center">:</td>
        <td><?= $detail_pengadaan->nama_paket; ?></td>
    </tr>
    <tr>
        <td class="fit">Tahun Pengadaan</td>
        <td class="fit text-center">:</td>
        <td><?= $detail_pengadaan->tahunpengadaan; ?></td>
    </tr>
    <tr>
        <td class="fit">Sumber Anggaran</td>
        <td class="fit text-center">:</td>
        <td><?= $detail_pengadaan->sumber_anggaran; ?></td>
    </tr>
    <tr>
        <td class="fit">Pagu Anggaran</td>
        <td class="fit text-center">:</td>
        <td>Rp <?= $detail_pengadaan->pagu_anggaran; ?></td>
    </tr>
    <tr>
        <td class="fit">Nilai Kontrak</td>
        <td class="fit text-center">:</td>
        <td>Rp <?= $detail_pengadaan->nilai_kontrak; ?></td>
    </tr>
    <tr>
        <td class="fit">Id Tender LPSE</td>
        <td class="fit text-center">:</td>
        <td><?= $detail_pengadaan->idtender; ?></td>
    </tr>
    <tr>
        <td class="fit">Jenis Pengadaan</td>
        <td class="fit text-center">:</td>
        <td><?= $detail_pengadaan->jenis_pengadaan; ?></td>
    </tr>
    <tr>
        <td class="fit">Nama Penyedia</td>
        <td class="fit text-center">:</td>
        <td><?= $detail_pengadaan->penyedia; ?></td>
    </tr>
    <tr>
        <td class="fit">Tanggal Kontrak</td>
        <td class="fit text-center">:</td>
        <td><?= $detail_pengadaan->tanggal_kontrak; ?></td>
    </tr>
    <tr>
        <td class="fit">Nomor Kontrak</td>
        <td class="fit text-center">:</td>
        <td><?= $detail_pengadaan->nomor_kontrak; ?></td>
    </tr>
</table>