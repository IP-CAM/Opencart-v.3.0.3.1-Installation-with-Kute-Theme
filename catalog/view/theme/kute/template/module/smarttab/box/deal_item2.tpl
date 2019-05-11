<?php foreach($products as $product) { ?>
<li class="deal-product-content">
	<div class="col-sm-5 deal-product-image">
		<a href="<?php echo $product['href']?>"><img src="<?php echo $product['thumb']?>" alt="<?php echo $product['name']?>"></a>
	</div>
	<div class="col-sm-7 deal-product-info">
		<p><a href="#"><?php echo $product['name']?></a></p>
		<div class="price">
			<?php if($product['special']){ ?>
			<span class="price product-price"><?php echo $product['special']?></span>
			<span class="price old-price"><?php echo $product['price']?></span>

			<?php } else { ?>
			<span class="price product-price"><?php echo $product['price']?></span>
			<?php } ?>
			<span  class="sale-price"><?php echo $product['special_percent']?>%</span>
		</div>
		<div class="show-count-down">
			<span class="countdown-lastest" data-y="<?php echo $product['date_end_array'][0]?>" data-m="<?php echo $product['date_end_array'][1]?>" data-d="<?php echo $product['date_end_array'][2]?>" data-h="00" data-i="00" data-s="00"></span>
		</div>
		<div class="product-star">
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star-half-o"></i>
		</div>
		<div class="product-desc">
			Sound performance tuning includes the smallest details like...
		</div>
	</div>
</li>
<?php } ?>
