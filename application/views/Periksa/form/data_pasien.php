<div class="col-md-12 col-12 col-xl-12">
  <!-- Card Narrower -->
  <div class="card card-cascade narrower z-depth-1">
    <div class="view view-cascade gradient-card-header purple-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">
          <h4><a href="" class="white-text mx-3">Data Diri Pasien</a></h4>

    </div>

    <!-- Card content -->
    <div class="card-body">

      <div class="table-responsive table--no-card m-b-40">

        <div class="col col-md-12">
          <table class="table table-borderless table-striped table-earning">
            <thead>
              <!-- <th colspan="2"><center>Data Diri Pasien</center></th> -->
            </thead>
            <tbody id="data Pasien">
              <tr>
                <td>Nama Lengkap</td>
                <td><?php echo @$pasien['namapasien']?></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td><?php echo @$pasien['alamat']." , ".@$pasien['kota']?></td>
              </tr>
              <tr>
                <td>Umur</td>
                <td><?php echo $this->ModelPasien->umur(@$pasien['tgl_lahir'])?></td>
              </tr>
              <tr>
                <td>Jenis Kelamin</td>
                <td><?php echo @$pasien['jenis_kelamin']?></td>
              </tr>
              <tr>
                <td>Pekerjaan</td>
                <td><?php echo @$pasien['pekerjaan']?></td>
              </tr>
              <tr>
                <td>Agama</td>
                <td><?php echo @$pasien['agama']?></td>
              </tr>
              <tr>
                <td>Suku</td>
                <td><?php echo @$pasien['suku']?></td>
              </tr>
              <tr>
                <td>No Telepon</td>
                <td><?php echo @$pasien['telepon']?></td>
              </tr>
            </tbody>

          </table>
        </div>

      </div>

      </div>

    </div>
    <!-- Card Narrower -->

  </div>
