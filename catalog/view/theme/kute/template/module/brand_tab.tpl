<div class="container">
	<div class="brand-showcase">
		<h2 class="brand-showcase-title">
			brand showcase
		</h2>
		<div class="brand-showcase-box">
			<ul class="brand-showcase-logo owl-carousel" data-loop="true" data-nav = "true" data-dots="false" data-margin = "1" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":2},"600":{"items":5},"1000":{"items":<?php echo count($manufacturers) ?>}}'>
				<?php $i = 0;?>
				<?php foreach($manufacturers as $brand) { ?>
				<li data-tab="showcase-<?php echo $brand['id']?>" class="item <?php echo ($i == 0 ? 'active' : '')?>"><?php echo $brand['name']?></li>
				<?php $i++;?>
				<?php } ?>
			</ul>
			<div class="brand-showcase-content">
				<?php $i = 0;?>
				<?php foreach($manufacturers as $brand) { ?>
				<div class="brand-showcase-content-tab <?php echo ($i == 0 ? 'active' : '')?>" id="showcase-<?php echo $brand['id']?>">
					<div class="row">
						<div class="col-xs-12 col-sm-4 trademark-info">
							<div class="trademark-logo">
								<a href="#"><img src="<?php echo $brand['image']?>" alt="trademark"></a>
							</div>
							<div class="trademark-desc">
								Whatever the occasion, complete your outfit with one of Hermes Fashion’s stylish women’s bags. Discover our spring collection.
							</div>
							<a href="<?php echo $brand['href']?>" class="trademark-link">shop this brand</a>
						</div>
						<div class="col-xs-12 col-sm-8 trademark-product">
							<div class="row">
								<?php foreach($brand['products'] as $product) { ?>
								<div class="col-xs-12 col-sm-6 product-item">
									<div class="image-product hover-zoom">
										<a href="<?php echo $product['href']?>"><img class="img-repon" src="<?php echo $product['thumb']?>" alt=""></a>
									</div>
									<div class="info-product">
										<a href="<?php echo $product['href']?>">
											<h5><?php echo $product['name']?></h5>
										</a>
										<span class="product-price"><?php echo $product['price']?></span>
										
										<div class="product-star">
										<?php if ($product['rating']) { ?>
											<?php for ($i = 1; $i <= 5; $i++) { ?>
										        <?php if ($product['rating'] < $i) { ?>
										        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
										        <?php } else { ?>
										        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
										        <?php } ?>
									        <?php } ?>
									    <?php } ?>
										</div>
										
										<a class="btn-view-more" title="View More" href="<?php echo $product['href']?>">View More</a>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<?php $i++;?>
				<?php } ?>
			</div>
		</div>

	</div>
</div>