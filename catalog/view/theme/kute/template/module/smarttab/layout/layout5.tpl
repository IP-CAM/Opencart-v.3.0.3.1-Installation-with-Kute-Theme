<div class="content-page">
	<div class="container">
		<div class="category-featured <?php echo (!empty($color_id) ? $color_id : 'red')?>">
			<nav class="navbar nav-menu show-brand">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-brand"><a href="#"><i class="fa fa-1x <?php echo $icon_id?>"></i><?php echo $setting['name']?></a></div>
					<span class="toggle-menu"></span>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav">
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
			<div class="product-featured clearfix">
				<div class="row">
					<div class="col-sm-2 sub-category-wapper">
						<ul class="sub-category-list">
							<?php foreach($sub_categories as $subcategory) { ?>
							<li><a href="<?php echo $subcategory['href']?>"><?php echo $subcategory['name']?></a></li>
							<?php } ?>
						</ul>
					</div>
					<?php if(isset($modules['box']['brand'])){ ?>
						<?php echo $data['modules']['box']['brand']['content'] ?>
					<?php } ?>
					<div class="col-sm-<?php echo $setting_module['box_col_sm']?> col-right-tab">
						<div class="product-featured-tab-content">
							<div class="tab-container">
								<?php $i = 0;?>
								<?php foreach($modules['tabs'] as $key => $tab) { ?>
								<div class="tab-panel <?php echo ($i == 0 ? 'active' : '')?>" id="tab-<?php echo $tab['tab_id'] ?>">
									<?php if(!isset($modules['box']['brand'])){ ?>
										<div class="box-left">
											<?php if(!isset($modules['box']['deal'])){ ?>
											<!--<div class="banner-img">
												<a href="#"><img src="catalog/view/theme/kute/images/data/banner-product1.jpg" alt="Banner Product"></a>
											</div>-->
												<?php if(!empty($banner['left']['src'])){ ?>
												<div class="banner-img">
													<a href="<?php echo $banner['left']['link']?>"><img src="<?php echo $banner['left']['src'] ?>" alt="Banner Product"></a>
												</div>
												<?php } ?>
											<?php } else { ?>
												<?php echo $modules['box']['deal']['content']?>
												<ul class="owl-intab owl-carousel" data-loop="true" data-items="1" data-dots="false" data-nav="true">
													<?php if(isset($banner['top_left']['src'])) { ?>
													<li><a href="<?php echo $banner['top_left']['link']?>"><img src="<?php echo $banner['top_left']['src'] ?>" alt="Image"></a></li>
													<?php } ?>
													<?php if(isset($banner['top_right']['src'])) { ?>
													<li><a href="<?php echo $banner['top_right']['link']?>"><img src="<?php echo $banner['top_right']['src'] ?>" alt="Image"></a></li>
													<?php } ?>
												</ul>
											<?php } ?>
										</div>
										<div class="box-right">
											<?php echo $tab['content']; ?>
										</div>
									<?php } else { ?>
										<div class="row">
											<div class="col-sm-12 category-list-product">
												<?php echo $tab['content']; ?>
											</div>
										</div>
									<?php } ?>
								</div>
								<?php $i++;?>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>