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
								<th>Id</th>
								<th>Caption</th>
								<th>Satuan</th>
								<th>Berat<br>Molekul</th>
							</tr>
							<?php foreach($alldata as $data) : ?>
								<tr>
									<td><input type="checkbox" class="form-control" id="is_view[<?= $data["param_id"];?>]" name="is_view[<?= $data["param_id"];?>]" value="1" <?php if($data["is_view"] == "1") :?> checked <?php endif ?>></td>
									<td><?= $data['param_id']; ?></td>
									<td><input class="form-control" id="caption[<?= $data["param_id"];?>]" name="caption[<?= $data["param_id"];?>]" value="<?= $data["caption"];?>"></td>
									<td><input class="form-control" id="default_unit[<?= $data["param_id"];?>]" name="default_unit[<?= $data["param_id"];?>]" value="<?= $data["default_unit"];?>"></td>
									<td><input class="form-control" id="molecular_mass[<?= $data["param_id"];?>]" name="molecular_mass[<?= $data["param_id"];?>]" value="<?= $data["molecular_mass"];?>"></td>
								</tr>
								<?php if($data["molecular_mass"] > 0) : ?>
									<tr>
										<td>&nbsp;</td>
										<td align="right">Formula : </td>
										<td colspan="3"><input class="form-control" id="formula[<?= $data["param_id"];?>]" name="formula[<?= $data["param_id"];?>]" value="<?= $data["formula"];?>"></td>
									</tr>
								<?php endif ?>
							<?php endforeach ?>
						</tbody>
					</table>
					<div class="card" style="padding:10px;">
						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
					</div>
				</form>
		    </div>
  		</div>
  	</div>
  </div>
</div>