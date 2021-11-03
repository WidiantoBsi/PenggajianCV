<div class="container-fluid">
  <h1 class="mt-4">Laporan Penggajian</h1>

  <form action="<?php echo base_url('CekLaporan'); ?>" method="post">
    <div class="card-body">
      <div class="input-group">
        <select class="form-control" name="InputSlip">
          <?php
          $bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
          for($a=1;$a<=12;$a++){
           if($a==date("m"))
           { 
             $pilih="selected";
           }
           else 
           {
             $pilih="";
           }
           echo("<option value=\"$a\" $pilih>$bulan[$a]</option>"."\n");
         }
         ?>
        </select>
        <span class="input-group-btn">
          <input class="btn btn-secondary" type="submit" name="Proses" value="Cek">
        </span>
      </div>
    </form>
  <!-- <br> -->
  <hr>
  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
      <thead>
        <tr>
          <th>No</th>
          <th>ID Karyawan</th>
          <th>Total Masuk</th>
          <th>Total Lembur</th>
          <th>Tanggal</th>
          <th>Total Gaji</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach($Gaji as $b){
          ?>
          <tr class="head">
            <td><?php echo $no++ ?></td>
            <td><?php echo $b->ID_Karyawan ?></td>
            <td><?php echo $b->Total_Masuk ?></td>
            <td><?php echo $b->Total_Lembur ?></td>
            <td><?php echo $b->Tgl_Transaksi ?></td>
            <td>Rp.<?php echo number_format($b->SubTotalupah) ?></td>
          </tr>
      <?php } ?>
      </tbody>
      <tr>
        <td colspan="5">SubTotal</td>
        <td>Rp.<?php echo number_format($total) ?></td>
      </tr>
    </table>
    <br>
    <div align="left">
      <?php if (count($Gaji)>0) { 
        ?>
        <a href="<?php echo base_url('PageHome/').'InportExcel/'.$keyword ?>" class="btn btn-md btn-success center-f-0"><i class="fa fa-upload"> EXPORT TO EXCEL</i></a>
        <a href="<?php echo base_url('PageHome/').'SavePdf/'.$keyword ?>" class="btn btn-md btn-primary center-f-0" target='_blank'><i class="fa fa-download"> SAVE PDF</i></a>
      <?php } ?>
    </div>
  </div>
  <hr>
</div>
</div>