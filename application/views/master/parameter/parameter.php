<div class="container-fluid">
	<br>
	<h3 class="text-center">Parameter</h3>

	<div class="card">
		<div class="row" style="padding-bottom: 50px;">
			<div class="col-sm">
				<div class="table-responsive">
					<form method="POST">
						<table class="table">
							<tbody>
								<tr class="bg-primary text-center text-light">
									<th>Show</th>
									<th>w/ Graph</th>
									<th>Id</th>
									<th>Caption</th>
									<th>Satuan</th>
									<th>Berat<br>Molekul</th>
								</tr>
								<?php foreach ($alldata as $data) : ?>
									<tr>
										<td>
											<div class="icheck-success d-inline">
												<input type="checkbox" id="<?= $data['param_id'] ?>" id="is_view[<?= $data["param_id"]; ?>]" name="is_view[<?= $data["param_id"]; ?>]" value="1" <?php if ($data["is_view"] == "1") : ?> checked <?php endif ?>>
												<label for="<?= $data['param_id'] ?>"></label>
											</div>
										</td>
										<td>
											<div class="icheck-success d-inline">
												<input type="checkbox" id="<?= $data['param_id'] ?>2" id="is_graph[<?= $data["param_id"]; ?>]" name="is_graph[<?= $data["param_id"]; ?>]" value="1" <?php if ($data["is_graph"] == "1") : ?> checked <?php endif ?>>
												<label for="<?= $data['param_id'] ?>2"></label>
											</div>
										</td>
										<td><?= $data['param_id']; ?></td>
										<td><input class="form-control" id="caption[<?= $data["param_id"]; ?>]" name="caption[<?= $data["param_id"]; ?>]" value="<?= $data["caption"]; ?>"></td>
										<td><input class="form-control" id="default_unit[<?= $data["param_id"]; ?>]" name="default_unit[<?= $data["param_id"]; ?>]" value="<?= $data["default_unit"]; ?>"></td>
										<td><input class="form-control" id="molecular_mass[<?= $data["param_id"]; ?>]" name="molecular_mass[<?= $data["param_id"]; ?>]" value="<?= $data["molecular_mass"]; ?>"></td>
									</tr>
									<?php if ($data["molecular_mass"] > 0) : ?>
										<tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td align="right">Formula : </td>
											<td colspan="3"><input class="form-control" id="formula[<?= $data["param_id"]; ?>]" name="formula[<?= $data["param_id"]; ?>]" value="<?= $data["formula"]; ?>"></td>
										</tr>
										<!--tr>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>
												Voltage Field:<br>
												<input class="form-control" id="voltage_field[<?= $data["param_id"]; ?>]" name="voltage_field[<?= $data["param_id"]; ?>]" value="<?= $data["voltage_field"]; ?>">
											</td>
											<td>
												Span Concentration:<br>
												<input class="form-control" id="span_concentration[<?= $data["param_id"]; ?>]" name="span_concentration[<?= $data["param_id"]; ?>]" value="<?= $data["span_concentration"]; ?>">
											</td>
											<td>
												Zero Voltage:<br>
												<input class="form-control" id="zero_voltage[<?= $data["param_id"]; ?>]" name="zero_voltage[<?= $data["param_id"]; ?>]" value="<?= $data["zero_voltage"]; ?>">
											</td>
											<td>
												Span Voltage:<br>
												<input class="form-control" id="span_voltage[<?= $data["param_id"]; ?>]" name="span_voltage[<?= $data["param_id"]; ?>]" value="<?= $data["span_voltage"]; ?>">
											</td>
										</tr-->
										<tr>
											<td colspan="6" bgcolor="LightGray"></td>
										</tr>
									<?php endif ?>
								<?php endforeach ?>
							</tbody>
						</table>
						<div class="d-flex align-items-end flex-column">
							<div class="p-2">
								<input style="margin-bottom: 45px; margin-left: 10px;" type="submit" name="simpan" value="Simpan" class="position-fixed fixed-bottom btn btn-primary btn-circle">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>