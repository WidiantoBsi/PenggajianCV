   <div class="container-fluid">
    <h1 class="mt-4">Dashboard</h1>
    <div class="card shadow mb-4">
     <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Absensi Karyawan</h6>
      <div class="dropdown no-arrow">
        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i></a>
        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
          <div class="dropdown-header">Absensi :</div>
          <a class="dropdown-item" href="<?php echo base_url('AbsensiIn')?>">Masuk</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="<?php echo base_url('AbsensiOut')?>">Keluar</a>
        </div>
      </div>
    </div>
    <div class="card-body">
      <!-- Data Absen Masuk -->
     <!-- <h4 class="small font-weight-bold">Absensi <span class="float-right"><?=$DbKeluar ?>%</span></h4> -->
     <!-- <div class="progress mb-4">
      <div class="progress-bar bg-danger" role="progressbar" style="width: <?=$DbKeluar ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
    </div> -->
    <!-- Data Penggajian -->
     <h4 class="small font-weight-bold">Penggajian <span class="float-right"><?php echo $DbGaji ?>%</span></h4>
     <div class="progress mb-4">
      <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $DbGaji ?>%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
     <!-- Data Karyawan -->
     <div class="row no-gutters align-items-center">
       <div class="col mr-2">
        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">jumlah Karyawan</div>
        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$Karyawan ?></div>
      </div>
      <div class="col-auto">
       <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
      </div>
    </div>
  </div>
</div>
</div>