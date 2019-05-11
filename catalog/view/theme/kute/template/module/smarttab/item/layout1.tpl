<?php foreach($products as $product){ ?>
<li>
	<div class="left-block">
		<a href="<?php echo $product['href']; ?>">
			<img class="img-responsive" alt="product" src="<?php echo $product['thumb']?>" /></a>
		<div class="quick-view">
			<a title="<?php echo (isset($button_wishlist) ? $button_wishlist : '#'); ?>" class="heart" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"></a>
			<a title="<?php echo (isset($button_compare) ? $button_compare : '#'); ?>" class="compare" onclick="compare.add('<?php echo $product['product_id']; ?>');"></a>
            <a title="Quick view" class="search quickview" href="javascript:quickview.view(<?php echo $product['product_id']; ?>);" data-product-id="<?php echo $product['product_id']; ?>"></a>
		</div>
		<div class="add-to-cart">
			<a title="Add to Cart" onclick="cart.add('<?php echo $product['product_id']; ?>');"><?php echo $translator->_('Add to Cart')?></a>
		</div>
        <div class="group-price">
            <?php if($product['is_new']){ ?>
            <span class="product-new"><?php echo $translator->_('NEW')?></span>
            <?php } ?>
            <?php if($product['special']){ ?>
            <span class="product-sale"><?php echo $translator->_('Sale')?></span>
            <?php } ?>
        </div>
	</div>
	<div class="right-block">
		<h5 class="product-name"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']?></a></h5>
		<div class="content_price">
			<?php if($product['special']){ ?>
			<span class="price product-price"><?php echo $product['special']?></span>
			<span class="price old-price"><?php echo $product['price']?></span>
			
			<?php } else { ?>
			<span class="price product-price"><?php echo $product['price']?></span>
			<?php } ?>
		</div>
		<?php if ($product['rating']) { ?>
		<div class="product-star">
			<?php for ($i = 1; $i <= 5; $i++) { ?>
		        <?php if ($product['rating'] < $i) { ?>
		        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span>
		        <?php } else { ?>
		        <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span>
		        <?php } ?>
	        <?php } ?>
		</div>
		<?php } ?>
	</div>
</li>
<?php } ?>