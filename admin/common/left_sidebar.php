 <!-- START SECONDARY CONTENT -->    
			<div class="secondary_content">
				<!-- START SIDEBAR -->
				<div class="sidebar">
				<h1 class="h1">quick links </h1>
				<ul style="padding:0px; margin:0px;">
			<?php foreach($hlink as $hrow) : ?>
					<li><a href="<?= $hrow['quicklink_url'] ?>" style="text-decoration:none" title="<?= $hrow['quicklink_title'] ?>" target="_blank"><?= ucwords($hrow['quicklink_name']) ?></a></li>
			<?php endforeach; ?>
				</ul>
				</div>
			   <!-- END SIDEBAR -->
			  </div>