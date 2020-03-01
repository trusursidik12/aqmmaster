<div class="container-fluid">
  <br>
  <h3 class="text-center">Export Data</h3>

  <div class="card">
  	<div class="row" style="padding-bottom: 50px;">
  		<div class="col-sm">
  			<div class="card-body table-responsive">
  				<div class="row p-1">
					<form class="form-inline"  method="post" >
		                <div class="form-group">
		                  <label for="fromdate">&emsp;Mulai Dari : </label>
		                  <input type="date"  id="datepicker1" value="<?php echo set_value('fromdate'); ?>" class="form-control"  placeholder="FROM DATE" required>
		                </div>
		                <div class="form-group">
		                  <label for="todate">&emsp;Sampai Dengan : </label>
		                    <input type="date"  id="datepicker2" value="<?php echo set_value('todate'); ?>" class="form-control"  placeholder="TO DATE" required>
		                </div>
		                <div class="form-group">
		                    &emsp;&emsp;&emsp;<button type="submit" id="search"  class="btn btn-primary">SEARCH</button>
		                </div>
	               </form>
				</div>
  				<table id="myTable" class="table table-bordered table-striped">
  					<thead>
	  					<tr>
	  						<th>No.</th>
	  						<th>Stasiun</th>
	  						<th>Waktu</th>
	  						<th>PM10</th>
	  						<th>PM25</th>
	  						<th>SO2</th>
	  						<th>CO</th>
	  						<th>O3</th>
	  						<th>NO2</th>
	  						<th>KEC. ANGIN</th>
	  						<th>ARAH ANGIN</th>
	  						<th>KELEMBABAN</th>
	  						<th>TEMPERATUR</th>
	  						<th>TEKANAN</th>
	  						<th>SOLAR RADIASI</th>
	  						<th>CURAH HUJAN</th>
	  					</tr>
	  				</thead>
  				</table>
		    </div>
  		</div>
  	</div>
  </div>
</div>
<script>
	$(document).ready(function () {
    	
        var dataTable =  $('#myTable').DataTable( {
			processing:true,
			serverSide: true,
			"ajax": {
				"url": "<?php echo base_url('data/ajax'); ?>",
				"type": "POST",
				"data":function(data) {
					data.from = $('#datepicker1').val();
					data.to = $('#datepicker2').val();
				},
			},
			dom: "lBfrtip",
			buttons: ['excel','pdf'],
		} );
		
		$('#search').on( 'click change', function (event) {
			event.preventDefault();

			if($('#datepicker1').val()=="")
			{
				$('#datepicker1').focus();
			}
			else if($('#datepicker2').val()=="")
			{
				$('#datepicker2').focus();
			}
			else
			{
				dataTable.draw();
			}

		} );

    });
  </script>