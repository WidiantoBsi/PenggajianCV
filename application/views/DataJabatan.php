<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="mb-0">Data Jabatan</h1>
		<a href="#" class="btn btn-sm btn-primary center-f-0" title="Tambah" data-toggle="modal" data-target="#AddJabatan"> Tambah <i class="fa fa-plus"></i></a>
	</div>
	<!-- <br> -->
	<hr>
	<div class="table-responsive">
		<table class="table table-bordered" id="dataTables-example">
			<thead>
				<tr>
					<th>Bagian</th>
					<th>Upah Harian</th>
					<th>Upah Lembur</th>
					<th>Bpjs</th>
					<th>Insentive</th>
					<th>Pilihan</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($Upah as $b){
					$Id = $b->ID_Golongan;
					?>
					<tr class="head">
						<td><a href="#" title="Edit Data" data-toggle="modal" data-target="#modal_edit<?php echo $Id;?>"><?php echo $b->Bagian ?></a></td>
						<td>Rp.<?php echo number_format($b->Upah_Harian) ?></td>
						<td>Rp.<?php echo number_format($b->Upah_Lembur) ?></td>
						<td>Rp.<?php echo number_format($b->Bpjs) ?></td>
						<td>Rp.<?php echo number_format($b->Insentive) ?></td>
						<td align="center">
							<?php
							$where = array('ID_Golongan' => $Id); 
							$data = $this->M_DBCV->edit_data($where, 'karyawan');
							$cek = $data->num_rows();
							if($cek < 1){ ?> <!-- Cek di data Karyawan Ada tidak nya -->
							<a class="btn btn-warning btn-sm" title="Hapus Data" data-toggle="modal" data-target="#modal_delete<?php echo $Id;?>" ><i class="fa fa-trash"></i></a>
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

<!-- ============================== modal edit ======================================= --> 
<?php 
foreach($Upah as $i){
	$IdData = $i->ID_Golongan;
	$Bagian = $i->Bagian;
	$UpahHarian = $i->Upah_Harian;
	$UpahLembur = $i->Upah_Lembur;
	$Insentive = $i->Insentive;
	$Bpjs = $i->Bpjs;
	?>
	<div class="modal animated zoomIn" id="modal_edit<?php echo $IdData?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog  modal-md">
			<form action="<?php echo base_url('PageHome').'/EditJabatan'; ?>" method="post">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="myModalLabel">Edit Data Jabatan</h3>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<table class="table table-condensed">
							<tr>
								<td><label for="ID_Number">Jabatan</label></td>
								<td>
									<input type="hidden" name="ID" value="<?php echo $IdData?>">
									<input name="bagian" type="text" class="form-control" value="<?php echo $Bagian ?>" required></td>
								</tr>

								<tr>
									<td><label for="UpahHarian">Upah Harian</label></td>
									<td>
										<input name="UpahHarian" type="number" class="form-control" value="<?php echo $UpahHarian ?>" required/></td>
									</tr>

									<tr>
										<td><label for="UpahLembur">Upah Lebur</label></td>
										<td>
											<input type="number" name="Lembur" class="form-control" value="<?php echo $UpahLembur ?>" required>
										</td>
									</tr>

									<tr>
										<td><label for="Insentive">Insetive</label></td>
										<td>
											<input type="number" name="insentive" class="form-control" value="<?php echo $Insentive ?>" required>
										</td>
									</tr>

									<tr>
										<td><label for="User">BPJS</label></td>
										<td>
											<input type="number" name="Bpjs" class="form-control" value="<?php echo $Bpjs ?>" required>
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
			
			<!-- =========================== Delet Karyawan ============================== -->
			<div class="modal animated shake" id="modal_delete<?php echo $IdData; ?>">
				<div class="modal-dialog modal-dialog-scrollable" role="document">
					<div class="modal-content" style="margin-top:100px;">
						<div class="modal-header">
							<h4 class="modal-title" style="text-align:center;">Hapus Data ?</h4>
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						</div>
						<form action="<?php echo base_url('PageHome').'/HapusJabatan'; ?>" method="post">
							<div class="modal-body">
								<input type="hidden" name="ID" value="<?php echo $IdData?>">
								Apakah Anda yakin ingin membuang data ini ke tempat sampah?
							</div>   
							<div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
								<button type="submit" class="btn-sm btn-danger">Delete</button>
								<button type="button" class="btn btn-sm btn-success" data-dismiss="modal">Cancel</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<?php } ?>