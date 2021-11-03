<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="mb-0">Data Karyawan</h1>
		<a href="#" class="btn btn-sm btn-primary center-f-0" title="Tambah" data-toggle="modal" data-target="#AddKaryaan"> Tambah <i class="fa fa-plus"></i></a>
	</div>
	<hr>
	<div class="table-responsive">
		<table class="table table-bordered" id="dataTables-example">
			<thead>
				<tr align="center">
					<th>ID Nuber</th>
					<th>Nama Karyawan</th>
					<th>Jabatan</th>
					<th>Tgl Lahir</th>
					<th>Alamat</th>
					<th>Pilihan</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($Karyawan as $b){
					$where = array('ID_Golongan' => $b->ID_Golongan);
					$DB = $this->M_DBCV->edit_data($where,'golongan')->result();
					foreach($DB as $row){
						$Golongan = $row->Bagian;
					}
					$IdData = $b->ID_Karyawan;
					?>
					<tr class="head">
						<td align="center"><a href="#" title="Edit" data-toggle="modal" data-target="#modal_edit<?php echo $IdData;?>"><?php echo $b->ID_Karyawan ?></a></td>
						<td><?php echo $b->Nama_Karyawan ?></td>
						<td><?php echo $Golongan ?></td>
						<td><?php echo date('d/m/Y',strtotime($b->Tgl_Lahir)) ?></td>
						<td><?php echo $b->Alamat ?></td>
						<td align="center">
							<a class="btn btn-warning btn-sm" title="Hapus" data-toggle="modal" data-target="#modal_delete<?php echo $IdData;?>" ><i class="fa fa-trash"></i></a> 
							<a class="btn btn-info btn-sm" href="<?php echo base_url('PageHome/').'QRTes/'.$IdData ?>" title="Print" target='_blank'><i class="fa fa-print"></i></a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<hr>
	</div>
</div>


   	 
  
  <!-- ============================== modal edit ======================================= --> 
<?php 
foreach($Karyawan as $i){
	$IdData = $i->ID_Karyawan;
	$NamaKaryawan = $i->Nama_Karyawan;
	$TglLahir = $i->Tgl_Lahir;
	$alamat = $i->Alamat;
	?>
	<div class="modal animated zoomIn" id="modal_edit<?php echo $IdData?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable">
			<form action="<?php echo base_url('PageHome').'/EditKaryawan'; ?>" method="post">
				<div class="modal-content">
					<div class="modal-header">
						<h3 class="modal-title" id="myModalLabel">Edit Data Karyawan</h3>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<table class="table table-condensed">
							<tr>
								<td><label for="ID_Number">ID Number Karyawan</label></td>
								<td>
									<input type="hidden" name="ID" value="<?php echo $IdData?>">
									<input name="ID" type="text" class="form-control" value="<?php echo $IdData ?>" disabled></td>
								</tr>

								<tr>
									<td><label for="NamaKary">Nama Karyawan</label></td>
									<td>
										<input name="nama" type="text" class="form-control" value="<?php echo $NamaKaryawan ?>" required/></td>
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
											<input type="date" name="tgl" class="form-control" value="<?php echo $TglLahir ?>" required>
										</td>
									</tr>

									<tr>
										<td><label for="Alamat">Alamat</label></td>
										<td>
											<textarea class="form-control" rows="3" name="alamat" required><?php echo $alamat ?></textarea>
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
				<form action="<?php echo base_url('PageHome').'/HapusKaryawan'; ?>" method="post">
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