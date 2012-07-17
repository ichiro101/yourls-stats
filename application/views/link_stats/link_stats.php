<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="<?php echo base_url("js/jquery.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("js/jquery-ui.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("js/moment.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("js/bootstrap.js"); ?>"></script>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript" src="<?php echo base_url("js/application.js"); ?>"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/bootstrap.css"); ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/black-tie/jquery-ui.custom.css"); ?>" />
	</head>
	<body>
		<div class="container-fluid">
			<?php
				// Navigation bar stuff...
			?>
			<div class="navbar">
				<div class="navbar-inner">
					<a class="brand" href="<?php echo site_url('/'); ?>">Yourls Stats</a>
					<ul class="nav">
						<li>
							<?php echo anchor("home/index", "Home"); ?>
						</li>
						<li>
							<?php echo anchor("link_stat/all", "Aggregate Statistics"); ?>
						</li>
					</ul>
				</div>
			</div>

			<div class="well form-inline">
				<span id="datePickers">
					<input type="text" id="before-date" class="input-medium">
					<input type="text" id="after-date" class="input-medium">
					<button id="filter-button" disabled="disabled" type="submit" class="btn">Filter Date</button>
				</div>
			</div>

			<?php if(empty($data)): ?>
			<div class="alert alert-error">
				<p>There are currently no data avaliable to show</p>
			</div>
			<?php else: ?>
				<div id="day-chart" style="width: 1200px; height: 500px;"></div>
				<div id="hour-chart" style="width: 1200px; height: 500px;"></div>
				<div id="country-chart" style="width: 1200px; height: 500px;"></div>
				<div id="country-map" style="width: 1200px; height: 500px;"></div>
			<?php endif; ?>

		</div>
	</body>
	<?php if(!empty($data)): ?>
	<script>
		google.load("visualization", "1", {packages:["corechart", "geochart"]});
		$(document).ready(function() {
			var today = new Date();

			$("#before-date").datepicker({
				maxDate: today,
				onSelect: function(selectDate) {
					$("#after-date").datepicker("option", "minDate", selectDate);
					enableFilterDate();
				}
			});

			$("#after-date").datepicker({
				maxDate: today,
				onSelect: function(selectDate) {
					$("#before-date").datepicker("option", "maxDate", selectDate);
					enableFilterDate();
				}
			});

			var data = <?php echo json_encode($data); ?>;

			analyzeData(data, false);

			$("#filter-button").click(function() {
				analyzeData(data, true);
			});
		});
	</script>
	<?php endif; ?>
</html>


