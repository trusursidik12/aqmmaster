<div class="container-fluid">
	<br>
	<h3 class="text-center">Konfigurasi</h3>

	<div class="card" style="padding:10px;">
		<div class="row" style="padding-bottom: 50px;">
			<div class="col-sm">
				<form>
					<?php foreach($configurations as $_configurations) : ?>
						<div class="form-group">
							<label><b><?= $_configurations["caption"];?> : </b></label>
							<input class="form-control" id="<?= $_configurations["id"];?>" name="<?= $_configurations["id"];?>" value="<?= $_configurations["value"];?>">
						</div>
					<?php endforeach ?>
					<?php foreach($serial_devices as $_serial_devices) : ?>
						<div class="form-group">
							<label><b><?= $_serial_devices["caption"];?> : </b></label>
							<div class="row" style="padding:0px;">
								<div class="col-1 text-right">Port : </div>
								<div class="col-4"> 
									<input class="form-control" id="<?= $_serial_devices["com_id"];?>" name="<?= $_serial_devices["com_id"];?>" value="<?= $_serial_devices["com_value"];?>">
								</div>
								<div class="col-1"></div> 
								<div class="col-1 text-right">Baud : </div>
								<div class="col-4">
									<input class="form-control" id="<?= $_serial_devices["baud_id"];?>" name="<?= $_serial_devices["baud_id"];?>" value="<?= $_serial_devices["baud_value"];?>">
								</div>
								<div class="col-1"></div> 
							</div>
						</div>
					<?php endforeach ?>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</div>