<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="mb-0">Penggajian</h1>
		<!-- <a href="#" class="btn btn-sm btn-primary center-f-0" title="Tambah" data-toggle="modal" data-target="#AddPenggajian"> Tambah <i class="fa fa-plus"></i></a> -->
	</div>
	<hr>
	<div class="table-responsive">
		<table class="table table-bordered" id="dataTables-example">
			<thead>
				<tr>
					<th>Id Karyawan</th>
					<th>Nama Karyawan</th>
					<th>Bagian</th>
					<th>Tanggal Masuk</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
				// $where = array('ID_Karyawan' => $user); 
				// $cek = $this->M_DBCV->edit_data($where, 'absensi')->result();
				// if (count($cek)>0) {
				foreach($Penggajian as $b){
					$Id = $b->ID_Karyawan;
					$where = array('ID_Golongan' => $b->ID_Golongan);
					$DB = $this->M_DBCV->edit_data($where,'golongan')->result();
					foreach($DB as $row){
						$Golongan = $row->Bagian;
					}
					?>
					<tr class="head" align="center">
						<td><?php echo $b->ID_Karyawan ?></td>
						<td><?php echo $b->Nama_Karyawan; ?></td>
						<td><?php echo $Golongan ?></td>
						<td><?php echo $b->Tgl_Masuk ?></td>
						<td align="center">
							
						<?php
							$where = array('ID_Karyawan' => $Id); 
							$data = $this->M_DBCV->edit_data($where, 'absensi')->result();
							 if (count($data)>0) { ?>
							<a href="#" class="btn btn-sm btn-primary center-f-0" data-toggle="modal" data-target="#Add_Penggajian<?php echo $b->ID_Karyawan ?>">Rp</a>
						<?php }else { ?>
							<i class="fa fa-unlock-alt"></i>
						<?php } ?>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<hr>
</div>
</div>

<!--  ======================== Modal Add Pengajian ============================= -->
<?php
	foreach($Penggajian as $row){
		$Id = $row->ID_Karyawan;
		$Nama = $row->Nama_Karyawan;
		$Tanggal = $row->Tgl_Masuk;
		$Golongan = $row->ID_Golongan;
	$where = array('ID_Golongan' => $Golongan);
	$Data = $this->M_DBCV->edit_data($where,'golongan')->result();
	foreach($Data as $Db){
		$IdBagian = $Db->ID_Golongan;
		$Bagian = $Db->Bagian;
		$Harian = $Db->Upah_Harian;
		$Lembur = $Db->Upah_Lembur;
		$Bpjs = $Db->Bpjs;
		$Insentive = $Db->Insentive;
	}
	$where3 = array('Id_karyawan' => $Id);
	$Absensi = $this->M_DBCV->edit_data($where3,'absensi')->num_rows();
	$TtlLembur = $this->M_DBCV->Jumlah_Lembur($Id);
?>
<div class="modal animated zoomIn" id="Add_Penggajian<?php echo $Id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-md">
		<form action="<?php echo base_url('PageAdmin').'/AddPenggajian'; ?>" method="post">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="myModalLabel">Add Data Penggajian</h3>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<table class="table table-condensed">
						<tr>
							<td><label for="Masuk">ID Karyawan</label></td>
							<td>
								<input type="hidden" name="IdKaryawan" value="<?php echo $Id ?>">
								<input name="Karyawan" type="text" class="form-control"  value="<?php echo $Id ?>" disabled/>
							</td>
						</tr>

						<tr>
							<td><label for="Masuk">Nama Karyawan</label></td>
							<td>
								<input type="hidden" name="IdGaji" value="<?php echo $IdGaji ?>">
								<input name="Nama" type="text" class="form-control"  value="<?php echo $Nama ?>" disabled/>
							</td>
						</tr>

						<tr>
							<td><label for="Masuk">Bagian</label></td>
							<td>
								<input name="Bagian" type="text" class="form-control"  value="<?php echo $Bagian ?>" disabled/>
							</td>
						</tr>

						<tr>
							<td><label for="Masuk">Upah Harian</label></td>
							<td>
								<input type="hidden" name="UpahHarian" value="<?php echo $Harian ?>">
								<input name="UpahHarian" type="text" class="form-control" value="<?php echo $Harian ?>" disabled/>
							</td>
						</tr>

						<tr>
							<td><label for="Masuk">Total Masuk</label></td>
							<td>
								<input type="hidden" name="TotalMasuk" value="<?php echo $Absensi ?>">
								<input name="TotalMasuk" type="text" class="form-control" value="<?php echo $Absensi ?>" disabled/>
							</td>
						</tr>

						<tr>
							<td><label for="Masuk">Upah Lembur</label></td>
							<td>
								<input type="hidden" name="UpahLembur" value="<?php echo $Lembur ?>">
								<input name="UpahLembur" type="text" class="form-control" value="<?php echo $Lembur ?>" disabled/>
							</td>
						</tr>

						<tr>
							<td><label for="Masuk">Total Lembur</label></td>
							<td>
								<input type="hidden" name="TotalLembur" value="<?php echo $TtlLembur ?>">
								<input name="TotalLembur" type="text" class="form-control" value="<?php echo $TtlLembur ?>" disabled/>
							</td>
						</tr>

						<tr>
							<td><label for="Masuk">BPJS(Rp.)</label></td>
							<td>
								<input type="hidden" name="Bpjs" value="<?php echo $Bpjs ?>">
								<input name="Bpjs" type="text" class="form-control" value="<?php echo $Bpjs ?>" disabled/>
							</td>
						</tr>

						<tr>
							<td><label for="Masuk">Insentive(Rp.)</label></td>
							<td>
								<input type="hidden" name="Insentive" value="<?php echo $Insentive ?>">
								<input name="Insentive" type="text" class="form-control" value="<?php echo $Insentive ?>" disabled/>
							</td>
						</tr>

						<tr>
							<td><label for="Masuk">Snak(Rp.)</label></td>
							<td>
								<input name="Snak" type="number" class="form-control" id="TglMasuk" placeholder="0" required/>
							</td>
						</tr>

						<tr>
							<td><label for="Masuk">Potongan(Rp.)</label></td>
							<td>
								<input name="Potongan" type="number" class="form-control" id="TglMasuk" placeholder="0" required/>
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
<?php } ?>