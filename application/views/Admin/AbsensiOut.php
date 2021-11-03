<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CV. Hikari Technology</title>
	<link href="<?php echo base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url()?>assets/css/Stiles.css">
</head>

<body>
	<div class="header">
		<h2>CV. Hikari Technology | Absensi Keluar</h2>
	</div>
	<hr>
	<h2 id="txt"></h2>
	<p>Arahkan Kode QR kehadapan kamera laptop/komputer Paskan dengan kotak, Agar terbaca oleh system database Tunggu hingga terdapat Notifikasi pesan berhasil/Bunyi Bep.</p>
	<?php
	if($this->session->flashdata('alert')){
		echo "<div class='alert alert-danger alert-message'>";
		echo "<center>".$this->session->flashdata('alert')."</center>";
		echo "</div>";
	}elseif ($this->session->flashdata('Pesan')) {
		echo "<div class='alert alert-success alert-message'>";
		echo  "<center>".$this->session->flashdata('Pesan')."</center>";
		echo "</div>";
	}
	?>
	<div class="container">
		<div class="bisablog-info">
			<center>
				<canvas width="250" height="180"></canvas>
			</center>
			<div class="input-group">
				<select class="form-control"></select>
				<span class="input-group-btn">
					<input type="submit" class="btn btn-secondary" onclick="QR()" id="Label" value="Stop">
				</span>
			</div>
		</div>
		<hr>
		<center>
			<a class="btn btn-primary" href="<?php echo base_url('LogIn')?>" title="LogIn">LogIn</a>
		</center>
	</div>

	<script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo base_url()?>assets/js/qrcodelib.js"></script>
	<script src="<?php echo base_url()?>assets/js/webcodecamjquery.js"></script>
	<script type="text/javascript">
		$('.alert-message').alert().delay(3000).slideUp('slow');
	</script>	
	<script type="text/javascript">
		var arg = {
			resultFunction: function(result) {
            // $('.hasilscan').append($('<input name="noijazah" value=' + result.code + ' readonly><input type="submit" value="Cek"/>'));
           // $.post("../cek.php", { noijazah: result.code} );
            // redirect(base_url().'Welcome/Hasil');
            var redirect = 'ScaneQROut';
            $.redirectPost(redirect, {IdKaryawan: result.code});
        }
    };
    
    var decoder = $("canvas").WebCodeCamJQuery(arg).data().plugin_WebCodeCamJQuery;
    decoder.buildSelectMenu("select");
    decoder.play();
      // Without visible select menu
        // decoder.buildSelectMenu(document.createElement('select'), 'environment|back').init(arg).play();
        function QR(){
        	var target=document.getElementById("Label");
        	if (target.value=="Stop") {
        		decoder.stop();
        		document.getElementById("Label").value ="Play";
        	}else{
        		decoder.play();
        		document.getElementById("Label").value ="Stop";
        	}
        }

        $('select').on('change', function(){
        	decoder.stop().play();
        });

    // jquery extend function
    $.extend(
    {
    	redirectPost: function(location, args)
    	{
    		var form = '';
    		$.each( args, function( key, value ) {
    			form += '<input type="hidden" name="'+key+'" value="'+value+'">';
    		});
    		$('<form action="'+location+'" method="POST">'+form+'</form>').appendTo('body').submit();
    	}
    });

</script>

<script type="text/javascript">
	window.setTimeout("waktu()",100);
	function waktu()
	{
		var waktu = new Date();
		setTimeout("waktu()",100);
		var h=waktu.getHours();
		var m=waktu.getMinutes();
		var s=waktu.getSeconds();
// add a zero in front of numbers<10
m=checkTime(m);
s=checkTime(s);
document.getElementById('txt').innerHTML=h+":"+m+":"+s;
function checkTime(i)
{
	if (i<10)
	{
		i="0" + i;
	}
	return i;
}
}
</script>

</body>
</html>