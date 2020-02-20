<div class="container-fluid">
  <br>
  <h3 class="text-left"><i class='fas fa-map-marker-alt' style='font-size:36px;color:red'></i> LAMPUNG</h3>
  <div class="text-center">
    <h2>PARTIKULAT DAN GAS</h2>
    <hr style="margin-top: -10px;margin-bottom: 0px;">
  </div>
  <div class="row text-center">
    <div class="col-sm-5">
      <div class="row justify-content-center">
      <?php foreach($partikulats as $partikulat) : ?>
        <div class="col-sm-6 p-3">
          <div class="card border border-success">
            <h3 style="margin-top: 10px;"><?= $partikulat['caption'] ?></h3>
            <hr style="margin-top: 2px; margin-bottom: 11px;">
            <p class="font-weight-bold" style="font-size: 60px;" id="<?= $partikulat['param_id'] ?>"></p>
            <hr style="margin-bottom: 4px;margin-top: 11px;">
            <p><?= $partikulat['satuan'] ?></p>
            <?php foreach($partikulatflows as $partikulatflow) : ?>
            <p id="<?= $partikulatflow['param_id'] ?>" class="text-danger" style="margin-bottom: 12px;"><?= $partikulatflow['satuan'] ?></p>
            <?php break;?>
            <?php endforeach ?>
          </div>
        </div>
      <?php endforeach ?>
      </div>
    </div>
    <div class="col-sm-7">
      <div class="row justify-content-center">
      <?php foreach($gass as $gas) : ?>
        <div class="col-sm-3 p-3">
          <div class="card border border-primary">
            <h5 class="font-weight-bold" style="margin-top: 4px;"><?= $gas['caption'] ?></h5>
            <hr style="margin-top: 0px; margin-bottom: -4px;">
            <h1 id="<?= $gas['param_id'] ?>"></h1>
            <hr style="margin-bottom: 0px; margin-top: -4px;">
            <p style="margin-bottom: 4px"><?= $gas['satuan'] ?></p>
          </div>
        </div>
      <?php endforeach ?>
      </div>
    </div>
  </div>
  <div class="text-center">
    <h2>CUACA</h2>
    <hr style="margin-top: -10px;margin-bottom: 0px;">
  </div>
  <div class="row text-center">
    <div class="col-sm">
      <div class="row justify-content-center">
      <?php foreach($cuacas as$cuaca) : ?>
        <div class="col-sm p-3">
          <div class="card border border-warning">
            <h5 class="font-weight-bold" style="margin-top: 4px;"><?= $cuaca['caption'] ?></h5>
            <hr style="margin-top: 0px; margin-bottom: -4px;">
            <h1 id="<?= $cuaca['param_id'] ?>"></h1>
            <hr style="margin-bottom: 0px; margin-top: -4px;">
            <p style="margin-bottom: 4px"><?= $cuaca['satuan'] ?></p>
          </div>
        </div>
      <?php endforeach ?>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function reload_sensor(){
      $.ajax({url: "<?=site_url('sensors');?>", success: function(result){
        var sensor = JSON.parse(result);
        $("#pm10").html(sensor.pm10);
        $("#pm10_flow").html(sensor.pm10_flow + " l/min");
        $("#pm25").html(sensor.pm25);
        $("#pm25_flow").html(sensor.pm25_flow + " l/min");
        $("#so2").html(sensor.so2);
        $("#co").html(sensor.co);
        $("#o3").html(sensor.o3);
        $("#no2").html(sensor.no2);
        $("#voc").html(sensor.voc);
        $("#hc").html(sensor.hc);
        $("#h2s").html(sensor.h2s);
        $("#cs2").html(sensor.cs2);
        $("#WindSpeed").html(sensor.WindSpeed);
        $("#WindDir").html(sensor.WindDir);
        $("#TempIn").html(sensor.TempIn);
        $("#TempOut").html(sensor.TempOut);
        $("#Barometer").html(sensor.Barometer);
        $("#RainDay").html(sensor.RainDay);
        $("#RainRate").html(sensor.RainRate);
        $("#SolarRad").html(sensor.SolarRad);
        $("#HumIn").html(sensor.HumIn);
        $("#HumOut").html(sensor.HumOut);
      }});
      setTimeout(function(){ reload_sensor() }, 1000);
    }
    reload_sensor();
</script>