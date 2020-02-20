<div class="container-fluid">
  <br>
  <h3 class="text-center">Parameter</h3>

  <div class="card">
  	<div class="row" style="padding-bottom: 50px;">
  		<div class="col-sm">
  			<div class="table-responsive">
		        <table class="table">
		          <thead>
                <thead class="thead-dark">
		          <tr class="text-center">
		            <th>Parameter Id</th>
                <th>Keterangan</th>
                <th>Satuan</th>
                <th>Aksi</th>
		          </thead>
		          <tbody>
		          <?php foreach($alldata as $data) : ?>
		          <tr>
		            <td class="<?php if(empty($data['is_view'])) { ?>table-danger <?php } ?>"><?= $data['param_id']; ?></td>
                <td class="<?php if(empty($data['is_view'])) { ?>table-danger <?php } ?>"><?= $data['caption']; ?></td>
                <td class="<?php if(empty($data['is_view'])) { ?>table-danger <?php } ?>"><?= $data['satuan']; ?></td>
                <td class="<?php if(empty($data['is_view'])) { ?>table-danger <?php } ?>">
                  <a href="<?= site_url('/parameter/edit/'.$data['id']) ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                </td>
		          </tr>
		          <?php endforeach ?>
		          </tbody>
		        </table>
		      </div>
  		</div>
  	</div>
  </div>
</div>