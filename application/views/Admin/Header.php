<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>CV. Hikari Technology</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url()?>assets/css/animate.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="<?php echo base_url()?>assets/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="<?php echo base_url()?>assets/vendor/css/simple-sidebar.css" rel="stylesheet">

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">CV. Hikari Technology</div>
      <div class="list-group list-group-flush">
        <a href="<?php echo base_url('PageAdmin')?>" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <a href="<?php echo base_url('Absensi')?>" class="list-group-item list-group-item-action bg-light">Data Absensi</a>
        <a href="<?php echo base_url('Penggajian')?>" class="list-group-item list-group-item-action bg-light">Penggajian</a>
        <a href="<?php echo base_url('SlipGaji')?>" class="list-group-item list-group-item-action bg-light">Struk Gaji</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-default btn-circle" id="menu-toggle"><i class="fa fa-list-ul"></i></button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Hi <?php echo $this->session->userdata('username'); ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#EditPengguna<?php echo $this->session->userdata('id');?>">Data Pengguna</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo base_url('LogOut')?>">LogOut</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
<!-- ========================= Modal Edit Pengguna ============================== -->
 <?php 
foreach($user as $i){
  $IdData = $i->ID_Karyawan;
  $NamaKaryawan = $this->session->userdata('username');
  // $Password = $i->Password;
  ?>
<div class="modal animated pulse" id="EditPengguna<?php echo $IdData?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="<?php echo base_url('PageAdmin').'/EditPengguna'; ?>" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="myModalLabel">Data Pengguna</h3>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
         <table class="table table-condensed">

          <tr>
            <td><label for="User">Id Karyawan</label></td>
            <td>
              <input type="hidden" name="ID" value="<?php echo $IdData ?>">
              <input type="text" name="ID_Karyawan" value="<?php echo $IdData ?>" disabled>
            </td>
          </tr>

          <tr>
            <td><label for="User">Nama Karyawan</label></td>
            <td>
              <input type="text" name="Nama" value="<?php echo $NamaKaryawan ?>" disabled>
            </td>
          </tr>

        </table>
        </div>
        <!-- <div class="modal-footer">
          <input type="submit" value="Simpan Data"  class="btn btn-sm btn-primary"/>
        </div> -->
      </div>
    </form>
  </div>
</div>
<?php } ?>