<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/bootstrap-toggle.min.css') ?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-buttons/css/buttons.dataTables.min.css') ?>">


    <!-- data table export -->
    <script src="<?= base_url('assets/dist/js/aqmmaster/jquery-3.3.1.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/aqmmaster/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/aqmmaster/dataTables.buttons.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/aqmmaster/buttons.flash.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/aqmmaster/jszip.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/aqmmaster/pdfmake.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/aqmmaster/vfs_fonts.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/aqmmaster/buttons.html5.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/aqmmaster/buttons.print.min.js') ?>"></script>

    <!-- font awesome -->
    <script src="<?= base_url('assets/dist/js/font-awesome.js') ?>"></script>
    <!-- data tables -->
    <script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js') ?>"></script>
    <!-- js date picker-->

    <style>
		body{
			background: #f2f4f5;
		}
		.footer {
			 position: fixed;
			 left: 0;
			 bottom: 0;
			 width: 100%;
			 color: white;
			 text-align: center;
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
			background: #f2f4f5;
			position: relative;
			display: none;
		}									
	  
		.card {
			position: relative;
			display: flex;
			flex-direction: column;
			min-width: 0;
			word-wrap: break-word;
			background-color: #fff;
			background-clip: border-box;
			border: 0 solid transparent;
			border-radius: .25rem;
		}
		
		.card-title{
			text-align:left;
			font-size:16px;
			color:grey;
		}
		
		.page-title {
			margin-bottom: 0;
			font-weight: 500;
			font-size: 21px;
			color: #6a7a8c;
		}
		
		.page-title2 {
			margin-bottom: 0;
			font-weight: 700;
			color: #6a7a8c;
		}
		
		.page-breadcrumb {
			padding: 10px 0px 10px 0px;
		}
    </style>

    <title><?= $title; ?></title>
  </head>
  <body onload="startTime()" >
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
      <a class="navbar-brand" href="<?= site_url() ?>">
          <img src="<?= base_url('assets/dist/img/trusur_logo3.png') ?>" alt="">
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
		<?php if (isset($nextunit)): ?>
			<form class="form-inline my-2 my-lg-0">
			  <button type="button" onclick="window.location='?unit=<?= $nextunit; ?>';" class="btn btn-outline-light my-2 my-sm-0">Satuan</button>      
			</form>
		<?php endif; ?>
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
      echo $dayList[$day].', '.date("j").' '.$monthList[$month].' '.date("Y").' | <a id="clock"></a>'; ?>
    </div>

    

    <script>
    function startTime() {
      var today = new Date();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      document.getElementById('clock').innerHTML =
      h + ":" + m + ":" + s;
      var t = setTimeout(startTime, 500);
    }
    function checkTime(i) {
      if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
      return i;
    }
    </script>



  </body>
</html>