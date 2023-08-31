<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resep extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model("ModelKunjungan");
    $this->load->model("ModelBilling");
    $this->load->model('ModelPasien');
    $this->load->model('ModelObat');
    $this->load->model('ModelResep');
    $this->load->model('ModelAkuntansi');
    $this->load->model('ModelJenisPasien');
  }

  function index()
  {
    // $tgl = date('Y-m-d');
    // $biaya = $this->ModelBilling->biaya()->row_array();
    $data = array(
      'body'      => "Resep/index",
      'resep' => $this->ModelResep->get_resep(),
      'resep_sdh' => $this->ModelResep->get_resep_sudah(),
      'jenis_pasien' => $this->ModelJenisPasien->get_data(),
    );
    $this->load->view('index',$data);
  }
  function index2()
  {
    // $tgl = date('Y-m-d');
    // $biaya = $this->ModelBilling->biaya()->row_array();
    $data = array(
      'body'      => "Resep/index2",
      'resep' => $this->ModelResep->get_resep(),
      'resep_sdh' => $this->ModelResep->get_resep_sudah(),
    );
    $this->load->view('index2',$data);
  }
  function detail(){
    $kode = $this->uri->segment(3);
    $data = array(
      'body' => "Resep/detail",
      'detail' => $this->ModelResep->get_tebusan($kode),
      'tebusan' => $this->ModelResep->get_resep_beri($kode),
      'pasien' => $this->ModelResep->get_pasien($kode)
    );
    $this->load->view('index',$data);
  }
  function tebusan(){
    $kode = $this->uri->segment(3);
    $data = array(
      'body' => "Resep/tebusan",
      'detail' => $this->ModelResep->get_tebusan($kode),
      'pasien' => $this->ModelResep->get_pasien($kode)
    );
    $this->load->view('index',$data);

  }
  function print(){
    $kode = $this->uri->segment(3);
    $pasien = $this->ModelResep->get_pasien($kode);
    $riwayat_alergi = $this->ModelResep->get_riwayat($pasien['noRM']);
    $data = array(
      // 'body' => "Resep/print",
      // 'detail' => $this->ModelResep->get_tebusan($kode),
      'dokter' => $this->ModelResep->get_dokter($kode),
      'resep' => $this->ModelResep->get_resep_beri($kode),
      'pasien' => $pasien,
      'alergi' => $riwayat_alergi
    );
    $this->load->view('Resep/print2',$data);

  }
  function get_batch(){
    $idobat = $this->input->post("kode_obat");
    // $idobat = "03o0o403";
    $data = $this->ModelResep->get_list_batch($idobat);
    // die(var_dump($data));
    echo json_encode($data);
  }

  function get_batch2(){
    $idobat = $this->input->post("kode_obat");
    // $idobat = "03o0o403";
    $data = $this->ModelResep->get_list_batch2($idobat);
    // die(var_dump($data));
    echo json_encode($data);
  }
  function get_batch_retur(){
    $idobat = $this->input->post("kode_obat");
    // $idobat = "03o0o403";
    $data = $this->ModelResep->get_list_batch_retur($idobat);
    // die(var_dump($data));
    echo json_encode($data);
  }

  function insert_tebusan(){
    $no_resep = $this->input->post("kode_resep");
    $list_batch = $this->input->post("list_batch");
    $id_pengadaan = $this->input->post('id_pengadaan');
    $jml_resep = $this->input->post("jumlah_resep");
    $jml_beri = $this->input->post("jumlah_beri");
    $id_detail = $this->input->post("id_detail_resep");
    $id_obat = $this->input->post("kode_obat");
    $signa = $this->input->post("signa");
    $kunjungan = $this->ModelResep->get_kunjungan($no_resep);
    // if ($kunjungan['acc_ranap']!=null) {
    //   for ($i=0; $i < count($id_pengadaan) ; $i++) {
    //     $data_obat = $this->ModelObat->get_data_edit($id_obat[$i])->row_array();
    //     $this->db->where('idobat',$id_obat[$i]);
    //     $this->db->update('obat',array('stok'=>($data_obat['stok']-$jumlah_beri[$i])));
    //   }
    // }
    if (count($id_pengadaan)==0) {
      redirect(base_url()."Resep/tebusan/".$no_resep);
    }else{
      for ($i=0; $i < count($id_pengadaan) ; $i++) {
        $data = array(
          'id_detail_resep' => $id_detail[$i],
          'jumlah_resep' => $jml_resep[$i],
          'jumlah_beri' => $jml_beri[$i],
          'resep_no_resep' => $no_resep,
          'obat_idobat' => $id_obat[$i],
          'signa' => $signa[$i],
          'no_batch' => $list_batch[$i],
          'id_pengadaan' => $id_pengadaan[$i]
        );
        if($this->db->insert("detail_resep_diberikan",$data)){
          $data_pembelian = $this->db->get_where("detail_pembelian_obat",array('iddetail_pembelian_obat'=>$id_pengadaan[$i]))->row_array();
          if ($data_pembelian['jumlah_terjual']==null) {
            $jumlah = 0;
          }else{
            $jumlah = $data_pembelian['jumlah_terjual'];
          }
          $jumlah_sekarang = $jumlah+$jml_beri[$i];
          $this->db->where("iddetail_pembelian_obat",$id_pengadaan[$i]);
          $this->db->update('detail_pembelian_obat',array("jumlah_terjual"=>$jumlah_sekarang));
          $this->db->reset_query();
          $this->db->where("no_resep",$no_resep);
          $this->db->update("resep",array("status_resep"=>1));
          $data_obat = $this->ModelObat->get_data_edit($id_obat[$i])->row_array();
          if ($kunjungan['acc_ranap']!=null) {
            $this->db->where('idobat',$id_obat[$i]);
            $this->db->update('obat',array('stok'=>($data_obat['stok']-$jumlah_beri[$i])));
          }

        }

      }
      redirect(base_url()."Resep/");
    }
  }
  function berikan(){
      $no = $this->uri->segment(3);
      $kode = $this->ModelAkuntansi->generete_notrans();
      $diberikan = $this->db
      ->select("detail_resep.*,hrg_beli_satuan_kecil as hrg,detail_resep_diberikan.jumlah_beri")
      ->join("detail_resep","detail_resep.iddetail_resep=detail_resep_diberikan.id_detail_resep")
      ->join("detail_pembelian_obat","detail_resep_diberikan.id_pengadaan=detail_pembelian_obat.iddetail_pembelian_obat")
      ->get_where("detail_resep_diberikan",array('detail_resep_diberikan.resep_no_resep'=>$no))->result();

      $kunjungan = $this->db
      ->join("periksa","periksa.idperiksa=resep.periksa_idperiksa")
      ->join("kunjungan","periksa.kunjungan_no_urutkunjungan=kunjungan.no_urutkunjungan")
      ->get_where("resep",array("no_resep"=>$no))->row_array();

      $this->db->where("resep_no_resep",$no)->update("detail_resep_diberikan",array("status_beri"=>1));
      // die(var_dump($diberikan));

      if ($kunjungan['sumber_dana'== 7]) {
        foreach ($diberikan as $value) {
          $obat= $this->db
          ->get_where("obat",array("idobat"=>$value->obat_idobat))->row();
          $data_sortir_signa = explode(' ',$value->signa);

          $data_non_dpho = array(
            "kdObatSK"=>0,
            "noKunjungan"=> $kunjungan['nokun_bridging'],
            "racikan"=> false,
            "kdRacikan"=> null,
            "obatDPHO"=> false,
            "kdObat"=> $value->obat_idobat,
            "signa1"=> intval($data_sortir_signa[0]),
            "signa2"=> intval($data_sortir_signa[2]),
            "jmlObat"=> intval($value->jumlah),
            "jmlPermintaan"=> intval($value->jumlah_beri),
            "nmObatNonDPHO"=> $obat->nama_obat
          );
          $bridge = PcareV4('obat/kunjungan','POST', 'text/plain', json_encode($data_non_dpho));
          // code...
          // echo json_encode($bridge);
          // echo json_encode($data_non_dpho);
        }
      }

      $total_beli = 0;
      $total_jual = 0;
      foreach ($diberikan as $value) {
        $total_jual += $value->total_harga;
        $total_beli += $value->hrg*$value->jumlah;

        // $data_obat = $this->ModelObat->get_data_edit($value->obat_idobat)->row_array();
        //
        // $this->db->where('idobat',$value->obat_idobat);
        // if ($kunjungan['unit_layanan']=="IGD") {
        //   $this->db->update('obat',array('stok_ugd'=>($data_obat['stok_ugd']-$value->jumlah_beri)));
        // }else{
        //   $this->db->update('obat',array('stok'=>($data_obat['stok']-$value->jumlah_beri)));
        // }
      }
      $nokun = $kunjungan['no_urutkunjungan'];
      $data_kunjungan = $this->db->get_where("kunjungan",array("no_urutkunjungan"=>$nokun))->row_array();

      $norm = $kunjungan['noRM'];
      $pendapatan = $total_jual-$total_beli;
      // $d = "2019-11-19";
      $jurnal = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
        'norek' => "218.001",
        'debet' => $total_jual,
        'kredit' => 0,
        'no_transaksi' => $kode,
        'jam' => date("H:i:s"),
        // 'jam' => $d,
        'no_urut' => $nokun,
        'pasien_noRM' => $norm
      );
      $jurnal1 = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
        'norek' => "411.014",
        'debet' => 0,
        'kredit' => $pendapatan,
        'no_transaksi' => $kode,
        'jam' => date("H:i:s"),
        // 'jam' => $d,
        'no_urut' => $nokun,
        'pasien_noRM' => $norm
      );
      $jurnal2 = array(
        'tanggal' => date("Y-m-d"),
        'keterangan' => 'Transaksi nomor kunjungan '.$nokun,
        'norek' => "116.001",
        'debet' => 0,
        'kredit' => $total_beli,
        'no_transaksi' => $kode,
        'jam' => date("H:i:s"),
        // 'jam' => $d,
        'no_urut' => $nokun,
        'pasien_noRM' => $norm
      );



      if ($data_kunjungan['sumber_dana']==7 || $data_kunjungan['sumber_dana']==9) {
        if ($data_kunjungan['acc_ranap']!=1) {
          $jurnal['norek'] = '218.001';
          if ($kunjungan['tupel_kode_tupel']=='IGD') {
            $jurnal1['norek'] = '411.016';
          }else{
            $jurnal1['norek'] = '411.014';
          }
        }else{
          $jurnal1['norek'] = '411.015';
        }
      }else{
        if ($data_kunjungan['acc_ranap']!=1) {
          if ($kunjungan['tupel_kode_tupel']=='IGD') {
            $jurnal1['norek'] = '411.016';
          }else{
            $jurnal1['norek'] = '411.014';
          }
        }else{
          $jurnal1['norek'] = '411.015';
        }
      }
      $this->db->insert("jurnal",$jurnal);
      $this->db->insert("jurnal",$jurnal1);
      if ($total_beli!=0) {
        $this->db->insert("jurnal",$jurnal2);
        // code...
      }


      $this->db->where("no_resep",$no);
      $this->db->update("resep",array("ambil"=>1));
      redirect(base_url()."Resep/");
    }
  public function filter_resep(){
    $tanggal = $this->input->post("tanggal");
    $sts = $this->input->post('sts');
    $poli = $this->input->post('poli');
    $ambil = $this->input->post('ambil');
    $jenis = $this->input->post('jenis');
    // $tanggal = date('Y-m-d');
    // $sts = 0;
    // $poli = 'UMU';
    // $ambil = 0;
    $data = $this->ModelResep->data_filter($tanggal,$sts,$poli,$ambil,$jenis);
    // die(var_dump($data));
    $html = '';
    $no=1;

    foreach ($data as $value) {
      $tupel = $value->acc_ranap=='1'?'RANAP':$value->tujuan_pelayanan;
      $button = "";
      $sts_billing ="";
      if ($value->acc_ranap!=1) {
        // code...
        if ($value->billing==1) {
          $sts_billing = '<span class="badge badge-success">Sudah Dibayar</span>';
        }else{
          $sts_billing = '<span class="badge badge-danger">Belum Dibayar</span>';
        }
      }
      if ($value->ambil==1) {
        $sts_ambil = '<span class="badge badge-success">Sudah Diambil</span>';
      }else{
        $sts_ambil = '<span class="badge badge-secondary">Belum Diambil</span>';
      }

      if ($value->status_resep==1) {
        if ($value->billing==1 || $value->acc_ranap==1) {
          $href = 'href="'.base_url().'Resep/berikan/'.$value->no_resep.'"';
          $disable = "";
        }else{
          $href="#";
          $disable = "disabled";
        }
        // die("dkaj");
        $button = '<a href="'.base_url().'Resep/detail/'.$value->no_resep.'" >
          <button id="'.$value->no_resep.'" type="button" class="detail_pembelian btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail Resep Pasien">
            Detail
          </button>
        </a> <a target="_blank" href="'.base_url().'Resep/print/'.$value->no_resep.'" >
          <button id="'.$value->no_resep.'" type="button" class="detail_pembelian btn btn-warning btn-sm"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Print Resep Pasien">
            Print Resep
          </button>
        </a>';
        // $button="hmmm";
        if ($value->ambil!=1) {
          $button.= '<a '.$href.' >
            <button d="'.$value->no_resep.'" '.$disable.' type="button" class="detail_pembelian btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Berikan Resep Pasien">
              Berikan Obat
            </button>
          </a>';
        }
      }else{
        if ($value->billing==1 || $value->acc_ranap==1) {
          $href = 'href="'.base_url().'Resep/tebusan/'.$value->no_resep.'"';
          $disable = "";
        }else{
          $href="#";
          $disable = "disabled";
        }
        $button = '<a '.$href.' >
          <button id="'.$value->no_resep.'" '.$disable.' type="button" class="detail_pembelian btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="" data-original-title="Buat Resep Pasien">
            Siapkan Obat
          </button>
        </a>';
      }
      if($value->sumber_dana == 7){
        $jp = "<h4><span class='badge badge-pill badge-success'>".$value->jenis_pasien."</h4>";
      }else {
        $jp = "<h4><span class='badge badge-pill badge-danger'>".$value->jenis_pasien."</h4>";
      }
      $html .= '<tr>
        <td>'.$no.'</td>
        <td>'.$value->no_resep.'</td>
        <td>'.$value->noRM.'</td>
        <td>'.$value->namapasien.'</td>
        <td>'.$tupel.'</td>
        <td>'.date("d-m-Y h:i:s",strtotime($value->tanggal)).'</td>
        <td>'.$jp.'</td>
        <td>'.$sts_billing.'</td>
        <td>'.$sts_ambil.'</td>
        <td>'.$button.'</td>';
      $no+=1;

    }
    // die(var_dump($html));
    echo $html;
  }

  public function get_resep(){
    $no_resep = $this->input->post("kode");
    $data = $this->db
    ->join("obat","obat.idobat=detail_resep.obat_idobat")
    ->where("resep_no_resep",$no_resep)->get("detail_resep")->result();
    echo json_encode($data);
  }

  public function edit_resep(){
    $this->session->set_flashdata('notif',$this->Notif->gagal("Fitur ini masih dalam perbaikan,untuk mengubah resep silahkan hubungi perawat atau petugas poli"));
    redirect(base_url()."Resep");
      // $id_detail = $this->input->post('iddetail_resep');
      // $idobat = $this->input->post('idobat');
      // $jumlah_awal = $this->input->post('jumlah_awal');
      // $jumlah_akhir = $this->input->post('jumlah_akhir');
      // $harga = $this->input->post('harga');
      // for($i=0;$i<count($id_detail);$i++){
      //   if ($jumlah_awal[$i]!=$jumlah_akhir[$i]) {
      //     //update stok
      //     $harga_akhir = $jumlah_akhir[$i]*$harga[$i];
      //     $this->db->where('iddetail_resep',$id_detail[$i]);
      //     $this->db->update('detail_resep',array('total_harga'=>$harga_akhir,'jumlah'=>$jumlah_akhir[$i]));
      //
      //
      //     if ($jumlah_akhir[$i]<$jumlah_awal[$i]) {
      //       //update stok berjalan
      //       $sisa_jumlah = $jumlah_awal[$i]-$jumlah_akhir[$i];
      //       $data_obat = $this->ModelObat->get_data_edit($idobat[$i])->row_array();
      //       $this->db->where('idobat',$idobat[$i]);
      //       $this->db->update('obat',array('stok_berjalan'=>($data_obat['stok_berjalan']+$sisa_jumlah)));
      //       //cek resep diberikan
      //       $cek = $this->db->where("id_detail_resep",$id_detail[$i])->get("detail_resep_diberikan");
      //       if ($cek->num_rows()<=1) {
      //         $res = $cek->row_array();
      //         $pengadaan = $this->db->where("iddetail_pembelian_obat",$res['id_pengadaan'])->get("detail_pembelian_obat")->row_array();
      //         $terjual = $pengadaan['jumlah_terjual']==NULL?0:$pengadaan['jumlah_terjual'];
      //         $this->db->where("iddetail_pembelian_obat",$res['id_pengadaan']);
      //         $this->db->update("detail_pembelian_obat",array("jumlah_terjual"=>$terjual-$sisa_jumlah));
      //         $this->db->reset_query();
      //         $this->db->where("iddetail_pemberian",$res['iddetail_pemberian']);
      //         $this->db->update("detail_resep_diberikan",array("jumlah_resep"=>$jumlah_akhir[$i],'jumlah_beri'=>$jumlah_akhir[$i]));
      //       }else{
      //         $res = $cek->result();
      //         $terpenuhi = false;
      //         $update_resep = $jumlah_akhir[$i];
      //         foreach ($res as $value) {
      //           if (!$terpenuhi) {
      //             if ($value->jumlah_beri >= $update_resep) {
      //               $sisa_beri = $value->jumlah_beri-$update_resep;
      //               $pengadaan = $this->db->where("iddetail_pembelian_obat",$value->id_pengadaan)->get("detail_pembelian_obat")->row_array();
      //               $terjual = $pengadaan['jumlah_terjual']==NULL?0:$pengadaan['jumlah_terjual'];
      //               $this->db->where("iddetail_pembelian_obat",$value->id_pengadaan);
      //               $this->db->update("detail_pembelian_obat",array("jumlah_terjual"=>$terjual-$sisa_beri));
      //               $this->db->reset_query();
      //               $this->db->where("iddetail_pemberian",$value->iddetail_pemberian);
      //               $this->db->update("detail_resep_diberikan",array("jumlah_resep"=>$update_resep,'jumlah_beri'=>$update_resep));
      //               $terpenuhi = true;
      //             }else{
      //               $update_resep = $update_resep-$value->jumlah_beri;
      //
      //             }
      //           }else{
      //             $pengadaan = $this->db->where("iddetail_pembelian_obat",$value->id_pengadaan)->get("detail_pembelian_obat")->row_array();
      //             $terjual = $pengadaan['jumlah_terjual']==NULL?0:$pengadaan['jumlah_terjual'];
      //             $this->db->where("iddetail_pembelian_obat",$value->id_pengadaan);
      //             $this->db->update("detail_pembelian_obat",array("jumlah_terjual"=>$terjual-$value->jumlah_beri));
      //             $this->db->where("iddetail_pemberian",$value->iddetail_pemberian);
      //             $this->db->delete("detail_resep_diberikan");
      //           }
      //         }
      //       }
      //     }else{
      //       $up_stok = $jumlah_akhir[$i]-$jumlah_awal[$i];
      //       $res = $this->db->where("id_detail_resep",$id_detail[$i])->get("detail_resep_diberikan");
      //       $diberikan = $res->row_array();
      //       //update stok berjalan
      //       $data_obat = $this->ModelObat->get_data_edit($idobat[$i])->row_array();
      //       foreach ($res->result() as $value) {
      //         $pengadaan = $this->db->where("iddetail_pembelian_obat",$value->id_pengadaan)->get("detail_pembelian_obat")->row_array();
      //         $terjual = $pengadaan['jumlah_terjual']==NULL?0:$pengadaan['jumlah_terjual'];
      //         $this->db->where("iddetail_pembelian_obat",$value->id_pengadaan);
      //         $this->db->update("detail_pembelian_obat",array("jumlah_terjual"=>$terjual-$value->jumlah_beri));
      //         $this->db->where('idobat',$idobat[$i]);
      //         $this->db->update('obat',array('stok_berjalan'=>($data_obat['stok_berjalan']+$value->jumlah_beri)));
      //       }
      //       $this->db->reset_query();
      //       $this->db->where("id_detail_resep",$id_detail[$i]);
      //       $this->db->delete("detail_resep_diberikan");
      //
      //       //FIFO RESEP
      //       $loop = true;
      //       $jm_resep = $jumlah_akhir[$i];
      //       do {
      //         $list_batch = $this->db
      //         ->order_by("tanggal_expired","ASC")
      //         ->get_where("list_batch",array("idobat"=>$idobat[$i],"stok >"=>0))->row_array();
      //         $jumlah_tersedia = $list_batch['stok'];
      //         if ($jumlah_akhir[$i] < $jumlah_tersedia && $jumlah_akhir[$i]>0) {
      //           $loop = false;
      //           $beri = $jumlah_akhir[$i];
      //           $jumlah_akhir[$i] = 0;
      //         }else{
      //           $sisa = $jumlah_akhir[$i]-$jumlah_tersedia;
      //           $beri =  $jumlah_tersedia;
      //           $jumlah_akhir[$i] = $sisa;
      //         }
      //         $resep_diberikan = array(
      //           'id_detail_resep' => $diberikan['id_detail_resep'],
      //           'jumlah_resep' => $jm_resep,
      //           'jumlah_beri' => $beri,
      //           'resep_no_resep' => $diberikan['resep_no_resep'],
      //           'obat_idobat' => $idobat[$i],
      //           'signa' => $diberikan['signa'],
      //           'no_batch' => $list_batch['no_batch'],
      //           'id_pengadaan' => $list_batch['iddetail_pembelian_obat'],
      //           'tanggal' => date("Y-m-d h:i:s")
      //         );
      //         $this->db->insert("detail_resep_diberikan",$resep_diberikan);
      //         $up_pembelian = $this->db->get_where("detail_pembelian_obat",array("iddetail_pembelian_obat"=>$list_batch['iddetail_pembelian_obat']))->row_array();
      //         $pemakaian = $up_pembelian['jumlah_terjual']+$beri;
      //         $this->db->where("iddetail_pembelian_obat",$list_batch['iddetail_pembelian_obat'])
      //         ->update("detail_pembelian_obat",array("jumlah_terjual"=>$pemakaian));
      //
      //       }while ($jumlah_akhir[$i] > 0);
      //
      //
      //       $this->db->where('idobat',$idobat[$i]);
      //       $this->db->update('obat',array('stok_berjalan'=>($data_obat['stok_berjalan']-$up_stok)));
      //     }
      //
      //   }
      // }
      // $this->session->set_flashdata('notif',$this->Notif->berhasil("Berhasil Simpan Data"));
      // redirect(base_url()."Resep");
  }

}
?>
