<div class="modal animated pulse" id="AddPengguna" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?php echo base_url('PageHome').'/AddPengguna'; ?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="myModalLabel">Tambah Data Pengguna</h3>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
         <table class="table table-condensed">
          <tr>
            <td><label for="User">ID Pengguna</label></td>
            <td>
              <select name="ID_Karyawan" id="ID_Karyawan" class="ID_Karyawan form-control" required>
                 <option value="">-ID Pengguna-</option>
                <?php foreach($DBKaryawan->result() as $row):?>
                  <option value="<?php echo $row->ID_Karyawan; ?>"><?php echo $row->ID_Karyawan; ?></option>
                <?php endforeach;?>
              </select>
            </td>
          </tr>
          <tr>
            <td><label for="User">Nama Pengguna</label></td>
            <td>
              <input type="hidden" name="password" value="<?php echo $Password; ?>">
              <select name="nama" id="nama" class="nama form-control" required>
                <option value="0"></option>
              </select>
            </td>
          </tr>
        </table>
        </div>
        <div class="modal-footer">
          <input type="submit" value="Simpan Data"  class="btn btn-sm btn-primary"/>
        </div>
      </div>
    </form>
  </div>
</div>