<div class="container-fluid">
	<br>
	<h3 class="text-center">Span Kalibrasi <?= $param["caption"]; ?></h3>
	<form method="POST">
		<div class="card text-center" style="padding:10px;">
			<div class="row" style="padding-bottom: 50px;">
				<div class="col-sm-4">
					<div class="form-group">
						<label>Voltage Field</label>
						<select id="voltage_field" name="voltage_field" class="form-control">
							<option value=""></option>
							<?php for ($ii = 0; $ii < 16; $ii++) : ?>
								<option value="AIN<?= $ii; ?>" <?= ($param["voltage_field"] == "AIN" . $ii) ? "selected" : ""; ?>>AIN<?= $ii; ?></option>
							<?php endfor ?>
						</select>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label>Span Concentration</label>
						<input id="span_concentration" name="span_concentration" value="<?= $param["span_concentration"]; ?>" class="form-control">
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group">
						<label>Span Voltage</label>
						<div class="input-group">
							<input id="span_voltage" name="span_voltage" value="<?= $param["span_voltage"]; ?>" class="form-control">
							<span class="input-group-btn">
								<button type="button" class="btn btn-info btn-flat" onclick="$('#voltage').val($('#span_voltage').val());$('#simpan').click();"><i class="fas fa-check"></i></button>
							</span>
						</div>
					</div>
				</div>
			</div>
			<div class="row" style="padding-bottom: 50px;">
				<div class="col-sm-4">
					<div class="form-group">
						<label>Voltage</label>
						<input id="voltage" name="voltage" class="form-control">
					</div>
				</div>
				<div class="col-sm-8">
					<div class="form-group">
						<label>Formula</label>
						<input type="text" class="form-control" value="<?= $param['formula'] ?>">
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-sm-4">
					<div class="d-flex align-items-end flex-column">
						<div class="p-2">
							<input style="margin-bottom: 45px; margin-left: 10px;" type="submit" id="simpan" name="simpan" value="Simpan" class="position-fixed fixed-bottom btn btn-primary btn-circle ">
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<br>
<br>
<br>
<br>

<script>
	function reload_sensor() {
		$.ajax({
			url: "<?= site_url('kalibrasi/show_sensor_values'); ?>",
			success: function(result) {
				var sensor = JSON.parse(result);
				try {
					$("#voltage").val(sensor.<?= $param["voltage_field"]; ?>);
				} catch (ex) {}
			}
		});
		setTimeout(function() {
			reload_sensor()
		}, 1000);
	}
	reload_sensor();
</script>