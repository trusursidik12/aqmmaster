<div class="container-fluid">
	<br>
	<h3 class="text-center">Kalibrasi</h3>

	<div class="card" style="padding:10px;">
		<div class="row" style="padding-bottom: 50px;">
			<?php foreach($selenoid_names as $key => $selenoid_name): ?>
				<div class="col-2">
					<input type="button" onclick="window.location='?selenoid_command=<?= $selenoid_commands[$key]; ?>';" class="btn btn-info" style="height:35px;" value="<?=$selenoid_name;?>">
				</div>
			<?php endforeach ?>
			</div>
		</div>
		<div class="row" style="padding-bottom: 50px;">
			<div class="col-2">
				<input type="button" onclick="window.location='?purge_command=p';" class="btn btn-info" style="height:35px;" value="Purge Open">
			</div>
			<div class="col-2">
				<input type="button" onclick="window.location='?purge_command=o';" class="btn btn-info" style="height:35px;" value="Purge Close">
			</div>
		</div>
	</div>
</div>