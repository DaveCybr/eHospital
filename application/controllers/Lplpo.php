<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lplpo extends CI_Controller{
  public $bulan = ['-','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

  // $bulan = array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('url', 'language'));
    $this->load->model('ModelLaporan');
    $this->load->library("excel");


  }

  function index()
  {
    $data = array(
      'body' => 'Laporan/lplpo/index'
    );
    $this->load->view('index',$data);
  }
  public function cetak()
  {
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $kelompok = $this->input->post('kelompok');
    // $from = date("Y-m-d");
    // $till = date("Y-m-d");
    // $jenis = 'opname';
    // if ($jenis=='opname') {
    $dataku = $this->ModelLaporan->get_opname($from,$till,$kelompok);
    // }else{
    // $dataku = $this->ModelLaporan->get_stok_batch($from,$till);
    // }
    $data = array(
      'data' => $dataku,
      'mulai' => date('d-m-Y',strtotime($from)),
      'sampai' => date('d-m-Y',strtotime($till))
    );
    // die(print_r($data));
    // if ($jenis=='opname') {
    $this->load->view('Laporan/lplpo/opname',$data);
    // }else{
    // $this->load->view('Laporan/lplpo/batch',$data);
    // }
  }



  function action(){
    $from = $this->input->post('tgl_mulai');
    $till = $this->input->post('tgl_sampai');
    $kelompok = $this->input->post('kelompok');
    // $from = date("Y-m-d");
    // $till = date("Y-m-d");
    // $jenis = 'opname';
    // if ($jenis=='opname') {
    $data = $this->ModelLaporan->get_opname($from,$till,$kelompok);
    $excel = new PHPExcel();

    //Merge cells
    $excel->setActiveSheetIndex(0)->mergeCells('A1:K1');
    $excel->setActiveSheetIndex(0)->mergeCells('A2:K2');
    $excel->setActiveSheetIndex(0)->mergeCells('A3:K3');
    $excel->setActiveSheetIndex(0)->mergeCells('B4:C4');
    $excel->setActiveSheetIndex(0)->mergeCells('D4:I4');
    $excel->setActiveSheetIndex(0)->mergeCells('B5:C5');
    $excel->setActiveSheetIndex(0)->mergeCells('D5:I5');
    $excel->setActiveSheetIndex(0)->mergeCells('B7:B8');
    $excel->setActiveSheetIndex(0)->mergeCells('C7:C8');
    $excel->setActiveSheetIndex(0)->mergeCells('D7:D8');
    $excel->setActiveSheetIndex(0)->mergeCells('E7:E8');
    $excel->setActiveSheetIndex(0)->mergeCells('F7:G7');
    $excel->setActiveSheetIndex(0)->mergeCells('H7:J7');
    $excel->setActiveSheetIndex(0)->mergeCells('K7:K8');

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
      ->getStyle("B7:K7")
      ->applyFromArray($fontStyle2);
      //set style
      $excel->getActiveSheet()
        ->getStyle("B8:K8")
        ->applyFromArray($fontStyle2);
        //set style
        $excel->getActiveSheet()
          ->getStyle("A2:K2")
          ->applyFromArray($fontStyle);

    //set header

    $judul = "LAPORAN PENGELUARAN DAN PENGADAAN OBAT ".$kelompok;

    $excel->getActiveSheet()->setCellValue('A2', $judul);
    $excel->getActiveSheet()->setCellValue('B4', 'Nama Unit Layanan');
    $excel->getActiveSheet()->setCellValue('D4', 'Klinik Dokterku Taman Gading');
    $excel->getActiveSheet()->setCellValue('J4', 'Tahun:');
    $excel->getActiveSheet()->setCellValue('K4', date("Y",strtotime($from)));
    $excel->getActiveSheet()->setCellValue('B5', 'Provinsi, Kabupaten/Kota');
    $excel->getActiveSheet()->setCellValue('D5', 'Jawa Timur, Kab. Jember');
    $excel->getActiveSheet()->setCellValue('J5', 'Bulan:');
    $excel->getActiveSheet()->setCellValue('K5', $this->bulan[(int)date("m",strtotime($from))]);
    $excel->getActiveSheet()->setCellValue('B7', 'NO');
    $excel->getActiveSheet()->setCellValue('C7', 'NAMA');
    $excel->getActiveSheet()->setCellValue('D7', 'SATUAN');
    $excel->getActiveSheet()->setCellValue('E7', 'STOK AWAL');
    $excel->getActiveSheet()->setCellValue('F7', 'PAMASUKAN');
    $excel->getActiveSheet()->setCellValue('H7', 'PENGELUARAN');
    $excel->getActiveSheet()->setCellValue('K7', 'STOK AKHIR');
    $excel->getActiveSheet()->setCellValue('F8', 'PBF');
    $excel->getActiveSheet()->setCellValue('G8', 'SARANA');
    $excel->getActiveSheet()->setCellValue('H8', 'RESEP');
    $excel->getActiveSheet()->setCellValue('I8', 'RETUR KE GUDANG');
    $excel->getActiveSheet()->setCellValue('J8', 'PEMUSNAHAN');
    $i = 9;
    $no = 1;
    foreach ($data as $value)
    {
          $excel->getActiveSheet()->setCellValueByColumnAndRow(1, $i,$no);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(2, $i,$value['nama']);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(3, $i,$value['satuan_kecil']);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(4, $i,$value['stok_awal']);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(5, $i,$value['pengadaan']);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(6, $i,0);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(7, $i,$value['pemakaian']);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(8, $i,$value['retur']);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(9, $i,$value['rusak']);
          $excel->getActiveSheet()->setCellValueByColumnAndRow(10, $i,$value['sisa']);
          $i++;
          $no++;
        }
    // $table_columns = array("Name", "Email");
    //
    // $column = 0;
    //
    // foreach($table_columns as $field){
    //
    //   $excel->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
    //
    //   $column++;
    //
    // }
    //
    // $excel_row = 2;

    // foreach($employee_data as $row){
    // $excel->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, "Text");

    // $excel->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, "22");

    //   $excel_row++;
    //
    // }

    $excel_writer = PHPExcel_IOFactory::createWriter($excel, 'Excel5');

    header('Content-Type: application/vnd.ms-excel');

    header('Content-Disposition: attachment;filename="Laporan LPLPO '.strtoupper($kelompok).'.xls"');

    $excel_writer->save('php://output');

  }

}
?>
