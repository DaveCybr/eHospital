
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
                (68172)</h4>&nbsp;&nbsp;<h2 align="center">LAPORAN REKAPITULASI RUJUKAN PER PASIEN </h2>
                  <p>DARI TGL: '.$mulai.' S/D TGL: '.$sampai.'</p>
                  <h3>RUJUKAN INTERNAL</h3>
                  <table cellspacing="1" border="1" bgcolor="#666666" cellpadding="2">
                      <tr bgcolor="#ffffff" style="font-size:11;">
                          <th width="5%" align="center">NO</th>
                          <th width="5%" align="center">ANTRIAN</th>
                          <th width="20%" align="center">NORM</th>
                          <th width="20%" align="center">NAMA</th>
                          <th width="20%" align="center">TUJUAN POLI</th>
                          <th width="20%" align="center">JUMLAH RUJUKAN</th>
                          <th width="10%" align="center">TANGGAL</th>
                      </tr>';
          $no = 1;
          $total_internal = 0;
          foreach ($rujukan as $value) {
            $html.='<tr bgcolor="#ffffff" style="font-size:9;">
                    <td align="center">'.$no.'</td>
                    <td align="left">'.$value->no_antrian.'</td>
                    <td align="left">'.$value->norm.'</td>
                    <td align="left">'.$value->nama.'</td>
                    <td align="left">'.$tupel[$value->asal_poli].'</td>
                    <td align="left">'.$tupel[$value->tujuan_poli].'</td>
                    <td align="left">'.date("d-m-Y", strtotime($value->tanggal)).'</td>
                </tr>';
                $no++;
            // $total_internal += $value->jml;
          }
          $html.='</table><p></p><p></p>';
          // $html.='<h3>RUJUKAN EXTERNAL</h3>
          //         <table cellspacing="1" border="1" bgcolor="#666666" cellpadding="2">
          //             <tr bgcolor="#ffffff">
          //                 <th width="15%" align="center">NO</th>
          //                 <th width="50%" align="center">POLI</th>
          //                 <th width="35%" align="center">JUMLAH KUNJUNGAN</th>
          //             </tr>';
          // $html.='</table><p>Total Kunjungan : '.$rawat['jumlah'].'</p>';
          $pdf->writeHTML($html, true, false, true, false, '');
          ob_end_clean();
          $pdf->Output('laporan_kunjungan_laborat'.$sampai.'.pdf', 'I');
?>
