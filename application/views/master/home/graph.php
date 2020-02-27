<link rel="stylesheet" href="<?= base_url('assets/dist/css/bootstrap.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/dist/css/morris.css') ?>">
<script src="<?= base_url('assets/dist/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/raphael-min.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/morris.min.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/dist/js/bootstrap-toggle.min.js') ?>"></script>

<style>
	body{
		background: #f2f4f5;
	}								
  
	.card {
		position: relative;
		display: flex;
		flex-direction: column;
		min-width: 0;
		word-wrap: break-word;
		background-color: #fff;
		background-clip: border-box;
		border: 0 solid transparent;
		border-radius: .25rem;
	}
</style>
<div id="graph" style="height:200px;"></div>
<script type="text/javascript">
	<?php if($is_graph) : ?>
		var chart = Morris.Line({
			element: 'graph',
			data: [<?= $graph_data;?>],
			xkey: 'time',
			ykeys: [<?= $graph_fields;?>],
			labels: [<?= $graph_fields;?>],
			resize: true
		});
	<?php endif ?>
</script>