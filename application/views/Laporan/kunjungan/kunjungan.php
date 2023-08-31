
<?php
          // ob_start();
          $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
          $pdf->AddPage('L');
          $i=0;
          $html='<h1 align="center">'.strtoupper($this->Core->nama_klinik()).'</h1>
          <h4 align="center" width="100px">'.($this->Core->alamat_klinik()).'</h4>&nbsp;&nbsp;<h2 align="center">LAPORAN KUNJUNGAN LOKET</h2>
                  <p>DARI TGL: '.$mulai.' S/D TGL: '.$sampai.'    Tupel : '.$tupel.'</p>
                  <table cellspacing="1" border="1" bgcolor="#666666" cellpadding="2">
                      <tr bgcolor="#ffffff">
                          <th width="5%" align="center">NO</th>
                          <th width="5%" align="center">NO KUNJUNGAN</th>
                          <th width="15%" align="center">NO INDEX</th>
                          <th width="25%" align="center">NAMA</th>
                          <th width="10%" align="center">KEL</th>
                          <th width="10%" align="center">Umur</th>
                          <th width="10%" align="center">Tupel</th>
                          <th width="10%" align="center">B/L</th>
                          <th width="10%" align="center">Pasien</th>
                      </tr>';
                      $lama1 = 0;
                      $baru1 = 0;
          foreach ($kunjungan as $value)
              {
                  if($value->jenis_kunjungan==1){
                    $bl = 'Lama';
                    $lama1 +=1;
                  }else{
                    $bl='Baru';
                    $baru1+=1;
                  }
                  if ($value->sumber_dana==1) {
                    $pasien = "UMUM";
                  }else{
                    $pasien = "ASURANSI";
                  }
                  $i++;
                  $html.='<tr bgcolor="#ffffff">
                          <td align="center">'.$i.'</td>
                          <td align="center">'.$value->no_urutkunjungan.'</td>
                          <td align="center">'.$value->noRM.'</td>
                          <td align="left">'.$value->namapasien.'</td>
                          <td align="center">'.$value->jenis_kelamin.'</td>
                          <td align="center">'.$this->Core->umur($value->tgl_lahir).'</td>
                          <td align="center">'.$value->tupel_kode_tupel.'</td>
                          <td align="center">'.$bl.'</td>
                          <td align="center">'.$pasien.'</td>
                      </tr>';

              }
          $html.='</table><p>Kunjungan Lama : '.$lama1.'</p><p>Kunjungan Baru : '.$baru1.'</p><p>Total Kunjungan : '.$i.'</p>';
          $pdf->writeHTML($html, true, false, true, false, '');
          ob_end_clean();
          $pdf->Output('laporan_kunjungan_'.$sampai.'.pdf', 'I');
?>
