<div class="page-top">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-9 page-top-left">
				<div class="popular-tabs">
					<ul class="nav-tab">
						<?php $i = 0;?>
						<?php foreach($tabs as $tab) { ?>
						<li class="<?php echo ($i == 0 ? 'active' : '')?>"><a data-toggle="tab" href="#tab-<?php echo $tab['tab_id']?>"><?php echo $tab['title']?></a></li>
						<?php $i++;?>
						<?php } ?>
					</ul>
					<div class="tab-container">
						<?php $i = 0;?>
						<?php foreach($tabs as $tab) { ?>
						<div id="tab-<?php echo $tab['tab_id']?>" class="tab-panel <?php echo ($i == 0 ? 'active' : '')?>">
							<?php echo $tab['content']?>
						</div>
						<?php $i++;?>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-3 page-top-right">
				<div class="latest-deals">
					<h2 class="latest-deal-title"><?php echo $last_deal['title']?></h2>
					<div class="latest-deal-content">
						<?php print_r($last_deal['content']);?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>