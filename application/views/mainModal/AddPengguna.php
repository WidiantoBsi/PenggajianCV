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
            <td><label for="User">Jabatan</label></td>
            <td>
              <input type="hidden" name="ID" value="<?php echo $ID; ?>">
              <select name="ID_Golongan" id="ID_Golongan" class="ID_Golongan form-control" required>
                 <option value="">-Jabatan-</option>
                <?php foreach($DBKaryawan->result() as $row):?>
                  <option value="<?php echo $row->ID_Golongan; ?>"><?php echo $row->Bagian; ?></option>
                <?php endforeach;?>
              </select>
            </td>
          </tr>

          <tr>
            <td><label for="User">Nama Karyawan</label></td>
            <td>
              <select name="ID_Karyawan" id="Karyawan" class="Karyawan form-control" required>
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