<div class="container-fluid">
  <br>
  <h3 class="text-center"></h3>
  <br>
</div>

<div class="container-fluid" style="padding-bottom: 50px;">
	<div class="card p-3 body-position">
		<form role="form" action="<?= site_url('kalibrasi/update') ?>" method="post">
		  	<div class="form-row">
			  	<?php foreach($alldata as $data) : ?>
				    <div class="form-group col-md-2">
				      <label for="inputEmail4"><?= $data['data'] ?></label>
				      <input type="text" name="<?= $data['id'] ?>" value="<?= $data['id'] ?>">
				      <input type="text" name="<?= $data['data'] ?>" value="<?= $data['content'] ?>" class="form-control" placeholder="<?= $data['data'] ?>">
				    </div>
				<?php endforeach ?>
		  	</div>
		  	<button type="submit" class="btn btn-primary">Save</button>
		</form>
	</div>
</div>