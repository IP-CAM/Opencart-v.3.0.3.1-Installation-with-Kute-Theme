<?php echo $header; ?>
<div id="columns" class="container">
  <ul class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
    <?php } ?>
  </ul>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div class="center_column col-xs-12 <?php echo $class; ?>" id="center_column">
        <?php echo $content_top; ?>
        <h2 class="page-heading"><span class="page-heading-title"><?php echo $heading_title; ?></span></h2>
        <div class="login">
            <?php echo $description; ?>
            <?php echo $content_bottom; ?>
        </div>
        <?php echo $column_right; ?>
    </div>
  </div>
</div>
<?php echo $footer; ?> 