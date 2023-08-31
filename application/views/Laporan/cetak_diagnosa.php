
<?php
          // ob_start();
          $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
          $pdf->AddPage('L');
          $i=0;
          $html='<h1 align="center">'.$this->Core->nama_klinik().'</h1><h4 align="center"></h4><h4 align="center">
              '.$this->Core->alamat_klinik().'</h4><h4 align="center">
                '.$this->Core->kontak_klinik().'</h4>&nbsp;&nbsp;<h2 align="center">DIAGNOSA PASIEN</h2>
                  <p>DARI TGL: '.$mulai.' S/D TGL: '.$sampai.'</p>
                  <table cellspacing="1" border="1" bgcolor="#666666" cellpadding="2">
                      <tr bgcolor="#ffffff">

                          <th width="3%" align="center">NO</th>
                          <th width="7%" align="center">NO URUT</th>
                          <th width="10%" align="center">TANGGAL KUNJ</th>
                          <th width="20%" align="center">NAMA PASIEN</th>
                          <th width="10%" align="center">TANGGAL LAHIR</th>
                          <th width="10%" align="center">USIA</th>
                          <th width="10%" align="center">JENIS KELAMIN</th>
                          <th width="15%" align="center">DIAGNOSA</th>
                          <th width="15%" align="center">NAMA PENYAKIT</th>
                        </tr>';
          foreach ($kunjungan as $value)
              {
                  $i++;
                  $html.='<tr bgcolor="#ffffff">
                          <td align="left">'.$i.'</td>
                          <td align="left">'.$value->no_urutkunjungan.'</td>
                          <td align="left">'.date("d-m-Y",strtotime($value->tgl_kunjungan)).'</td>
                          <td align="left">'.$value->namapasien.'</td>
                          <td align="left">'.date("d-m-Y",strtotime($value->tgl_lahir)).'</td>
                          <td align="left">'.$this->Core->Umur($value->tgl_lahir).'</td>
                          <td align="left">'.$value->jenis_kelamin.'</td>
                          <td align="left">'.$value->kode.'</td>
                          <td align="left">'.$value->penyakit.'</td>
                      </tr>';

              }
          $html.='</table>';
          $pdf->writeHTML($html, true, false, true, false, '');
          ob_end_clean();
          $pdf->Output('laporan_pasien_inhealt'.$sampai.'.pdf', 'I');
?>
