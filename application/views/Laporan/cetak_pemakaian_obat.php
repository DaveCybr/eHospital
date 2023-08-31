
<?php
          // ob_start();
          $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
          $pdf->AddPage('L');
          $i=0;
          $html='<h1 align="center" class="m-0">'.strtoupper($this->Core->nama_klinik()).'</h1>
          <h4 align="center">'.($this->Core->alamat_klinik()).'</h4>
          &nbsp;&nbsp;<h2 align="center">Pemakaian Obat Per Tanggal '.$mulai.'</h2>
          &nbsp;&nbsp;<p>Unit :  '.$unit.'</p>

                  <table cellspacing="1" bgcolor="#666666" cellpadding="2">
                      <tr bgcolor="#ffffff">
                          <th width="10%" align="center">#</th>
                          <th width="30%" align="center">Kode Obat</th>
                          <th width="30%" align="center">Nama Obat</th>
                          <th width="30%" align="center">Jumlah</th>
                      </tr>';
                      $akhir = 0;
          foreach ($data as $value)
              {
                  $i++;
                  $html.='<tr bgcolor="#ffffff">
                      <td align="left">'.$i.'</td>
                          <td align="left">'.$value->idobat.'</td>
                          <td align="left">'.$value->nama_obat.'</td>
                          <td align="left">'.$value->beri.'</td>
                      </tr>';


              }
          $html.='</table>';
          $pdf->writeHTML($html, true, false, true, false, '');
          ob_end_clean();
          $pdf->Output('kunjungan pemakaian obat.pdf', 'I');
?>
