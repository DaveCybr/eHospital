<div class="table-responsive">
  <table id="myTable" class="table color-table info-table tab ">
      <thead>
          <tr>
              <th width="10%">#</th>
              <th>Username</th>
              <th>Level</th>
              <th>opsi</th>
          </tr>
      </thead>
      <tbody>
        <?php $no = 1; foreach ($user as $data):
          $id_check = $data->id_user;?>
          <tr>

              <td><div class="checkbox">
                  <label for="<?php echo $id_check ?>" class="form-check-label ">
                    <?php echo $no;?>
                  </label>
                </div></td>
              <td><?php echo $data->Nama; ?></td>
              <td><?php echo $data->Jabatan; ?></td>
              <td>
                <a href="<?php echo base_url().'User/edit/'.$id_check; ?>">
                <button type="button" class="btn btn-warning btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                  <i class="fa fa-edit"></i>
                </button>
                </a>
                <a href="<?php echo base_url().'User/edit/'.$id_check; ?>">
                <button type="button" class="btn btn-danger btn-sm btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="Hapus">
                  <i class="fa fa-trash"></i>
                </button>
                </a>
              </td>
          </tr>
        <?php $no++;  endforeach; ?>
      </tbody>
    </table>
</div>
