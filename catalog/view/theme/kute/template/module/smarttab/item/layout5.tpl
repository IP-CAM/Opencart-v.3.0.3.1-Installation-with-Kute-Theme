<?php foreach($products as $product){ ?>
<li class="col-sm-<?php echo $setting['li_col_sm']?>">
	<div class="right-block">
		<h5 class="product-name">
			<a href="<?php echo $product['href']; ?>">
				<?php 
					if (strlen($product['name']) > 20) {
						$trimstring = substr($product['name'], 0, 20);
					} else {
						$trimstring = $product['name'];
					}echo $trimstring;
				?>
			</a>
		</h5>
		<div class="content_price">
			<?php if($product['special']){ ?>
			<span class="price product-price"><?php echo $product['special']?></span>
			<span class="price old-price"><?php echo $product['price']?></span>

			<?php } else { ?>
			<span class="price product-price"><?php echo $product['price']?></span>
			<?php } ?>
		</div>
	</div>
	<div class="left-block">
		<a href="<?php echo $product['href']; ?>">
			<img class="img-responsive" alt="product" src="<?php echo $product['thumb']?>" />
		</a>
		<div class="quick-view">
            <a title="<?php echo (isset($button_wishlist) ? $button_wishlist : '#'); ?>" class="heart" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"></a>
            <a title="<?php echo (isset($button_compare) ? $button_compare : '#'); ?>" class="compare" onclick="compare.add('<?php echo $product['product_id']; ?>');"></a>
            <a title="Quick view" class="search quickview" href="javascript:quickview.view(<?php echo $product['product_id']; ?>);" data-product-id="<?php echo $product['product_id']; ?>"></a>
		</div>
		<div class="add-to-cart">
			<a title="<?php echo $translator->_('Add to Cart')?>" onclick="cart.add('<?php echo $product['product_id']; ?>');"><?php echo $translator->_('Add to Cart')?></a>
		</div>
	</div>
</li>
<?php } ?>
