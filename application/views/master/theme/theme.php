<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#">
    <link rel="icon" href="<?= base_url('assets/dist/img/trusur_logo3.png') ?>">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/bootstrap-toggle.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/dist/css/morris.css') ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-buttons/css/buttons.dataTables.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">

    <script src="<?= base_url('assets/dist/js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('assets/dist/js/raphael-min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/morris.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/bootstrap-toggle.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/font-awesome.js') ?>"></script>
    <!-- data tables -->
    <script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') ?>"></script>
    <script src="<?= base_url('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>

    <!-- data table export -->
    <script src="<?= base_url('assets/dist/js/aqmmaster/jszip.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/aqmmaster/pdfmake.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/aqmmaster/vfs_fonts.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/aqmmaster/buttons.html5.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/aqmmaster/buttons.print.min.js') ?>"></script>

    <!-- data tables -->
    <script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') ?>"></script>
    <!-- js date picker-->

    <style>
		body{
			background-image: url('<?= base_url('assets/dist/img/black_metal_texture.png') ?>'); 
		}
		.footer {
			position: fixed;
			left: 0;
			bottom: 0;
			width: 100%;
			color: white;
			text-align: center; 
			background-image: url('<?= base_url('assets/dist/img/dark-textures.jpg') ?>'); 
			background-size: 1024px 40px;
		}
		.text-position-center {
			margin-top: 13px;
		}
		.header-fixed {
			position: fixed;
			width: 100%;
		}
		.body-position {
			margin-top: 40px;
		}
		.page-wrapper {
			background-image: url('<?= base_url('assets/dist/img/black_metal_texture.png') ?>'); 
			position: relative;
			display: none;
		}									
	  
		.card {
			position: relative;
			display: flex;
			flex-direction: column;
			min-width: 0;
			word-wrap: break-word;
			background-color: grey;
			background-clip: border-box;
			border: 0 solid transparent;
			border-radius: .25rem;
			background-image: url('<?= base_url('assets/dist/img/dark-textures.jpg') ?>'); 
		}
		
		.card-title{
			text-align:left;
			font-size:16px;
			color:white;
		}
		
		.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
			margin-bottom: .5rem;
			font-family: inherit;
			font-weight: 500;
			line-height: 1.2;
			color: #00FF00;
		}
		
		.page-title {
			margin-bottom: 0;
			font-weight: 500;
			font-size: 21px;
			color: #00FF00;
		}
		
		.page-title2 {
			margin-bottom: 0;
			font-weight: 700;
			color: #80FF80;
		}
		
		.page-breadcrumb {
			padding: 10px 0px 10px 0px;
		}
		
		.navbar-dark .navbar-nav .nav-link {
			color: #FFFF00;
			font-weight:bolder;
			font-size:20px;
		}
		
		.navbar-dark .navbar-brand {
			color: #FFF;
			font-weight:bolder;
			font-size:26px;
		}
		
		.font-flow{
			font-weight:bolder;
			color:#FFFF00;
		}
		
		nav{ 
			background-image: url('<?= base_url('assets/dist/img/dark-textures.jpg') ?>'); 
			background-size: 1024px 70px;
		}
		
		.bg-primary{
			background-image: url('<?= base_url('assets/dist/img/dark-textures.jpg') ?>'); 
			background-size: 1024px 70px;
		}
		
		#remaining{ color:white; }
		#myTable{ background-color:white; }
		#myTable td{ color:black; }
		label{ color:white; }
		td{ color:white; }
		
		.text-right{ color:white; }
		
    .btn-circle {
      width: 60px;
      height: 60px;
      text-align: center;
      padding: 6px 0;
      font-size: 16px;
      line-height: 1.42;
      border-radius: 55px;
    }
    
    </style>

    <title><?= $title; ?></title>
  </head>
  <body onload="startTime()" >
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
		<a class="navbar-brand" href="<?= site_url() ?>">
          <img src="<?= base_url('assets/dist/img/trusur_logo3.png') ?>" alt="PT Trusur Unggul Teknusa">
        </a>
      <a class="navbar-brand" href="<?= site_url() ?>">TRUSUR</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?= $this->uri->uri_string() == 'konfigurasi' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= site_url('konfigurasi') ?>">Konfigurasi</a>
          </li>
          <li class="nav-item <?= $this->uri->uri_string() == 'parameter' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= site_url('parameter') ?>">Parameter</a>
          </li>
          <li class="nav-item <?= $this->uri->uri_string() == 'export' ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= site_url('export') ?>">Export</a>
          </li>
        </ul>
		<div id="online_indicator"><h6 style='color:#FF0000;'>Internet Disconnect</h6></div>&nbsp;&nbsp;&nbsp;&nbsp;
		<img src="<?= base_url('assets/dist/img/indonesia.jpg') ?>" alt="100% Indonesia" height="35">
      </div>
    </nav>

    <?=$contents?>

    <div class="footer bg-primary text-right p-2">
      <?php
      date_default_timezone_set("Asia/Bangkok");
      $day = date("D");
      $dayList = array(
        'Sun' => 'Minggu',
        'Mon' => 'Senin',
        'Tue' => 'Selasa',
        'Wed' => 'Rabu',
        'Thu' => 'Kamis',
        'Fri' => 'Jumat',
        'Sat' => 'Sabtu'
      );
      $month = date("m");
      $monthList = array(
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
      );
      echo '<a id="clock"></a>'; ?>
    </div>

    

    <script>
	function cek_is_online(){
		$.ajax({url: "http://103.247.11.149/server_side/api/is_connect.php", success: function(result){
			if(result == "1"){
				$("#online_indicator").html("<h6 style='color:#00FF00;'>Internet Connected</h6>");
			} else {
				$("#online_indicator").html("<h6 style='color:#FF0000;'>Internet Disconnect</h6>");
			}
		}});
		setTimeout(function(){ cek_is_online() }, 30000);
	}
	cek_is_online();
	
	function dayList(dd){
		if(dd == "0") return "Minggu";
		if(dd == "1") return "Senin";
		if(dd == "2") return "Selasa";
		if(dd == "3") return "Rabu";
		if(dd == "4") return "Kamis";
		if(dd == "5") return "Jumat";
		if(dd == "6") return "Sabtu";
	}
	
	function monthList(mm){
		if(mm == "1") return "Januari";
		if(mm == "2") return "Februari";
		if(mm == "3") return "Maret";
		if(mm == "4") return "April";
		if(mm == "5") return "Mei";
		if(mm == "6") return "Juni";
		if(mm == "7") return "Juli";
		if(mm == "8") return "Agustus";
		if(mm == "9") return "September";
		if(mm == "10") return "Oktober";
		if(mm == "11") return "November";
		if(mm == "12") return "Desember";
	}
	
    function startTime() {
      var today = new Date();
	  var hari = dayList(today.getDay());
	  var tanggal = today.getDate() + " " + monthList(today.getMonth()) + " " + today.getFullYear();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      document.getElementById('clock').innerHTML = hari + ", " + tanggal + " | " + h + ":" + m + ":" + s;
      var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
      if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
      return i;
    }
    </script>



  </body>
</html>