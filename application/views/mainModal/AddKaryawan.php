<div class="modal animated pulse" id="AddKaryaan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <form action="<?php echo base_url('PageHome').'/AddKaryawan'; ?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="myModalLabel">Tambah Data Karyawan</h3>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">

          <table class="table table-condensed">

            <tr>
              <td><label for="ID_Number">ID Number Karyawan</label></td>
              <td>
                <input type="hidden" name="ID" value="<?php echo $kodeKary; ?>">
                <input name="Id" type="text" class="form-control" id="ID_Number" value="<?php echo $kodeKary; ?>" disabled></td>
              </tr>

              <tr>
                <td><label for="NamaKary">Nama Karyawan</label></td>
                <td>
                  <input name="NamaKary" type="text" class="form-control" placeholder="Nama Karyawan" required/></td>
                </tr>

                <tr>
                  <td><label for="User">Jabatan</label></td>
                  <td>
                    <select name="Bagian" class="User form-control">
                      <?php foreach($Bagian->result() as $row):?>
                        <option value="<?php echo $row->ID_Golongan; ?>"><?php echo $row->Bagian; ?></option>
                      <?php endforeach;?>
                    </select>
                    <div id="notif" ></div>
                  </td>
                </tr>

                <tr>
                  <td><label for="TglLahir">Tanggal Lahir</label></td>
                  <td>
                    <input type="date" name="tgl_lahir" class="form-control" value="Tanggal Lahir">
                  </td>
                  <?php echo form_error('tgl_lahir'); ?>
                </tr>

                <tr>
                  <td><label for="TglMasuk">Tanggal Masuk</label></td>
                  <td>
                    <input type="hidden" name="Tgl" value="<?php echo date('d-F-Y')?>">
                    <input name="TglMasuk" type="text" class="form-control" id="TglMasuk" placeholder=<?php echo date('d-F-Y')?> disabled/></td>
                  </tr>

                  <tr>
                    <td><label for="Alamat">Alamat</label></td>
                    <td>
                      <textarea class="form-control" rows="3" name="Alamat" placeholder="Alamat" required></textarea>
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