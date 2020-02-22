<div class="page-wrapper" style="display: block;">
	<div class="container-fluid">
	  <br>
	  <h3 class="text-left"><i class='fas fa-map-marker-alt' style='font-size:36px;color:red'></i> <?=$configurations["sta_nama"];?></h3>
	  <div style="margin-top: -20px;">
		<div class="text-center">
		  <h2>PARTIKULAT DAN GAS</h2>
		  <hr style="margin-top: -10px;margin-bottom: 0px;">
		</div>
		<br>
		<div class="row text-center">
		  <div class="col-sm-5">
			<div class="row justify-content-center">
			<?php foreach($partikulats as $partikulat) : ?>
				<div class="col-6">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title"><?= $partikulat['caption'] ?></h4>
							<div class="row">
								<div class="col-12">
									<h2 class="font-light text-right mb-0" id="<?= $partikulat['param_id'] ?>"></h2>
								</div>
							</div>
							<div class="row align-items-center">
								<div class="col-12">
									<p id="<?= $partikulat['param_id'] ?>_flow" class="text-danger" style="margin-bottom: 12px;"></p>
								</div>
							</div>
						</div>
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
				  <h3 id="<?= $gas['param_id'] ?>"></h3>
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
				  <h6 class="font-weight-bold" style="margin-top: 4px;"><?= $cuaca['caption'] ?></h6>
				  <hr style="margin-top: 0px; margin-bottom: -4px;">
				  <h3 id="<?= $cuaca['param_id'] ?>"></h3>
				  <hr style="margin-bottom: 0px; margin-top: -4px;">
				  <p style="margin-bottom: 4px"><?= $cuaca['satuan'] ?></p>
				</div>
			  </div>
			<?php endforeach ?>
			</div>
		  </div>
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