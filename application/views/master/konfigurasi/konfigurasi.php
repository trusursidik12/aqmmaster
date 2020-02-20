<div class="container-fluid">
  <br>
  <h3 class="text-center">Kalibrasi</h3>

  <div class="card">
  	<div class="row" style="padding-bottom: 50px;">
  		<div class="col-sm">
  			<div class="table-responsive">
		        <table class="table">
		          <thead>
                <thead class="thead-dark">
		          <tr class="text-center">
		            <th>DATA</th>
                <th>KONTEN</th>
                <th>ACTIONS</th>
		          </thead>
		          <tbody>
		          <?php foreach($alldata as $data) : ?>
		          <tr>
		            <td><?= $data['data']; ?></td>
                <td style="color: red"><?= $data['content']; ?></td>
                <td>ACTION</td>
		          </tr>
		          <?php endforeach ?>
		          </tbody>
		        </table>
		      </div>
  		</div>
  	</div>
  </div>
</div>