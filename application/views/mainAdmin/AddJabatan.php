<div class="modal animated pulse" id="AddJabatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" width="100%">
  <div class="modal-dialog modal-md">
    <form action="<?php echo base_url('PageHome').'/AddJabatan'; ?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="myModalLabel">Tambah Data Jabatan</h3>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
          <form action="<?php echo base_url('PageHome/').'AddJabatan'; ?>" method="post">
        <div class="modal-body">
             <table class="table table-condensed">
               <tr>
                
              <tr>
                <td><label for="ID_Bagian">Nama Bagian</label></td>
                <td>
                  <input type="hidden" name="ID" value="<?php echo $data; ?>">
                  <input name="bagian" type="text" class="form-control" id="ID_Bagian" placeholder="Bagian" required/></td>
                </tr>

                <tr>
                  <td><label for="Upah">Upah Harian (Rp.)</label></td>
                  <td>
                    <input name="Upah_Harian" type="number" class="form-control" id="Upah" placeholder="0" required/></td>
                  </tr>

                  <tr>
                    <td><label for="Upah2">Upah Lemburan (Rp.)</label></td>
                    <td>
                      <input name="Upah_Lembur" type="number" class="form-control" id="Upah2" placeholder="0"></td>
                    </tr>

                    <tr>
                      <td><label for="insentive">Insentive (Rp.)</label></td>
                      <td>
                        <input type="number" name="insentive" class="form-control" placeholder="0" required>
                      </td>
                    </tr>

                    <tr>
                      <td><label for="User">BPJS</label></td>
                      <td>
                        <select name="Bpjs" class="User form-control">
                          <option value="80000">Kelas I [80.000]</option>
                          <option value="51000">Kelas II [51.000]</option>
                          <option value="25500">Kelas III [25.500]</option>
                        </select>
                      </td>
                    </tr>
                    <br>
                  </table>
              </div>
              <div class="modal-footer">
                <input type="submit" value="Simpan Data"  class="btn btn-sm btn-primary"/>
              </div>
                </form>
            </div>
          </form>
        </div>
      </div>