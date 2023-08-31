<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Core extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function getChatKonsul($norm)
  {
    $this->db->where("pasien_noRM", $norm);
    $this->db->order_by('waktu', 'ASC');
    return $this->db->get('chat_konsul');
  }

  public function getChatBaca($norm, $status)
  {
    $this->db->where("pasien_noRM", $norm);
    $this->db->where("status_baca", $status);
    $this->db->where("pegawai_NIK", "0");
    $this->db->order_by('waktu', 'ASC');
    return $this->db->get('chat_konsul');
  }

  public function get_pcare()
  {
    return $this->db->get("pcare")->row_array();
  }

  function nama_klinik()
  {
    $data = $this->db->get("klinik")->row_array();
    return $data['nama'];
  }
  function alamat_klinik()
  {
    $data = $this->db->get("klinik")->row_array();
    return $data['alamat'];
  }
  function kontak_klinik()
  {
    $data = $this->db->get("klinik")->row_array();
    return $data['kontak'];
  }
  function logo_klinik()
  {
    $data = $this->db->get("klinik")->row_array();
    return base_url() . $data['logo'];
  }
  function cek_username($username)
  {
    return $this->db->get_where("user", array('nama' => $username));
  }
  public function get_pasien($norm)
  {
    if (strlen($norm) > 8) {
      return $this->db
        ->get_where("pasien_sementara", array("noRM" => $norm))->row_array();
    } else {
      return $this->db
        ->get_where("pasien", array("noRM" => $norm))->row_array();
    }
  }
  function get_dokumentasi($nokun)
  {
    return $this->db->get_where("foto_pemeriksaan", array("kunjungan_no_urutkunjungan" => $nokun))->result();
  }
  function get_numdokumentasi($nokun)
  {
    return $this->db->get_where("foto_pemeriksaan", array("kunjungan_no_urutkunjungan" => $nokun))->num_rows();
  }
  function generate_kode($panjang)
  {
    $karakter = "asdfghjklqwertyuipzxcvbnm1234567890ZXCVBNMASDFGHJKLQWERTYUIOP";
    $kode = "";
    for ($i = 0; $i < $panjang; $i++) {
      $pos = rand(0, strlen($karakter) - 1);
      $kode .= $karakter[$pos];
    }
    return $kode;
  }
  public function get_kadaluarsa()
  {
    $date = date("Y-m-d");
    $batas = date("Y-m-d", strtotime("+30 days"));
    return $this->db
      ->select("(IFNULL(jumlah,0)-IFNULL(jumlah_terjual,0)) as jumlah,tanggal_expired")
      ->get_where("detail_pembelian_obat", array("DATE(tanggal_expired) >=" => $date, "DATE(tanggal_expired) <=" => $batas, 'jumlah !=' => 0))
      ->num_rows();
  }
  public function get_jatuh_tempo()
  {
    $sekarang = date("Y-m-d");
    $j_tempo = date("Y-m-d", strtotime("+7 days"));
    // die(var_dump($j_tempo));
    return $this->db
      ->join('hutang', 'hutang.pembelian_obat_no_nota=pembelian_obat.no_nota')
      ->get_where("pembelian_obat", array("tanggal_jatuh_tempo <=" => $j_tempo, 'status !=' => "Lunas"))
      ->num_rows();
  }
  public function get_kunjungan($poli)
  {
    return $this->db
      ->get_where("kunjungan", array("tupel_kode_tupel" => $poli, 'tgl' => date("Y-m-d"), 'sudah' => 0))
      ->num_rows();
  }
  public function get_kunjungan_lab()
  {
    return $this->db
      ->get_where("labkunjungan", array('DATE(jam)' => date("Y-m-d"), 'status' => 1))
      ->num_rows();
  }
  public function hit_data($tgl)
  {
    $this->db->distinct();
    $this->db->group_by("no_urutkunjungan");
    $this->db->join('pasien', 'pasien.noRM = kunjungan.pasien_noRM');
    $this->db->join('tujuan_pelayanan', 'tujuan_pelayanan.kode_tupel = kunjungan.tupel_kode_tupel');
    $this->db->join('rujukan_internal', 'kunjungan.no_urutkunjungan=rujukan_internal.kunjungan_no_urutkunjungan');
    return $this->db->get_where('kunjungan', array('kunjungan.sudah <=' => 5, 'tujuan_poli' => 'RANAP', 'acc_ranap' => 0))->num_rows();
  }
  function get_billing()
  {
    $date = date("Y-m-d");
    $this->db->select("count(*) as total");
    $query = $this->db->get_where("kunjungan", array("tgl" => $date, "billing !=" => 1, "siap_pulang" => 1))->row_array();
    return $query['total'];
  }

  function combine_harga($harga)
  {
    $jml_bayar = "";
    $ex_jml_bayar = explode(",", $harga);
    for ($i = 0; $i < count($ex_jml_bayar); $i++) {
      $jml_bayar = $jml_bayar . "" . $ex_jml_bayar[$i];
    }
    return $jml_bayar;
  }

  function Fungsi_JS_Hapus()
  {
    return "<script type=\"text/javascript\">
        $('document').ready(function() {
            $(\"#alert\").show();
            $(\"#modal\").hide();

            $(\".id_checkbox\").on('click', function (e) {
                $(\"#jumlah_pilih\").html($(\"input.id_checkbox:checked\").length);
                if ($(\"input.id_checkbox:checked\").length == 0) {
                    $(\"#alert\").show();
                    $(\"#modal\").hide();
                } else {
                    $(\"#alert\").hide();
                    $(\"#modal\").show();
                }
            });
        });
        </script>";
  }

  public function Hapus_aktif()
  {
    return "
    <div class=\"modal fade\" id=\"Hapus_aktif\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"smallmodalLabel\" aria-hidden=\"true\">
      <div class=\"modal-dialog modal-sm\" role=\"document\">
        <div class=\"modal-content\">
          <div class=\"modal-header\">
            <h5 class=\"modal-title\" id=\"smallmodalLabel\">Hapus Data</h5>
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
          </button>
          </div>
          <div class=\"modal-body\">
            <p>
              Apakah Anda Yakin Untuk Menghapus Data
            </p>
          </div>
          <div class=\"modal-footer\">
            <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Cancel</button>
            <button type=\"submit\" class=\"btn btn-danger\">Hapus</button>
          </div>
        </div>
      </div>
    </div>";
  }

  public function Hapus_disable()
  {
    return "
    <div class=\"modal fade\" id=\"Hapus_disable\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"smallmodalLabel\" aria-hidden=\"true\">
      <div class=\"modal-dialog modal-sm\" role=\"document\">
        <div class=\"modal-content\">
          <div class=\"modal-header\">
            <h5 class=\"modal-title\" id=\"smallmodalLabel\">Hapus Data</h5>
            <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
          </button>
          </div>
          <div class=\"modal-body\">
            <p>
              Pilih Data Terlebih Dahulu !!!!
            </p>
          </div>
          <div class=\"modal-footer\">
            <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Cancel</button>
          </div>
        </div>
      </div>
    </div>";
  }

  public function alert_succcess($isi)
  {
    return "<div class=\"sufee-alert alert with-close alert-success alert-dismissible \">
      <span class=\"badge badge-pill badge-success\">Success</span> $isi
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
      <span aria-hidden=\"true\">&times;</span>
    </button>";
  }

  public function alert_danger($isi)
  {
    return "<div class=\"sufee-alert alert with-close alert-danger alert-dismissible \">
      <span class=\"badge badge-pill badge-danger\">Peringatan</span> $isi
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
      <span aria-hidden=\"true\">&times;</span>
    </button>";
  }

  public function modal($name, $judul, $isi)
  {
    return "<button type=\"button\" class=\"btn btn-secondary mb-1\" data-toggle=\"modal\" data-target=\"#$name\">
    $name
  </button>
  <div class=\"modal fade\" id=\"$name\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"smallmodalLabel\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-sm\" role=\"document\">
      <div class=\"modal-content\">
        <div class=\"modal-header\">
          <h5 class=\"modal-title\" id=\"smallmodalLabel\">$judul</h5>
          <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">
          <span aria-hidden=\"true\">&times;</span>
        </button>
        </div>
        <div class=\"modal-body\">
          <p>
            $isi
          </p>
        </div>
        <div class=\"modal-footer\">
          <button type=\"button\" class=\"btn btn-secondary\" data-dismiss=\"modal\">Cancel</button>
          <button type=\"button\" class=\"btn btn-primary\">Confirm</button>
        </div>
      </div>
    </div>
  </div>";
  }

  public function Kembali()
  {
    return "<button type=\"button\" class=\"btn btn-outline-secondary btn-sm\" onclick=\"window.history.back()\"><i class=\"fas fa-reply\"></i> Kembali</button>";
  }

  public function btn_input()
  {
    return "<div class=\"card-footer\" style='    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    /* flex-wrap: wrap; */'>
    <div class=\"col col-sm-12 com-md-12\">
    <button type=\"button\" class=\"btn btn-outline-secondary btn-sm pull-left\" onclick=\"window.history.back()\"><i class=\"fa fa-reply\"></i> Kembali</button>

        <button type=\"submit\" class=\"btn btn-primary btn-sm pull-right\">SIMPAN</button>
    </div>
    </div>";
  }

  public function save_riwayat()
  {
  }

  public function notif_success($text)
  {
    return "

    ";
  }
  public function umur($tgl_lahir = '')
  {
    if ($tgl_lahir == null) {
      return;
    }
    // Tanggal Lahir
    $birthday = $tgl_lahir;

    // Convert Ke Date Time
    $biday = new DateTime($birthday);
    $today = new DateTime();

    $diff = $today->diff($biday);
    if ($diff->y <= 0) {
      // code...
      return $diff->m . " Bulan";
    } else {

      // Display
      return $diff->y . " Tahun";
    }
  }

  public function umur_baru($tgl_lahir = '')
  {
    if ($tgl_lahir == null) {
      return;
    }
    // Tanggal Lahir
    $birthday = $tgl_lahir;

    // Convert Ke Date Time
    $biday = new DateTime($birthday);
    $today = new DateTime();

    $diff = $today->diff($biday);
    return $diff->y;
  }
}
