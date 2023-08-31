
<?php
          // ob_start();
          $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
          $pdf->AddPage('L');
          $i=0;
          $html='<h1 align="center">'.$this->Core->nama_klinik().'</h1><h4 align="center"></h4><h4 align="center">
              '.$this->Core->alamat_klinik().'</h4><h4 align="center">
                '.$this->Core->kontak_klinik().'</h4>&nbsp;&nbsp;<h2 align="center">LAPORAN PASIEN PASIEN INHEALT</h2>
                  <p>DARI TGL: '.$mulai.' S/D TGL: '.$sampai.'</p>
                  <table cellspacing="1" border="1" bgcolor="#666666" cellpadding="2">
                      <tr bgcolor="#ffffff">
                          <th width="20%" align="center">TANGGAL</th>
                          <th width="20%" align="center">NAMA PASIEN</th>
                          <th width="20%" align="center">TANGGAL LAHIR</th>
                          <th width="20%" align="center">KODE PENYAKIT</th>
                          <th width="20%" align="center">NAMA PENYAKIT</th>
                        </tr>';
          foreach ($pasieninhealt as $value)
              {
                  $i++;
                  $html.='<tr bgcolor="#ffffff">
                          <td align="left">'.date("d-m-Y",strtotime($value->tgl)).'</td>
                          <td align="left">'.$value->namapasien.'</td>
                          <td align="left">'.$value->tgl_lahir.'</td>
                          <td align="left">'.$value->kode_sakit.'</td>
                          <td align="left">'.$value->nama_penyakit.'</td>
                      </tr>';

              }
          $html.='</table>';
          $pdf->writeHTML($html, true, false, true, false, '');
          ob_end_clean();
          $pdf->Output('laporan_pasien_inhealt'.$sampai.'.pdf', 'I');
?>
