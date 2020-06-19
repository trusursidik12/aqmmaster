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
					<!--div class="row">
						<div class="col-3"> 
							<label><b>Date Time : </b></label>
						</div>
					</div>
					<div class="row">
						<div class="col-3"> 
							<div class="form-group">
								<input class="form-control" id="x_date" name="x_date" value="<?= date("Y-m-d");?>" type="date">
							</div>
						</div>
						<div class="col-3"> 
							<div class="form-group">
								<input class="form-control" id="x_time" name="x_time" value="<?= date("H:i:s");?>" type="time">
							</div>
						</div>
						<div class="col-6">
							<input class="btn btn-primary" id="savedatetime" name="savedatetime" value="Save Date Time" type="button" onclick="window.location='?savedatetime=1&date=' + x_date.value + '&time=' + x_time.value;">
						</div>
					</div-->
					<?php foreach($serial_devices as $_serial_devices) : ?>
						<div class="form-group">
							<label><b><?= $_serial_devices["caption"];?> : </b></label>
							<div class="row" style="padding:0px;">
								<div class="col-1 text-right">Port : </div>
								<div class="col-5">
									<input class="form-control" id="<?= $_serial_devices["com_id"];?>" name="<?= $_serial_devices["com_id"];?>" value="<?= $_serial_devices["com_value"];?>">
								</div>
								<div class="col-1 text-right">Baud : </div>
								<div class="col-4">
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
					<div class="d-flex align-items-end flex-column">
						<div class="p-2">
							<input style="margin-bottom: 45px; margin-left: 10px;" type="submit" name="simpan" value="Simpan" class="position-fixed fixed-bottom btn btn-primary btn-circle ">
						</div>
					</div>
				</form>
				<div>
				<div class="row">
					<div class="col-1"></div>
					<div class="col-5" style="background-color:white;">
						<b><u>PORTS : </u></b><br>
						<?php if(count($serial_ports) > 0): ?>
							<?php foreach($serial_ports as $port => $description) : ?><?= $port; ?> : <?= $description; ?><br><?php endforeach ?>
						<?php endif ?>
					</div>
					<div class="col-6"></div>
				</div>
			</div>
		</div>
	</div>
</div>