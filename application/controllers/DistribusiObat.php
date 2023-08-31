<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class DistribusiObat extends CI_Controller{

    public function __construct()
    {
      parent::__construct();
      $this->load->helper(array('url', 'language'));
      $this->load->model('ModelObat');
      $this->load->model('ModelDistribusiObat');
    }

    function index()
    {
      $data = array(
        'form' => 'DistribusiObat/form',
        'body' => 'DistribusiObat/input',
        'obat' => $this->ModelObat->get_data()
       );
      $this->load->view('index', $data);
    }

    public function insert(){
      
      $permintaan = array(
        'tanggal' => date("Y-m-d"),
        'jam' => date ("h:i:sa"),
        //'NIK' => $_SESSION['nik'],
        'status' => 0,
        'asal' => $this->input->post('penerima')
      );

      if ($this->db->insert('permintaan_unit', $permintaan)) {
        $id_obat = $this->input->post('id_obat');
        $jumlah = $this->input->post('jumlah');
        $idpermintaan = $this->db->insert_id();
        $count = count($id_obat);
        for($i=0;$i<$count;$i++){
           $detail_permintaan = array(
            'obat_idobat' => $id_obat[$i],
            'permintaan_unit_idpermintaan_unit' => $idpermintaan,
            'jumlah' => $jumlah[$i],
          );
          $this->db->insert('detail_permintaan', $detail_permintaan);

        }
        $this->session->set_flashdata('notif', $this->Notif->berhasil('Permintaan Berhasil Disimpan!!!!'));
        redirect(base_url().'DistribusiObat');
      }
    }

    public function get_obat(){
      $data_obat = $this->ModelObat->get_data_edit($this->input->post('id_obat'))->row_array();
      echo json_encode($data_obat);
    }

    public function get_satuan(){
      $id_obat = $this->input->post('id_obat');
      $data_obat = $this->ModelObat->get_data_edit($id_obat)->row_array();
      $data_satuan = array();
      if($data_obat!=null){
        array_push($data_satuan,array(
          'label' => 'satuan_besar',
          'satuan' => $data_obat['satuan_besar'],
          'harga_satuan' => $data_obat['harga_beli_satuan_besar'],
          'jml_satuan' => $data_obat['jml_satuan_besar']
        ));
        array_push($data_satuan,array(
          'label' => 'satuan_sedang',
          'satuan' => $data_obat['satuan_sedang'],
          'harga_satuan' => $data_obat['harga_beli_satuan_sedang'],
          'jml_satuan' => $data_obat['jml_satuan_sedang']
        ));
        array_push($data_satuan,array(
          'label' => 'satuan_kecil',
          'satuan' => $data_obat['satuan_kecil'],
          'harga_satuan' => $data_obat['harga_beli_satuan_kecil'],
          'jml_satuan' => $data_obat['jml_satuan_kecil']
        ));

      }
      echo json_encode($data_satuan);
    }

    public function detail($id=""){
      $detail= $this->db
      ->join("detail_permintaan","detail_permintaan.permintaan_unit_idpermintaan_unit=permintaan_unit.idpermintaan_unit")
      ->join("obat","obat.idobat=detail_permintaan.obat_idobat")
      ->get_where("permintaan_unit",array("idpermintaan_unit"=>$id))->result();
      $data = array(
        'body' => "DistribusiObat/detail",
        'detail' => $detail,
      );
      $this->load->view('index',$data);
    }

    public function insert_pemberian($id=""){

      $id_obat = $this->input->post("idobat");
      $id_detail = $this->input->post("iddetail");
      $jumlah = $this->input->post("jumlah_beri");
      $permintaan = $this->db->where("idpermintaan_unit",$id)
      ->get("permintaan_unit")->row_array();
      $unit = $permintaan['asal'];
      //FIFO RESEP
      for ($i=0; $i < count($id_obat) ; $i++) {
        $obat = $this->ModelObat->get_data_edit($id_obat[$i])->row_array();
        $loop = true;
        $jm_resep = $jumlah[$i];
        $jumlah_tersimpan = 0;
        if ($jumlah[$i]>0) {
          do {
            $list_batch = $this->db
            ->order_by("ed","ASC")
            ->get_where("list_batch_gudang",array("obat_idobat"=>$id_obat[$i],"stok_akhir >"=>0))->row_array();
            $jumlah_tersedia = $list_batch['stok_akhir'];
            if (empty($list_batch)) {
              break;
            }
            if ($jumlah[$i] < $jumlah_tersedia && $jumlah[$i]>0) {
              $loop = false;
              $beri = $jumlah[$i];
              $jumlah[$i] = 0;
            }else{
              $sisa = $jumlah[$i]-$jumlah_tersedia;
              $beri =  $jumlah_tersedia;
              $jumlah[$i] = $sisa;
            }
            $resep_diberikan = array(
              'jumlah' => $beri,
              'jumlah_satuan_kecil' => $beri,
              'hrg_beli' => $list_batch['harga_beli'],
              'hrg_beli_satuan_kecil'=> $list_batch['harga_beli'],
              'tanggal_expired' => $list_batch['ed'],
              'obat_idobat' =>$id_obat[$i],
              'tanggal' => date("Y-m-d H:i:s"),
              'satuan_beli' => $list_batch['satuan'],
              'id_gudang' => $list_batch['idgudang_obat'],
              'unit' => $unit,
              'id_permintaan' => $id_detail[$i]
            );
            $this->db->insert("detail_pembelian_obat",$resep_diberikan);
            $jumlah_tersimpan+=$beri;
          }while ($jumlah[$i] > 0);

        }
        // echo json_encode($id);
        $this->db->where("iddetail_permintaan",$id_detail[$i])->update("detail_permintaan",array("jumlah_beri"=>$jumlah_tersimpan));
        //$this->db->where("idpermintaan_unit",$id)
        //->update("permintaan_unit",array("status"=>1));
      }
      redirect("DistribusiObat");
    }

  }
?>
