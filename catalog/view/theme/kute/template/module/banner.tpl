<div class="col-left-slide left-module">
    <ul class="owl-carousel owl-style2" id="banner<?php echo $module; ?>" data-loop="true" data-nav = "false" data-margin = "0" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-items="1" data-autoplay="true">
      <?php foreach ($banners as $banner) { ?>
      <li>
        <?php if ($banner['link']) { ?>
        <a href="<?php echo $banner['link']; ?>"><img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>"/></a>
        <?php } else { ?>
        <img src="<?php echo $banner['image']; ?>" alt="<?php echo $banner['title']; ?>" />
        <?php } ?>
      </li>
      <?php } ?>
    </ul>
</div>
