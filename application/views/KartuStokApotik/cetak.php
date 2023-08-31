
<?php
          // ob_start();
          $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
          $pdf->AddPage('L');
          $i=0;
          $html='<h1 align="center" class="m-0">'.strtoupper($this->Core->nama_klinik()).'</h1>
          <h4 align="center">'.($this->Core->alamat_klinik()).'</h4>
          &nbsp;&nbsp;<h2 align="center">Kartu Stok Apotik</h2>

          <table cellspacing="1" border="1" bgcolor="#666666" cellpadding="2">
              <tr bgcolor="#ffffff">
                  <th width="10%" align="center">KODE OBAT</th>
                  <th width="10%" align="center">NAMA OBAT</th>
                  <th width="10%" align="center">TANGGAL</th>
                  <th width="10%" align="center">STOK AWAL</th>
                  <th width="10%" align="center">PENERIMAAN</th>
                  <th width="10%" align="center">SO</th>
                  <th width="10%" align="center">RETUR</th>
                  <th width="10%" align="center">PERSEDIAAN</th>
                  <th width="10%" align="center">PENGELUARAN</th>
                  <th width="10%" align="center">SISA STOK</th>
              </tr>';
                      $akhir = 0;
                      foreach ($data_apotek as $value)
                          {
                              $i++;
                              $html.='<tr bgcolor="#ffffff">
                                      <td align="center">'.$value["kode_obat"].'</td>
                                      <td align="left">'.$value["nama_obat"].'</td>
                                      <td align="center">'.$value["tgl"].'</td>
                                      <td align="center">'.$value["stok_awal"].'</td>
                                      <td align="center">'.$value["penerimaan"].'</td>
                                      <td align="center">'.$value["stok_opname"].'</td>
                                      <td align="center">'.$value["retur"].'</td>
                                      <td align="center">'.$value["persediaan"].'</td>
                                      <td align="center">'.$value["pengeluaran"].'</td>
                                      <td align="center">'.$value["sisa_stok"].'</td>
                                  </tr>';
                                  $akhir = $value["sisa_stok"];

                          }
          $html.='</table><p>stok APOTEK : '.$akhir.'';
          $pdf->writeHTML($html, true, false, true, false, '');
          ob_end_clean();
          $pdf->Output('kartu stok.pdf', 'I');
?>
