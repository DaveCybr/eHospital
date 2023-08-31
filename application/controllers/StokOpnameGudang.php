<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StokOpnameGudang extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("ModelObat");
    $this->load->model("ModelAkuntansi");
    $this->load->model("ModelStokOpnameGudang");
    $this->load->library("excel");
  }

  function index()
  {
    $data = array(
      // 'form' => 'StokOpnameGudang/form',
      'body'          => 'StokOpnameGudang/list',
      'stok_opname'   => $this->ModelStokOpnameGudang->get_list_stokopname()->result(),
      'opname' => $this->ModelStokOpnameGudang->get_list()
    );
    $this->load->view('index', $data);
  }

  function input()
  {
    $data = array(
      // 'form' => 'Kunjungan/form',
      'body' => 'StokOpnameGudang/form',
      'obat' => $this->ModelObat->get_data()
     );
    $this->load->view('index', $data);
  }

  function list_batch()
  {
    $idobat = $this->input->post("kode_obat");
    // $idobat = "010042";
    $data = $this->ModelStokOpnameGudang->list_batch($idobat)->result();
    if (empty($data)) {
      $data = $this->ModelStokOpnameGudang->list_batch_baru($idobat)->result();
    }
    // die(var_dump($data));
    $html = "";
    foreach ($data as $value) {
      $html .= "<tr>
      <td><input hidden value='".$value->idgudang_obat."' name='id_pengadaan[]'><input hidden value='".$value->obat_idobat."' name='kode_obat[]'><input type='hidden' name='nama[]' value='".$value->nama_obat."'>".$value->nama_obat."</td>
      <td><input type='hidden' name='no_batch[]' class='form-control' value='".$value->no_batch."'>".$value->no_batch."</td>
      <td><input type='hidden' id='harga_beli".$value->idgudang_obat."' name='harga_beli[]' class='form-control' value='".$value->harga_beli."'>".$value->harga_beli."</td>
      <td><input type='hidden' name='satuan[]' class='form-control' value='".$value->satuan."'>".$value->satuan."</td>
      <td><input type='number' id='jumlah_komp".$value->idgudang_obat."' class='form-control jml_beli' name='jumlah_komp[]' readonly value='".$value->stok_akhir."'></td>
      <td><input type='number'min='0' id='jumlah_real".$value->idgudang_obat."' class='form-control jml_beli' name='jumlah_real[]' onkeyup='hitung(`".$value->idgudang_obat."`)'></td>
      <td><input type='number' readonly id='selisih".$value->idgudang_obat."' class='form-control jml_beli' name='selisih[]'></td>
      <td ><input type='hidden' id='selisih_harga".$value->idgudang_obat."' class='form-control jml_beli' name='selisih_harga[]'><span id='tx_selisih_harga".$value->idgudang_obat."''></span></td>
      <td ><input type='text' id='ket' class='form-control' name='keterangan[]'></td>
      <td><button type=\"button\"  class=\"hapus btn btn-danger btn-sm btn-circle\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Hapus Data\"><i class=\"fa fa-trash\"></i></button></td>
      </tr>";
    }
    echo json_encode(array("html"=>$html));
  }

  function insert()
  {
    $kode = $this->ModelAkuntansi->generete_notrans();
    $kode_input = $this->Core->generate_kode(10);
    $jam = date("H:i:s");
    $id = $this->input->post("id_pengadaan");
    for ($i=0; $i < count($id); $i++) {
      $data_pembelian = $this->db->where("idgudang_obat",$id[$i])->get("gudang_obat")->row();

      $data = array(
        'tanggal'     => $this->input->post("tanggal"),
        'id_pengadaan'=> NULL,
        'no_batch'    => $this->input->post("no_batch")[$i],
        'nama'        => $this->input->post("nama")[$i],
        'satuan'      => $this->input->post("satuan")[$i],
        'harga_beli'  => $this->input->post("harga_beli")[$i],
        'jumlah_real' => $this->input->post("jumlah_real")[$i],
        'jumlah_komp' => $this->input->post("jumlah_komp")[$i],
        'selisih'     => $this->input->post("jumlah_real")[$i]-$this->input->post("jumlah_komp")[$i],
        'selisih_harga'=> $this->input->post("selisih_harga")[$i],
        'kode_input' => $kode_input,
        'keterangan'=> $this->input->post("keterangan")[$i],
        'unit_obat' => "GUDANG",
        'id_gudang' => $id[$i],
        'obat_idobat' => $data_pembelian->obat_idobat
      );
      $this->db->insert("stok_opname", $data);
      $this->db->reset_query();
      if ($this->input->post("selisih_harga")[$i] != 0) {
        $jurnal_kredit = array(
          'tanggal' => $this->input->post("tanggal"),
          'keterangan' => 'Selisih harga dari obat '.$this->input->post("nama")[$i].' ,nomor batch '.$this->input->post("no_batch")[$i].', sejumlah '.$this->input->post("selisih")[$i].', dengan harga beli per satuan Rp. '.$this->input->post("harga_beli")[$i].' ,tanggal '.date("d-m-Y"),
          'norek' => '116.001',
          'debet' => 0,
          'kredit' => $this->input->post("selisih_harga")[$i],
          'no_transaksi' => $kode,
          'jam' => $jam
        );
        $this->db->insert("jurnal", $jurnal_kredit);
        $this->db->reset_query();
        $jurnal_debet = array(
          'tanggal' => $this->input->post("tanggal"),
          'keterangan' => 'Selisih harga dari obat '.$this->input->post("nama")[$i].' ,nomor batch '.$this->input->post("no_batch")[$i].', sejumlah '.$this->input->post("selisih")[$i].', dengan harga beli per satuan Rp. '.$this->input->post("harga_beli")[$i].' ,tanggal '.date("d-m-Y"),
          'norek' => '511.002',
          'debet' => $this->input->post("selisih_harga")[$i],
          'kredit' => 0,
          'no_transaksi' => $kode,
          'jam' => $jam,
          // 'pasien_noRM' =>
        );
        $this->db->insert("jurnal", $jurnal_debet);
        $this->db->reset_query();
      }


      $data_obat = $this->ModelObat->get_data_edit($this->input->post("kode_obat")[$i])->row_array();
      $data_pengadaan = $this->db->get_where("gudang_obat",array("idgudang_obat"=>$id[$i]))->row_array();
      if ($data_pengadaan['stok_opname']==NULL) {
        $opname = ($this->input->post("selisih")[$i]);
      }else{
        $opname = $data_pengadaan['stok_opname']+($this->input->post("selisih")[$i]);
      }
      // $this->db->where("idgudang_obat",$id[$i])->update("gudang_obat",array("stok_opname"=>$opname));
     //  $stok_baru = $data_obat['stok'] + ($this->input->post("selisih")[$i]);
     //  $stok_berjalan_baru = $data_obat['stok_berjalan'] + ($this->input->post("selisih")[$i]);
     //  $update = array(
     //    'stok'          => $stok_baru,
     //    'stok_berjalan' => $stok_berjalan_baru
     // );
     // $this->db->where("idobat", $this->input->post("kode_obat")[$i]);
     // $this->db->update("obat", $update);

     //Tambahan stok opname untu retur ke gudang
    //  $kode = $this->Core->generate_kode(10);
    //  $detail_pembelian_obat = array(
    //    'obat_idobat' =>  $this->input->post("kode_obat")[$i],
    //    'ed' => $data_pengadaan['tanggal_expired'],
    //    'no_batch' => $data_pengadaan['no_batch'],
    //    'jumlah_stok' => $this->input->post("jumlah_real")[$i],
    //    'stok_awal' => 1,
    //    'kode_input' => $kode,
    //    'harga' =>$data_pengadaan['hrg_beli'],
    //    'satuan_obat' => $data_pengadaan['satuan_beli'],
    //
    //  );
    //  $this->db->insert('gudang_obat', $detail_pembelian_obat);
    //  if ($data_pengadaan['retur_gudang']==NULL) {
    //    $opname = ($this->input->post("jumlah_real")[$i]);
    //  }else{
    //    $opname = $data_pengadaan['retur_gudang']+($this->input->post("jumlah_real")[$i]);
    //  }
    //  $this->db->where("iddetail_pembelian_obat",$id[$i])->update("detail_pembelian_obat",array("retur_gudang"=>$opname));
    //  $stok_baru = $data_obat['stok'] - ($this->input->post("jumlah_real")[$i]);
    //  $stok_berjalan_baru = $data_obat['stok_berjalan'] - ($this->input->post("jumlah_real")[$i]);
    //  $update = array(
    //    'stok'          => $stok_baru,
    //    'stok_berjalan' => $stok_berjalan_baru
    // );
    // $this->db->where("idobat", $this->input->post("kode_obat")[$i]);
    // $this->db->update("obat", $update);

    }

    $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Disimpan!!!!'));
    redirect(base_url().'StokOpnameGudang/input');
  }

  function cetak(){
    $tanggal = $this->uri->segment(3);
    $excel = new PHPExcel();
    $data = $this->ModelStokOpnameGudang->get_opname($tanggal);
    // die(var_dump($data));
    //Merge cells
    $excel->setActiveSheetIndex(0)->mergeCells('A1:H1');
    $excel->setActiveSheetIndex(0)->mergeCells('A2:H2');
    $excel->setActiveSheetIndex(0)->mergeCells('A3:K3');
    $excel->setActiveSheetIndex(0)->mergeCells('B4:C4');
    $excel->setActiveSheetIndex(0)->mergeCells('D4:I4');
    $excel->setActiveSheetIndex(0)->mergeCells('B5:C5');
    $excel->setActiveSheetIndex(0)->mergeCells('D5:I5');
    $excel->setActiveSheetIndex(0)->mergeCells('B7:B8');
    $excel->setActiveSheetIndex(0)->mergeCells('C7:C8');
    $excel->setActiveSheetIndex(0)->mergeCells('D7:D8');
    $excel->setActiveSheetIndex(0)->mergeCells('E7:E8');
    $excel->setActiveSheetIndex(0)->mergeCells('F7:F8');
    $excel->setActiveSheetIndex(0)->mergeCells('G7:G8');
    $excel->setActiveSheetIndex(0)->mergeCells('H7:H8');

    //inisialisai lebar cells
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(5);
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
    $excel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
    $excel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
    $excel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
    $excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
    $excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);

    //set font
    $fontStyle = array(
      'font' => array(
        'size' => 16,
        'bold' => true
      ),
      // 'fill' => array(
      //       'type' => PHPExcel_Style_Fill::FILL_SOLID,
      //       'color' => array('rgb' => 'FF0000')
      //   )
      'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )
    );
    $fontStyle2 = array(
      'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'c0c0c0'
          )
      ),
      'font' => array(
        'size' => 10,
        'bold' => true
      ),
      'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
      ),
      'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        )

    );
    //set style
    $excel->getActiveSheet()
      ->getStyle("B7:H7")
      ->applyFromArray($fontStyle2);
      //set style
      $excel->getActiveSheet()
        ->getStyle("B8:H8")
        ->applyFromArray($fontStyle2);
        //set style
        $excel->getActiveSheet()
          ->getStyle("A2:K2")
          ->applyFromArray($fontStyle);

    //set header

    $judul = "REKAPITULASI LAPORAN STOK OPNAME";

    $excel->getActiveSheet()->setCellValue('A2', $judul);
    $excel->getActiveSheet()->setCellValue('B7', 'NO');
    $excel->getActiveSheet()->setCellValue('C7', 'KODE OBAT');
    $excel->getActiveSheet()->setCellValue('D7', 'NAMA OBAT');
    $excel->getActiveSheet()->setCellValue('E7', 'SATUAN');
    $excel->getActiveSheet()->setCellValue('F7', 'STOK KOMPUTER');
    $excel->getActiveSheet()->setCellValue('G7', 'STOK REAL');
    $excel->getActiveSheet()->setCellValue('H7', 'SELISIH');
    $i = 9;
    $no = 1;
    foreach ($data as $value)
    {
          $excel->getActiveSheet()->setCellValueByColumnAndRow(1, $i,$no);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(2, $i,$value->idobat);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(3, $i,$value->nama);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(4, $i,$value->satuan);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(5, $i,$value->komputer);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(6, $i,$value->asli);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(7, $i,$value->selisih);
          $i++;
          $no++;
        }
    $excel_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');

    header('Content-Type: application/vnd.ms-excel');

    header('Content-Disposition: attachment;filename="laporan stok opname.xls"');

    $excel_writer->save('php://output');

  }

  public function set_opname(){
    $data = $this->db
    ->join("obat","nama_obat=nama")
    ->get_where("stok_opname",array("stok_opname.tanggal"=>"2020-08-30"))->result();
    // var_dump($data);
    // die();
    foreach ($data as $value) {
      // $gudang = $this->db->get_where("gudang_obat",array("idgudang_obat"=>$value->id_gudang))->row();
      $stok_opname = $value->jumlah_real-$value->jumlah_komp;
      // var_dump($stok_opname);
      // die();
      // echo $value->id_gudang." | ".$value->selisih."<br>";
      $this->db
      ->where("idstok_opname",$value->idstok_opname)
      ->update("stok_opname",array("obat_idobat"=>$value->idobat));
      // $this->db->where("idstok_opname",$value->idstok_opname)->update("stok_opname",array("selisih"=>$stok_opname));
    }
    echo "Selesai";
  }


}
