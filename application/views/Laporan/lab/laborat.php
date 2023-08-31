
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
          $html='<h1 align="center">'.strtoupper($this->Core->nama_klinik()).'</h1>
                <h4 align="center" width="100px">'.($this->Core->alamat_klinik()).'</h4>&nbsp;&nbsp;<h2 align="center">LAPORAN KUNJUNGAN LABORAT PER POLI</h2>
                  <p>DARI TGL: '.$mulai.' S/D TGL: '.$sampai.'</p>
                  <table cellspacing="1" border="1" bgcolor="#666666" cellpadding="2">
                      <tr bgcolor="#ffffff">
                          <th width="15%" align="center">NO</th>
                          <th width="50%" align="center">UNIT LAYANAN</th>
                          <th width="35%" align="center">JUMLAH KUNJUNGAN</th>
                      </tr>';
          foreach ($laborat as $value)
              {
                  $i++;
                  $total += $value->jumlah;
                  $html.='<tr bgcolor="#ffffff">
                          <td align="center">'.$i.'</td>
                          <td align="left">'.$tupel[$value->unit_layanan].'</td>
                          <td align="center">'.$value->jumlah.'</td>
                      </tr>';

              }
          $html.='</table><p>Total Kunjungan : '.$total.'</p>';
          $pdf->writeHTML($html, true, false, true, false, '');
          ob_end_clean();
          $pdf->Output('laporan_kunjungan_laborat'.$sampai.'.pdf', 'I');
?>
