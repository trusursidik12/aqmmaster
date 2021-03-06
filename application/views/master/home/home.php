<?php if ($is_graph) : ?>
	<meta http-equiv="refresh" content="300"> <?php endif ?>
<div class="page-wrapper" style="display: block;">
	<div class="container-fluid">
		<div class="page-breadcrumb">
			<div class="row">
				<div class="col-5 align-self-center">
					<h4 class="page-title"><i class='fas fa-map-marker-alt' style='font-size:21px;color:red'></i> <?= $configurations["sta_nama"]; ?></h4>
				</div>
				<div class="col-2"></div>
				<div class="col-2 text-right">
					<?php if ($is_sampling == 1) : ?>
						<input type="button" onclick="sampling();" class="btn btn-<?= ($is_start_sampling) ? "secondary" : "primary"; ?>" style="height:35px;" value="<?= ($is_start_sampling) ? "Stop Sampling" : "Start Sampling"; ?>">
					<?php endif ?>
				</div>
				<div class="col-3 align-self-right">
					<?php if (isset($nextunit) && count($gass) > 0) : ?>
						<input type="button" onclick="window.location='?unit=<?= $nextunit; ?>';" class="btn btn-outline-light" style="height:35px;" value="Satuan">
					<?php endif; ?>

					<?php if ($pump_control == 1) : ?>
						<input id="pump_state" type="checkbox" data-height="20" data-toggle="toggle" data-on="Pompa 1" data-off="Pompa 2" data-onstyle="success" data-offstyle="primary">
						<div class="text-center" id="remaining"></div>
					<?php endif ?>
				</div>
			</div>
		</div>

		<?php if ($title_partikulat_gas != "") : ?>
			<div class="page-breadcrumb">
				<div class="row">
					<div class="col-12 align-self-center">
						<h4 class="text-center page-title2"><?= $title_partikulat_gas; ?></h4>
					</div>
				</div>
			</div>

			<div class="row text-center">
				<?php if (count($partikulats) > 0) : ?>
					<div class="col-sm-5">
						<div class="row justify-content-center">
							<?php foreach ($partikulats as $partikulat) : ?>
								<div class="col-<?= (12 / count($partikulats)); ?>">
									<div class="card border border-success" <?= (count($partikulats) > 2) ? " style=\"padding:0px 5px 5px 0px;\"" : ""; ?>>
										<?= (count($partikulats) <= 2) ? "<div class=\"card-body\">" : ""; ?>
										<h4 class="card-title"><?= $partikulat['caption'] ?></h4>
										<div class="row">
											<div class="col-12">
												<h3 class="font-light text-right mb-0" id="<?= $partikulat['param_id'] ?>"></h3>
											</div>
										</div>
										<div class="row align-items-center">
											<div class="col-12">
												<?php if (count($partikulatflows) > 0) : ?>
													<p id="<?= $partikulat['param_id'] ?>_flow" class="font-flow" style="margin-bottom: 12px;"></p>
												<?php else : ?>
													<p></p>
												<?php endif ?>

											</div>
										</div>
										<?= (count($partikulats) <= 2) ? "</div>" : ""; ?>
									</div>
								</div>
							<?php endforeach ?>
						</div>
					</div>
				<?php endif ?>
				<div class="<?= (count($partikulats) > 0) ? "col-sm-7" : "col-sm-12"; ?>">
					<?php if (count($gass) > 0) : ?>
						<div class="row">
							<?php foreach ($gass as $gas) : ?>
								<div class="<?php if (count($gass) > 6) : ?> col-3 <?php elseif (count($gass) > 4) : ?> col-4 <?php else : ?> col-6 <?php endif ?>" style="padding:0px 20px 20px 0px;">
									<div class="card border border-primary" style="padding:0px 5px 5px 0px;">
										<h4 class="card-title">&nbsp;<?= $gas['caption'] ?><div style="position:relative;float:right;" id="unit_<?= $gas['param_id'] ?>">(<?= $gas['default_unit'] ?>)</div>
										</h4>
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
					<?php if ($is_graph) : ?>
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div id="graph" style="height:200px;background-color:white;"></div>
								</div>
							</div>
						</div>
					<?php endif ?>
				</div>
			</div>
		<?php endif ?>

		<?php if (@$partikulatattr["pm25_bar"]["is_view"]) : ?>
			<div class="row text-center">
				<div class="col-sm">
					<div class="row justify-content-center">

						<div class="col-sm p-3" style="padding:0px 20px 20px 0px;">
							<div class="card border border-warning">
								<h6 class="card-title">&nbsp;<?= $partikulatattr["pm25_bar"]["caption"] ?></h6>
								<h3 id="<?= $partikulatattr["pm25_bar"]['param_id'] ?>"></h3>
							</div>
						</div>
						<?php if (@$partikulatattr["pm25_humid"]["is_view"]) : ?>
							<div class="col-sm p-3" style="padding:0px 20px 20px 0px;">
								<div class="card border border-warning">
									<h6 class="card-title">&nbsp;<?= $partikulatattr["pm25_humid"]["caption"] ?></h6>
									<h3 id="<?= $partikulatattr["pm25_humid"]['param_id'] ?>"></h3>
								</div>
							</div>
						<?php endif ?>
						<?php if (@$partikulatattr["pm25_temp"]["is_view"]) : ?>
							<div class="col-sm p-3" style="padding:0px 20px 20px 0px;">
								<div class="card border border-warning">
									<h6 class="card-title">&nbsp;<?= $partikulatattr["pm25_temp"]["caption"] ?></h6>
									<h3 id="<?= $partikulatattr["pm25_temp"]['param_id'] ?>"></h3>
								</div>
							</div>
						<?php endif ?>

					</div>
				</div>
			</div>
		<?php endif ?>

		<?php if (@$partikulatattr["pm10_bar"]["is_view"]) : ?>
			<div class="row text-center">
				<div class="col-sm">
					<div class="row justify-content-center">

						<div class="col-sm p-3" style="padding:0px 20px 20px 0px;">
							<div class="card border border-warning">
								<h6 class="card-title">&nbsp;<?= $partikulatattr["pm10_bar"]["caption"] ?></h6>
								<h3 id="<?= $partikulatattr["pm10_bar"]['param_id'] ?>"></h3>
							</div>
						</div>
						<?php if (@$partikulatattr["pm10_humid"]["is_view"]) : ?>
							<div class="col-sm p-3" style="padding:0px 20px 20px 0px;">
								<div class="card border border-warning">
									<h6 class="card-title">&nbsp;<?= $partikulatattr["pm10_humid"]["caption"] ?></h6>
									<h3 id="<?= $partikulatattr["pm10_humid"]['param_id'] ?>"></h3>
								</div>
							</div>
						<?php endif ?>
						<?php if (@$partikulatattr["pm10_temp"]["is_view"]) : ?>
							<div class="col-sm p-3" style="padding:0px 20px 20px 0px;">
								<div class="card border border-warning">
									<h6 class="card-title">&nbsp;<?= $partikulatattr["pm10_temp"]["caption"] ?></h6>
									<h3 id="<?= $partikulatattr["pm10_temp"]['param_id'] ?>"></h3>
								</div>
							</div>
						<?php endif ?>

					</div>
				</div>
			</div>
		<?php endif ?>

		<?php if ($title_cuacas != "") : ?>
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
						<?php foreach ($cuacas as $cuaca) : ?>
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
		<?php endif ?>
	</div>
</div>

<script type="text/javascript">
	function sampling() {
		$.ajax({
			url: "<?= site_url('home/get_sampling_data'); ?>",
			success: function(result) {
				var data = JSON.parse(result);
				var sampling_form = "";
				sampling_form += "<form method='POST' id=\"sampling_form\">";
				sampling_form += "	<input type='hidden' id='startsampling' name='startsampling' value='1'>";
				sampling_form += "	<div class=\"row\">";
				sampling_form += "		<div class='col-6'>";
				sampling_form += "			<div class=\"form-group\">";
				sampling_form += "				<label><b>Serial Number : </b></label>";
				sampling_form += "				<input class=\"form-control\" id=\"device_id\" name=\"device_id\" value=\"" + data.device_id + "\" readonly>";
				sampling_form += "			</div>";
				sampling_form += "		</div>";
				sampling_form += "		<div class='col-6'>";
				sampling_form += "			<div class=\"form-group\">";
				sampling_form += "				<label><b>ID Sampling : </b></label>";
				sampling_form += "				<input class=\"form-control\" id=\"id_sampling\" name=\"id_sampling\" value=\"" + data.id_sampling + "\" readonly>";
				sampling_form += "			</div>";
				sampling_form += "		</div>";
				sampling_form += "		<div class='col-12'>";
				sampling_form += "			<div class=\"form-group\">";
				sampling_form += "				<label><b>Nama Operator : </b></label>";
				sampling_form += "				<input class=\"form-control\" id=\"sampler_operator_name\" name=\"sampler_operator_name\" value=\"" + data.sampler_operator_name + "\">";
				sampling_form += "			</div>";
				sampling_form += "		</div>";
				sampling_form += "		<div class='col-12'>";
				sampling_form += "			<div class=\"form-group\">";
				sampling_form += "				<label><b>Alamat Sampling : </b></label>";
				sampling_form += "				<input class=\"form-control\" id=\"sta_alamat\" name=\"sta_alamat\" value=\"" + data.sta_alamat + "\">";
				sampling_form += "			</div>";
				sampling_form += "		</div>";
				sampling_form += "		<div class='col-6'>";
				sampling_form += "			<div class=\"form-group\">";
				sampling_form += "				<label><b>Latitude : </b></label>";
				sampling_form += "				<input class=\"form-control\" id=\"sta_lat\" name=\"sta_lat\" value=\"" + data.sta_lat + "\">";
				sampling_form += "			</div>";
				sampling_form += "		</div>";
				sampling_form += "		<div class='col-6'>";
				sampling_form += "			<div class=\"form-group\">";
				sampling_form += "				<label><b>Longitude : </b></label>";
				sampling_form += "				<input class=\"form-control\" id=\"sta_lon\" name=\"sta_lon\" value=\"" + data.sta_lon + "\">";
				sampling_form += "			</div>";
				sampling_form += "		</div>";
				sampling_form += "	</div>";
				sampling_form += "</form>";

				$('#modal_title').html('Sampling');
				$('#modal_message').html(sampling_form);
				$('#modal_type').attr("class", 'modal-content bg-primary');
				$('#modal_ok_link').attr("href", "javascript:sampling_form.submit();");
				$('#modal_ok_link').html("Start");
				<?php if ($is_start_sampling) : ?>
					$('#startsampling').val("2");
					$('#modal_ok_link').html("Stop");
				<?php endif ?>
				$('#modal-form').modal();
			}
		});
	}

	<?php if (isset($_startsampling)) : ?>
		sampling();
	<?php endif ?>

	function padnum(number) {
		if (number < 9)
			return "0" + number;
		else
			return number;
	}

	$(function() {
		$('#pump_state').change(function() {
			$.ajax({
				url: "<?= site_url('sensors/change_pump_state'); ?>?state=" + $('#pump_state').prop('checked'),
				success: function(result) {}
			});
		})
	})

	function put_data_to_vps() {
		$.ajax({
			url: "http://127.0.0.1/aqmmaster/put_data.php",
			success: function(result) {}
		});
		$.ajax({
			url: "http://127.0.0.1/aqmmaster/put_data_v2.php",
			success: function(result) {}
		});
		setTimeout(function() {
			put_data_to_vps()
		}, 60000);
	}

	function reload_sensor() {
		$.ajax({
			url: "<?= site_url('home/graph'); ?>",
			success: function(graphview) {
				try {
					$("#graph").html(graphview);
				} catch (ex) {}
			}
		});
		$.ajax({
			url: "<?= site_url('sensors'); ?>?unit=<?= $_GET["unit"]; ?>",
			success: function(result) {
				var sensor = JSON.parse(result);
				try {
					$("#pm10").html((sensor.pm10 * 1000).toFixed(1) + " " + <?= (count($partikulats) > 2) ? "\"<div style='margin-top:10px;font-size:16px;'>(\" + sensor.pm10_unit + \")</div>\"" : "sensor.pm10_unit"; ?>);
				} catch (ex) {}
				try {
					$("#pm10_flow").html(sensor.pm10_flow + " " + sensor.pm10_flow_unit);
				} catch (ex) {}
				try {
					$("#pm10_bar").html(sensor.pm10_bar + "</h3><br><h6>" + sensor.pm10_bar_unit + "</h6>");
				} catch (ex) {}
				try {
					$("#pm10_humid").html(sensor.pm10_humid + "&nbsp;" + sensor.pm10_humid_unit + "</h3><br><h6>&nbsp;</h6>");
				} catch (ex) {}
				try {
					$("#pm10_temp").html(sensor.pm10_temp + "</h3><br><h6>" + sensor.pm10_temp_unit + "</h6>");
				} catch (ex) {}
				try {
					$("#pm25").html((sensor.pm25 * 1000).toFixed(1) + " " + <?= (count($partikulats) > 2) ? "\"<div style='margin-top:10px;font-size:16px;'>(\" + sensor.pm25_unit + \")</div>\"" : "sensor.pm25_unit"; ?>);
				} catch (ex) {}
				try {
					$("#pm25_flow").html(sensor.pm25_flow + " " + sensor.pm25_flow_unit);
				} catch (ex) {}
				try {
					$("#pm25_bar").html(sensor.pm25_bar + "</h3><br><h6>" + sensor.pm25_bar_unit + "</h6>");
				} catch (ex) {}
				try {
					$("#pm25_humid").html(sensor.pm25_humid + "&nbsp;" + sensor.pm25_humid_unit + "</h3><br><h6>&nbsp;</h6>");
				} catch (ex) {}
				try {
					$("#pm25_temp").html(sensor.pm25_temp + "</h3><br><h6>" + sensor.pm25_temp_unit + "</h6>");
				} catch (ex) {}
				try {
					$("#tsp").html((sensor.tsp * 1000).toFixed(1) + " " + <?= (count($partikulats) > 2) ? "\"<div style='margin-top:10px;font-size:16px;'>(\" + sensor.tsp_unit + \")</div>\"" : "sensor.tsp_unit"; ?>);
				} catch (ex) {}
				try {
					$("#tsp_flow").html(sensor.tsp_flow + " " + sensor.tsp_flow_unit);
				} catch (ex) {}
				try {
					$("#so2").html(sensor.so2);
				} catch (ex) {}
				try {
					$("#unit_so2").html("(" + sensor.so2_unit + ")");
				} catch (ex) {}
				try {
					$("#co").html(sensor.co);
				} catch (ex) {}
				try {
					$("#unit_co").html("(" + sensor.co_unit + ")");
				} catch (ex) {}
				try {
					$("#o3").html(sensor.o3);
				} catch (ex) {}
				try {
					$("#unit_o3").html("(" + sensor.o3_unit + ")");
				} catch (ex) {}
				try {
					$("#no2").html(sensor.no2);
				} catch (ex) {}
				try {
					$("#unit_no2").html("(" + sensor.no2_unit + ")");
				} catch (ex) {}
				try {
					$("#voc").html(sensor.voc);
				} catch (ex) {}
				try {
					$("#unit_voc").html("(" + sensor.voc_unit + ")");
				} catch (ex) {}
				try {
					$("#hc").html(sensor.hc);
				} catch (ex) {}
				try {
					$("#unit_hc").html("(" + sensor.hc_unit + ")");
				} catch (ex) {}
				try {
					$("#h2s").html(sensor.h2s);
				} catch (ex) {}
				try {
					$("#unit_h2s").html("(" + sensor.h2s_unit + ")");
				} catch (ex) {}
				try {
					$("#cs2").html(sensor.cs2);
				} catch (ex) {}
				try {
					$("#unit_cs2").html("(" + sensor.cs2_unit + ")");
				} catch (ex) {}
				try {
					$("#nh3").html(sensor.nh3);
				} catch (ex) {}
				try {
					$("#unit_nh3").html("(" + sensor.nh3_unit + ")");
				} catch (ex) {}
				try {
					$("#nmhc").html(sensor.nmhc);
				} catch (ex) {}
				try {
					$("#unit_nmhc").html("(" + sensor.nmhc_unit + ")");
				} catch (ex) {}
				try {
					$("#ch4").html(sensor.ch4);
				} catch (ex) {}
				try {
					$("#unit_ch4").html("(" + sensor.ch4_unit + ")");
				} catch (ex) {}
				try {
					$("#WindSpeed").html(sensor.WindSpeed + "</h3><br><h6>" + sensor.WindSpeed_unit + "</h6>");
				} catch (ex) {}
				try {
					$("#WindDir").html(sensor.WindDir + sensor.WindDir_unit + "</h3><br><h6>&nbsp;</h6>");
				} catch (ex) {}
				try {
					$("#TempIn").html(sensor.TempIn + "</h3><br><h6>" + sensor.TempIn_unit + "</h6>");
				} catch (ex) {}
				try {
					$("#TempOut").html(sensor.TempOut + "</h3><br><h6>" + sensor.TempOut_unit + "</h6>");
				} catch (ex) {}
				try {
					$("#Barometer").html(sensor.Barometer + "</h3><br><h6>" + sensor.Barometer_unit + "</h6>");
				} catch (ex) {}
				try {
					$("#RainDay").html(sensor.RainDay + "</h3><br><h6>" + sensor.RainDay_unit + "</h6>");
				} catch (ex) {}
				try {
					$("#RainRate").html(sensor.RainRate + "</h3><br><h6>" + sensor.RainRate_unit + "</h6>");
				} catch (ex) {}
				try {
					$("#SolarRad").html(sensor.SolarRad + "</h3><br><h6>" + sensor.SolarRad_unit + "</h6>");
				} catch (ex) {}
				try {
					$("#HumIn").html(sensor.HumIn + "&nbsp;" + sensor.HumIn_unit + "</h3><br><h6>&nbsp;</h6>");
				} catch (ex) {}
				try {
					$("#HumOut").html(sensor.HumOut + "&nbsp;" + sensor.HumOut_unit + "</h3><br><h6>&nbsp;</h6>");
				} catch (ex) {}
				try {
					if (sensor.pump_state == "0" && $('#pump_state').prop('checked') == true) $("#pump_state").bootstrapToggle('off');
					else if (sensor.pump_state == "1" && $('#pump_state').prop('checked') == false) $("#pump_state").bootstrapToggle('on');
				} catch (ex) {}
				try {
					var pump_last = new Date(sensor.pump_last.replace(" ", "T"));
					var current = new Date(sensor.now.replace(" ", "T"));
					var pump_state_time = (current - pump_last) / 1000;
					var remaining = (sensor.pump_interval * 60) - pump_state_time;
					var remaining_h = Math.floor(remaining / 3600);
					var remaining_m = Math.floor((remaining - (remaining_h * 3600)) / 60);
					var remaining_s = Math.floor(remaining % 60);
					$("#remaining").html(padnum(remaining_h) + ":" + padnum(remaining_m) + ":" + padnum(remaining_s));
					if ((sensor.pump_interval * 60) <= pump_state_time) {
						if ($('#pump_state').prop('checked') == true) $("#pump_state").bootstrapToggle('off');
						else if ($('#pump_state').prop('checked') == false) $("#pump_state").bootstrapToggle('on');
					}
				} catch (ex) {}
			}
		});
		<?php if (isset($is_start_sampling)) : ?>
			<?php if ($is_start_sampling == "1") : ?>
				$.ajax({
					url: "<?= site_url('mqtt_data.php'); ?>?mode=send_data_sampler",
					success: function(result) {}
				});
			<?php endif ?>
			$.ajax({
				url: "<?= site_url('mqtt_data.php'); ?>?mode=send_data_sampling",
				success: function(result) {}
			});
		<?php endif ?>
		setTimeout(function() {
			reload_sensor()
		}, 1000);
	}
	reload_sensor();
	put_data_to_vps();
</script>