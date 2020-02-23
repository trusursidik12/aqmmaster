<div class="container-fluid">
	<br>
	<h3 class="text-center">Konfigurasi</h3>

	<div class="card" style="padding:10px;">
		<div class="row" style="padding-bottom: 50px;">
			<div class="col-sm">
				<form method="POST">
					<div class="row">
						<?php foreach($configurations as $_configurations) : ?>
								<div class="col-6"> 
									<div class="form-group">
										<label><b><?= $_configurations["caption"];?> : </b></label>
										<input class="form-control" id="<?= $_configurations["id"];?>" name="<?= $_configurations["id"];?>" value="<?= $_configurations["value"];?>">
									</div>
								</div>
						<?php endforeach ?>
					</div>
					<?php foreach($serial_devices as $_serial_devices) : ?>
						<div class="form-group">
							<label><b><?= $_serial_devices["caption"];?> : </b></label>
							<div class="row" style="padding:0px;">
								<div class="col-1 text-right">Port : </div>
								<div class="col-7"> 
									<select class="form-control" id="<?= $_serial_devices["com_id"];?>" name="<?= $_serial_devices["com_id"];?>">
										<option value=""></option>
										<?php if(!isset($serial_ports[$_serial_devices["com_value"]])) : ?>
											<option value="<?= $_serial_devices["com_value"]; ?>" selected><?= $_serial_devices["com_value"]; ?></option>
										<?php endif ?>
										<?php foreach($serial_ports as $port => $description) : ?>
											<option value="<?= $port; ?>" <?php if($port == $_serial_devices["com_value"]) : ?> selected <?php endif ?>>
												<?= $port; ?> : <?= $description; ?>
											</option>
										<?php endforeach ?>
									</select>
								</div>
								<div class="col-1 text-right">Baud : </div>
								<div class="col-2">
									<select class="form-control" id="<?= $_serial_devices["baud_id"];?>" name="<?= $_serial_devices["baud_id"];?>">
										<?php foreach($bauds as $baud) : ?>
											<option value="<?= $baud; ?>" <?php if($baud == $_serial_devices["baud_value"]) : ?> selected <?php endif ?>> <?= $baud; ?> </option>
										<?php endforeach ?>
									</select>
								</div>
								<div class="col-1"></div> 
							</div>
						</div>
					<?php endforeach ?>
					<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
				</form>
			</div>
		</div>
	</div>
</div>