<?php
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
echo '<tr>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle" class="linedown" height="50px">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    </tr>
    <tr>
    <td align="center" valign="middle" class="linedown" height="50px">&nbsp;</td>
    <td align="center" valign="middle" class="lineup">&nbsp;</td>
    <td align="center" valign="middle" class="lineup">&nbsp;</td>
    <td align="center" valign="middle" class="linedown lineup">&nbsp;</td>
    <td align="center" valign="middle" class="lineup">&nbsp;</td>
    <td align="center" valign="middle" class="lineup">&nbsp;</td>
    <td align="center" valign="middle" class="lineup linedown">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    </tr>';
