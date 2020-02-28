<?php if($is_graph) : ?> <meta http-equiv="refresh" content="30"> <?php endif ?>
<div class="page-wrapper" style="display: block;">
	<div class="container-fluid">
		<div class="page-breadcrumb">
			<div class="row">
				<div class="col-5 align-self-center">
					<h4 class="page-title"><i class='fas fa-map-marker-alt' style='font-size:21px;color:red'></i> <?=$configurations["sta_nama"];?></h4>
				</div>
				<div class="col-5"></div>
				<div class="col-2 align-self-right">
					<input id="pump_state" type="checkbox" data-height="20" data-toggle="toggle" data-on="Pompa 1" data-off="Pompa 2" data-onstyle="success" data-offstyle="primary">
					<div class="text-center" id="remaining"></div>
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
											<h3 class="font-light text-right mb-0" id="<?= $partikulat['param_id'] ?>"></h3>
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
				<?php if(count($gass) > 0) : ?>
					<div class="row">
						<?php foreach($gass as $gas) : ?>
							<div class="<?php if(count($gass) > 6) : ?> col-3 <?php elseif (count($gass) > 4) : ?> col-4 <?php else : ?> col-6 <?php endif ?>" style="padding:0px 20px 20px 0px;">
								<div class="card border border-primary" style="padding:0px 5px 5px 0px;">
									<h4 class="card-title">&nbsp;<?= $gas['caption'] ?><div style="position:relative;float:right;" id="unit_<?= $gas['param_id'] ?>">(<?= $gas['default_unit'] ?>)</div></h4>
									<div class="row">
										<div class="col-12">
											<h4 class="font-light text-right mb-0" id="<?= $gas['param_id'] ?>"></h4>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach ?>
					</div>
				<?php endif ?>
				<?php if($is_graph) : ?>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div id="graph" style="height:200px;"></div>
							</div>
						</div>
					</div>
				<?php endif ?>
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
						<div class="col-sm p-3" style="padding:0px 20px 20px 0px;">
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
	function padnum(number) {
		if (number < 9)
			return "0" + number;
		else
			return number;
	}
  
  $(function() {
    $('#pump_state').change(function() {
		$.ajax({url: "<?=site_url('sensors/change_pump_state');?>?state=" + $('#pump_state').prop('checked'), success: function(result){}});
    })
  })
  
  function put_data_to_vps(){
	$.ajax({url: "http://127.0.0.1/aqmmaster/put_data.php", success: function(result){}});
	setTimeout(function(){ put_data_to_vps() }, 15000);
  }
  
  function reload_sensor(){
      $.ajax({url: "<?=site_url('home/graph');?>", success: function(graphview){
        try { $("#graph").html(graphview); } catch(ex){}
	  }});
      $.ajax({url: "<?=site_url('sensors');?>?unit=<?= $_GET["unit"]; ?>", success: function(result){
        var sensor = JSON.parse(result);
        try { $("#pm10").html((sensor.pm10 * 1000) + " " + sensor.pm10_unit); } catch(ex){}
        try { $("#pm10_flow").html(sensor.pm10_flow + " " + sensor.pm10_flow_unit); } catch(ex){}
        try { $("#pm25").html((sensor.pm25 * 1000) + " " + sensor.pm25_unit); } catch(ex){}
        try { $("#pm25_flow").html(sensor.pm25_flow + " " + sensor.pm25_flow_unit); } catch(ex){}
        try { $("#so2").html(sensor.so2); } catch(ex){}
        try { $("#unit_so2").html("(" + sensor.so2_unit + ")"); } catch(ex){}
        try { $("#co").html(sensor.co); } catch(ex){}
        try { $("#unit_co").html("(" + sensor.co_unit + ")"); } catch(ex){}
        try { $("#o3").html(sensor.o3); } catch(ex){}
        try { $("#unit_o3").html("(" + sensor.o3_unit + ")"); } catch(ex){}
        try { $("#no2").html(sensor.no2); } catch(ex){}
        try { $("#unit_no2").html("(" + sensor.no2_unit + ")"); } catch(ex){}
        try { $("#voc").html(sensor.voc); } catch(ex){}
        try { $("#unit_voc").html("(" + sensor.voc_unit + ")"); } catch(ex){}
        try { $("#hc").html(sensor.hc); } catch(ex){}
        try { $("#unit_hc").html("(" + sensor.hc_unit + ")"); } catch(ex){}
        try { $("#h2s").html(sensor.h2s); } catch(ex){}
        try { $("#unit_h2s").html("(" + sensor.h2s_unit + ")"); } catch(ex){}
        try { $("#cs2").html(sensor.cs2); } catch(ex){}
        try { $("#unit_cs2").html("(" + sensor.cs2_unit + ")"); } catch(ex){}
        try { $("#WindSpeed").html(sensor.WindSpeed + "</h3><br><h6>" + sensor.WindSpeed_unit + "</h6>"); } catch(ex){}
        try { $("#WindDir").html(sensor.WindDir + sensor.WindDir_unit + "</h3><br><h6>&nbsp;</h6>"); } catch(ex){}
        try { $("#TempIn").html(sensor.TempIn + "</h3><br><h6>" + sensor.TempIn_unit + "</h6>"); } catch(ex){}
        try { $("#TempOut").html(sensor.TempOut + "</h3><br><h6>" + sensor.TempOut_unit + "</h6>"); } catch(ex){}
        try { $("#Barometer").html(sensor.Barometer + "</h3><br><h6>" + sensor.Barometer_unit + "</h6>"); } catch(ex){}
        try { $("#RainDay").html(sensor.RainDay + "</h3><br><h6>" + sensor.RainDay_unit + "</h6>"); } catch(ex){}
        try { $("#RainRate").html(sensor.RainRate + "</h3><br><h6>" + sensor.RainRate_unit + "</h6>"); } catch(ex){}
        try { $("#SolarRad").html(sensor.SolarRad + "</h3><br><h6>" + sensor.SolarRad_unit + "</h6>"); } catch(ex){}
        try { $("#HumIn").html(sensor.HumIn + "&nbsp;" + sensor.HumIn_unit + "</h3><br><h6>&nbsp;</h6>"); } catch(ex){}
        try { $("#HumOut").html(sensor.HumOut + "&nbsp;" + sensor.HumOut_unit + "</h3><br><h6>&nbsp;</h6>"); } catch(ex){}
		try { 
			if(sensor.pump_state == "0" && $('#pump_state').prop('checked') == true) $("#pump_state").bootstrapToggle('off'); 
			else if(sensor.pump_state == "1" && $('#pump_state').prop('checked') == false) $("#pump_state").bootstrapToggle('on');
		} catch(ex){}
		try { 
			var pump_last = new Date(sensor.pump_last.replace(" ","T"));
			var current = new Date(sensor.now.replace(" ","T"));
			var pump_state_time = (current - pump_last) / 1000;
			var remaining = (sensor.pump_interval * 60) - pump_state_time;
			var remaining_h = Math.floor(remaining / 3600);
			var remaining_m = Math.floor((remaining - (remaining_h*3600)) / 60);
			var remaining_s = Math.floor(remaining % 60);
			$("#remaining").html(padnum(remaining_h) + ":" + padnum(remaining_m) + ":" + padnum(remaining_s));
			if((sensor.pump_interval * 60) <= pump_state_time){
				if($('#pump_state').prop('checked') == true) $("#pump_state").bootstrapToggle('off'); 
				else if($('#pump_state').prop('checked') == false) $("#pump_state").bootstrapToggle('on');
			}
		} catch(ex){}
      }});
      setTimeout(function(){ reload_sensor() }, 1000);
    }
    reload_sensor();
    put_data_to_vps();
</script>