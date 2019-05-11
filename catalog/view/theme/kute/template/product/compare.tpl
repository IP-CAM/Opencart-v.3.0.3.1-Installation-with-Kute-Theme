<?php echo $header; ?>
<div id="columns" class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
    <h2 class="page-heading"><span class="page-heading-title"><?php echo $heading_title; ?></span></h2>
  <div class="row margin-top"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?> page-content"><?php echo $content_top; ?>
      <?php if ($products) { ?>
      <table class="table table-bordered table-compare">
        <tbody>
          <tr>
            <td class="compare-label"><?php echo $text_image; ?></td>
            <?php foreach ($products as $product) { ?>
            <td class="text-center" style="display:table-cell"><?php if ($products[$product['product_id']]['thumb']) { ?>
              <img src="<?php echo $products[$product['product_id']]['thumb']; ?>" alt="<?php echo $products[$product['product_id']]['name']; ?>" title="<?php echo $products[$product['product_id']]['name']; ?>"/>
              <?php } ?></td>
            <?php } ?>
          </tr>  
          <tr>
            <td class="compare-label"><?php echo $text_name; ?></td>
            <?php foreach ($products as $product) { ?>
            <td><a href="<?php echo $products[$product['product_id']]['href']; ?>"><strong><?php echo $products[$product['product_id']]['name']; ?></strong></a></td>
            <?php } ?>
          </tr>
          <?php if ($review_status) { ?>
          <tr>
            <td class="compare-label"><?php echo $text_rating; ?></td>
            <?php foreach ($products as $product) { ?>
            <td>
               <div class="product-star"> 
                  <?php for ($i = 1; $i <= 5; $i++) { ?>
                  <?php if ($products[$product['product_id']]['rating'] < $i) { ?>
                  <span class="fa fa-stack"><i class="fa fa-star-o "></i></span>
                  <?php } else { ?>
                  <span class="fa fa-stack"><i class="fa fa-star"></i></span>
                  <?php } ?>
                  <?php } ?>
                  <span>(<?php echo $products[$product['product_id']]['reviews']; ?>)</span>
                <?php } ?>
               </div>
             </td>
           </tr>
          <?php } ?>
          <tr>
            <td class="compare-label"><?php echo $text_price; ?></td>
            <?php foreach ($products as $product) { ?>
            <td><?php if ($products[$product['product_id']]['price']) { ?>
              <?php if (!$products[$product['product_id']]['special']) { ?>
              <?php echo $products[$product['product_id']]['price']; ?>
              <?php } else { ?>
              <span class="price-old"><?php echo $products[$product['product_id']]['price']; ?> </span> <span class="price-new price"> <?php echo $products[$product['product_id']]['special']; ?> </span>
              <?php } ?>
              <?php } ?></td>
            <?php } ?>
          </tr>
          <tr>
            <td class="compare-label"><?php echo $text_model; ?></td>
            <?php foreach ($products as $product) { ?>
            <td><?php echo $products[$product['product_id']]['model']; ?></td>
            <?php } ?>
          </tr>
          <tr>
            <td class="compare-label"><?php echo $text_manufacturer; ?></td>
            <?php foreach ($products as $product) { ?>
            <td><?php echo $products[$product['product_id']]['manufacturer']; ?></td>
            <?php } ?>
          </tr>
          <tr>
            <td class="compare-label"><?php echo $text_availability; ?></td>
            <?php foreach ($products as $product) { ?>
            <td><?php echo $products[$product['product_id']]['availability']; ?></td>
            <?php } ?>
          </tr>
          
          <tr>
            <td class="compare-label"><?php echo $text_summary; ?></td>
            <?php foreach ($products as $product) { ?>
            <td class="description"><?php echo $products[$product['product_id']]['description']; ?></td>
            <?php } ?>
          </tr>
          <tr>
            <td class="compare-label"><?php echo $text_weight; ?></td>
            <?php foreach ($products as $product) { ?>
            <td><?php echo $products[$product['product_id']]['weight']; ?></td>
            <?php } ?>
          </tr>
          <tr>
            <td class="compare-label"><?php echo $text_dimension; ?></td>
            <?php foreach ($products as $product) { ?>
            <td><?php echo $products[$product['product_id']]['length']; ?> x <?php echo $products[$product['product_id']]['width']; ?> x <?php echo $products[$product['product_id']]['height']; ?></td>
            <?php } ?>
          </tr>
        </tbody>
        <?php foreach ($attribute_groups as $attribute_group) { ?>
        <thead>
          <tr>
            <td colspan="<?php echo count($products) + 1; ?>"><strong><?php echo $attribute_group['name']; ?></strong></td>
          </tr>
        </thead>
        <?php foreach ($attribute_group['attribute'] as $key => $attribute) { ?>
        <tbody>
          <tr>
            <td><?php echo $attribute['name']; ?></td>
            <?php foreach ($products as $product) { ?>
            <?php if (isset($products[$product['product_id']]['attribute'][$key])) { ?>
            <td><?php echo $products[$product['product_id']]['attribute'][$key]; ?></td>
            <?php } else { ?>
            <td></td>
            <?php } ?>
            <?php } ?>
          </tr>
        </tbody>
        <?php } ?>
        <?php } ?>
        <tbody>
        <tr>
          <td>Action</td>
          <?php foreach ($products as $product) { ?>
          <td class="action">
            <input type="button" value="<?php echo $button_cart; ?>" class="add-cart button button-sm" onclick="cart.add('<?php echo $product['product_id']; ?>');" />
            <button class="button button-sm" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart-o"></i></button>
            <a href="<?php echo $product['remove']; ?>" class="button button-sm"><i class="fa fa-times"></i></a>
          </td>
          <?php } ?>
        </tr>
        </tbody>
      </table>
      <?php } else { ?>
      <p><?php echo $text_empty; ?></p>
      <div class="buttons">
        <div class="pull-right"><a href="<?php echo $continue; ?>" class="btn btn-default"><?php echo $button_continue; ?></a></div>
      </div>
      <?php } ?>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>