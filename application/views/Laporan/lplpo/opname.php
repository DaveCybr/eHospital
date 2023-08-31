
<?php
          // ob_start();
          $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
          $pdf->AddPage('L');
          $i=0;
          $html='<h1 align="center">Rumah Sakit Utama Husada</h1><h4 align="center">Jl. Manggar No.134, Tegalsari, Ambulu,</h4><h4 align="center">
                Kabupaten Jember, Jawa Timur</h4><h4 align="center">
                (68172)</h4>&nbsp;&nbsp;<h2 align="center">LAPORAN LPLPO</h2>
                  <p>DARI TGL: '.$mulai.' S/D TGL: '.$sampai.'</p>
                  <table cellspacing="1" border="1" bgcolor="#666666" cellpadding="2">
                      <tr bgcolor="#ffffff">
                          <th align="center">KODE</th>
                          <th align="center">NAMA OBAT</th>
                          <th align="center">HARGA BELI</th>
                          <th align="center">SATUAN</th>
                          <th align="center">STOK AWAL</th>
                          <th align="center">PENGADAAN</th>
                          <th align="center">PERSEDIAAN</th>
                          <th align="center">PEMAKAIAN</th>
                          <th align="center">RETUR</th>
                          <th align="center">RUSAK</th>
                          <th align="center">SISA</th>
                      </tr>';
          foreach ($data as $value)
              {
                  $i++;
                  $html.='<tr bgcolor="#ffffff">
                          <td align="center">'.$value['idobat'].'</td>
                          <td align="center">'.$value['nama'].'</td>
                          <td align="center">'.$value['harga'].'</td>
                          <td align="center">'.$value['satuan_kecil'].'</td>
                          <td align="center">'.$value['stok_awal'].'</td>
                          <td align="center">'.$value['pengadaan'].'</td>
                          <td align="center">'.$value['persediaan'].'</td>
                          <td align="center">'.$value['pemakaian'].'</td>
                          <td align="center">'.$value['retur'].'</td>
                          <td align="center">'.$value['rusak'].'</td>
                          <td align="center">'.$value['sisa'].'</td>
                      </tr>';

              }
          $html.='</table>';
          $pdf->writeHTML($html, true, false, true, false, '');
          ob_end_clean();
          $pdf->Output('laporan_stok_opname_'.$sampai.'.pdf', 'I');
?>
