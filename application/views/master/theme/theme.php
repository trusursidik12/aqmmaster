<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/bootstrap.min.css') ?>">

    <style>
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
    </style>

    <title>Hello, world!</title>
  </head>
  <body onload="startTime()" >
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand" href="<?= site_url() ?>">
          <img src="<?= base_url('assets/dist/img/trusur_logo3.png') ?>" alt="">
        </a>
      <a class="navbar-brand" href="<?= site_url() ?>">TRUSUR</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="<?= site_url('kalibrasi') ?>">Kalibrasi</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Database</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <button type="button" onclick="window.close();" class="btn btn-outline-light my-2 my-sm-0">EXIT</button>      
        </form>
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

    <!-- Optional JavaScript -->
    <script src="<?= base_url('assets/dist/js/jquery-3.2.1.slim.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/popper.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('assets/dist/js/font-awesome.js') ?>"></script>

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