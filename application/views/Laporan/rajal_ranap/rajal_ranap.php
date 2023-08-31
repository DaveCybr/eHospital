
<?php
          // ob_start();
          $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
          $pdf->AddPage('P');
          $i=0;
          $tupel = array(
            'OZO' => "Poli Ozon",
            'UMU' => "Poli Umum",
            'IGD' => "Unit Gawat Darurat",
            'OBG' => "Poli Obgyn",
            'INT' => "Poli Internis",
            'GIG' => "Poli Gigi",
            'RANAP' => "Rawat Inap"
          );
          $total = 0;
          $html='<h1 align="center">Rumah Sakit Utama Husada</h1><h4 align="center">Jl. Manggar No.134, Tegalsari, Ambulu,</h4><h4 align="center">
                Kabupaten Jember, Jawa Timur</h4><h4 align="center">
                (68172)</h4>&nbsp;&nbsp;<h2 align="center">LAPORAN KUNJUNGAN RAWAT JALAN DAN RAWAT INAP</h2>
                  <p>DARI TGL: '.$mulai.' S/D TGL: '.$sampai.'</p>
                  <table cellspacing="1" border="1" bgcolor="#666666" cellpadding="2">
                      <tr bgcolor="#ffffff">
                          <th width="15%" align="center">NO</th>
                          <th width="50%" align="center">JENIS KUNJUNGAN</th>
                          <th width="35%" align="center">JUMLAH KUNJUNGAN</th>
                      </tr>';
                      $html.='<tr bgcolor="#ffffff">
                              <td align="center">1</td>
                              <td align="left">RAWAT JALAN</td>
                              <td align="center">'.$rawat['rajal'].'</td>
                          </tr>';
                          $html.='<tr bgcolor="#ffffff">
                                  <td align="center">2</td>
                                  <td align="left">RAWAT INAP</td>
                                  <td align="center">'.$rawat['ranap'].'</td>
                              </tr>';
          $html.='</table><p>Total Kunjungan : '.$rawat['jumlah'].'</p>';
          $pdf->writeHTML($html, true, false, true, false, '');
          ob_end_clean();
          $pdf->Output('laporan_kunjungan_laborat'.$sampai.'.pdf', 'I');
?>
