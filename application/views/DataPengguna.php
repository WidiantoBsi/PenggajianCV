<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="mb-0">Data Pengguna</h1>
		<a href="#" class="btn btn-sm btn-primary center-f-0" title="Tambah" data-toggle="modal" data-target="#AddPengguna"> Tambah <i class="fa fa-user-plus"></i></a>
	</div>
	<hr>
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover" id="dataTables-example">
			<thead>
				<tr>
					<th>Jabatan</th>
					<th>Id Karyawan</th>
					<th>Nama Karawan</th>
					<th>Pilihan</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($User as $b){
					$iduser = $b->ID_Karyawan;
					$where = array('ID_Karyawan' => $iduser);
					$Db = $this->M_DBCV->edit_data($where,'karyawan')->result();
					$where2 = array('ID_Golongan' => $b->ID_Grup);
					foreach($Db as $i){
						$NamaKary = $i->Nama_Karyawan;
					} 
					$DB = $this->M_DBCV->edit_data($where2,'golongan')->result();
					foreach($DB as $row){
						$Golongan = $row->Bagian;
					} 
					?>
					<tr class="head">
						<td><?php echo $Golongan ?></td>
						<td><?php echo $b->ID_Karyawan ?></td>
						<td><?php echo $NamaKary ?></td>
						<td align="center">
							<?php 
							$Nama =$this->session->userdata('id');
							if ($b->ID_Karyawan==$Nama) { ?>
							<i class="fa fa-unlock-alt"></i>
							<?php }else{ ?>
							<a class="btn btn-warning btn-sm" title="Hapus" data-toggle="modal" data-target="#modal_delete<?php echo $b->Id_User;?>" ><i class="fa fa-trash"></i></a>
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

<!-- =========================== Delet Pengguna ============================== -->

<?php
foreach($User as $row){ 
	$Id = $row->Id_User;
	?>	
	<div class="modal animated shake" id="modal_delete<?php echo $Id; ?>">
		<div class="modal-dialog modal-dialog-scrollable" role="document">
			<div class="modal-content" style="margin-top:100px;">
				<div class="modal-header">
					<h4 class="modal-title" style="text-align:center;">Hapus Data? <?php echo $Id?></h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<form action="<?php echo base_url('PageHome').'/HapusPengguna'; ?>" method="post">
					<div class="modal-body">
						<input type="hidden" name="ID" value="<?php echo $Id?>">
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