<!-- Bootstrap core JavaScript -->
  <script src="<?php echo base_url()?>assets/js/bootstrap.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url()?>assets/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url()?>assets/datatables/dataTables.bootstrap4.js"></script>
  <script>
    $(document).ready(function () {
      $('#dataTables-example').dataTable();
    });
  </script>
  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
    $('#ID_Golongan').change(function(){
      var id=$(this).val();
      $.ajax({
        url : "<?php echo base_url();?>PageHome/get_nama",
        method : "POST",
        data : {id: id},
        async : false,
            dataType : 'json',
        success: function(data){
          var html = '';
                var i;
                for(i=0; i<data.length; i++){
                    html += '<option value='+data[i].ID_Karyawan+'>'+data[i].ID_Karyawan+' ['+data[i].Nama_Karyawan+']'+'</option>';
                }
                $('.Karyawan').html(html);
        }
      });
    });
  });
  </script>
</body>

</html>