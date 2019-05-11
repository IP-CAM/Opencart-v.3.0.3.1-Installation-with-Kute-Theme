<div class="deal-product">
	<div class="deal-product-head">
		<h3><span>Deals of The Day</span></h3>
	</div>
	<ul class="owl-carousel" data-items="1" data-nav="<?php echo (count($products) > 1 ? 'true' : 'false')?>" data-dots="false">
		<?php echo $products_list_html ?>
	</ul>
</div>