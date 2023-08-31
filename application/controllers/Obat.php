<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obat extends CI_Controller{
  public $obat = array();
  public function __construct()
  {
    parent::__construct();
    $this->load->helper(array('url', 'language'));
    $this->load->model('ModelObat');
    $this->load->model('ModelJenisObat');
    $this->load->model('ModelKategoriObat');
    $this->load->model('ModelSatuan');
    $this->load->model('ModelAkuntansi');
    $this->obat = array(
      'idobat' => $this->input->post('idobat'),
      'nama_obat' => $this->input->post("nama_obat"),
      'dosis' => $this->input->post('dosis'),
      'kegunaan' => $this->input->post("kegunaan"),
      'jenis_obat_idjenis_obat' => $this->input->post('jenis_obat'),
      'kategori_obat_idkategori_obat' => $this->input->post("kategori_obat"),
      'kandungan_obat' => $this->input->post('kandungan'),
      'satuan_kecil' => $this->input->post("satuan_kecil"),
      'satuan_sedang' => $this->input->post("satuan_sedang"),
      'satuan_besar' => $this->input->post("satuan_besar"),
      'harga_beli_satuan_kecil' => $this->input->post("harga_satuan_kecil"),
      'harga_beli_satuan_sedang' => $this->input->post("harga_satuan_sedang"),
      'harga_beli_satuan_besar' => $this->input->post("harga_satuan_besar"),
      'jml_satuan_besar' => $this->input->post('jumlah_satuan_besar'),
      'jml_satuan_sedang' => $this->input->post('jumlah_satuan_sedang'),
      'jml_satuan_kecil' => 1,
      'harga_1' => $this->input->post('hrg_1'),
      'harga_2' => $this->input->post('hrg_2'),
      'harga_3' => $this->input->post('hrg_3'),
      'harga_4' => $this->input->post('hrg_4'),
      'harga_5' => $this->input->post('hrg_5'),
      'harga_ozon' => $this->input->post('hrg_ozon'),
      'status' => $this->input->post('status'),
      'kelompok_obat' => $this->input->post("kelompok_obat")
    );
  }

  function index()
  {
    $data = array(
      'body' => 'Obat/list',
      'obat' => $this->ModelObat->get_data(),
      'form_dialog' => 'Obat/form_dialog',
    );
    // die(var_dump($data));
    $this->load->view('index', $data);
  }

  public function get_obat(){
    $this->load->model("Datatable");
    $setup = array(
      'table' => 'obat', //nama tabel dari database
      'column_order' => array(null, 'idobat','nama_obat','kegunaan'), //field yang ada di table user
      'column_search' => array('idobat','nama_obat','kegunaan'), //field yang diizin untuk pencarian
      'order' => array('idobat' => 'asc'), // default order
      'join' => array("jenis_obat" => array('kolom'=>"jenis_obat.idjenis_obat=obat.jenis_obat_idjenis_obat",'jenis'=>"left"),
                "kategori_obat" => array('kolom'=>"kategori_obat.idkategori_obat=obat.kategori_obat_idkategori_obat",'jenis'=>"left"),),
      // 'group' => 'notran',
      // 'select' => 'norek,nama,wilayah.*,noktp,bayar.*,SUM(jml_angsur) as total_angsur'

    );
    // die(var_dump($this->session->userdata("wilayah")));
    $this->Datatable->setup($setup);

    $list = $this->Datatable->get_datatables();
    // die(var_dump($list));
        $data_obat = array();
        $no = $_POST['start'];
        foreach ($list as $data) {
          $apotek = $this->db
          ->select("sum(stok) as stok")
          ->get_where("list_batch",array("idobat"=>$data->idobat,"unit"=>"APOTEK"))->row();
          $ugd = $this->db
          ->select("sum(stok) as stok")
          ->get_where("list_batch",array("idobat"=>$data->idobat,"unit"=>"UGD"))->row();
          $stok_apotek = !empty($apotek) ?$apotek->stok:0;
          $stok_ugd = !empty($ugd)?$ugd->stok:0;
          $id_check = $data->idobat;
          $no++;
          $row = array();


            $row[] = '<input type="checkbox" class="form-check-input id_checkbox" id="tableMaterialCheck'.$id_check.'" name="id[]" value="'.$id_check.'">
              <label class="form-check-label" for="tableMaterialCheck'.$id_check.' ">';
            $row[] = $data->idobat;
            $row[] = $data->nama_obat;
            $row[] = $data->jenis_obat;
            $row[] = $data->kategori_obat;
            $row[] = $data->dosis;
            $row[] = $stok_apotek==NULL?0:$stok_apotek;

            // $row[] = $stok_ugd==NULL?0:$stok_ugd;
            $row[] = $data->status;
            $row[] = '<span class="btn-group">
                   <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <i class="ti-settings"></i>
                   </button>
                   <span class="dropdown-menu animated flipInY">
                     <a class="dropdown-item" href="'.base_url().'Obat/edit/'.$data->idobat.'">Edit Data</a>
                     <a class="dropdown-item detail_batch" href="#" id="'.$id_check.'" data-toggle="modal" data-target="#batchmodal" data-placement="top" title="" data-original-title="More">List Batch</a>
                     <a class="dropdown-item detail_obat" href="#" id="'.$id_check.'" data-toggle="modal" data-target="#scrollmodal" data-placement="top" title="" data-original-title="More">Detail Obat</a>

                     </span>';

            $data_obat[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Datatable->count_all(),
            "recordsFiltered" => $this->Datatable->count_filtered(),
            "data" => $data_obat,
        );
        //output dalam format JSON
        echo json_encode($output);
    // $data = $this->Datatable->get_datatables();
    // echo "<pre>";
    // print_r($data);
    // echo "</pre>";
  }

  function get_data_obat(){
    $id = $this->input->post('id_obat');
    echo json_encode($this->ModelObat->get_data_edit($id)->row_array());
  }

  function get_data_batch(){
    $id = $this->input->post('id_obat');
    // $data = array();
    echo json_encode($this->db->get_where('list_batch',array("idobat"=>$id,"stok!="=>0))->result());
  }

  function input()
  {
    $data = array(
      'form' => 'Obat/form',
      'body' => 'Obat/input',
      'satuan' => $this->ModelSatuan->get_data(),
      'jenis_obat' => $this->ModelJenisObat->get_data(),
      'kategori_obat' => $this->ModelKategoriObat->get_data()
    );
    $this->load->view('index', $data);
  }

  public function insert()
  {
    $hitung = $this->db->get_where("obat",array("idobat"=>$this->obat['idobat']))->num_rows();
    if ($hitung>0) {
      $this->session->set_flashdata('notif', $this->Notif->gagal('kode obat telah ada,silahkan gunakan kode obat lain yang masih belum ada'));
      redirect(base_url().'Obat');
    }else{

      if ($this->db->insert('obat', $this->obat)) {
        $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Tersimpan'));
        redirect(base_url().'Obat');
      } else {
        $this->session->set_flashdata('notif', $this->Notif->gagal('Gagal Tersimpan'));
        redirect(base_url().'Obat');
      }
    }

  }

  public function edit()
  {
    $id = $this->uri->segment(3);
    $data = array(
      'form' => 'Obat/form',
      'body' => 'Obat/edit',
      'obat' => $this->ModelObat->get_data_edit($id)->row_array(),
      'satuan' => $this->ModelSatuan->get_data(),
      'jenis_obat' => $this->ModelJenisObat->get_data(),
      'kategori_obat' => $this->ModelKategoriObat->get_data()
    );
    $this->load->view('index', $data);
  }

  public function update()
  {
    $idobat = $this->input->post('idobat');
    $this->db->where('idobat',$idobat);
    if ($this->db->update('obat', $this->obat)) {
      $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Tersimpan'));
      redirect(base_url().'Obat');
    } else {
      $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Tersimpan'));
      redirect(base_url().'Obat');
    }

  }

  public function delete()
  {
    $id = $this->input->post('id');
    // $cek_data = $this->db->where_in('obat_idobat	',$id)->get('obat')->num_rows();
    // if ($cek_data>0) {
    //   $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Hapus Data Obat,Data Master Masih Digunakan!!!!'));
    // }else{
    $this->db->where_in('idobat', $id);
    $delete = $this->db->delete('obat');
    if ($delete) {
      $this->session->set_flashdata('alert', $this->Core->alert_succcess('Berhasil Hapus Data Obat'));
    }else{
      $this->session->set_flashdata('alert', $this->Core->alert_danger('Gagal Hapus Data Obat'));
    };
    // }
    redirect(base_url().'Obat');
  }

  public function stokAwal(){
    $data = array(
      'form' => 'Obat/formstokAwal',
      'body' => 'Obat/stokAwal',
      'obat' => $this->ModelObat->get_data()
    );
    $this->load->view('index', $data);
  }

  public function stokAwalGudang(){
    $data = array(
      'form' => 'Obat/formStokAwalGudang',
      'body' => 'Obat/stokAwalGudang',
      'obat' => $this->ModelObat->get_data()
    );
    $this->load->view('index', $data);
  }
  public function listStokAwal(){
    $data = array(
      // 'form' => 'Obat/formstokAwal',
      'body' => 'Obat/listStokAwal',
      'obat' => $this->db->order_by("tanggal","DESC")->select("tanggal,count(*) as jumlah,kode_input")->group_by("kode_input")->get_where("detail_pembelian_obat",array("stok_awal"=>1))->result()
    );
    $this->load->view('index', $data);
  }
  public function listStokAwalGudang(){
    $data = array(
      // 'form' => 'Obat/formstokAwal',
      'body' => 'Obat/listStokAwalGudang',
      'obat' => $this->db->order_by("tanggal","DESC")->select("tanggal,count(*) as jumlah,kode_input")->group_by("kode_input")->get_where("gudang_obat",array("stok_awal"=>1))->result()
    );
    $this->load->view('index', $data);
  }
  public function detailStokAwal($kode){
    $data = array(
      // 'form' => 'Obat/formstokAwal',
      'body' => 'Obat/detailStokAwal',
      'obat' => $this->db->join("obat","obat.idobat=detail_pembelian_obat.obat_idobat")->get_where("detail_pembelian_obat",array("kode_input"=>$kode))->result()
    );
    $this->load->view('index', $data);
  }
  public function detailStokAwalGudang($kode){
    $data = array(
      // 'form' => 'Obat/formstokAwal',
      'body' => 'Obat/detailStokAwalGudang',
      'obat' => $this->db->join("obat","obat.idobat=gudang_obat.obat_idobat")->get_where("gudang_obat",array("kode_input"=>$kode))->result()
    );
    $this->load->view('index', $data);
  }
  public function insertStokAwal(){
    $kode = $this->ModelAkuntansi->generete_notrans();

    $id_obat = $this->input->post('id_obat');
    $no_batch = $this->input->post('no_batch');
    $jumlah = $this->input->post('jumlah');
    $harga = $this->input->post('harga');
    $satuan = $this->input->post('satuan');
    $tanggal_expired = $this->input->post('ed');
    $count = count($id_obat);
    $total_harga = 0;
    $kode_akun = $this->ModelAkuntansi->generete_notrans();
    $kode = $this->Core->generate_kode(10);
    for($i=0;$i<$count;$i++){
      $data_obat = $this->ModelObat->get_data_edit($id_obat[$i])->row_array();
      $jml_satuan_kecil = $jumlah[$i];
      $stok = $jml_satuan_kecil+$data_obat['stok'];
      $stok_berjalan = $jml_satuan_kecil+$data_obat['stok_berjalan'];
      $detail_pembelian_obat = array(
        'no_batch' => $no_batch[$i],
        'jumlah' => $jumlah[$i],
        'jumlah_satuan_kecil' => $jml_satuan_kecil,
        'tanggal_expired' => $tanggal_expired[$i],
        'obat_idobat' => $id_obat[$i],
        'stok_awal' => 1,
        'hrg_beli' => $harga[$i],
        'hrg_beli_satuan_kecil' => $harga[$i],
        'satuan_beli' => $satuan[$i],
        'kode_input' => $kode

      );
      $this->db->insert('detail_pembelian_obat', $detail_pembelian_obat);
      $update = array(
        'stok' => $stok,
        'stok_berjalan' => $stok_berjalan
      );
      $this->db->where('idobat',$id_obat[$i]);
      $this->db->update('obat',$update);
      $total_harga += $harga[$i]*$jumlah[$i];
    }
    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Stok Awal Obat',
      'norek' => '300.001',
      'debet' => 0,
      'kredit' => $total_harga,
      'no_transaksi' => $kode_akun,
      'jam' => date("H:i:s")
    );
    $jurnal2 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Stok Awal Obat',
      'norek' => '116.001',
      'debet' => $total_harga,
      'kredit' => 0,
      'no_transaksi' => $kode_akun,
      'jam' => date("H:i:s")
    );
    $this->db->insert('jurnal',$jurnal1);
    $this->db->insert('jurnal',$jurnal2);
    $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Disimpan!!!!'));
    redirect(base_url().'Obat/stokAwal');

  }

  public function insertStokAwalGudang(){
    $kode = $this->ModelAkuntansi->generete_notrans();

    $id_obat = $this->input->post('id_obat');
    $no_batch = $this->input->post('no_batch');
    $jumlah = $this->input->post('jumlah');
    $harga = $this->input->post('harga');
    $satuan = $this->input->post('satuan');
    $tanggal_expired = $this->input->post('ed');
    $count = count($id_obat);
    $total_harga = 0;
    $kode_akun = $this->ModelAkuntansi->generete_notrans();
    $kode = $this->Core->generate_kode(10);
    for($i=0;$i<$count;$i++){
      $data_obat = $this->ModelObat->get_data_edit($id_obat[$i])->row_array();
      $detail_pembelian_obat = array(
        'obat_idobat' => $id_obat[$i],
        'ed' => $tanggal_expired[$i],
        'no_batch' => $no_batch[$i],
        'jumlah_stok' => $jumlah[$i],
        'stok_awal' => 1,
        'kode_input' => $kode,
        'harga' => $harga[$i],
        'satuan_obat' => $satuan[$i],

      );
      $this->db->insert('gudang_obat', $detail_pembelian_obat);
      // $update = array(
      //   'stok' => $stok,
      //   'stok_berjalan' => $stok_berjalan
      // );
      // $this->db->where('idobat',$id_obat[$i]);
      // $this->db->update('obat',$update);
      $total_harga += $harga[$i]*$jumlah[$i];
    }
    $jurnal1 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Stok Awal Obat',
      'norek' => '300.001',
      'debet' => 0,
      'kredit' => $total_harga,
      'no_transaksi' => $kode_akun,
      'jam' => date("H:i:s")
    );
    $jurnal2 = array(
      'tanggal' => date("Y-m-d"),
      'keterangan' => 'Stok Awal Obat',
      'norek' => '116.001',
      'debet' => $total_harga,
      'kredit' => 0,
      'no_transaksi' => $kode_akun,
      'jam' => date("H:i:s")
    );
    $this->db->insert('jurnal',$jurnal1);
    $this->db->insert('jurnal',$jurnal2);
    $this->session->set_flashdata('notif', $this->Notif->berhasil('Berhasil Disimpan!!!!'));
    redirect(base_url().'Obat/stokAwalGudang');

  }
  public function kadaluarsa(){
    $data = array(
      'body' => 'Obat/kadaluarsa',
      'obat' => $this->ModelObat->get_kadaluarsa(),
      // 'form_dialog' => 'Obat/form_dialog',
    );
    $this->load->view('index', $data);
  }
  public function set_stok(){
    $data = $this->db->get("obat")->result();
    foreach ($data as $value) {
      $stok = $this->db->select("SUM(stok) as stok")->get_where("list_batch",array("idobat"=>$value->idobat,"unit"=>"APOTEK"))->row_array();
      $stok = $stok['stok']==NULL?0:$stok['stok'];
      $this->db->where("idobat",$value->idobat);
      $this->db->update("obat",array('stok'=>$stok,"stok_berjalan"=>$stok));
    }
    echo "Selesai";
  }
  // public function set_kode(){
  //   $data = $this->db->group_by("DATE(tanggal)")->get("detail_pembelian_obat")->result();
  //   // var_dump($data);
  //   foreach ($data as $value) {
  //     $kode = $this->Core->generate_kode(10);
  //     // echo $value->tanggal."<br>";
  //     if ($value->stok_awal==0) {
  //       $kode = NULL;
  //     }
  //     $this->db->where_in("DATE(tanggal)",date("Y-m-d",strtotime($value->tanggal)));
  //     $this->db->update("detail_pembelian_obat",array("kode_input"=>$kode));
  //     // echo $kode."<br>";
  //
  //   }
  //   echo "Selesai";
  // }

  // public function update_stok(){
  //   $data = $this->db
  //   ->select("SUM(jumlah_beri) as jumlah_pakai,detail_pembelian_obat.obat_idobat as idobat")
  //   ->group_by("detail_pembelian_obat.obat_idobat")
  //   // ->where("detail_pembelian_obat.obat_idobat","TBL0055")
  //   ->join("detail_pembelian_obat","detail_pembelian_obat.iddetail_pembelian_obat=detail_resep_diberikan.id_pengadaan")
  //   ->get("detail_resep_diberikan")
  //   ->result();
  //   foreach ($data as $value) {
  //     $data2 = $this->db
  //     ->select("SUM(jumlah_satuan_kecil) as pengadaan")
  //     ->get_where("detail_pembelian_obat",array("obat_idobat"=>$value->idobat))->row_array();
  //     $stok = $data2['pengadaan']-$value->jumlah_pakai;
  //     // die(var_dump($stok));
  //     $this->db->where("idobat",$value->idobat);
  //     $this->db->update("obat",array("stok"=>$stok));
  //
  //   }
  //   // die(var_dump($data2));
  //   echo "Selesai";
  // }
  public function set_harga(){
    $data = $this->db->get("obat_p")->result();
    foreach ($data as $value) {
      $up = array(
        'harga_1' => $value->rajal,
        'harga_2' => $value->ranap_1,
        'harga_3' => $value->ranap_2,
        'harga_4' => $value->ranap_3,
        'harga_5' => $value->vip,
        'harga_ozon' => $value->ozon
      );

      $this->db->where("idobat",$value->idobat)
      ->update("obat",$up);
    }
    echo "Selesai";
  }

  public function opname_ugd(){
    $data = $this->db
    ->select("SUM(stok) as stok, idobat")
    ->group_by("idobat")
    ->where("unit","UGD")
    ->get("list_batch")->result();
    foreach ($data as $value) {
      $dataku = array(
        'stok_berjalan_ugd' => $value->stok,
        'stok_ugd' => $value->stok
      );
      $this->db->where("idobat",$value->idobat);
      $this->db->update("obat",$dataku);
    }
    echo "selesai";
  }
  public function opname_apotek(){
    $data = $this->db
    ->select("SUM(stok) as stok, idobat")
    ->group_by("idobat")
    ->where("unit","APOTEK")
    ->get("list_batch")->result();
    foreach ($data as $value) {
      $dataku = array(
        'stok_berjalan' => $value->stok,
        'stok' => $value->stok
      );
      $this->db->where("idobat",$value->idobat);
      $this->db->update("obat",$dataku);
    }
    echo "selesai";
  }

  public function cek_stok(){
    // $kode = $this->input->post("idobat");
    $kode = '070073';
    // $kode = '0033';
    $jumlah = $this->input->post("jumlah");
    $obat = $this->db->where("idobat",$kode)->get("obat")->row_array();
    if ($_SESSION['poli']=='IGD') {
      if ($jumlah > $obat['stok_berjalan_ugd']) {
        $status = 0;
      }else{
        $status = 1;
      }
      $stok = $obat['stok_berjalan_ugd'];
    }else{
      if ($jumlah > $obat['stok_berjalan']) {
        $status = 0;
      }else{
        $status = 1;
      }
      $stok = $obat['stok_berjalan'];
    }
    $data = array(
      'status' => $status,
      'kode' => $kode,
      'nama_obat' => $obat['nama_obat'],
      'sisa' => $stok,
    );
    echo json_encode($obat);
  }

  public function cek_stok_edit(){
    $kode = $this->input->post("idobat");
    $jumlah = $this->input->post("jumlah");
    $no_resep = $this->input->post("no_resep");
    $diberikan = $this->db->get_where("detail_resep_diberikan",array("resep_no_resep"=>$no_resep,"obat_idobat"=>$kode))->row();
    if ($_SESSION['poli']=='IGD') {
      $obat = $this->db->select("SUM(stok) as stok_berjalan,nama_obat")->where(array("idobat"=>$kode,'stok > ' => 0,"unit"=>"UGD"))->get("list_batch")->row_array();

    }else{

      $obat = $this->db->select("SUM(stok) as stok_berjalan,nama_obat")->where(array("idobat"=>$kode,'stok > ' => 0,"unit"=>"APOTEK"))->get("list_batch")->row_array();
    }
    if (!empty($diberikan)) {
      $jml_beri = $diberikan->jumlah_beri;
    }else{
      $jml_beri = 0;
    }
    $stok = $obat['stok_berjalan']==NULL?0:$obat['stok_berjalan'];
    $jm = $stok+$jml_beri;
    if ($jumlah > $jm) {
      $status = 0;
    }else{
      $status = 1;
    }
    $data = array(
      'status' => $status,
      'kode' => $kode,
      'nama_obat' => $obat['nama_obat'],
      'sisa' => $jm,
    );
    echo json_encode($data);
  }


  public function set_gudang(){
    $data = $this->db->get("gudang_obat")->result();
    foreach ($data as $value) {
      $this->db->where("idgudang_obat",$value->idgudang_obat)->update("gudang_obat",array("mutasi"=>0));
    }
    echo "Selesai";
  }


  public function update_harga(){
    $data = $this->db
    ->group_by("obat_idobat")
    ->get("detail_pengajuan")->result();
    foreach ($data as $value) {
      $data_usulan = $this->db
      ->select("sum(harga_beli) as harga,count(*) as jumlah")
      ->get_where("detail_pengajuan",array("harga_beli !="=>NULL,"obat_idobat"=>$value->obat_idobat))->row();
      if ($data_usulan->harga > 0 && $data_usulan->jumlah>0) {
        $harga_beli = round($data_usulan->harga/$data_usulan->jumlah);
        $harga_jual = round($harga_beli*1.55);
        // echo $value->obat_idobat." || ".$harga_jual."<br>";
        $this->db->where("idobat",$value->obat_idobat)->update('obat', array(
          "harga_1" => $harga_jual,
          "harga_2" => $harga_jual,
          "harga_3" => $harga_jual,
          'harga_beli_satuan_kecil' => $harga_beli,
          'harga_beli_satuan_sedang' => $harga_beli,
          'harga_beli_satuan_besar' => $harga_beli,


        ));
      }
    }
    echo "Selesai";
  }
}
