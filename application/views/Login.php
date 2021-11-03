<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>CV. Hikari Technology - Login</title>

    <link href="<?php echo base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/vendor/css/style.css" media="screen" type="text/css" />

</head>

<body>

  <span href="#" class="button" id="toggle-login">LogIn</span>

<div id="login">
  <div id="triangle"></div>
  <h1>LogIn</h1>
  <form action="<?php echo base_url().'LogIn/Cek_Login'; ?>" method="post">
    <input type="text" placeholder="Id Karyawan" name="ID_Karyawan" autocomplete="off" required/>
    <input type="password" placeholder="Password" name="Password" required/>
    <input type="submit" value="LogIn" />
  </form>
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
</div>

  <script src="<?php echo base_url()?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
  <script src="<?php echo base_url()?>assets/vendor/js/index.js"></script>
  <script type="text/javascript">
    $('.alert-message').alert().delay(3000).slideUp('slow');
  </script>

</body>

</html>