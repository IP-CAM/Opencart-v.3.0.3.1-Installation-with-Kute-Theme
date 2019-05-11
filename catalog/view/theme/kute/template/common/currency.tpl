<?php if (count($currencies) > 1) { ?>
<div class="currency">
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="currency">
  <div class="dropdown">
    <a class="current-open" data-toggle="dropdown"><?php foreach ($currencies as $currency) { ?><?php if ($currency['symbol_left'] && $currency['code'] == $code) { ?><?php echo $currency['title']; ?><?php } elseif ($currency['symbol_right'] && $currency['code'] == $code) { ?><?php echo $currency['title']; ?><?php } ?><?php } ?></a>
    <ul class="dropdown-menu">
      <?php foreach ($currencies as $currency) { ?>
      <?php if ($currency['symbol_left']) { ?>
      <li class="currency-select" data-code="<?php echo $currency['code']; ?>"><a><?php echo $currency['title']; ?></a></li>
      <?php } else { ?>
      <li class="currency-select" data-code="<?php echo $currency['code']; ?>"><a><?php echo $currency['title']; ?></a></li>
      <?php } ?>
      <?php } ?>
    </ul>
  </div>
  <input type="hidden" name="code" value="" />
  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
</form>
</div>
<?php } ?>
