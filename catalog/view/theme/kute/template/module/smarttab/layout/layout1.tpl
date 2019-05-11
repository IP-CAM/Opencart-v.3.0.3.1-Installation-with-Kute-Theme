<div class="content-page">
	<div class="container">
		<!-- featured category fashion -->
		<div class="category-featured">
			<nav class="navbar nav-menu nav-menu-<?php echo (!empty($color_id) ? $color_id : 'red')?> show-brand">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-brand"><a href="#"><i class="fa fa-1x <?php echo $icon_id?>"></i><?php echo $setting['name']?></a></div>
					<span class="toggle-menu"></span>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav">
							<!--<li class="active"><a data-toggle="tab" href="#tab-4">Best Seller</a></li>-->
							<?php $i = 0;?>
							<?php foreach($modules['tabs'] as $key => $tab) { ?>
							<?php if(!isset($tab['title'])) continue; ?>
							<li class="<?php echo ($i == 0 ? 'active' : '')?>"><a data-toggle="tab" href="#tab-<?php echo $tab['tab_id'] ?>"><?php echo $tab['title'] ?></a></li>
							<?php $i++;?>
							<?php } ?>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->

				<div id="elevator-<?php echo $elevator?>" class="floor-elevator">
					<a href="#elevator-<?php echo $elevator_prev++?>" class="btn-elevator up fa fa-angle-up"></a>
					<a href="#elevator-<?php echo $elevator_next++?>" class="btn-elevator down fa fa-angle-down"></a>
				</div>
			</nav>
			<!-- BANNER TOP -->
			<?php if(!empty($banner['top_left']['src']) || !empty($banner['top_right']['src'])){ ?>
			<div class="category-banner">
				<?php if(!empty($banner['top_left']['src'])){ ?>
				<div class="col-sm-6 banner">
					<a href="<?php echo $banner['top_left']['link']?>"><img alt="ads2" width="<?php echo $banner['top_left']['dim']['w'] ?>" height="<?php echo $banner['top_left']['dim']['h'] ?>" class="img-responsive" src="<?php echo $banner['top_left']['src'] ?>" /></a>
				</div>
				<?php } ?>
				<?php if(!empty($banner['top_right'])){ ?>
				<div class="col-sm-6 banner">
					<a href="<?php echo $banner['top_right']['link']?>"><img alt="ads2" width="<?php echo $banner['top_right']['dim']['w'] ?>" height="<?php echo $banner['top_right']['dim']['h'] ?>" class="img-responsive" src="<?php echo $banner['top_right']['src'] ?>" /></a>
				</div>
				<?php } ?>
			</div>
			<?php } ?>
			<div class="product-featured clearfix">
				<!-- BANNER LEFT -->
				<?php if(!empty($banner['left']['src'])){ ?>
				<div class="banner-featured">
					<div class="featured-text"><span><?php echo $translator->_('featured')?></span></div>
					<div class="banner-img">
						<a href="<?php echo $banner['left']['link']?>"><img alt="Featured 1" src="<?php echo $banner['left']['src'] ?>" /></a>
					</div>
				</div>
				<?php } ?>
				<div class="product-featured-content">
					<div class="product-featured-list">
						<div class="tab-container">
							<!-- tab product -->
							<?php $i = 0;?>
							<?php foreach($modules['tabs'] as $key => $tab) { ?>
							<?php if(!isset($tab['title'])) continue; ?>
							<div class="tab-panel <?php echo ($i == 0 ? 'active' : '')?>" id="tab-<?php echo $tab['tab_id']; ?>">
								<?php echo $tab['content']; ?>
							</div>
							<?php $i++;?>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end featured category fashion -->
	</div>
</div>