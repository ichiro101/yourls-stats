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
					<li class="active">
						<?php echo anchor("home/index", "Home"); ?>
					</li>
					<li>
						<?php echo anchor("link_stat/all", "Aggregate Statistics"); ?>
					</li>
				</ul>
			<div class="container">
			</div>
			</div>
			</div>

			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Name</th>
						<th>Target url</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($urls as $url): ?>
						<tr>
							<td><?php echo $url->keyword; ?></td>
							<td><?php echo $url->url; ?></td>
							<td><?php echo anchor("link_stat/link_stats/" . xss_clean($url->keyword), "View Stats", array("class" => "btn")); ?></td>
						</tr>
					<?php endforeach;?>
				</tbody>
			</table>
		</div>
	</body>
</html>
