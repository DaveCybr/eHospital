
<?php
          // ob_start();
          $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
          $pdf->AddPage('P');
          $i=0;
          $html='
          <table>
            <td valign="middle"><img src="'.base_url().'desain/assets/images/rsuh_7.png" class="logo" style="width: 50px;height: 50px; vertical-align: middle;"></td>
            <td><h1 align="center">Rumah Sakit Utama Husada</h1><h4 align="center">Jl. Manggar No.134, Tegalsari, Ambulu,</h4><h4 align="center">
                  Kabupaten Jember, Jawa Timur</h4><h4 align="center">
                  (68172)</h4></td>
          </table>


                <hr>
                &nbsp;&nbsp;<h2 align="center">HASIL PEMERIKSAAN LAB</h2>
                <br><br><table bgcolor="#666666" >
                    <tr bgcolor="#ffffff">
                        <th width="15%" align="center">NO RM : </th>
                        <th width="35%">'.$data_lab['noRM'].'</th>
                        <th width="15%">DOKTER : </th>
                        <th width="35%">'.$data_lab_2['nama_dokter'].'</th>
                    </tr>
                    <tr bgcolor="#ffffff">
                        <th width="15%" align="center">PASIEN : </th>
                        <th width="35%">'.$data_lab['namapasien'].'</th>
                        <th width="15%">TANGGAL : </th>
                        <th width="35%">'.date("d:m:Y",strtotime($data_lab_2['jam'])).'</th>
                    </tr>
                    <tr bgcolor="#ffffff">
                        <th width="15%" align="center">ANALIS : </th>
                        <th width="35%">'.$data_lab['nama_analis'].'</th>
                        <th width="15%">JAM : </th>
                        <th width="35%">'.date("h:i:s",strtotime($data_lab_2['jam'])).'</th>
                    </tr>
                  </table><br><br><br><br>

                  <table cellspacing="1" border="1" bgcolor="#666666" cellpadding="2">
                      <tr bgcolor="#ffffff">
                      <th width="5%" align="center">NO</th>
                          <th>KODE LAB</th>
                          <th>NAMA</th>
                          <th>NILAI NORMAL</th>
                          <th>HASIL LAB</th>
                      </tr>';
          foreach ($hasil_lab as $value)
              {
                  $i++;
                  $html.='<tr bgcolor="#ffffff">
                          <td align="center">'.$i.'</td>

                          <td >'.$value->kodelab.'</td>
                          <td >'.$value->nama.'</td>
                          <td >'.$value->nilainormal.'</td>
                          <td >'.$value->hasil.'</td>
                      </tr>';

              }
          $html.='</table>';
          $pdf->writeHTML($html, true, false, true, false, '');
          ob_end_clean();
          $pdf->Output('hasil_lab_'.$data_lab['noRM'].'.pdf', 'I');
?>
