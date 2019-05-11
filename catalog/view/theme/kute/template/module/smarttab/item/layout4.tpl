<?php foreach($products as $product){ ?>
<li>
    <div class="left-block">
        <a href="<?php echo $product['href']; ?>"><img class="img-responsive" alt="product" src="<?php echo $product['thumb']?>" /></a>
        <div class="quick-view">
            <a title="Add to my wishlist" class="heart" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"></a>
            <a title="Add to compare" class="compare" onclick="compare.add('<?php echo $product['product_id']; ?>');"></a>
            <a title="Quick view" class="search quickview" href="javascript:quickview.view(<?php echo $product['product_id']; ?>);"></a>
        </div>
        <div class="add-to-cart">
            <a title="Add to Cart" href="<?php echo $product['href']; ?>"><?php echo $translator->_('Add to Cart')?></a>
        </div>
    </div>
    <div class="right-block">
        <h5 class="product-name"><a href="<?php echo $product['href']; ?>">
                <?php
                if (strlen($product['name']) > 20) {
                    $trimstring = substr($product['name'], 0, 20);
                } else {
                    $trimstring = $product['name'];
                }echo $trimstring;
                ?>
            </a></h5>
        <div class="content_price">
            <?php if($product['special']){ ?>
                <span class="price product-price"><?php echo $product['special']?></span>
                <span class="price old-price"><?php echo $product['price']?></span>
            <?php } else { ?>
                <span class="price product-price"><?php echo $product['price']?></span>
            <?php } ?>
        </div>
    </div>
    <?php if (!empty($product['special_percent'])) { ?>
    <div class="price-percent-reduction2">
        -<?php echo $product['special_percent']?>%<?php echo $translator->_('OFF')?>
    </div>
    <?php } ?>
</li>
<?php } ?>