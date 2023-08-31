
<?php
          // ob_start();
          $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
          $pdf->AddPage('L');
          $i=0;
          $html='<h1 align="center">'.strtoupper($this->Core->nama_klinik()).'</h1>
                <h4 align="center" width="100px">'.($this->Core->alamat_klinik()).'</h4>&nbsp;&nbsp;<h2 align="center">LAPORAN KUNJUNGAN BERDASAR UMUR</h2>
                  <p>DARI TGL: '.$mulai.' S/D TGL: '.$sampai.'</p>
                  <table cellspacing="1" border="1" bgcolor="#666666" cellpadding="2">
                      <tr bgcolor="#ffffff">
                      <th style="width:4%;text-align:center">No</th>
                      <th style="width:12%;text-align:center">Tanggal</th>
                      <th style="width:6%;text-align:center">0 - 7 Hari</th>
                      <th style="width:6%;text-align:center">8 - 28 Hari</th>
                      <th style="width:6%;text-align:center">1 - 12 Bln</th>
                      <th style="width:6%;text-align:center">1 - 4 Thn</th>
                      <th style="width:6%;text-align:center">5 - 9 Thn</th>
                      <th style="width:6%;text-align:center">10 - 14 Thn</th>
                      <th style="width:6%;text-align:center">15 - 19 Thn</th>
                      <th style="width:6%;text-align:center">20 - 44 Thn</th>
                      <th style="width:6%;text-align:center">45 - 54 Thn</th>
                      <th style="width:6%;text-align:center">55 - 64 Thn</th>
                      <th style="width:6%;text-align:center">65 - 70 Thn</th>
                      <th style="width:6%;text-align:center"> > 70 Thn</th>
                      <th style="text-align:center">Total</th>
                      </tr>';
                  $kes_bp = 0;
                  $kes_bl =0;
                  $kes_ll =0;
                  $kes_lp =0;
                  $kes_total = 0;
                  // die(var_dump($data_html));
                  if (!empty(@$data_html)) {
                    $no =0;
                    $pnjng = count($data_html);
                    foreach ($data_html as $value) {
                      $no+=1;
                      // if ($no==11 || $no==$pnjng) {
                      //   $no = "#";
                      // }
                      $html .= '<tr bgcolor="#ffffff">
                        <th style="width:4%;text-align:center">'.$no.'</th>
                        <th style="width:12%;text-align:center">'.$mulai.' S/D '.$sampai.'</th>
                        <th style="width:6%;text-align:center">'.$value['NOL_HARI'].'</th>
                        <th style="width:6%;text-align:center">'.$value['LAPAN_HARI'].'</th>
                        <th style="width:6%;text-align:center">'.$value['BULAN'].'</th>
                        <th style="width:6%;text-align:center">'.$value['TAHUN_1'].'</th>
                        <th style="width:6%;text-align:center">'.$value['TAHUN_2'].'</th>
                        <th style="width:6%;text-align:center">'.$value['TAHUN_3'].'</th>
                        <th style="width:6%;text-align:center">'.$value['TAHUN_4'].'</th>
                        <th style="width:6%;text-align:center">'.$value['TAHUN_5'].'</th>
                        <th style="width:6%;text-align:center">'.$value['TAHUN_6'].'</th>
                        <th style="width:6%;text-align:center">'.$value['TAHUN_7'].'</th>
                        <th style="width:6%;text-align:center">'.$value['TAHUN_8'].'</th>
                        <th style="width:6%;text-align:center">'.$value['TAHUN_9'].'</th>
                        <th style="text-align:center">'.$value['TOTAL'].'</th>
                      </tr>';
                    }
                  }else{
                    $html .= '<tr><td colspan="7">Kosong</td></tr>';
                  }
          $html.='</table>';
          $pdf->writeHTML($html, true, false, true, false, '');
          ob_end_clean();
          $pdf->Output('laporan_kunjungan_umur_'.$sampai.'.pdf', 'I');
?>
