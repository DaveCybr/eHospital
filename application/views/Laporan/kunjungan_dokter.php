
<?php
          // ob_start();
          $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
          $pdf->AddPage('L');
          $i=0;
          $html='<h1 align="center" class="m-0">'.strtoupper($this->Core->nama_klinik()).'</h1>
          <h4 align="center">'.($this->Core->alamat_klinik()).'</h4>
          &nbsp;&nbsp;<h2 align="center">Kunjungan</h2>

                  <table cellspacing="1" bgcolor="#666666" cellpadding="2">
                      <tr bgcolor="#ffffff">
                          <th width="15%" align="center">Poli</th>
                          <th width="25%" align="center">Dokter</th>
                          <th width="25%" align="center">Jenis Kunjungan</th>
                          <th width="25%" align="center">Jumlah</th>
                      </tr>';
                      $akhir = 0;
          foreach ($data as $value)
              {
                  $i++;
                  $html.='<tr bgcolor="#ffffff">
                          <td align="left" colspan="4">'.$value["poli"].'</td>
                      </tr>';
                foreach ($value['dokter'] as $dokter) {
                  $html.='<tr bgcolor="#ffffff">
                          <td align="left"></td>
                          <td align="left" colspan="3">'.$dokter["nama_dokter"].'</td>
                      </tr>';
                  foreach ($dokter['pasien'] as $pasien) {
                    $html.='<tr bgcolor="#ffffff">
                            <td align="left" colspan="2"></td>
                            <td align="left">'.$pasien["sumber_dana"].'</td>
                            <td align="left">'.$pasien["jumlah"].'</td>
                        </tr>';
                  }

                }

              }
          $html.='</table>';
          $pdf->writeHTML($html, true, false, true, false, '');
          ob_end_clean();
          $pdf->Output('kunjungan per dokter.pdf', 'I');
?>
