   <div class="container-fluid">
   	<!-- <h1 class="mt-4">Simple Sidebar</h1> -->
   	<div class="d-sm-flex align-items-center justify-content-between mb-4">
   		<h1 class="mt-4">Dashboard</h1>
   	</div>
   	
   	<div class="row">

   		<!-- Earnings (Monthly) Card Example  -->
   		<!-- <div class="col-xl-3 col-md-6 mb-4">
   			<div class="card border-left-primary shadow h-100 py-2">
   				<div class="card-body">
   					<div class="row no-gutters align-items-center">
   						<div class="col mr-2">
   							<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Earnings (Monthly)</div>
   							<div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
   						</div>
   						<div class="col-auto">
   							<i class="fas fa-calendar fa-2x text-gray-300"></i>
   						</div>
   					</div>
   				</div>
   			</div>
   		</div> -->

   		<!-- Earnings (Monthly) Card Example -->
   		<div class="col-xl-3 col-md-6 mb-4">
   			<div class="card border-left-success shadow h-100 py-2">
   				<div class="card-body">
   					<div class="row no-gutters align-items-center">
   						<div class="col mr-2">
   							<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Penggajian</div>
   							<div class="h5 mb-0 font-weight-bold text-gray-800">Rp.<?php echo number_format($total)?></div>
   						</div>
   						<div class="col-auto">
   							<i class="fas fa-calendar fa-2x text-gray-300"></i>
   						</div>
   					</div>
   				</div>
   			</div>
   		</div>

   		<!-- Earnings (Monthly) Card Example -->
   		<div class="col-xl-3 col-md-6 mb-4">
   			<div class="card border-left-info shadow h-100 py-2">
   				<div class="card-body">
   					<div class="row no-gutters align-items-center">
   						<div class="col mr-2">
   							<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Penggajian</div>
   							<div class="row no-gutters align-items-center">
   								<div class="col-auto">
   									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $Gaji ;?>%</div>
   								</div>
   								<div class="col">
   									<div class="progress progress-sm mr-2">
   										<div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $Gaji ;?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
   									</div>
   								</div>
   							</div>
   						</div>
   						<div class="col-auto">
   							<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
   						</div>
   					</div>
   				</div>
   			</div>
   		</div>

   		<!-- Pending Requests Card Example -->
   		<div class="col-xl-3 col-md-6 mb-4">
   			<div class="card border-left-warning shadow h-100 py-2">
   				<div class="card-body">
   					<div class="row no-gutters align-items-center">
   						<div class="col mr-2">
   							<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Data Karyawan</div>
   							<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $Karyawan ?></div>
   						</div>
   						<div class="col-auto">
   							<i class="fas fa-users fa-2x text-gray-300"></i>
   						</div>
   					</div>
   				</div>
   			</div>
   		</div>

         <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
               <div class="card-body">
                  <div class="row no-gutters align-items-center">
                     <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Data Pengguna</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                           <?php echo $this->M_DBCV->get_data('user')->num_rows(); ?>
                        </div>
                     </div>
                     <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                     </div>
                  </div>
               </div>
            </div>
         </div>
   	</div>
   </div>

   <!-- Pending Requests Card Example -->
         

    </div>
   <!-- /#page-content-wrapper -->

</div>