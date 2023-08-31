
<?php
          // ob_start();
          $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
          $pdf->AddPage('L');
          $i=0;
          $html='<h1 align="center">'.strtoupper($this->Core->nama_klinik()).'</h1>
                <h4 align="center" width="100px">'.($this->Core->alamat_klinik()).'</h4>&nbsp;&nbsp;<h2 align="center">LAPORAN REKAPITULASI TUPEL KUNJUNGAN LOKET</h2>
                  <p>DARI TGL: '.$mulai.' S/D TGL: '.$sampai.'    Tupel : '.$tupel.'</p>
                  <table cellspacing="1" border="1" bgcolor="#666666" cellpadding="2">
                  <tr bgcolor="#ffffff">
                    <th style="width:5%;text-align:center" rowspan="2">No</th>
                    <th style="text-align:center" rowspan="2">TUJUAN PELAYANAN</th>
                    <th style="text-align:center" colspan="2">BARU</th>
                    <th style="text-align:center" colspan="2">LAMA</th>
                    <th style="text-align:center" rowspan="2">Total</th>
                    </tr>
                    <tr bgcolor="#ffffff">
                    <th style="text-align:center">L</th>
                    <th style="text-align:center">P</th>
                    <th style="text-align:center">L</th>
                    <th style="text-align:center">P</th>
                    </tr>
                    ';
          $kes_bp = 0;
          $kes_bl =0;
          $kes_ll =0;
          $kes_lp =0;
          $kes_total = 0;
          // die(var_dump($data_html));
          if (!empty($data_html)) {
            $no =0;
            foreach ($data_html as $value) {
              $no+=1;
              $kes_bp += $value['BARU_P'];
              $kes_bl += $value['BARU_L'];
              $kes_ll += $value['LAMA_L'];
              $kes_lp += $value['LAMA_P'];
              $kes_total += $value['TOTAL'];
              $html .= '<tr bgcolor="#ffffff">
              <td style="width:5%;text-align:center">'.$no.'</td>
              <td style="text-align:left">'.$value['TUPEL'].'</td>
              <td style="text-align:center">'.$value['BARU_L'].'</td>
              <td style="text-align:center">'.$value['BARU_P'].'</td>
              <td style="text-align:center">'.$value['LAMA_L'].'</td>
              <td style="text-align:center">'.$value['LAMA_P'].'</td>
              <td style="text-align:cente">'.$value['TOTAL'].'</td>
              </tr>';
            }
          }else{
            $html = '<tr bgcolor="#ffffff"><td colspan="7">Kosong</td></tr>';
          }
          $html .= '<tr bgcolor="#ffffff"><td style="width:5%;text-align:center">#</td>
          <td style="text-align:left"><b>GRAND TOTAL</b></td>
          <td style="text-align:center">'.$kes_bl.'</td>
          <td style="text-align:center">'.$kes_bp.'</td>
          <td style="text-align:center">'.$kes_ll.'</td>
          <td style="text-align:center">'.$kes_lp.'</td>
          <td style="text-align:cente">'.$kes_total.'</td>
          </tr>';
          $html.='</table>';
          $pdf->writeHTML($html, true, false, true, false, '');
          ob_end_clean();
          $pdf->Output('laporan_kunjungan_'.$sampai.'.pdf', 'I');
?>
