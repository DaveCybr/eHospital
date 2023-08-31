<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPasien extends CI_Model{

  var $table = 'pasien'; //nama tabel dari database
  var $column_order = array(null, 'noRM','namapasien','umur','tgl_lahir','jenis_kelamin', 'alamat','jenis_pasien_kode_jenis','noBPJS'); //field yang ada di table user
  var $column_search = array('noRM','namapasien','umur','tgl_lahir','	jenis_kelamin', 'noAsuransiLain', 'noBPJS','agama','suku','alamat','jenis_pasien_kode_jenis'); //field yang diizin untuk pencarian
  var $order = array('noRM' => 'desc'); // default order

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function get_data(){
    return $this->db->get('pasien')->result();
  }

  public function get_data_edit($noRM){
    return $this->db->get_where('pasien',array('noRM'=>$noRM));
  }

  public function cek_nobpjs($nobpjs){
    return $this->db->get_where('pasien',array('noBPJS'=>$nobpjs))->row_array();
  }

  public function generete_noRM(){
    $get_data = $this->db->select_max("noRM")->get('pasien')->row_array();
    if($get_data){
      $kode = (int) $get_data['noRM'];
      $kode = $kode+1;
      $kode_RM = str_pad($kode,8,"0",STR_PAD_LEFT);
    }else{
      $kode_RM = "00000001";
    }
    return $kode_RM;
  }
  public function generete_noRM_sementara(){
    $get_data = $this->db->select_max("noRM")
    ->where("tgl_daftar",date("Y-m-d"))
    ->get('pasien_sementara')->row_array();
    if($get_data){
      $kode = substr($get_data['noRM'],-3);
      $kode = (int) $kode;
      $kode = $kode+1;
      $kode_RM = str_pad($kode,3,"0",STR_PAD_LEFT);
    }else{
      $kode_RM = "001";
    }
    $kode_RM = substr(date("Y"),-2).date("md").$kode_RM;
    return $kode_RM;
  }
  public function list_pekerjaan(){
    return array(
      "Administrator" => "Administrator",
      "Advokat/Pengacara" => "Advokat/Pengacara",
      "Akuntan" => "Akuntan",
      "Apoteker" => "Apoteker",
      "Arsitek" => "Arsitek",
      "Bidan" => "Bidan",
      "Buruh" => "Buruh",
      "Camat" => "Camat",
      "Desainer" => "Desainer",
      "Direktur" => "Direktur",
      "Dokter" => "Dokter",
      "Dokter hewan" => "Dokter hewan",
      "Dosen" => "Dosen",
      "Editor" => "Editor",
      "Fotografer" => "Fotografer",
      "Guru/Pengajar" => "Guru/Pengajar",
      "Ilmuwan" => "Ilmuwan",
      "Ilustrator" => "Ilustrator",
      "Insinyur" => "Insinyur",
      "Ibu Rumah Tangga" => "Ibu Rumah Tangga",
      "Jaksa" => "Jaksa",
      "Jurnalis" => "Jurnalis",
      "Karyawan" => "Karyawan",
      "Kasir" => "Kasir",
      "Kiai" => "Kiai",
      "Koki" => "Koki",
      "Kondektur" => "Kondektur",
      "Konsultan" => "Konsultan",
      "Lurah" => "Lurah",
      "Mahasiswa" => "Mahasiswa",
      "Manajer" => "Manajer",
      "Marketing" => "Marketing",
      "Masinis" => "Masinis",
      "Model" => "Model",
      "Montir" => "Montir",
      "Nakhoda" => "Nakhoda",
      "Nelayan" => "Nelayan",
      "Notaris" => "Notaris",
      "Operator" => "Operator",
      "Pastor" => "Pastor",
      "Pensiunan" => "Pensiunan",
      "Pedagang" => "Pedagang",
      "Pegawai negeri (Pegawai Negeri Sipil)" => "Pegawai negeri (Pegawai Negeri Sipil)",
      "Pekerja sosial" => "Pekerja sosial",
      "Pelaut" => "Pelaut",
      "Pelayan" => "Pelayan",
      "Pelajar" => "Pelajar",
      "Pelukis" => "Pelukis",
      "Perangkat Desa" => "Perangkat Desa",
      "Pemadam kebakaran (Damkar)" => "Pemadam kebakaran (Damkar)",
      "Pemahat" => "Pemahat",
      "Pemain sepak bola" => "Pemain sepak bola",
      "Pemeran (Aktor)" => "Pemeran (Aktor)",
      "Pemrogram (Pengembang perangkat lunak, Programmer)" => "Pemrogram (Pengembang perangkat lunak, Programmer)",
      "Penari" => "Penari",
      "Pendeta" => "Pendeta",
      "Peneliti" => "Peneliti",
      "Pengantar surat/Tukang pos" => "Pengantar surat/Tukang pos",
      "Pengusaha/Wirausahawan" => "Pengusaha/Wirausahawan",
      "Penulis" => "Penulis",
      "Penyanyi" => "Penyanyi",
      "Perancang grafis (Desainer grafis)" => "Perancang grafis (Desainer grafis)",
      "Perawat" => "Perawat",
      "Petani" => "Petani",
      "Peternak" => "Peternak",
      "Polisi" => "Polisi",
      "Politikus" => "Politikus",
      "Pramugari" => "Pramugari",
      "Psikiater (Dokter jiwa)" => "Psikiater (Dokter jiwa)",
      "Psikolog (Ahli psikologi)" => "Psikolog (Ahli psikologi)",
      "Resepsionis" => "Resepsionis",
      "Satpam" => "Satpam",
      "Sekretaris" => "Sekretaris",
      "Seniman" => "Sekretaris",
      "Sopir" => "Sopir",
      "TNI" => "TNI",
      "Tukang" => "Tukang",
      "Wartawan" => "Tukang",
      "Lain-Lain" => "Lain-Lain"
    );
  }


  private function _get_datatables_query()
   {

       $this->db->from($this->table);

       $i = 0;

       foreach ($this->column_search as $item) // looping awal
       {
           if($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
           {

               if($i===0) // looping awal
               {
                   $this->db->group_start();
                   $this->db->like($item, $_POST['search']['value']);
               }
               else
               {
                   $this->db->or_like($item, $_POST['search']['value']);
               }

               if(count($this->column_search) - 1 == $i)
                   $this->db->group_end();
           }
           $i++;
       }

       if(isset($_POST['order']))
       {
           $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
       }
       else if(isset($this->order))
       {
           $order = $this->order;
           $this->db->order_by(key($order), $order[key($order)]);
       }
   }

   function get_datatables()
   {
       $this->_get_datatables_query();
       if($_POST['length'] != -1)
       $this->db->limit($_POST['length'], $_POST['start']);
       $query = $this->db->get();
       return $query->result();
   }

   function count_filtered()
   {
       $this->_get_datatables_query();
       $query = $this->db->get();
       return $query->num_rows();
   }

   public function count_all()
   {
       $this->db->from($this->table);
       return $this->db->count_all_results();
   }

   public function edit($value)
   {
     $link = base_url().'Pasien/edit/'.$value;
     $link2 = base_url().'Pasien/cetak_kartu/'.$value;
     $link3 = base_url().'Pasien/delete/'.$value;
     // return "<a href= '".$link. "'>
     //   <button type=\"button\" class=\"btn btn-circle btn-warning\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Edit\">
     //     <i class=\"fa fa-edit\"></i>
     //   </button>
     // </a><a href= '".$link2. "' target='_blank'>
     //   <button type=\"button\" class=\"btn btn-circle btn-primary\" data-toggle=\"tooltip\" data-placement=\"top\" data-original-title=\"Cetak Kartu\">
     //     <i class=\"fa fa-address-card\"></i>
     //   </button>
     // </a>";
     return '<span class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="ti-settings"></i>
                    </button>
                    <span class="dropdown-menu animated flipInY">
                      <a class="dropdown-item" target="_blank" href="'.$link2.'">Cetak Kartu</a>
                      <a class="dropdown-item" href="'.$link.'">Edit Data</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="'.$link3.'">Hapus Data</a>
                    </span>
                  </span>';
   }

   function no($id_check,$no)
   {
     return "
     <div class=\"custom-control custom-checkbox\">
       <input type=\"checkbox\" class=\"custom-control-input id_checkbox \" id=\"customCheck$id_check\" name=\"id[]\" value=\"$id_check\">
       <label class=\"custom-control-label\" for=\"customCheck$id_check\">$no</label>
     </div>
     ";
   }

   public function umur($tgl_lahir='')
   {
     if ($tgl_lahir==null) {
       return;
     }
     // Tanggal Lahir
 	$birthday = $tgl_lahir;

 	// Convert Ke Date Time
 	$biday = new DateTime($birthday);
 	$today = new DateTime();

 	$diff = $today->diff($biday);

 	// Display
 	return $diff->y ." Tahun";
   }

   public function get_pasien(){
    $data = $this->db
    ->select("tujuan_pelayanan as NAMA_UNIT,no_urutkunjungan as ID_ANTRIAN_UNIT,namapasien as NAMA_PASIEN,noRM as NO_KESEHATAN_PASIEN,noBPJS as nobpjs,
    pekerjaan as PEKERJAAN_PASIEN,tgl_lahir as TGL_LAHIR_PASIEN,jenis_kelamin as GENDER_PASIEN")
    ->join("tujuan_pelayanan","tujuan_pelayanan.kode_tupel=kunjungan.tupel_kode_tupel")
    ->join("pasien","pasien.noRM=kunjungan.pasien_noRM")
    ->get_where("kunjungan",array("DATE(tgl)"=>date("Y-m-d")))->result();
    // return $this->db->get("antrian_unit");
    // die(var_dump($data));
    echo json_encode($data);
  }

}
