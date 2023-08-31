<?php
$this->load->model('ModelRole');
$user_Roles = $this->db->get_where('user', array('id_user' => $_SESSION['id_login'],))->row_array();
$roles_Roles = explode(', ', $user_Roles['roles']);
foreach ($roles_Roles as $value) {
  $Menu_Roles[$value] = true;
  $this->db->reset_query();
  $this->db->select('group_roles_idgroup_roles');
  $this->db->group_by('group_roles_idgroup_roles');
  $Group_Roles = $this->db->get_where('roles', array('roles' => $value,))->result();
  foreach ($Group_Roles as $value) {
    $Menu_Group[$value->group_roles_idgroup_roles] = true;
  }
}
?>

<li class="nav-small-cap">--- PERSONAL</li>
<li <?php if ($this->uri->segment(1) == '') : ?> class="active" <?php endif; ?>>
  <a class="waves-effect waves-dark" href="<?php echo base_url() ?>">
    <i class="icon-speedometer"></i>
    <span class="hide-menu">Dashboard</span></a>
</li>

<?php if (@$Menu_Group['admin']) : ?>
  <li class="nav-small-cap">--- FITUR ADMIN</li>
<?php endif; ?>
<?php if (@$Menu_Roles['Rekap']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Rekap" ?>">
      <i class="mdi mdi-book-multiple"></i>
      <span class="hide-menu">Rekapitulasi</span></a>
  </li>
<?php endif; ?>
<!-- <?php if (@$Menu_Roles['Antrian']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Antrian/video" ?>">
      <i class="mdi mdi-camera"></i>
      <span class="hide-menu">Video Antrian</span></a>
  </li>
<?php endif; ?> -->
<?php if (@$Menu_Roles['Antrian']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Antrian/pengumuman" ?>">
      <i class="mdi mdi-bullhorn"></i>
      <span class="hide-menu">Pengumuman</span></a>
  </li>
<?php endif; ?>
<?php if (@$Menu_Group['md']) : ?>
  <li class="nav-small-cap">--- MASTER DATA</li>
<?php endif; ?>
<?php if (
  @$Menu_Roles['Pekerjaan'] | @$Menu_Roles['Supplier'] | @$Menu_Roles['JenisObat'] | @$Menu_Roles['Satuan'] |
  @$Menu_Roles['KategoriObat'] | @$Menu_Roles['Obat'] | @$Menu_Roles['JenisPasien'] |
  @$Menu_Roles['Laborat'] | @$Menu_Roles['Penyakit'] | @$Menu_Roles['TempatTidur'] |
  @$Menu_Roles['TujuanPelayanan'] | @$Menu_Roles['JasaPelayanan']
) : ?>
  <li>
    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
      <i class="fa fa-h-square"></i>
      <span class="hide-menu">Master Data </span></a>
    <ul aria-expanded="false" class="collapse">
      <?php if (@$Menu_Roles['Supplier']) : ?>
        <li <?php if ($this->uri->segment(1) == 'Supplier') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Supplier'; ?>">
            Supplier</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['Ruangan']) : ?>

        <li <?php if ($this->uri->segment(1) == 'Ruangan') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Ruangan'; ?>">
            Ruangan</a>
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['Administrasi']) : ?>

        <li <?php if ($this->uri->segment(1) == 'Administrasi') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Administrasi'; ?>">
            Biaya Adminitrasi</a>
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['JenisObat']) : ?>

        <li <?php if ($this->uri->segment(1) == 'JenisObat') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'JenisObat'; ?>">
            Jenis Obat</a>
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['Pekerjaan']) : ?>

        <li <?php if ($this->uri->segment(1) == 'Pekerjaan') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Pekerjaan'; ?>">
            Pekerjaan</a>
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['Satuan']) : ?>

        <li <?php if ($this->uri->segment(1) == 'Satuan') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Satuan'; ?>">
            Satuan Obat</a>
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['KategoriObat']) : ?>

        <li <?php if ($this->uri->segment(1) == 'KategoriObat') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'KategoriObat'; ?>">
            Kategori Obat</a>
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['Obat'] && $_SESSION['jabatan'] != 'keuangan') : ?>

        <li <?php if ($this->uri->segment(1) == 'Obat') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Obat'; ?>">
            Data Obat</a>
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['JenisPasien']) : ?>

        <li <?php if ($this->uri->segment(1) == 'JenisPasien') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'JenisPasien'; ?>">
            Jenis Pasien</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['Laborat']) : ?>

        <li <?php if ($this->uri->segment(1) == 'Laborat') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Laborat'; ?>">
            Laboraturium</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['Penyakit']) : ?>

        <li <?php if ($this->uri->segment(1) == 'Penyakit') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Penyakit'; ?>">
            Penyakit</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['TempatTidur']) : ?>

        <li <?php if ($this->uri->segment(1) == 'TempatTidur') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'TempatTidur'; ?>">
            Tempat Tidur</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['TujuanPelayanan']) : ?>

        <li <?php if ($this->uri->segment(1) == 'TujuanPelayanan') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'TujuanPelayanan'; ?>">
            Tujuan Pelayanan</a>
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['JasaPelayanan']) : ?>

        <li <?php if ($this->uri->segment(1) == 'JasaPelayanan') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'JasaPelayanan'; ?>">
            Jasa Pelayanan</a>
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['PenanggungJawab']) : ?>

        <li <?php if ($this->uri->segment(1) == 'PenanggungJawab') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'PenanggungJawab'; ?>">
            Penanggung Jawab Lab</a>
        </li>
      <?php endif; ?>
    </ul>
  </li>
<?php endif; ?>
<?php if (@$Menu_Group['akuntan']) : ?>
  <li class="nav-small-cap">--- AKUNTANSI</li>
<?php endif; ?>

<?php if (@$Menu_Roles['Mbesar']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Mbesar" ?>">
      <i class="mdi mdi-book"></i>
      <span class="hide-menu">No rekening</span></a>
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['Kas']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Kas/masuk" ?>">
      <i class="mdi mdi-book-multiple"></i>
      <span class="hide-menu">Kas Masuk</span></a>
  </li>
<?php endif; ?>

<?php if (@$Menu_Roles['Kas']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Kas/keluar" ?>">
      <i class="mdi mdi-book-multiple"></i>
      <span class="hide-menu">Kas Keluar</span></a>
  </li>
<?php endif; ?>

<?php if (@$Menu_Roles['Bank']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Bank/masuk" ?>">
      <i class="mdi mdi-book-multiple"></i>
      <span class="hide-menu">Bank Masuk</span></a>
  </li>
<?php endif; ?>

<?php if (@$Menu_Roles['Bank']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Bank/keluar" ?>">
      <i class="mdi mdi-book-multiple"></i>
      <span class="hide-menu">Bank Keluar</span></a>
  </li>
<?php endif; ?>


<?php if (@$Menu_Roles['Jurnal']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Jurnal" ?>">
      <i class="mdi mdi-book-open"></i>
      <span class="hide-menu">Jurnal</span></a>
  </li>
<?php endif; ?>

<?php if (@$Menu_Roles['Inventaris']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Inventaris" ?>">
      <i class="mdi mdi-pen"></i>
      <span class="hide-menu">Inventaris</span></a>
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['Susut']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Susut" ?>">
      <i class="mdi mdi-elevation-decline"></i>
      <span class="hide-menu">Susutan</span></a>
  </li>
<?php endif; ?>

<?php if (@$Menu_Roles['Jurnal']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Jurnal/list" ?>">
      <i class="mdi mdi-book-open"></i>
      <span class="hide-menu">Laporan Jurnal</span></a>
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['Jurnal']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Laporan/laba" ?>">
      <i class="mdi mdi-book-open"></i>
      <span class="hide-menu">Laporan Laba/Rugi</span></a>
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['Jurnal']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Laporan/buku_besar" ?>">
      <i class="mdi mdi-book-open"></i>
      <span class="hide-menu">Rekap Buku Besar</span></a>
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['Jurnal']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Laporan/buku_besar_detail" ?>">
      <i class="mdi mdi-book-open"></i>
      <span class="hide-menu">Detail Buku Besar</span></a>
  </li>
<?php endif; ?>
<?php if (@$Menu_Group['lk']) : ?>
  <li class="nav-small-cap">--- LAYANAN KLINIK</li>
<?php endif; ?>
<?php if (@$Menu_Roles['Pasien']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Pasien" ?>">
      <i class="mdi mdi-human-male-female"></i>
      <span class="hide-menu">Daftar Pasien</span></a>
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['Kunjungan']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Kunjungan" ?>">
      <i class="ti-agenda"></i>
      <span class="hide-menu">Kunjungan Pasien</span></a>
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['Chat'] || $_SESSION['jabatan'] == "dumu" || $_SESSION['jabatan'] == "dgig") : ?>
  <!-- <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "APO/Konsultasi/Chat/" ?>">
      <i class="fas fa-comment"></i>
      <span class="hide-menu">Chatting Pasien</span></a>
  </li> -->
<?php endif; ?>
<?php if (@$Menu_Roles['Admisi']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Admisi" ?>">
      <i class="ti-agenda"></i>
      <span class="hide-menu">Admisi Ranap</span></a>
  </li>
<?php endif; ?>
<!-- <?php if (@$Menu_Roles['Admisi']) : ?>
<li>
  <a class="waves-effect waves-dark" href="<?php echo base_url() . "Admisi/signature" ?>">
    <i class="fas fa-signature"></i>
    <span class="hide-menu">Signature</span></a>
</li>
<?php endif; ?> -->
<?php if (@$Menu_Roles['Ranap']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Ranap" ?>">
      <i class="ti-agenda"></i>
      <span class="hide-menu">Rawat Inap</span></a>
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['KunjunganLab']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "KunjunganLab" ?>">
      <i class="fa fa-flask"></i>
      <span class="hide-menu">Kunjungan Laborat</span></a>
  </li>
<?php endif; ?>

<?php if (@$Menu_Roles['Deposit']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Deposit" ?>">
      <i class="ti-credit-card"></i>
      <span class="hide-menu">Deposit</span></a>
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['Billing']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Billing" ?>">
      <i class="ti-credit-card"></i>
      <span class="hide-menu">BILLING<span class="badge badge-pill badge-cyan ml-auto total_billing"></span></span></a>
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['BillingRanap']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "BillingRanap" ?>">
      <i class="ti-credit-card"></i>
      <span class="hide-menu">BILLING RANAP</span></a>
  </li>
<?php endif; ?>

<?php if (@$Menu_Roles['Dapur']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "Dapur" ?>">
      <i class="ti-notepad"></i>
      <span class="hide-menu">DAPUR</span></a>
  </li>
<?php endif; ?>


<?php if (@$Menu_Roles['PembelianObat']) : ?>
  <li <?php if ($this->uri->segment(1) == 'PembelianObat') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'PembelianObat'; ?>">
      <i class="fas fa-shipping-fast"></i>
      <span class="hide-menu">Pembelian Obat</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['PemakaianObat'] && $_SESSION['poli'] != null) : ?>
  <li <?php if ($this->uri->segment(1) == 'PemakaianObat') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'PemakaianObat'; ?>">
      <i class="fas fa-shipping-fast"></i>
      <span class="hide-menu">Pemakaian Obat</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['ObatRusak']) : ?>
  <li <?php if ($this->uri->segment(1) == 'ObatRusak') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'ObatRusak'; ?>">
      <i class="fas fa-shipping-fast"></i>
      <span class="hide-menu">Obat Rusak</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['Hutang']) : ?>

  <li <?php if ($this->uri->segment(1) == 'Hutang') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'Hutang'; ?>">
      <i class="fa fa-book"></i>
      <span class="hide-menu">Hutang</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>

<?php if ((@$Menu_Roles['PengajuanObat'] ||  $_SESSION['poli'] == "IGD") && $_SESSION['jabatan'] != "resepsionis") : ?>

  <li <?php if ($this->uri->segment(1) == 'PengajuanObat') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'PengajuanObat'; ?>">
      <i class="fas fa-capsules"></i>
      <span class="hide-menu">Mutasi Obat</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>
<!-- <?php if (@$Menu_Roles['Retur']) : ?>
<li <?php if ($this->uri->segment(1) == 'Retur') : ?>
  class="active"
<?php endif; ?>>
    <a href="<?php echo base_url() . 'Retur'; ?>">
        <i class="fas fa-shipping-fast"></i>
        <span class="hide-menu">Retur Obat</span></a>
  </li>
<?php endif; ?> -->
<?php if (@$Menu_Roles['Obat']) : ?>
  <li <?php if ($this->uri->segment(2) == 'listStokAwalGudang') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'Obat/listStokAwalGudang/'; ?>">
      <i class="fas fa-capsules"></i>
      <span class="hide-menu">Stok Awal Gudang</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['Obat']) : ?>
  <li <?php if ($this->uri->segment(2) == 'listStokAwal') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'Obat/listStokAwal/'; ?>">
      <i class="fas fa-capsules"></i>
      <span class="hide-menu">Stok Awal Apotek</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['StokOpname']) : ?>
  <li <?php if ($this->uri->segment(2) == 'StokOpname') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'StokOpname'; ?>">
      <i class="fas fa-capsules"></i>
      <span class="hide-menu">Stok Opname Apotek</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['StokOpnameGudang']) : ?>
  <li <?php if ($this->uri->segment(2) == 'StokOpnameGudang') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'StokOpnameGudang'; ?>">
      <i class="fas fa-capsules"></i>
      <span class="hide-menu">Stok Opname Gudang</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['Piutang']) : ?>

  <li <?php if ($this->uri->segment(1) == 'Piutang') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'Piutang'; ?>">
      <i class="fa fa-book"></i>
      <span class="hide-menu">Piutang Pasien</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>

<?php if ((@$Menu_Roles['ReturGudang'] ||  $_SESSION['poli'] == "IGD") && $_SESSION['jabatan'] != "resepsionis") : ?>

  <li <?php if ($this->uri->segment(1) == 'ReturGudang') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'ReturGudang'; ?>">
      <i class="fas fa-capsules"></i>
      <span class="hide-menu">Retur Gudang</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['Catatan']) : ?>

  <li <?php if ($this->uri->segment(1) == 'Catatan') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'Catatan'; ?>">
      <i class="fas fa-edit"></i>
      <span class="hide-menu">Catatan Covid</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['Pcare']) : ?>

  <li <?php if ($this->uri->segment(1) == 'Pcare') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'Pcare'; ?>">
      <i class="fas fa-edit"></i>
      <span class="hide-menu">Ganti Pass Pcare</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['Resep']) : ?>

  <li <?php if ($this->uri->segment(1) == 'Resep') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'Resep'; ?>">
      <i class="fas fa-capsules"></i>
      <span class="hide-menu">Menyiapkan Obat</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['Lplpo']) : ?>
  <li <?php if ($this->uri->segment(1) == 'Lplo') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'Lplpo'; ?>">
      <i class="fas fa-capsules"></i>
      <span class="hide-menu">LPLPO</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['StokGudang']) : ?>
  <li <?php if ($this->uri->segment(1) == 'StokGudang') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'StokGudang'; ?>">
      <i class="fas fa-capsules"></i>
      <span class="hide-menu">Stok Gudang</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['StokApotek']) : ?>
  <li <?php if ($this->uri->segment(1) == 'StokApotek') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'StokApotek'; ?>">
      <i class="fas fa-capsules"></i>
      <span class="hide-menu">Stok Apotek</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['StokUGD']) : ?>
  <li <?php if ($this->uri->segment(1) == 'StokUGD') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'StokUGD'; ?>">
      <i class="fas fa-capsules"></i>
      <span class="hide-menu">Stok UGD</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>
<!-- <?php if (@$Menu_Roles['KartuStok']) : ?>

<li <?php if ($this->uri->segment(1) == 'KartuStok') : ?>
  class="active"
<?php endif; ?>>
    <a href="<?php echo base_url() . 'KartuStok'; ?>">
        <i class="fas fa-capsules"></i>
        <span class="hide-menu">Kartu Stok</span></a>
  </li>
<?php endif; ?> -->

<?php if (@$Menu_Roles['KartuStok']) : ?>
  <li <?php if ($this->uri->segment(1) == 'KartuStok') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'KartuStok/Gudang'; ?>">
      <i class="fas fa-capsules"></i>
      <span class="hide-menu">Kartu Stok Gudang</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>

<?php if (@$Menu_Roles['KartuStok']) : ?>
  <li <?php if ($this->uri->segment(1) == 'KartuStokApotik') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'KartuStokApotik/Apotik'; ?>">
      <i class="fas fa-capsules"></i>
      <span class="hide-menu">Kartu Stok Apotik</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>



<!-- <li <?php if ($this->uri->segment(1) == 'KartuStokUgd') : ?> class="active" <?php endif; ?>>
  <a href="<?php echo base_url() . 'KartuStokUgd/Ugd'; ?>">
    <i class="fas fa-capsules"></i>
    <span class="hide-menu">Kartu Stok UGD</span></a>
  <span class="inbox-num">3</span>
</li> -->

<?php if (@$Menu_Group['Laporan']) : ?>
  <li class="nav-small-cap">--- Laporan</li>
<?php endif; ?>

<?php if (@$Menu_Roles['Laporan']) : ?>
  <li>
    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
      <i class="fa fa-file"></i>
      <span class="hide-menu">Laporan</span></a>
    <ul aria-expanded="false" class="collapse">
      <?php if ($_SESSION['jabatan'] == 'pumu') : ?>
        <?php if (@$Menu_Roles['Laporan']) : ?>
          <li <?php if ($this->uri->segment(1) == 'Laporan') : ?> class="active" <?php endif; ?>>
            <a href="<?php echo base_url() . 'Laporan/cari_diagnosa'; ?>">
              Cari Diagnosa</a>
            <!-- <span class="inbox-num">3</span> -->
          </li>
        <?php endif; ?>

      <?php endif; ?>
      <?php if ($_SESSION['jabatan'] == 'dumu' || $_SESSION['jabatan'] == 'dugd') : ?>
        <?php if (@$Menu_Roles['Laporan']) : ?>
          <li <?php if ($this->uri->segment(1) == 'Laporan') : ?> class="active" <?php endif; ?>>
            <a href="<?php echo base_url() . 'Laporan/rekap_pasien'; ?>">
              Rekap Pasien</a>
            <!-- <span class="inbox-num">3</span> -->
          </li>
        <?php endif; ?>

      <?php endif; ?>
      <?php if ($_SESSION['jabatan'] == 'keuangan') : ?>
        <?php if (@$Menu_Roles['Laporan']) : ?>
          <li <?php if ($this->uri->segment(1) == 'Laporan') : ?> class="active" <?php endif; ?>>
            <a href="<?php echo base_url() . 'Laporan/jasa_all'; ?>">
              Jasa Pelayanan</a>
            <!-- <span class="inbox-num">3</span> -->
          </li>
        <?php endif; ?>

      <?php endif; ?>
      <?php if ($_SESSION['jabatan'] == 'dgig' || $_SESSION['jabatan'] == 'dumu' || $_SESSION['jabatan'] == 'dint' || $_SESSION['jabatan'] == 'dugd' || $_SESSION['jabatan'] == 'dozo' || $_SESSION['jabatan'] == 'RANAP' || $_SESSION['jabatan'] == 'dobg') : ?>
        <?php if (@$Menu_Roles['Laporan']) : ?>
          <li <?php if ($this->uri->segment(1) == 'Laporan') : ?> class="active" <?php endif; ?>>
            <a href="<?php echo base_url() . 'Laporan/jasa'; ?>">
              Penghasilan jasa saya</a>
            <!-- <span class="inbox-num">3</span> -->
          </li>
        <?php endif; ?>
      <?php endif; ?>
      <?php if (@$Menu_Roles['Laporan'] && $_SESSION['jabatan'] == 'resepsionis') : ?>
        <li <?php if ($this->uri->segment(1) == 'Laporan') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Laporan/kunjungan'; ?>">
            Detail Kunjungan</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['Laporan'] && $_SESSION['jabatan'] == 'resepsionis') : ?>
        <li <?php if ($this->uri->segment(1) == 'Laporan') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Laporan/kunjungan_poli'; ?>">
            Rekap Kunjungan</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['Laporan'] && ($_SESSION['jabatan'] == 'resepsionis' || $_SESSION['jabatan'] == "pumu")) : ?>
        <li <?php if ($this->uri->segment(1) == 'Laporan') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Laporan/pxbpjs'; ?>">
            Laporan Kunjungan Px BPJS</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['Laporan'] && $_SESSION['jabatan'] == 'resepsionis') : ?>
        <li <?php if ($this->uri->segment(1) == 'Laporan') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Laporan/pasieninhealt'; ?>">
            Laporan Pasien Inhealt</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['Laporan'] && $_SESSION['jabatan'] == 'resepsionis') : ?>
        <li <?php if ($this->uri->segment(1) == 'Laporan') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Laporan/kunjungan_dokter'; ?>">
            Rekap Kunjungan Dokter</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>

      <?php if (@$Menu_Roles['Laporan'] && $_SESSION['jabatan'] != 'lab' && $_SESSION['jabatan'] != 'kasir' && ($_SESSION['jabatan'] == 'resepsionis' || $_SESSION['jabatan'] == 'pumu')) : ?>
        <li <?php if ($this->uri->segment(1) == 'Laporan') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Laporan/kesakitan'; ?>">
            Laporan Kesakitan</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>

      <?php if (@$Menu_Roles['Laporan'] && $_SESSION['jabatan'] != 'lab' && $_SESSION['jabatan'] != 'kasir' && ($_SESSION['jabatan'] == 'resepsionis' || $_SESSION['jabatan'] == 'pumu')) : ?>
        <li <?php if ($this->uri->segment(1) == 'Laporan') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Laporan/pelayanan'; ?>">
            Laporan Pelayanan Kesehatan</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>

      <?php if (@$Menu_Roles['Laporan'] && $_SESSION['jabatan'] != 'lab' && $_SESSION['jabatan'] != 'kasir' && ($_SESSION['jabatan'] == 'resepsionis' || $_SESSION['jabatan'] == 'pumu')) : ?>
        <li <?php if ($this->uri->segment(1) == 'Laporan') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Laporan/kesakitan_umur'; ?>">
            Laporan Kesakitan Umur</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['Laporan'] && $_SESSION['jabatan'] == 'lab') : ?>
        <li <?php if ($this->uri->segment(1) == 'Laporan') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Laporan/kunjungan_laborat'; ?>">
            Laporan Kunjungan Laborat</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['Laporan'] && $_SESSION['jabatan'] == 'lab') : ?>
        <li <?php if ($this->uri->segment(1) == 'Laporan') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Laporan/lab'; ?>">
            Laporan Kunjungan Laborat Per Poli</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['Laporan'] && $_SESSION['jabatan'] == 'resepsionis') : ?>
        <li <?php if ($this->uri->segment(1) == 'Laporan') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Laporan/kunjungan_rajal_ranap'; ?>">
            Laporan Kunjungan Rajal dan Ranap</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['Laporan'] && $_SESSION['jabatan'] == 'resepsionis') : ?>
        <li <?php if ($this->uri->segment(1) == 'Laporan') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Laporan/rujukan'; ?>">
            Laporan Rujukan</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['Laporan'] && $_SESSION['jabatan'] == 'resepsionis') : ?>
        <li <?php if ($this->uri->segment(1) == 'Laporan') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Laporan/pemakaian_obat'; ?>">
            Laporan Pengeluaran Obat</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>

      <?php if (@$Menu_Roles['Laporan']) : ?>
        <li style="background-color:#ec644b;" <?php if ($this->uri->segment(1) == 'Laporan') : ?> class="active" <?php endif; ?>>
          <a style="color:#fff" href="<?php echo base_url() . 'Laporan/pasien_diabetes'; ?>">
            Pasien DM</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>

      <?php if (@$Menu_Roles['Laporan']) : ?>
        <li style="background-color:#ec644b;" <?php if ($this->uri->segment(1) == 'Laporan') : ?> class="active" <?php endif; ?>>
          <a style="color:#fff" href="<?php echo base_url() . 'Laporan/pasien_hipertensi'; ?>">
            Pasien HT</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['Laporan']) : ?>
        <li style="background-color:#ec644b;" <?php if ($this->uri->segment(1) == 'Laporan') : ?> class="active" <?php endif; ?>>
          <a style="color:#fff" href="<?php echo base_url() . 'Laporan/prb_aktif'; ?>">
            PRB Aktif</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>

    </ul>
  </li>
<?php endif; ?>

<?php if (@$Menu_Group['K_Binaan']) : ?>
  <li class="nav-small-cap">--- Keluarga Binaan</li>
<?php endif; ?>

<?php if (@$Menu_Roles['KBDokter']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "K_Binaan/KBDokter" ?>">
      <i class="mdi mdi-book"></i>
      <span class="hide-menu">Dokter PenanggungJawab</span></a>
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['KBDokter']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "K_Binaan/KBPasien/getPerawat" ?>">
      <i class="mdi mdi-book"></i>
      <span class="hide-menu">Pasien Keluarga Binaan</span></a>
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['KBPerawat']) : ?>
  <li>
    <a class="waves-effect waves-dark" href="<?php echo base_url() . "K_Binaan/KBPasien" ?>">
      <i class="mdi mdi-book"></i>
      <span class="hide-menu">Pasien Binaan</span></a>
  </li>
<?php endif; ?>


<?php if (@$Menu_Group['karyawan']) : ?>
  <li class="nav-small-cap">--- KARYAWAN</li>
<?php endif; ?>


<?php if (@$Menu_Roles['Pegawai']) : ?>
  <li <?php if ($this->uri->segment(1) == 'Pegawai') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'Pegawai'; ?>">
      <i class="fas fa-user-md"></i>
      <span class="hide-menu">Pegawai</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['Jabatan']) : ?>
  <li <?php if ($this->uri->segment(1) == 'Jabatan') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'Jabatan'; ?>">
      <i class="fas fa-award"></i>
      <span class="hide-menu">Jabatan</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>
<?php if (@$Menu_Roles['User']) : ?>
  <li <?php if ($this->uri->segment(1) == 'User') : ?> class="active" <?php endif; ?>>
    <a href="<?php echo base_url() . 'User'; ?>">
      <i class="fa fa-user"></i>
      <span class="hide-menu">User</span></a>
    <!-- <span class="inbox-num">3</span> -->
  </li>
<?php endif; ?>

<?php if (@$Menu_Roles['Roles'] | @$Menu_Roles['GroupRole']) : ?>
  <li>
    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
      <i class="fa fa-h-square"></i>
      <span class="hide-menu">Access </span></a>
    <ul aria-expanded="false" class="collapse">
      <?php if (@$Menu_Roles['Roles']) : ?>
        <li <?php if ($this->uri->segment(1) == 'Roles') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'Roles'; ?>">
            Roles</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>
      <?php if (@$Menu_Roles['GroupRole']) : ?>
        <li <?php if ($this->uri->segment(1) == 'GroupRole') : ?> class="active" <?php endif; ?>>
          <a href="<?php echo base_url() . 'GroupRole'; ?>">
            Group Roles</a>
          <!-- <span class="inbox-num">3</span> -->
        </li>
      <?php endif; ?>
    </ul>
  </li>
<?php endif; ?>