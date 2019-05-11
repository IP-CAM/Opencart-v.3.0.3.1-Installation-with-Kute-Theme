<?php echo $header; ?>
<div id="columns" class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <?php if ($attention) { ?>
  <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $attention; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
      <h2 class="page-heading no-line">
            <span class="page-heading-title2">
                <?php echo $heading_title; ?>
            </span>
        </h2>
      <div class="page-content page-order">
          <ul class="step">
            <li class="current-step"><span><?php echo $translator->_('01. Summary'); ?></span></li>
            <li><span><?php echo $translator->_('02. Sign in'); ?></span></li>
            <li><span><?php echo $translator->_('03. Address'); ?></span></li>
            <li><span><?php echo $translator->_('04. Shipping'); ?></span></li>
            <li><span><?php echo $translator->_('05. Payment'); ?></span></li>
          </ul>
          <script type="text/javascript">
            jQuery(document).ready(function(){
              var number = jQuery("span.notify-left").text();
              jQuery("span.count_cart").html(number);
            })
          </script>
          <div class="heading-counter warning"><?php echo $translator->_('Your shopping cart contains: '); ?>
            <span><span class="count_cart"></span> <?php echo $translator->_('Product'); ?></span>
          </div>  
          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
            <div class="order-detail-content">
              <table class="table table-bordered table-responsive cart_summary">
                <thead>
                  <tr>
                    <th class="text-left cart_product"><?php echo $column_image; ?></th>
                    <th class="text-left"><?php echo $column_name; ?></th>
                    <th class="text-left"><?php echo $translator->_('Avail.'); ?></th>
                    <th class="text-left"><?php echo $column_quantity; ?></th>
                    <th class="text-left"><?php echo $column_price; ?></th>
                    <th class="text-left"><?php echo $column_total; ?></th>
                    <th class="action"><i class="fa fa-trash-o"></i></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($products as $product) { ?>
                  <tr>
                    <td class="cart_product"><?php if ($product['thumb']) { ?>
                      <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>"/></a>
                      <?php } ?></td>
                    <td class="text-left cart_description"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                      
                      <?php if ($product['option']) { ?>
                      <?php foreach ($product['option'] as $option) { ?>
                      <br />
                      <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
                      <?php } ?>
                      <?php } ?>
                      <?php if ($product['reward']) { ?>
                      <br />
                      <small><?php echo $product['reward']; ?></small>
                      <?php } ?>
                      <?php if ($product['recurring']) { ?>
                      <br />
                      <span class="label label-info"><?php echo $text_recurring_item; ?></span> <small><?php echo $product['recurring']; ?></small>
                      <?php } ?></td>
                    <td class="text-left cart_avail">
                        <?php if (!$product['stock']) { ?>
                          <span class="label label-success"><?php echo $translator->_('Not in stock'); ?></span>
                          <?php }else{ ?>
                            <span class="label label-success"><?php echo $translator->_('In stock'); ?></span>
                          <?php } ?>
                    </td>
                    <td class="text-left"><div class="input-group btn-block" style="max-width: 200px;">
                        <input type="text" name="quantity[<?php echo (isset($product['key']) ? $product['key'] : $product['cart_id']); ?>]" value="<?php echo $product['quantity']; ?>" size="1" class="form-control" />
                        <span class="input-group-btn">
                        <button type="submit" data-toggle="tooltip" title="<?php echo $button_update; ?>" class="btn btn-primary"><i class="fa fa-refresh"></i></button>
                        </span>
                    </div></td> 
                    <td class="text-right"><?php echo $product['price']; ?></td>
                    <td class="text-right"><?php echo $product['total']; ?></td>
                    <td class="action"><a title="<?php echo $button_remove; ?>" onclick="cart.remove('<?php echo (isset($product['key']) ? $product['key'] : $product['cart_id']); ?>');"></a></td>
                  </tr>
                  <?php } ?>
                  <?php foreach ($vouchers as $vouchers) { ?>
                  <tr>
                    <td></td>
                    <td class="text-left"><?php echo $vouchers['description']; ?></td>
                    <td class="text-left"></td>
                    <td class="text-left"><div class="input-group btn-block" style="max-width: 200px;">
                        <input type="text" name="" value="1" size="1" disabled="disabled" class="form-control" />
                        <span class="input-group-btn"><button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger" onclick="voucher.remove('<?php echo $vouchers['key']; ?>');"><i class="fa fa-times-circle"></i></button></span></div></td>
                    <td class="text-right"><?php echo $vouchers['amount']; ?></td>
                    <td class="text-right"><?php echo $vouchers['amount']; ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
                <tfoot>
                    <?php foreach ($totals as $total) { ?>
                        <tr>
                            <td colspan="6"><?php echo $total['title']; ?>:</td>
                            <td colspan="1"><?php echo $total['text']; ?></td>
                        </tr>
                    <?php } ?>
                </tfoot>
              </table>
            </div>
          </form>
          
          <br />
          
          <div class="cart_navigation">
            <a href="<?php echo $continue; ?>" class="prev-btn"><?php echo $button_shopping; ?></a>
            <a href="<?php echo $checkout; ?>" class="next-btn"><?php echo $button_checkout; ?></a>
          </div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?> 