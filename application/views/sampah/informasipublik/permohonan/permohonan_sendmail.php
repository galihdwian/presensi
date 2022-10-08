<p>PPID RSUD Prof. Dr. Margono Soekarjo</p>
<p>Anda telah melakukan pendaftaran sebagai anggota member PPID RSUD Prof. Dr. Margono Soekarjo dengan data sebagai berikut</p>
<?php
foreach ($get_pemohon as $r):
    ?>
    <table border="0" cellpadding="2" cellspacing="0">
        <tr>
            <td>Nama</td>
            <td>: <?php echo strtoupper($r['full_name']); ?></td>
        </tr>
        <tr>
            <td>Tanda Pengenal</td>
            <td>: <?php echo $r['tanda_pengenal']; ?></td>
        </tr>
        <tr>
            <td>No. Tanda Pengenal</td>
            <td>: <?php echo $r['nomor_identitas']; ?></td>
        </tr>
        <tr>
            <td>Tempat, Tanggal Lahir</td>
            <td>: <?php echo ucwords($r['tempat_lahir']) . ', ' . tgl_indo($r['tgl_lahir']); ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: <?php echo $r['jk'] == 'L' ? 'Laki-Laki' : 'Perempuan'; ?></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: <?php echo ucwords(strtolower($r['alamat'])); ?></td>
        </tr>
        <tr>
            <td>Kode Pos</td>
            <td>: <?php echo $r['kode_pos']; ?></td>
        </tr>
        <tr>
            <td>Kabupaten / Kota</td>
            <td>: <?php echo ucwords(strtolower($r['kabupaten_kota'])); ?></td>
        </tr>
        <tr>
            <td>Provinsi</td>
            <td>: <?php echo ucwords($r['provinsi']); ?></td>
        </tr>
        <tr>
            <td>Password</td>
            <td>: <?php echo $pwd; ?></td>
        </tr>
    </table>
    <?php
endforeach;
unset($r);
?>
<p>Terima Kasih Telah melakukan Pendaftaran, untuk login silahkan menggunakan <i>Email</i> dan <i>Password</i> anda</p>
<p>Untuk melengkapi proses pendaftaran ini, lakukan proses aktivasi dibawah ini</p>
<h2>Aktivasi Account : <a href="<?php echo 'rsmargono.jatengprov.go.id/ppid/activation/user/' . $cipertext; ?>">EMAIL</a></h2>
<p>Email disclaimer:</p>
<ul>    
    <li>Ini adalah email otomatis, mohon tidak me-reply ke alamat email ini.</li>
    <li>Alamat email berdasarkan atas alamat email yang diberikan pada saat melakukan pendaftaran, kami tidak bertanggung jawab jika ada kesalahan tujuan pengiriman.</li>
    <li>Informasi dalam email ini bersifat rahasia. Setiap penyebaran atau penggunaan lain, atau mengambil dari tindakan apapun atas informasi ini oleh orang atau badan lain selain penerima yang dimaksud dilarang.</li>
    <li>Jika anda bukan pemilik atas data pendaftaran ini, silahkan hapus setiap salinan dari informasi ini.</li>
    <li>Jika anda merasa tidak melakukan pendaftaran, abaikan email ini.</li>
</ul>
<p>Terimakasih</p>
<p>PPID RSUD Prof. Dr. Margono Soekarjo</p>