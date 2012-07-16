<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="<?php echo base_url("js/jquery.js"); ?>"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url("css/bootstrap.css"); ?>" />
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

			
		</div>
	</body>
	<script>
		$(document).ready(function() {

		});
	</script>
</html>

