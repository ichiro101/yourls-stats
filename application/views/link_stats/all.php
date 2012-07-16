<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="<?php echo base_url("js/jquery.js"); ?>"></script>
		<script type="text/javascript" src="<?php echo base_url("js/jquery-ui.js"); ?>"></script>
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
						<li class="active">
							<?php echo anchor("link_stat/all", "Aggregate Statistics"); ?>
						</li>
					</ul>
				</div>
			</div>

			<div class="well form-inline">
				<label class="checkbox">
					<input id="all" type="checkbox" checked="checked"> Show all
				</label>
				<input type="text" id="before-date" class="input-medium">
				<input type="text" id="after-date" class="input-medium">
				<button type="submit" class="btn">Select Date</button>
			</div>
		</div>
	</body>
	<script>
		$(document).ready(function() {
			var today = new Date();

			$("#before-date").datepicker({
				maxDate: today,
				onSelect: function(selectDate) {
					$("#after-date").datepicker("option", "minDate", selectDate);
				}
			});

			$("#after-date").datepicker({
				maxDate: today,
				onSelect: function(selectDate) {
					$("#before-date").datepicker("option", "maxDate", selectDate);
				}
			});
		});
	</script>
</html>

