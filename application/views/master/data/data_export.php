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
		                  <label for="fromdate">&emsp;Mulai Dari&nbsp;&nbsp;:&nbsp;&nbsp;</label>
		                  <input type="date"  id="datepicker1" value="" class="form-control"  placeholder="FROM DATE" required>
		                </div>
		                <div class="form-group">
		                  <label for="todate">&emsp;Sampai Dengan&nbsp;&nbsp;:&nbsp;&nbsp;</label>
		                    <input type="date"  id="datepicker2" value="" class="form-control"  placeholder="TO DATE" required>
		                </div>
		                <div class="form-group">
		                    &emsp;&emsp;&emsp;<button type="submit" id="search"  class="btn btn-primary">SEARCH</button>
		                </div>
	               </form>
				</div>
  				<table id="myTable" class="table table-bordered table-striped" style="white-space: nowrap;">
  					<thead>
	  					<tr>
	  						<th>No.</th>
	  						<th>Stasiun</th>
	  						<th>Waktu</th>
							<?php if(@$params["pm10"]) : ?> <th>PM10</th> <?php endif ?>
	  						<?php if(@$params["pm25"]) : ?> <th>PM2.5</th> <?php endif ?>
	  						<?php if(@$params["so2"]) : ?> <th>SO2</th> <?php endif ?>
	  						<?php if(@$params["co"]) : ?> <th>CO</th> <?php endif ?>
	  						<?php if(@$params["o3"]) : ?> <th>O3</th> <?php endif ?>
	  						<?php if(@$params["no2"]) : ?> <th>NO2</th> <?php endif ?>
	  						<?php if(@$params["hc"]) : ?> <th>HC</th> <?php endif ?>
	  						<?php if(@$params["voc"]) : ?> <th>VOC</th> <?php endif ?>
	  						<?php if(@$params["nh3"]) : ?> <th>NH3</th> <?php endif ?>
	  						<?php if(@$params["h2s"]) : ?> <th>H2S</th> <?php endif ?>
	  						<?php if(@$params["cs2"]) : ?> <th>CS2</th> <?php endif ?>
	  						<?php if(@$params["ws"]) : ?> <th>Kec. Angin</th> <?php endif ?>
	  						<?php if(@$params["wd"]) : ?> <th>Arah Angin</th> <?php endif ?>
	  						<?php if(@$params["humidity"]) : ?> <th>Kelembaban</th> <?php endif ?>
	  						<?php if(@$params["temperature"]) : ?> <th>Temperatur</th> <?php endif ?>
	  						<?php if(@$params["pressure"]) : ?> <th>Tekanan</th> <?php endif ?>
	  						<?php if(@$params["sr"]) : ?> <th>Solar Radiasi</th> <?php endif ?>
	  						<?php if(@$params["rain_intensity"]) : ?> <th>Curah Hujan</th> <?php endif ?>
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
			"pageLength": 50,
			"searching": false,
			"lengthChange": false,
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