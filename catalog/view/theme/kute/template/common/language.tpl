<?php if (count($languages) > 1) { ?>
<div class="pull-left language">
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="language">
  <div class="dropdown">
    <a class="current-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
    <?php foreach ($languages as $language) { ?>
    <?php if ($language['code'] == $code) { ?>
    <img src="image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>"><?php echo $language['name']; ?>
    <?php } ?>
    <?php } ?>
    </a>
    <ul class="dropdown-menu">
      <?php foreach ($languages as $language) { ?>
      <li><a href="javascript:;" data-code="<?php echo $language['code']; ?>"><img src="image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>" /> <?php echo $language['name']; ?></a></li>
      <?php } ?>
    </ul>
  </div>
  <input type="hidden" name="code" value="" />
  <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
</form>
</div>
<?php } ?>
