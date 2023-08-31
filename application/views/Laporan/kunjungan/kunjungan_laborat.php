
<?php
          // ob_start();
          $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
          $pdf->AddPage('P');
          $i=0;
          $html='<h1 align="center" class="m-0">'.strtoupper($this->Core->nama_klinik()).'</h1>
          <h4 align="center">'.($this->Core->alamat_klinik()).'</h4>
          &nbsp;&nbsp;<h2 align="center">LAPORAN KUNJUNGAN LABORAT</h2>
                  <p>DARI TGL: '.$mulai.' S/D TGL: '.$sampai.'</p>
                  <table cellspacing="1" border="1" bgcolor="#666666" cellpadding="2">
                      <tr bgcolor="#ffffff">
                          <th width="15%" align="center">KODE LAB</th>
                          <th width="50%" align="center">NAMA LAB</th>
                          <th width="35%" align="center">JUMLAH KUNJUNGAN</th>
                      </tr>';
          foreach ($laborat as $value)
              {
                  $i++;
                  $html.='<tr bgcolor="#ffffff">
                          <td align="center">'.$value->kodelab.'</td>
                          <td align="left">'.$value->nama.'</td>
                          <td align="center">'.$value->jumlah.'</td>
                      </tr>';

              }
          $html.='</table><p>Total Kunjungan : '.$i.'</p>';
          $pdf->writeHTML($html, true, false, true, false, '');
          ob_end_clean();
          $pdf->Output('laporan_kunjungan_laborat'.$sampai.'.pdf', 'I');
?>
