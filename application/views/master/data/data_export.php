<div class="container-fluid">
  <br>
  <h3 class="text-center">Export Data</h3>

  <div class="card">
  	<div class="row" style="padding-bottom: 50px;">
  		<div class="col-sm">
  			<div class="card-body table-responsive">
  				<div class="row p-1">
					<div class="col-sm input-daterange">
						<div class="row">
							<div class="col-sm">
								<input type="text" name="start_date" id="start_date" class="form-control" />
							</div>
							<div class="col-sm">
								<input type="text" name="end_date" id="end_date" class="form-control" />
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<input type="button" name="search" id="search" value="Search" class="btn btn-info" />
					</div>
				</div>
  				<table id="tablesrv" class="table table-bordered table-striped">
  					<thead>
	  					<tr>
	  						<th>No.</th>
	  						<th>Stasiun</th>
	  						<th>Waktu</th>
	  						<th>PM10</th>
	  						<th>PM25</th>
	  					</tr>
	  				</thead>
	  				<tbody>
	  				</tbody>
  				</table>
		    </div>
  		</div>
  	</div>
  </div>
</div>
<script>
	$('.input-daterange').datepicker({
	todayBtn:'linked',
	format: "yyyy-mm-dd",
	autoclose: true
	});

    $(document).ready(function() {
      $('#tablesrv').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
          "url" : "<?= site_url('data/get_ajax') ?>",
          "type" : "POST"
        }
      })
    })
  </script>