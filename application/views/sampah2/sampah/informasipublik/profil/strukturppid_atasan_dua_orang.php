<?php
$eselon == $r_str->eselon;
if ($no_control == 0) {
    $text_2 = NULL;
    $text_2 .= '<tr>
            <td align="center" valign="middle">&nbsp;</td>
            <td align="center" valign="middle">&nbsp;</td>
            <td align="center" valign="middle">&nbsp;</td>
            <td align="center" valign="middle" class="linedown" height="50px">&nbsp;</td>
            <td align="center" valign="middle">&nbsp;</td>
            <td align="center" valign="middle">&nbsp;</td>
            <td align="center" valign="middle">&nbsp;</td>
            <td align="center" valign="middle">&nbsp;</td>
            </tr>';
    $text_2 .= '<tr';
    $text_2 .= '<td align="center" valign="middle">&nbsp;</td>';
    $text_2 .= '<td align="center" valign="middle">&nbsp;</td>';
    $text_2 .= '<td colspan="6" align="center" valign="middle" class="fullborder"><div class="contentstr"><p class="jabatan-ppid">' . $r_str->nama_struktur . '</p>';
    $text_2 .= '<div class="row">';
    $text_2 .= '<div class="col-md-4 col-md-offset-2">';
    $text_2 .= print_pegawai($r_str->id_pegawai, $r_str->nama_pegawai, $r_str->eselon, $r_str->foto_profil);
    $text_2 .= '</div>';
}
if ($no_control == 1) {
    $text_2 .= '<div class="col-md-4">';
    $text_2 .= print_pegawai($r_str->id_pegawai, $r_str->nama_pegawai, $r_str->eselon, $r_str->foto_profil);
    $text_2 .= '</div>';
    $text_2 .= '</div>';
    $text_2 .= '</div>';
    $text_2 .= '</td>';
    $text_2 .= '<td align="center" valign="middle">&nbsp;</td>';
    $text_2 .= '</tr>';
    echo $text_2;
}
$no_control++;
