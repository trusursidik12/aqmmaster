<div class="container-fluid">
	<br>
	<h3 class="text-center">Kalibrasi</h3>
	<div class="card text-center" style="padding:10px;">
		<div class="row" style="padding-bottom: 50px;">
			<?php if ($selenoid_names[0] != "") : ?>
				<?php foreach ($selenoid_names as $key => $selenoid_name) : ?>
					<div class="col-sm-4">
						<input type="button" onclick="window.location='?selenoid_command=<?= $selenoid_commands[$key]; ?>';" class="btn btn-info" style="height:35px;" value="<?= $selenoid_name; ?>">
					</div>
				<?php endforeach ?>
			<?php endif ?>
		</div>
		<?php foreach ($gass as $gas) : ?>
			<div class="row" style="padding-bottom: 30px;">
				<div class="col-sm-6">
					<input type="button" onclick="window.location='<?= base_url(); ?>kalibrasi/kalibrasi_gas/zero/<?= $gas['id']; ?>';" class="btn btn-info" style="height:35px;" value="Zero Calibration <?= $gas['caption']; ?>">
				</div>
				<div class="col-sm-6">
					<input type="button" onclick="window.location='<?= base_url(); ?>kalibrasi/kalibrasi_gas/span/<?= $gas['id']; ?>';" class="btn btn-info" style="height:35px;" value="Span Calibration <?= $gas['caption']; ?>">
				</div>
			</div>
		<?php endforeach ?>
		<div class="row" style="padding-top: 50px;">
			<div class="col-sm-2"></div>
			<div class="col-sm-4">
				<input type="button" onclick="window.location='?purge_command=p';" class="btn btn-info" style="height:35px;" value="Purge Open">
			</div>
			<div class="col-sm-4">
				<input type="button" onclick="window.location='?purge_command=o';" class="btn btn-info" style="height:35px;" value="Purge Close">
			</div>
			<div class="col-sm-2"></div>
		</div>
	</div>
</div>
<br>
<br>
<br>
<br>