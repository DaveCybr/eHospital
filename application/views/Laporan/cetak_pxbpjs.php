
<?php
          // ob_start();
          $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
          $pdf->AddPage('L');
          $i=0;
          $html='<h1 align="center">'.$this->Core->nama_klinik().'</h1><h4 align="center"></h4><h4 align="center">
              '.$this->Core->alamat_klinik().'</h4><h4 align="center">
                '.$this->Core->kontak_klinik().'</h4>&nbsp;&nbsp;<h2 align="center">LAPORAN KUNJUNGAN PASIEN BPJS</h2>
                  <p>DARI TGL: '.$mulai.' S/D TGL: '.$sampai.'</p>
                  <table cellspacing="1" border="1" bgcolor="#666666" cellpadding="2">
                      <tr bgcolor="#ffffff">
                          <th width="50%" align="center"></th>
                          <th width="50%" align="center">JUMLAH</th>
                        </tr>';
          foreach ($pxbpjs as $value)
              {
                  $i++;
                  $html.='<tr bgcolor="#ffffff">
                          <td align="left">'.$value['label'].'</td>
                          <td align="left">'.$value['jumlah'].'</td>
                      </tr>';

              }
          $html.='</table>';
          $pdf->writeHTML($html, true, false, true, false, '');
          ob_end_clean();
          $pdf->Output('laporan_kunjungan_pasien_bpjs_'.$sampai.'.pdf', 'I');
?>
