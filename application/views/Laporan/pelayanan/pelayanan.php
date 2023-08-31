
<?php
          // ob_start();
          $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
          $pdf->AddPage('P');
          $font_size = $pdf->pixelsToUnits('24');
          $pdf->SetFont ('helvetica', '', $font_size , '', 'default', true );

          $i=0;
          $html='<h1 align="center">'.$this->Core->nama_klinik().'</h1><h4 align="center">'.$this->Core->alamat_klinik().'</h4>&nbsp;&nbsp;<h2 align="center">LAPORAN BULANAN PELAYANAN KESEHATAN</h2>
                  <p>DARI TGL: '.$mulai.' S/D TGL: '.$sampai.'</p>
                  <table cellspacing="1" border="0" bgcolor="#666666" cellpadding="2">
                      <tr bgcolor="#ffffff">
                          <th width="5%" align="center">NO</th>
                          <th width="65%" align="center">URAINAN</th>
                          <th width="10%" align="center">L</th>
                          <th width="10%" align="center">P</th>
                          <th width="10%" align="center">JUMLAH</th>
                      </tr>';

                  $html.='<tr>
                          <td><H4>A.</h4></td>
                          <td><h4>KEGIATAN KUNJUNGAN KLINIK</h4></td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>
                      <tr bgcolor="#ffffff">
                          <td>1.</td>
                          <td>Jumlah Keluarga (KK) baru yang tercatat di Klinik</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>2.</td>
                          <td>Jumlah Kunjungan Klinik (baru)</td>
                          <td>'.$pelayanan['kunjungan_baru']['l'].'</td>
                          <td>'.$pelayanan['kunjungan_baru']['p'].'</td>
                          <td>'.$pelayanan['kunjungan_baru']['total'].'</td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>3.</td>
                          <td>Jumlah Kunjungan Klinik (lama)</td>
                          <td>'.$pelayanan['kunjungan_lama']['l'].'</td>
                          <td>'.$pelayanan['kunjungan_lama']['p'].'</td>
                          <td>'.$pelayanan['kunjungan_lama']['total'].'</td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>4.</td>
                          <td>Jumlah Kunjungan Rawat Jalan (baru)</td>
                          <td>'.$pelayanan['rawat_jalan_baru']['l'].'</td>
                          <td>'.$pelayanan['rawat_jalan_baru']['p'].'</td>
                          <td>'.$pelayanan['rawat_jalan_baru']['total'].'</td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>5.</td>
                          <td>Jumlah Kunjungan Rawat Jalan (lama)</td>
                          <td>'.$pelayanan['rawat_jalan_lama']['l'].'</td>
                          <td>'.$pelayanan['rawat_jalan_lama']['p'].'</td>
                          <td>'.$pelayanan['rawat_jalan_lama']['total'].'</td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>6.</td>
                          <td>Jumlah Kunjungan Rawat Jalan Gigi (baru)</td>
                          <td>'.$pelayanan['kunjungan_gigi_baru']['l'].'</td>
                          <td>'.$pelayanan['kunjungan_gigi_baru']['p'].'</td>
                          <td>'.$pelayanan['kunjungan_gigi_baru']['total'].'</td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>7.</td>
                          <td>Jumlah Kunjungan Rawat Jalan Gigi (lama)</td>
                          <td>'.$pelayanan['kunjungan_gigi_lama']['l'].'</td>
                          <td>'.$pelayanan['kunjungan_gigi_lama']['p'].'</td>
                          <td>'.$pelayanan['kunjungan_gigi_lama']['total'].'</td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>8.</td>
                          <td>Jumlah Kunjungan Rawat Jalan Baru Gol. Umur > 60 Tahun</td>
                          <td>'.$pelayanan['kunjungan_umur_baru']['l'].'</td>
                          <td>'.$pelayanan['kunjungan_umur_baru']['p'].'</td>
                          <td>'.$pelayanan['kunjungan_umur_baru']['total'].'</td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>9.</td>
                          <td>Jumlah Kunjungan Rawat Jalan Lama Gol. Umur > 60 Tahun </td>
                          <td>'.$pelayanan['kunjungan_umur_lama']['l'].'</td>
                          <td>'.$pelayanan['kunjungan_umur_lama']['p'].'</td>
                          <td>'.$pelayanan['kunjungan_umur_lama']['total'].'</td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>10.</td>
                          <td>Jumlah Kunjungan Sesuai Dengan Jenis Kepesertaan (=jumlah point 2 & 3 di atas)</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td></td>
                          <td>     a. Umum</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>


                      <tr bgcolor="#ffffff">
                          <td></td>
                          <td>     b. BPJS (Askes, Jamsostek, Jamkesmas, Jampersal)</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>


                      <tr bgcolor="#ffffff">
                          <td></td>
                          <td>                  1. Kunjungan</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>


                      <tr bgcolor="#ffffff">
                          <td></td>
                          <td>                  2. Di Rujuk</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>
                      <tr bgcolor="#ffffff">
                          <td>11.</td>
                          <td>Jumlah Kasus Baru</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>12.</td>
                          <td>Jumlah Kasus Lama</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>13.</td>
                          <td>Jumlah Kunjungan Kasus Lama</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>14.</td>
                          <td>Jumlah Kunjungan Kasus (= jumlah no. 11 + 12 + 13)</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr>
                          <td><h4>B.</h4></td>
                          <td><h4>KEGIATAN PELAYANAN KEGAWATDARURATAN</h4></td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>1.</td>
                          <td>Jumlah Penderita Gawat Darurat Yang Ditemukan</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>2.</td>
                          <td>Jumlah Penderita Gawat Darurat Yang ditangani ( Target : 100% dari yang ditemukan)</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td></td>
                          <td>    a. Maternal</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td></td>
                          <td> b. Neonatal</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td></td>
                          <td> c. Bayi</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td></td>
                          <td> d. Anak Balita</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td></td>
                          <td> e. Penderita kasus kecelakaan lalu lintas</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td></td>
                          <td> - Luka ringan</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td></td>
                          <td> - Luka Berat</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td></td>
                          <td> - Meninggal/Mati</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td></td>
                          <td> f. Penderita dengan penyakit potensial KLB</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>
                      <tr bgcolor="#ffffff">
                          <td></td>
                          <td> g. Lain - lain</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>3. </td>
                          <td>Jumlah Penderita Gawat darurat yang di Rujuk (Target : 25% dari yang ditemukan)</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>  <tr bgcolor="#ffffff">
                            <td></td>
                            <td>    a. Maternal</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr bgcolor="#ffffff">
                            <td></td>
                            <td> b. Neonatal</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr bgcolor="#ffffff">
                            <td></td>
                            <td> c. Bayi</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr bgcolor="#ffffff">
                            <td></td>
                            <td> d. Anak Balita</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr bgcolor="#ffffff">
                            <td></td>
                            <td> e. Penderita kasus kecelakaan lalu lintas</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr bgcolor="#ffffff">
                            <td></td>
                            <td> - Luka ringan</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr bgcolor="#ffffff">
                            <td></td>
                            <td> - Luka Berat</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr bgcolor="#ffffff">
                            <td></td>
                            <td> - Meninggal/Mati</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr bgcolor="#ffffff">
                            <td></td>
                            <td> f. Penderita dengan penyakit potensial KLB</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr bgcolor="#ffffff">
                            <td></td>
                            <td> g. Lain - lain</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                      <tr>
                          <td><h4>C. </h4></td>
                          <td>PEMERIKSAAN KESEHATAN / KEURING</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>1.</td>
                          <td>Keuring Tenaga Kerja</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>2.</td>
                          <td>Keuring Pelajar</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>3.</td>
                          <td>Keuring Calon Transmigrasi</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>4.</td>
                          <td>Keuring Jemaah Haji</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>5.</td>
                          <td>Keuring Olahraga</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>6.</td>
                          <td>Keuring Calon Pengantin (Sepasang)</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>

                      <tr bgcolor="#ffffff">
                          <td>7.</td>
                          <td>Keuring Kesehatan Umum</td>
                          <td></td>
                          <td></td>
                          <td></td>
                      </tr>





                      ';

          $html.='</table>';
          $pdf->writeHTML($html, true, false, true, false, '');
          ob_end_clean();
          $pdf->Output('laporan_kesakitan_'.$sampai.'.pdf', 'I');
?>
