<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="mb-0">Struk Gaji</h1>
	</div>
	<hr>
	<div class="table-responsive">
		<table class="table table-bordered" id="dataTables-example">
			<thead>
				<tr>
					<th>Id Karyawan</th>
					<th>Total Masuk</th>
					<th>Total Lembur</th>
					<th>Tanggal</th>
					<th>Total Gaji</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($Penggajian as $b){
					$IdData = $b->ID_Gaji;
					?>
					<tr class="head" align="center">
						<td><?php echo $b->ID_Karyawan ?></td>
						<td><?php echo $b->Total_Masuk; ?></td>
						<td><?php echo $b->Total_Lembur ?></td>
						<td><?php echo $b->Tgl_Transaksi ?></td>
						<td><?php echo number_format($b->SubTotalupah) ?></td>
						<td align="center">
							<a href="<?php echo base_url().'PageAdmin/PrintPdf/'.$IdData; ?>" class="btn btn-sm btn-info center-f-0" target='_blank'><i class="fa fa-print"></i></a>
							<a href="#" class="btn btn-sm btn-danger center-f-0" title="Hapus" data-toggle="modal" data-target="#modal_delete<?php echo $IdData;?>"><i class="fa fa-trash"></i></a>
						</td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<hr>
</div>
</div>

<?php 
foreach($Penggajian as $i){ 
	$Id = $i->ID_Gaji;
?>
<div class="modal animated shake" id="modal_delete<?php echo $Id; ?>">
		<div class="modal-dialog modal-dialog-scrollable" role="document">
			<div class="modal-content" style="margin-top:100px;">
				<div class="modal-header">
				<h4 class="modal-title" style="text-align:center;">Hapus Data ?</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<form action="<?php echo base_url('PageAdmin').'/HapusPenggajian'; ?>" method="post">
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