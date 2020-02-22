<div class="page-wrapper" style="display: block;">
	<div class="container-fluid">
		<div class="page-breadcrumb">
			<div class="row">
				<div class="col-5 align-self-center">
					<h4 class="page-title"><i class='fas fa-map-marker-alt' style='font-size:21px;color:red'></i> <?=$configurations["sta_nama"];?></h4>
				</div>
			</div>
		</div>
		
		<div class="page-breadcrumb">
			<div class="row">
				<div class="col-12 align-self-center">
					<h4 class="text-center page-title2">Partikulat dan Gas</h4>
				</div>
			</div>
		</div>
	
		<div class="row text-center">
			<div class="col-sm-5">
				<div class="row justify-content-center">
					<?php foreach($partikulats as $partikulat) : ?>
						<div class="col-6">
							<div class="card border border-success">
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
						<div class="col-sm-3" style="padding:0px 20px 20px 0px;">
							<div class="card border border-primary" style="padding:0px 5px 5px 0px;">
								<h4 class="card-title">&nbsp;<?= $gas['caption'] ?><div style="position:relative;float:right;">(<?= $gas['default_unit'] ?>)</div></h4>
								<div class="row">
									<div class="col-12">
										<h4 class="font-light text-right mb-0" id="<?= $gas['param_id'] ?>"></h4>
									</div>
								</div>
							</div>
						</div>
				<?php endforeach ?>
				</div>
			</div>
		</div>
		
		<div class="page-breadcrumb">
			<div class="row">
				<div class="col-12 align-self-center">
					<h4 class="text-center page-title2">Cuaca</h4>
				</div>
			</div>
		</div>
		
		<div class="row text-center">
			<div class="col-sm">
				<div class="row justify-content-center">
					<?php foreach($cuacas as$cuaca) : ?>
						<div class="col-sm" style="padding:0px 20px 20px 0px;">
							<div class="card border border-warning">
								<h6 class="card-title">&nbsp;<?= $cuaca['caption'] ?></h6>
								<h3 id="<?= $cuaca['param_id'] ?>"></h3>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
  function reload_sensor(){
      $.ajax({url: "<?=site_url('sensors');?>", success: function(result){
        var sensor = JSON.parse(result);
        $("#pm10").html((sensor.pm10 * 1000) + " " + sensor.pm10_unit);
        $("#pm10_flow").html(sensor.pm10_flow + " " + sensor.pm10_flow_unit);
        $("#pm25").html((sensor.pm25 * 1000) + " " + sensor.pm25_unit);
        $("#pm25_flow").html(sensor.pm25_flow + " " + sensor.pm25_flow_unit);
        $("#so2").html(sensor.so2);
        $("#co").html(sensor.co);
        $("#o3").html(sensor.o3);
        $("#no2").html(sensor.no2);
        $("#voc").html(sensor.voc);
        $("#hc").html(sensor.hc);
        $("#h2s").html(sensor.h2s);
        $("#cs2").html(sensor.cs2);
        $("#WindSpeed").html(sensor.WindSpeed + "</h3><br><h6>" + sensor.WindSpeed_unit + "</h6>");
        $("#WindDir").html(sensor.WindDir + sensor.WindDir_unit + "</h3><br><h6>&nbsp;</h6>");
        $("#TempIn").html(sensor.TempIn + "</h3><br><h6>" + sensor.TempIn_unit + "</h6>");
        $("#TempOut").html(sensor.TempOut + "</h3><br><h6>" + sensor.TempOut_unit + "</h6>");
        $("#Barometer").html(sensor.Barometer + "</h3><br><h6>" + sensor.Barometer_unit + "</h6>");
        $("#RainDay").html(sensor.RainDay + "</h3><br><h6>" + sensor.RainDay_unit + "</h6>");
        $("#RainRate").html(sensor.RainRate + "</h3><br><h6>" + sensor.RainRate_unit + "</h6>");
        $("#SolarRad").html(sensor.SolarRad + "</h3><br><h6>" + sensor.SolarRad_unit + "</h6>");
        $("#HumIn").html(sensor.HumIn + "&nbsp;" + sensor.HumIn_unit + "</h3><br><h6>&nbsp;</h6>");
        $("#HumOut").html(sensor.HumOut + "&nbsp;" + sensor.HumOut_unit + "</h3><br><h6>&nbsp;</h6>");
      }});
      setTimeout(function(){ reload_sensor() }, 1000);
    }
    reload_sensor();
</script>