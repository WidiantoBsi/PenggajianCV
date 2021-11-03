<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="mb-0">Data Absensi</h1>
		<a href="#" class="btn btn-sm btn-primary center-f-0" title="Tambah">Cetak <i class="fa fa-print"></i></a>
	</div>
	<hr>
	<div class="table-responsive">
		<table class="table table-bordered" id="dataTables-example">
			<thead>
				<tr>
					<th>Id Karawan</th>
					<th>Jam Masuk</th>
					<th>Jam Keluar</th>
					<th>Lembur</th>
					<th>Tanggal</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($Absensi as $b){
					$Id = $b->Id_Absen;
					?>
					<tr class="head" align="center">
						<td>
							<?php if ($b->Keterangan==0) { ?>
							<a href="#" title="Edit Data" data-toggle="modal" data-target="#modal_edit<?php echo $Id;?>" ><?php echo $b->ID_Karyawan ?></a>
							<?php }else { ?>
							<?php echo $b->ID_Karyawan ?>
							<?php } ?>
						</td>
						<td><?php echo $b->Jam_In; ?></td>
						<td><?php echo $b->Jam_Out ?></td>
						<td><!-- <?php echo $b->Lembur ?> -->
						<?php if ($b->Lembur==0) { ?>
							<label class="text-default">Tidak</label>
						<?php }else { ?>
							<label class="text-success">Lembur</label>
						<?php } ?>
						</td>
						<td><?php echo $b->Bulan ?></td>
						<td align="center">
							<?php
							if ($b->Keterangan==0) { ?>
								<label class="text-primary">Masuk</label>
							<?php }elseif ($b->Keterangan==1) { ?>
								<label class="text-danger">Pulang</label>
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

<!-- ============================== modal edit ======================================= --> 
<?php 
foreach($Absensi as $i){
	$IdData = $i->Id_Absen;
	$IdKaryawan  = $i->ID_Karyawan;
	$Lembur = $i->Lembur;
	?>
	<div class="modal animated zoomIn" id="modal_edit<?php echo $IdData?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog  modal-md">
			<form action="<?php echo base_url('PageAdmin').'/EditAbsensi'; ?>" method="post">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="myModalLabel">Edit Data Absensi</h3>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<table class="table table-condensed">
							<tr>
								<td><label for="ID_Number">Id Karyawan</label></td>
								<td>
									<input type="hidden" name="ID" value="<?php echo $IdData?>">
									<input name="Id_karyawan" type="text" class="form-control" value="<?php echo $IdKaryawan ?>" required></td>
								</tr>

								<tr>
									<td><label for="User">Lembur</label></td>
									<td>
										<select name="lembur" class="User form-control">
											<option value="0">Tidak</option>
											<option value="1">Lembur</option>
										</select>
									</td>
								</tr>
							</table>
						</div>
						<div class="modal-footer">
							<input type="submit" value="Update Data"  class="btn btn-sm btn-primary"/>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } ?>