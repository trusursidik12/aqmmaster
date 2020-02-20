<div class="container-fluid">
  <br>
  <h3 class="text-center">Konfigurasi</h3>

  <div class="card">
  	<div class="row" style="padding-bottom: 50px;">
  		<div class="col-sm">
  			<div class="table-responsive">
		        <table class="table">
		          <tr class="bg-primary text-center text-light">
		            <th>Data</th>
                <th>Konten</th>
                <th>Aksi</th>
              </tr>
		          <tbody>
		          <?php foreach($alldata as $data) : ?>
		          <tr>
		            <td class="<?php if(empty($data['is_view'])) { ?>bg-danger <?php } ?>"><?= $data['data']; ?></td>
                <td class="<?php if(empty($data['is_view'])) { ?>bg-danger <?php } ?>"><?= $data['content']; ?></td>
                <td class="<?php if(empty($data['is_view'])) { ?>bg-danger <?php } ?>">
                  <a href="<?= site_url('/konfigurasi/edit/'.$data['id']) ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
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